<?php
session_start();
require_once __DIR__ . '/../core/config.php';

if (isset($_POST['update_profile']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    try {
        // 1. Lấy mật khẩu hiện tại trong DB để so sánh
        $stmt = $pdo->prepare("SELECT password FROM users WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();

        // 2. Nếu người dùng nhập mật khẩu mới, bắt đầu quy trình kiểm tra bảo mật
        if (!empty($new_password)) {
            
            // A. Kiểm tra mật khẩu cũ có đúng không
            if (!password_verify($old_password, $user['password'])) {
                header("Location: ../index.php?page=profile&status=old_password_wrong");
                exit();
            }

            // B. Kiểm tra 2 mật khẩu mới có khớp nhau không
            if ($new_password !== $confirm_password) {
                header("Location: ../index.php?page=profile&status=mismatch");
                exit();
            }

            // C. Nếu mọi thứ OK, tiến hành cập nhật
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_stmt = $pdo->prepare("UPDATE users SET full_name = ?, password = ? WHERE user_id = ?");
            $update_stmt->execute([$full_name, $hashed_password, $user_id]);

            // D. ĐĂNG XUẤT NGƯỜI DÙNG (Vì đã đổi mật khẩu)
            session_unset();
            session_destroy();

            // Chuyển về trang login kèm thông báo thành công
            header("Location: ../index.php?page=login&update_status=success");
            exit();

        } else {
            // Trường hợp người dùng CHỈ đổi họ tên, không nhập mật khẩu mới
            $update_stmt = $pdo->prepare("UPDATE users SET full_name = ? WHERE user_id = ?");
            $update_stmt->execute([$full_name, $user_id]);
            
            $_SESSION['full_name'] = $full_name;
            header("Location: ../index.php?page=profile&status=success");
            exit();
        }

    } catch (PDOException $e) {
        error_log($e->getMessage());
        header("Location: ../index.php?page=profile&status=error");
        exit();
    }
} else {
    header("Location: ../index.php?page=login");
    exit();
}