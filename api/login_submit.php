<?php
session_start(); // Bắt đầu phiên làm việc
require_once __DIR__ . '/../core/config.php';

if (isset($_POST['login'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    // Kiểm tra các trường rỗng
    if (empty($username) || empty($password)) {
        header("Location: ../index.php?page=login&error=empty_fields");
        exit;
    }

    try {
        // Tìm người dùng theo username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // Kiểm tra sự tồn tại của người dùng và xác thực mật khẩu
        if ($user && password_verify($password, $user['password'])) {
            
            // 1. KIỂM TRA TÀI KHOẢN BỊ KHÓA
            // Nếu cột status trong database bằng 0, chuyển hướng về thông báo lỗi account_locked
            if (isset($user['status']) && $user['status'] == 0) {
                header("Location: ../index.php?page=login&error=account_locked");
                exit();
            }

            // 2. Lưu Session PHP (Đăng nhập thành công)
            $_SESSION['user_id']   = $user['user_id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['role']      = $user['role'];
            $_SESSION['full_name'] = $user['full_name']; 

            // 3. Chuyển hướng theo phân quyền
            if ($_SESSION['role'] == 1) {
                // Nếu là Admin (role = 1) chuyển vào trang quản trị
                header("Location: ../admin/index.php");
            } else {
                // Nếu là User, chuyển về trang chủ kèm tham số success để JS xử lý (nếu có)
                header("Location: ../index.php?page=home&login_status=success");
            }
            exit;

        } else {
            // Sai tên đăng nhập hoặc mật khẩu
            header("Location: ../index.php?page=login&error=invalid_credentials");
            exit;
        }

    } catch (PDOException $e) {
        // Lỗi hệ thống hoặc kết nối Database
        error_log($e->getMessage());
        header("Location: ../index.php?page=login&error=system_error");
        exit;
    }
} else {
    // Chặn truy cập trực tiếp vào file api không qua form
    header("Location: ../index.php?page=login");
    exit;
}
?>