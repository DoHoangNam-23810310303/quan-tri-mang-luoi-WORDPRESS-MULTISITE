BÁO CÁO THỰC HÀNH
Đề tài: Cấu hình WordPress Multisite và Plugin Network Site Stats

Họ và tên: ..................................................
MSSV: .......................................................
Lớp: ........................................................
Ngày thực hiện: .............................................

1. Mục tiêu bài thực hành
1.1. Hiểu mô hình WordPress Multisite (Network).
1.2. Cấu hình hệ thống với wp-config.php và .htaccess.
1.3. Xây dựng plugin hỗ trợ Network Activate để quản lý tập trung.

2. Môi trường thực hiện
2.1. Hệ điều hành: Windows (XAMPP)
2.2. Web server: Apache
2.3. Database: MySQL/MariaDB
2.4. WordPress URL: http://localhost/wordpress
2.5. Thư mục WordPress: C:\xampp\htdocs\wordpress

3. Nội dung thực hiện
3.1. Kích hoạt tính năng Network
3.1.1. Thực hiện
- Mở file wp-config.php.
- Thêm dòng: define( 'WP_ALLOW_MULTISITE', true );
- Vào Tools > Network Setup, chọn Sub-directories, nhấn Install.

3.1.2. Giải thích
- WP_ALLOW_MULTISITE cho phép WordPress hiển thị giao diện tạo mạng lưới site.
- Chế độ Sub-directories tạo site theo dạng localhost/wordpress/site-a.

3.1.3. Ảnh cần dán
- [ẢNH 1] Trang Tools > Network Setup (màn hình tạo network).
- [ẢNH 2] Màn hình WordPress hiển thị 2 khối code sau khi nhấn Install.

3.2. Cập nhật wp-config.php và .htaccess
3.2.1. Thực hiện
- Copy block cấu hình Multisite vào wp-config.php (trước dòng "That's all, stop editing").
- Thay rewrite rules trong .htaccess bằng block do WordPress cung cấp.
- Đăng xuất và đăng nhập lại.

3.2.2. Giải thích code trong wp-config.php
- MULTISITE = true: Bật chế độ network.
- SUBDOMAIN_INSTALL = false: Dùng Sub-directories.
- DOMAIN_CURRENT_SITE, PATH_CURRENT_SITE: Xác định domain và đường dẫn gốc network.
- SITE_ID_CURRENT_SITE, BLOG_ID_CURRENT_SITE: Định danh site chính.

3.2.3. Ảnh cần dán
- [ẢNH 3] Đoạn code Multisite trong wp-config.php sau khi đã cập nhật.
- [ẢNH 4] Nội dung .htaccess rewrite cho Multisite.

3.3. Tạo 2 site con trong Network Admin
3.3.1. Thực hiện
- Vào My Sites > Network Admin > Sites > Add New.
- Tạo site thứ nhất: site-a (tên hiển thị: Site A).
- Tạo site thứ hai: site-b (tên hiển thị: Site B).

3.3.2. Kết quả
- Site ID 1: Website chính.
- Site ID 2: Site A.
- Site ID 3: Site B.

3.3.3. Ảnh cần dán
- [ẢNH 5] Form Add New Site.
- [ẢNH 6] Danh sách Sites hiển thị đủ 3 site (main + Site A + Site B).

3.4. Cài đặt Theme cho toàn mạng lưới
3.4.1. Thực hiện
- Vào Network Admin > Themes.
- Chọn 1 theme (ví dụ: Twenty Twenty-Five).
- Bấm Network Enable.

3.4.2. Kết quả
- Theme được bật cho toàn mạng lưới.

3.4.3. Ảnh cần dán
- [ẢNH 7] Trang Themes hiển thị trạng thái Enabled hoặc link Network Disable ở theme đã bật.

3.5. Lập trình plugin Network Site Stats
3.5.1. Tên plugin
- Network Site Stats

