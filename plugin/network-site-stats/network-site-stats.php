<?php
/**
 * Plugin Name: Network Site Stats
 * Description: Network admin dashboard page showing quick stats for all sites in a WordPress multisite network.
 * Version: 1.0.0
 * Author: Student
 * Network: true
 * Requires at least: 5.8
 * Requires PHP: 7.4
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!is_multisite()) {
    return;
}

add_action('network_admin_menu', 'nss_register_network_menu');

/**
 * Register menu page inside Network Admin.
 */
function nss_register_network_menu()
{
    add_menu_page(
        __('Network Site Stats', 'network-site-stats'),
        __('Site Stats', 'network-site-stats'),
        'manage_network',
        'network-site-stats',
        'nss_render_network_page',
        'dashicons-chart-bar',
        30
    );
}

/**
 * Render Network Site Stats page.
 */
function nss_render_network_page()
{
    if (!current_user_can('manage_network')) {
        wp_die(esc_html__('You do not have permission to access this page.', 'network-site-stats'));
    }

    $sites = get_sites([
        'number' => 0,
        'deleted' => 0,
        'archived' => 0,
        'spam' => 0,
    ]);

    echo '<div class="wrap">';
    echo '<h1>' . esc_html__('Network Site Stats', 'network-site-stats') . '</h1>';

    if (empty($sites)) {
        echo '<p>' . esc_html__('No sites found in this network.', 'network-site-stats') . '</p>';
        echo '</div>';
        return;
    }

    echo '<table class="widefat striped">';
    echo '<thead><tr>';
    echo '<th>' . esc_html__('Site ID', 'network-site-stats') . '</th>';
    echo '<th>' . esc_html__('Site Name', 'network-site-stats') . '</th>';
    echo '<th>' . esc_html__('Post Count', 'network-site-stats') . '</th>';
    echo '<th>' . esc_html__('Storage Used', 'network-site-stats') . '</th>';
    echo '<th>' . esc_html__('Latest Post Date', 'network-site-stats') . '</th>';
    echo '</tr></thead><tbody>';

    foreach ($sites as $site) {
        $blog_id = (int) $site->blog_id;

        switch_to_blog($blog_id);

        $site_name = get_bloginfo('name');
        $counts = wp_count_posts('post');
        $post_count = isset($counts->publish) ? (int) $counts->publish : 0;

        $storage_used = '-';
        if (function_exists('get_space_used')) {
            $storage_used = number_format_i18n((float) get_space_used(), 2) . ' MB';
        }

        $latest_post = get_posts([
            'post_type' => 'post',
            'post_status' => 'publish',
            'numberposts' => 1,
            'orderby' => 'date',
            'order' => 'DESC',
        ]);

        $latest_post_date = esc_html__('No published posts', 'network-site-stats');
        if (!empty($latest_post)) {
            $latest_post_date = get_the_date('Y-m-d H:i:s', $latest_post[0]->ID);
        }

        restore_current_blog();

        echo '<tr>';
        echo '<td>' . esc_html((string) $blog_id) . '</td>';
        echo '<td>' . esc_html($site_name) . '</td>';
        echo '<td>' . esc_html((string) $post_count) . '</td>';
        echo '<td>' . esc_html($storage_used) . '</td>';
        echo '<td>' . esc_html($latest_post_date) . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
    echo '</div>';
}
