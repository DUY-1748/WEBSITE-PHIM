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
        if ($user && password_verify($password, $user['password'])) {
            // Lưu thông tin vào Session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Giá trị 0 hoặc 1 dựa trên bảng của bạn

            // Nếu là Admin (giả sử role = 1), chuyển đến trang quản lý
            if ($_SESSION['role'] == 1) {
                header("Location: ../admin/index.php");
            } else {
                header("Location: ../index.php?page=home&success=login");
            }
            exit;
        } else {
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