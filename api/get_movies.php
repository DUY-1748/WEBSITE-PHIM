<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json'); 
require_once '../core/config.php';          
require_once 'tmdb_helper.php';           

// 1. Lấy dữ liệu từ 2 trang
$Data1 = getMovieData('movie/popular', 1);
$Data2 = getMovieData('movie/popular', 2);

$movies1 = isset($Data1['results']) ? $Data1['results'] : [];
$movies2 = isset($Data2['results']) ? $Data2['results'] : [];

// GỘP MẢNG RESULTS LẠI VỚI NHAU (Chuẩn nhất)
$allTmdbMovies = array_merge($movies1, $movies2);

if (!empty($allTmdbMovies)) {
    foreach ($allTmdbMovies as $movie) {
        // 2. Kiểm tra trùng lặp
        $stmt = $pdo->prepare("SELECT id FROM movies WHERE tmdb_id = ?");
        $stmt->execute([$movie['id']]);
        
        if (!$stmt->fetch()) {
            // 3. INSERT (ĐÃ SỬA: backdrop_path -> backdrop)
            $sql = "INSERT INTO movies (tmdb_id, title, overview, poster_path, backdrop_path, release_date, rating) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $pdo->prepare($sql);
            
            try {
                $insertStmt->execute([
                    $movie['id'],
                    $movie['title'],
                    $movie['overview'],
                    $movie['poster_path'],
                    $movie['backdrop_path'], // Dữ liệu từ TMDB
                    $movie['release_date'] ?: '2024-01-01',
                    $movie['vote_average']
                ]);
            } catch (PDOException $e) {
                // Nếu lỗi, log ra để debug nhưng không làm chết app
                error_log("Lỗi Insert: " . $e->getMessage());
            }
        }
    }
}

// 4. Lấy dữ liệu từ MySQL trả về cho Frontend
try {
    $stmt = $pdo->query("SELECT * FROM movies ORDER BY id DESC");
    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($movies);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
exit;
?>