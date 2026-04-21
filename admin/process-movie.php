<?php
include_once __DIR__ . '/../core/config.php';

// Xử lý thêm phim
if(isset($_POST['add_movie'])) {
    $name = mysqli_real_escape_string($conn, $_POST['movie_name']);
    $dir = mysqli_real_escape_string($conn, $_POST['director']);
    $genre = isset($_POST['genre']) ? implode(", ", $_POST['genre']) : "";
    
    $file = $_FILES['poster']['name'];
    $tmp_name = $_FILES['poster']['tmp_name'];
    move_uploaded_file($tmp_name, "../assets/img/".$file);

    mysqli_query($conn, "INSERT INTO movies (movie_name, director, genre, poster, views) VALUES ('$name', '$dir', '$genre', '$file', 0)");
    header("Location: manage-movies.php");
}

// Xử lý xóa phim
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM movies WHERE id = $id");
    header("Location: manage-movies.php");
}
// XỬ LÝ CẬP NHẬT PHIM
if (isset($_POST['update_movie'])) {
    $id = intval($_POST['movie_id']);
    $name = mysqli_real_escape_string($conn, $_POST['movie_name']);
    $director = mysqli_real_escape_string($conn, $_POST['director']);
    $genres = isset($_POST['genre']) ? implode(", ", $_POST['genre']) : "";

    // 1. Cập nhật các thông tin chữ trước
    $sql = "UPDATE movies SET movie_name='$name', director='$director', genre='$genres' WHERE id=$id";
    mysqli_query($conn, $sql);

    // 2. Kiểm tra nếu có upload poster mới
    if ($_FILES['poster']['name'] != "") {
        $poster = $_FILES['poster']['name'];
        $tmp_name = $_FILES['poster']['tmp_name'];
        
        // Upload file mới
        move_uploaded_file($tmp_name, "../assets/img/" . $poster);
        
        // Cập nhật tên file vào DB
        mysqli_query($conn, "UPDATE movies SET poster='$poster' WHERE id=$id");
    }

    header("Location: manage-movies.php?msg=updated");
}
?>