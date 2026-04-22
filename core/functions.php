// Các hàm tiện ích
// 2 sreach function

<?php

// Trong file core/functions.php
require_once __DIR__ . '/../api/get_movies.php';


<?php

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    
    
    $keyword = htmlspecialchars($_GET['search']);
    header("Location: index.php?page=search&query=" . urlencode($keyword));
    exit;
    
    
} else {
    
    header("Location: index.php?error=missing_keyword");
    exit;
}
?>
