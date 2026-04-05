# QUẢN TRỊ MẠNG LƯỚI WORDPRESS MULTISITE

Bài thực hành cấu hình WordPress Multisite (Sub-directories) và xây dựng plugin quản lý tập trung `Network Site Stats`.

Thông tin sinh viên: **Đỗ Hoàng Nam - 23810310303**

## 1. Nội dung repo
- `plugin/network-site-stats/`: Source plugin.
- `plugin/network-site-stats.zip`: Bản zip plugin để cài nhanh.
- `database/wordpress_db_multisite.sql`: File database xuất từ môi trường thực hành.

## 2. Môi trường
- XAMPP (Apache + MySQL)
- WordPress chạy tại: `http://localhost/wordpress`
- PHP: 7.4+

## 3. Cách sử dụng nhanh
### 3.1 Import database
1. Mở `http://localhost/phpmyadmin`
2. Tạo database: `wordpress_db` (nếu chưa có).
3. Chọn tab `Import` và import file:
   - `database/wordpress_db_multisite.sql`

### 3.2 Cài plugin
1. Vào WordPress Network Admin > Plugins.
2. Upload `plugin/network-site-stats.zip` hoặc copy thư mục `plugin/network-site-stats` vào `wp-content/plugins/`.
3. Bấm `Network Activate` cho plugin `Network Site Stats`.

### 3.3 Xem thống kê mạng lưới
- Vào Network Admin > `Site Stats` để xem:
  - Site ID
  - Site Name
  - Post Count
  - Storage Used
  - Latest Post Date

## 4. Ghi chú kỹ thuật
Plugin sử dụng đúng các hàm multisite:
- `get_sites()`
- `switch_to_blog($blog_id)`
- `restore_current_blog()`

## 5. Link repo
- https://github.com/DoHoangNam-23810310303/quan-tri-mang-luoi-WORDPRESS-MULTISITE
