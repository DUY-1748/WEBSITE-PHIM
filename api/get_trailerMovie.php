<?php
require_once '../core/config.php';
require_once 'tmdb_helper.php';

$tmdb_id = $_GET['tmdb_id'] ?? null;

if ($tmdb_id) {
    // 1. Gọi API TMDB lấy trailer (Chỉ 1 phim duy nhất)
    $videoKey = getMovieVideos($tmdb_id);
    
    if ($videoKey) {
        // 2. Cập nhật ngay vào Database để lần sau không phải lấy lại nữa
        $update = $pdo->prepare("UPDATE movies SET video_key = ? WHERE tmdb_id = ?");
        $update->execute([$videoKey, $tmdb_id]);
        
        echo json_encode(['video_key' => $videoKey]);
    } else {
        echo json_encode(['video_key' => null]);
    }
}