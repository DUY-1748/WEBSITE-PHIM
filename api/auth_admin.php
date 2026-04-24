<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra nếu không có user_id hoặc role không phải 1 thì đẩy ra trang login
if (!isset($_SESSION['user_id']) || (isset($_SESSION['role']) && $_SESSION['role'] != 1)) {
    header("Location: ../index.php?page=login&error=unauthorized");
    exit();
}
?>