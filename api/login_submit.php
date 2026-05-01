<?php
session_start(); // Bắt đầu phiên làm việc
require_once __DIR__ . '/../core/config.php';

if (isset($_POST['login'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        header("Location: ../index.php?page=login&error=empty_fields");
        exit;
    }

    try {
        // Tìm người dùng theo username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // Kiểm tra mật khẩu (Sử dụng password_verify vì mình đã hash lúc đăng ký)
       // ... đoạn kiểm tra user và password_verify thành công ...
if ($user && password_verify($password, $user['password'])) {
    
    // 1. Kiểm tra tài khoản bị khóa
    if (isset($user['status']) && $user['status'] == 0) {
        header("Location: ../index.php?page=login&error=account_locked");
        exit();
    }

    // 2. Lưu Session PHP (Bắt buộc)
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['full_name'] = $user['full_name']; 

    // 3. Chuyển hướng bằng PHP 
    if ($_SESSION['role'] == 1) {
        header("Location: ../admin/index.php");
    } else {
        // Thêm tham số login_status để JS nhận diện
        header("Location: ../index.php?page=home&login_status=success");
    }
    exit;
}  else {
            header("Location: ../index.php?page=login&error=wrong_credentials");
            exit;
        }

    } catch (PDOException $e) {
        error_log($e->getMessage());
        header("Location: ../index.php?page=login&error=system_error");
        exit;
    }
}
?>