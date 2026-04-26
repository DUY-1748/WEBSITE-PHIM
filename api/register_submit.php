<?php 
require_once __DIR__ . '/../core/config.php';

if (isset($_POST['register'])) { 
    // Lấy dữ liệu từ Form và làm sạch
    $username = htmlspecialchars(trim($_POST['username']));
    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // 1. Kiểm tra các trường trống
    if (empty($username) || empty($password) || empty($full_name)) {
        header("Location: ../index.php?page=register&error=empty_fields");
        exit;
    }

    // 2. Kiểm tra mật khẩu khớp
    if ($password !== $confirm_password) {
        header("Location: ../index.php?page=register&error=password_mismatch");
        exit;
    }

    try {
        // 3. Kiểm tra trùng username
        $checkUser = $pdo->prepare("SELECT user_id FROM users WHERE username = ?");
        $checkUser->execute([$username]);
        
        if ($checkUser->fetch()) {
            header("Location: ../index.php?page=register&error=username_taken");
            exit;
        }

        // 4. Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // 5. Thực hiện lưu vào Database
        // Giả sử role = 0 là người dùng bình thường
        $sql = "INSERT INTO users (username, password, full_name, role) VALUES (?, ?, ?, 0)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $hashed_password, $full_name]);

        // Đăng ký thành công, chuyển hướng sang trang login với thông báo
        header("Location: ../index.php?page=login&success=registered");
        exit;

    } catch (PDOException $e) {
        // Ghi log lỗi vào server thay vì die() để bảo mật thông tin database
        error_log("Lỗi đăng ký: " . $e->getMessage());
        header("Location: ../index.php?page=register&error=system_error");
        exit;
    }
} else {
    header("Location: ../index.php?page=register");
    exit;
}