3.5.2. Yêu cầu kỹ thuật đã đáp ứng
- Có khả năng Network Activate (Network: true trong plugin header).
- Thêm menu trong Network Admin.
- Hiển thị bảng thống kê toàn bộ site con gồm: Site ID, Site Name, Post Count, Storage Used, Latest Post Date.
- Sử dụng đúng các hàm: get_sites(), switch_to_blog($blog_id), restore_current_blog().

3.5.3. Giải thích code quan trọng
- Hook network_admin_menu: Tạo menu riêng trong khu vực quản trị mạng lưới.
- get_sites(): Lấy danh sách tất cả site đang tồn tại trong multisite.
- switch_to_blog()/restore_current_blog(): Chuyển context qua từng site để truy vấn đúng dữ liệu, sau đó trả về context cũ.
- wp_count_posts('post'): Đếm bài viết đã publish.
- get_posts(... numberposts = 1 ...): Lấy bài viết mới nhất của từng site.
- get_space_used(): Lấy dung lượng (MB) của mỗi site nếu hệ thống hỗ trợ.

3.5.4. Ảnh cần dán
- [ẢNH 8] Trang Plugins trong Network Admin, plugin Network Site Stats ở trạng thái Network Deactivate (nghĩa là đang active).
- [ẢNH 9] Trang Site Stats hiển thị bảng thống kê 3 site.

4. Kiến trúc dữ liệu Multisite (Database)
4.1. Bảng dùng chung: wp_users, wp_usermeta, wp_blogs, wp_site.
4.2. Bảng riêng từng site: wp_2_posts, wp_3_posts, ...
4.3. Ý nghĩa
- Tài khoản người dùng được quản lý tập trung.
- Nội dung bài viết/trang của mỗi site được tách bảng theo blog_id.

4.4. Ảnh cần dán
- [ẢNH 10] phpMyAdmin hiển thị các bảng wp_2_posts, wp_3_posts.

5. Sản phẩm nộp bài
5.1. File plugin zip: network-site-stats.zip
5.2. Source code plugin: wp-content/plugins/network-site-stats/
5.3. File database: wordpress_db_multisite.sql
5.4. Báo cáo: File Word (.docx) có đầy đủ nội dung và hình ảnh minh chứng.
5.5. Link git: Link repository chứa source code hoàn chỉnh.

6. Kết luận
Bài thực hành đã cấu hình thành công WordPress Multisite theo mô hình Sub-directories trên môi trường localhost. Hệ thống đã tạo được 2 site con (Site A, Site B), kích hoạt theme cho toàn network và triển khai plugin Network Site Stats ở chế độ Network Activate.

Plugin hoạt động đúng yêu cầu: cung cấp trang quản trị tập trung cho Super Admin, hiển thị thống kê từng site (ID, tên site, số bài viết, dung lượng, ngày bài mới nhất). Qua đó, bài làm đáp ứng đầy đủ mục tiêu về cấu hình mạng lưới và lập trình plugin quản lý tập trung trong WordPress Multisite.

7. Hướng dẫn dán ảnh vào Word
7.1. Đặt tên file ảnh theo thứ tự: ANH1.png, ANH2.png, ... ANH10.png.
7.2. Trong Word, đến đúng mục có ghi [ẢNH x] rồi Insert > Pictures chèn đúng ảnh đó.
7.3. Mỗi ảnh nên thêm caption dưới hình theo mẫu: Hình x. Mô tả ngắn gọn.

7.4. Gợi ý caption
- Hình 1. Trang Network Setup trước khi Install.
- Hình 2. Mã cấu hình WordPress cung cấp sau khi Install.
- Hình 3. Cấu hình Multisite trong wp-config.php.
- Hình 4. Rewrite rules Multisite trong .htaccess.
- Hình 5. Form tạo site mới trong Network Admin.
- Hình 6. Danh sách 3 site trong mạng lưới.
- Hình 7. Theme đã được Network Enable.
- Hình 8. Plugin Network Site Stats ở trạng thái Network Active.
- Hình 9. Trang Site Stats hiển thị bảng thống kê.
- Hình 10. Các bảng dữ liệu site con trong phpMyAdmin.
