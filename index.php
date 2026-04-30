<?php
/**
 * FILE INDEX ĐÃ FIX LỖI ĐƯỜNG DẪN
 */

// 1. Bắt đầu session ở đầu file để đồng bộ đăng nhập
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Kết nối database
require_once 'core/config.php';

// 3. Lấy tham số 'page' trên thanh URL
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// 4. Nhúng HEADER (Chứa logo, menu và icon người dùng)
include 'includes/header.php';

// 5. XỬ LÝ ĐỊNH TUYẾN (ROUTING) - Chỉ dùng thư mục views
switch ($page) {
    case 'home':
        include 'views/home.php'; 
        break;
    case 'login':
        include 'views/login.php'; 
        break;
    case 'register':
        include 'views/register.php'; 
        break;
    case 'profile':
        include 'views/profile.php'; 
        break;
    case 'category':
    case 'loc-phim':
        include 'views/category.php'; 
        break;
    case 'watch':
        include 'views/movie-detail.php';
        break;
    case 'watching':
        include 'views/watch.php'; // Trang xem phim chứa phần bình luận
        break; 
    case 'search':
        include 'views/search.php';
        break;
    case 'bookmarks':
        include 'views/profile.php'; 
        break;
    default:
        // Nếu không tìm thấy trang, mặc định về home
        if (file_exists("views/$page.php")) {
            include "views/$page.php";
        } else {
            include 'views/home.php';
        }
        break;
}

// 6. Nhúng FOOTER
include 'includes/footer.php';
?>