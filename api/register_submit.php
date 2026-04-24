<?php 
require_once __DIR__ . '/../core/config.php';

if (isset($_POST['register'])) { 
    // Lấy dữ liệu từ Form (nhớ dùng đúng name trong HTML)
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    // Vì bạn không dùng email, mình sẽ lấy username làm full_name tạm thời hoặc để trống
    $full_name = htmlspecialchars(trim($_POST['full_name']));

    if (empty($username) || empty($password)) {
        header("Location: ../index.php?page=register&error=empty_fields");
        exit;
    }

    if ($password !== $confirm_password) {
        header("Location: ../index.php?page=register&error=password_mismatch");
        exit;
    }

    try {
        // Kiểm tra trùng username (Dùng user_id theo đúng ảnh DB của bạn)
        $checkUser = $pdo->prepare("SELECT user_id FROM users WHERE username = ?");
        $checkUser->execute([$username]);
        
        if ($checkUser->fetch()) {
            header("Location: ../index.php?page=register&error=username_taken");
            exit;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // INSERT khớp với 4 cột chính trong ảnh của bạn (user_id tự tăng nên bỏ qua)
        // role kiểu tinyint nên mình để là 0 (tương ứng cho user thường)
        $sql = "INSERT INTO users (username, password, full_name, role) VALUES (?, ?, ?, 0)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $hashed_password, $full_name]);

        header("Location: ../index.php?page=login&success=registered");
        exit;

    } catch (PDOException $e) {
        error_log($e->getMessage());
        die("Lỗi Database: " . $e->getMessage());
        exit;
    }
} else {
    header("Location: ../index.php?page=register");
    exit;
}