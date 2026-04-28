<?php 
// Đã thay đổi thành thông tin Database trên mạng (freesqldatabase)
$host = 'localhost';      // Thay cho sql12.freesqldatabase.com
$db   = 'lang_phim_db';    // Tên Database 
$user = 'root';           // Mặc định của XAMPP luôn là root
$pass = '';               // Mặc định của XAMPP là để trống (không có mật khẩu)
$charset = 'utf8mb4';

// 1. Kết nối kiểu MySQLi (Cho các file admin hiện tại)
$conn = mysqli_connect($host, $user, $pass, $db);
mysqli_set_charset($conn, $charset);

if (!$conn) {
    die("Lỗi kết nối MySQLi: " . mysqli_connect_error());
}
// 2. Kết nối kiểu PDO (Cho file get_movies.php và đồng bộ API)
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

