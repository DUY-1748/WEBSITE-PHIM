<?php
session_start();

// Kiểm tra: Nếu chưa đăng nhập HOẶC không phải là admin (role != 1)
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    // Đuổi về trang chủ hoặc trang báo lỗi
    header("Location: ../index.php?page=login&error=unauthorized");
    exit;
}
?>