<?php
// 1. Sửa lại đường dẫn cho đúng vì file này đang ở trong thư mục core
require_once 'config.php'; 

$username = 'admin';
$password = '123456'; 
$full_name = 'Admin Làng Phim';
$role = 1; 

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    // 2. Đảm bảo biến $pdo được định nghĩa trong config.php
    if (!isset($pdo)) {
        die("Lỗi: Biến kết nối \$pdo không tồn tại. Kiểm tra lại file config.php");
    }

    $sql = "INSERT INTO users (username, password, full_name, role) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $hashed_password, $full_name, $role]);
    
    echo "Chúc mừng Văn Đức! Đã tạo tài khoản Admin thành công trong Database.";
} catch (PDOException $e) {
    echo "Lỗi Database: " . $e->getMessage();
}
?>