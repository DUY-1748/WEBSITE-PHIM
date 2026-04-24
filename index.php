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
    case 'login':
        include 'views/login.php'; 
        break;
    case 'register':
        include 'views/register.php'; 
        break;
    case 'loc-phim':
        include 'views/category.php'; 
        break;
    case 'watch':
        include 'views/movie-detail.php';
        break;
    case 'watching':
        include 'views/watch.php';
    case 'search';
        include 'views/search.php';
        break;
    default:
        include 'views/home.php';
        break;
}


// 4. Nhúng FOOTER
include 'includes/footer.php';
?>