<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json'); 
require_once '../core/config.php';          
require_once 'tmdb_helper.php';           
set_time_limit(120); 

$totalPages = 5; 
$allTmdbMovies = [];

for ($i = 1; $i <= $totalPages; $i++) {
    $data = getMovieData('movie/popular', $i);
    
    if (isset($data['results']) && is_array($data['results'])) {
        
        $allTmdbMovies = array_merge($allTmdbMovies, $data['results']);
    }
}

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
                    $movie['vote_average'],
                    
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