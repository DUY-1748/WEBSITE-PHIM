<?php
include_once __DIR__ . '/../core/config.php';

// Xử lý thêm tập phim
if (isset($_POST['add_episode'])) {
    $movie_id = $_POST['movie_id'];
    $episode_number = $_POST['episode_number']; 
    $video_url = $_POST['video_url'];

    $sql = "INSERT INTO episodes (movie_id, episode_number, video_url) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$movie_id, $episode_number, $video_url])) {
        header("Location: manage-episodes.php?msg=added");
        exit();
    }
}

// Xử lý xóa tập phim
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM episodes WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: manage-episodes.php?msg=deleted");
    exit();
}
?>