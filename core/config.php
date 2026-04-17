<?php 
$host = 'localhost';
$db = 'lang_phim_db';
$user = 'root';
$pass = '';
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

