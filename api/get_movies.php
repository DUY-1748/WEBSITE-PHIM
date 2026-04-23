<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// header('Content-Type: application/json'); 
require_once '../core/config.php';          
require_once 'tmdb_helper.php';           
set_time_limit(120); 

$totalPages = 5; // Đảm bảo không có ký tự lạ sau dấu chấm phẩy
$allTmdbMovies = [];

for ($i = 1; $i <= $totalPages; $i++) {
    $data = getMovieData('movie/popular', $i);
    
    if (isset($data['results']) && is_array($data['results'])) {
        // Sử dụng toán tử gộp mảng thay vì array_merge trong vòng lặp lớn để tối ưu hơn
        $allTmdbMovies = array_merge($allTmdbMovies, $data['results']);
    }
}

if (!empty($allTmdbMovies)) {
    foreach ($allTmdbMovies as $movie) {
        // 2. Kiểm tra xem phim đã tồn tại trong Database chưa
        $stmt = $pdo->prepare("SELECT id FROM movies WHERE tmdb_id = ?");
        $stmt->execute([$movie['id']]);
        
        if (!$stmt->fetch()) {
            // --- BƯỚC MỚI: Lấy mã Trailer từ TMDB trước khi Insert ---
            $video_key = getMovieVideos($movie['id']); 

            // 3. Insert dữ liệu mới (bao gồm cả backdrop_path và video_key)
            $sql = "INSERT INTO movies (tmdb_id, title, overview, poster_path, backdrop_path, release_date, rating, video_key) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $pdo->prepare($sql);
            
            try {
                $insertStmt->execute([
                    $movie['id'],
                    $movie['title'],
                    $movie['overview'],
                    $movie['poster_path'],
                    $movie['backdrop_path'], 
                    $movie['release_date'] ?: '2024-01-01',
                    $movie['vote_average'],
                    $video_key // Lưu mã YouTube vào đây
                ]);
            } catch (PDOException $e) {
                error_log("Lỗi Insert: " . $e->getMessage());
            }
        }
    }
}

// 4. Trả dữ liệu về cho Frontend (Lúc này dữ liệu đã có video_key)
try {
    $stmt = $pdo->query("SELECT * FROM movies ORDER BY id DESC");
    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($movies);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
exit;