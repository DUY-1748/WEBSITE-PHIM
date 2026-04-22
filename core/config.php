<?php 
// Đã thay đổi thành thông tin Database trên mạng (freesqldatabase)
$host = 'localhost';      // Thay cho sql12.freesqldatabase.com
$db   = 'sql6464118';    // Tên Database 
$user = 'root';           // Mặc định của XAMPP luôn là root
$pass = '';               // Mặc định của XAMPP là để trống (không có mật khẩu)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; // address
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Hiện lỗi nếu kết nối thất bại
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Trả dữ liệu dạng mảng (Array)
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Tăng tính bảo mật cho SQL

];

try {

     $pdo = new PDO($dsn, $user, $pass, $options);

} catch (\PDOException $e) {
     // Nếu lỗi, dừng chương trình và hiện thông báo
     die("Lỗi kết nối Database: " . $e->getMessage());
} 

