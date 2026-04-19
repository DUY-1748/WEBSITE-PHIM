<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// api/get_movies.php

header('Content-Type: application/json'); // Báo cho js biết đây là dữ liệu JSON
require_once '../core/config.php';          // Kết nối DB
require_once 'tmdb_helper.php';           // File chứa hàm getMovieData (cURL)

// 1. Gọi hàm cURL để lấy phim phổ biến từ TMDB

$Data1 = getMovieData('movie/popular', 1);
$Data2 = getMovieData('movie/popular', 2);
$movies1 = isset($Data1['results']) ? $Data1['results'] : [];
$movies2 = isset($Data2['results']) ? $Data2['results'] : [];

$tmdbData = array_merge($Data1,$Data2);


if (isset($tmdbData['results'])) {
    foreach ($tmdbData['results'] as $movie) {
        // 2. Kiểm tra xem phim này đã có trong MySQL chưa để tránh trùng lặp
        $stmt = $pdo->prepare("SELECT id FROM movies WHERE tmdb_id = ?");
        $stmt->execute([$movie['id']]);
        
        if (!$stmt->fetch()) {
            // 3. Nếu chưa có thì INSERT vào MySQL
            $sql = "INSERT INTO movies (tmdb_id, title, overview, poster_path, release_date, rating) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $insertStmt = $pdo->prepare($sql);
            $insertStmt->execute([
                $movie['id'],
                $movie['title'],
                $movie['overview'],
                $movie['poster_path'],
                $movie['release_date'],
                $movie['vote_average']
            ]);
        }
    }
}

// 4. Cuối cùng, lấy toàn bộ phim từ MySQL để trả về cho Frontend
$stmt = $pdo->query("SELECT * FROM movies ORDER BY created_at DESC");
$allMovies = $stmt->fetchAll();




$stmt = $pdo->query("SELECT * FROM movies ORDER BY created_at DESC");
$movies = $stmt->fetchAll();

header('Content-Type: application/json'); // Đảm bảo header nằm ở đây hoặc đầu file
echo json_encode($movies);
exit;

?>
