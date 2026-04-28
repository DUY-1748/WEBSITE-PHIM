<?php
// Bắt đầu session ở đầu file index để mọi trang con đều dùng được
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kết nối database (Đảm bảo đường dẫn này đúng với cấu trúc của bạn)
require_once 'core/config.php';

// 1. Lấy tham số 'page' trên thanh URL
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// 2. Nhúng HEADER
include 'includes/header.php';

// 3. XỬ LÝ ĐỊNH TUYẾN (ROUTING)
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
        include 'views/profile.php'; // Đã thêm đường dẫn này
        break;
    case 'category':
    case 'loc-phim':
        include 'views/category.php'; 
        break;
    case 'watch':
        include 'views/movie-detail.php';
        break;
    case 'watching':
        include 'views/watch.php';
        break; 
    case 'search':
        include 'views/search.php';
        break;
    case 'bookmarks':
        // tạm thời dùng chung home hoặc profile
        include 'views/profile.php'; 
        break;
    default:
        include 'views/home.php';
        break;
}

// 4. Nhúng FOOTER
include 'includes/footer.php';

$page = $_GET['page'] ?? 'home';

include 'includes/header.php';

switch ($page) {
    case 'search':
        include 'pages/search.php';
        break;
    case 'home':
        include 'pages/home.php';
        break;
    // ... các case khác
    default:
        include 'pages/home.php';
}

?>