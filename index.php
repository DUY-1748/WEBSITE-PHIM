<?php


// 1. Lấy tham số 'page' trên thanh URL
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// 2. Nhúng HEADER
include 'includes/header.php';



// 3. XỬ LÝ ĐỊNH TUYẾN (ROUTING)
switch ($page) {
    case 'home':
        include 'views/home.php'; 
        break;
    case 'loc-phim':
        include 'views/category.php'; 
        break;
    case 'watch':
        include 'views/movie-detail.php';
        break;
    case 'search';
        include 'views/search.php';
        break;
    default:
        echo '<div style="text-align:center; padding: 100px;"><h2>404 - Không tìm thấy trang!</h2></div>';
        break;
}

// 4. Nhúng FOOTER
include 'includes/footer.php';




?>