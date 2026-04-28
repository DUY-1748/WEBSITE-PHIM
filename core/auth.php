<?php
// Xử lý xác thực người dùng
session_start();

// Nếu chưa đăng nhập thì chuyển về trang login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Nếu muốn kiểm tra quyền admin
// Ví dụ: trong quá trình login bạn đã lưu $_SESSION['role'] = 'admin' hoặc 'user'
if (isset($_SESSION['role']) && $_SESSION['role'] !== 'admin') {
    // Nếu không phải admin thì chuyển về trang chính
    header("Location: index.php");
    exit;
}
?>





