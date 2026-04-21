<?php
include_once __DIR__ . '/../core/config.php';

// Xử lý thêm/cập nhật tập phim
if (isset($_POST['add_episode'])) {
    $movie_id = intval($_POST['movie_id']);
    $episode_number = mysqli_real_escape_string($conn, $_POST['episode_number']); 
    $video_url = mysqli_real_escape_string($conn, $_POST['video_url']);

    // Câu lệnh INSERT vào bảng episodes
    $sql = "INSERT INTO episodes (movie_id, episode_number, video_url) 
            VALUES ('$movie_id', '$episode_number', '$video_url')";
    
    if (mysqli_query($conn, $sql)) {
        // Sau khi lưu thành công, quay lại trang quản lý và gửi kèm thông báo
        header("Location: manage-episodes.php?msg=added");
        exit();
    } else {
        die("Lỗi SQL: " . mysqli_error($conn)); 
    }
}

// Xử lý xóa tập phim (Nếu cần)
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM episodes WHERE id = $id");
    header("Location: manage-episodes.php?msg=deleted");
    exit();
}
?>