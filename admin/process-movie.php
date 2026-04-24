<?php
// Kết nối database thông qua PDO
include_once __DIR__ . '/../core/config.php';

if (isset($_POST['add_new_movie'])) {
    $title = $_POST['title'];
    $poster_path = $_POST['poster_path'];
    $overview = $_POST['overview'];
    $rating = $_POST['rating'];
    $tmdb_id = null; // Phim tự thêm thủ công mặc định tmdb_id = 0

    try {
        $sql = "INSERT INTO movies (title, poster_path, overview, rating, tmdb_id) 
                VALUES (:title, :poster, :overview, :rating, :tmdb)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title'    => $title,
            ':poster'   => $poster_path,
            ':overview' => $overview,
            ':rating'   => $rating,
            ':tmdb'     => $tmdb_id
        ]);
        header("Location: manage-movies.php?msg=added");
        exit();
    } catch (PDOException $e) {
        die("Lỗi khi thêm phim: " . $e->getMessage());
    }
}

/**
 * 1. XỬ LÝ CẬP NHẬT PHIM
 */
if (isset($_POST['update_movie'])) {
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $overview = $_POST['overview'];
    $rating = $_POST['rating'];
    
    
    try {
        $sql = "UPDATE movies SET 
                title = :title, 
                overview = :overview, 
                rating = :rating 
                WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title'    => $title,
            ':overview' => $overview,
            ':rating'   => $rating,
            ':id'       => $id
        ]);

        // Chuyển hướng về trang quản lý với thông báo thành công
        header("Location: manage-movies.php?msg=updated");
        exit();
        
    } catch (PDOException $e) {
        die("Lỗi cập nhật: " . $e->getMessage());
    }
}

/**
 * 2. XỬ LÝ XÓA PHIM
 */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    try {
        // Trước khi xóa phim, bạn có thể xóa các tập phim liên quan để tránh lỗi khóa ngoại (nếu có)
        $deleteEpisodes = $pdo->prepare("DELETE FROM episodes WHERE movie_id = ?");
        $deleteEpisodes->execute([$id]);

        // Tiến hành xóa phim
        $stmt = $pdo->prepare("DELETE FROM movies WHERE id = ?");
        $stmt->execute([$id]);

        header("Location: manage-movies.php?msg=deleted");
        exit();
        
    } catch (PDOException $e) {
        die("Lỗi xóa dữ liệu: " . $e->getMessage());
    }
}

include_once __DIR__ . '/../core/config.php';

if (isset($_POST['add_movie_action'])) {
    $title = $_POST['title'];
    $author = $_POST['author']; // Lấy tên tác giả
    $overview = $_POST['overview'];
    $rating = $_POST['rating'];
    $genres = $_POST['genres'] ?? []; // Lấy mảng ID thể loại

    // Xử lý upload ảnh
    $poster_url = "";
    if (isset($_FILES['poster_file']) && $_FILES['poster_file']['error'] == 0) {
        $path = "../uploads/posters/";
        if (!is_dir($path)) mkdir($path, 0777, true);
        $filename = time() . "_" . $_FILES['poster_file']['name'];
        if (move_uploaded_file($_FILES['poster_file']['tmp_name'], $path . $filename)) {
            $poster_url = "uploads/posters/" . $filename;
        }
    }

    try {
        $pdo->beginTransaction();

        // CHÚ Ý: Các cột (title, author, overview...) phải tồn tại trong bảng movies của bạn
        $sql = "INSERT INTO movies (title, author, overview, rating, poster_path, tmdb_id) 
                VALUES (?, ?, ?, ?, ?, 0)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $author, $overview, $rating, $poster_url]);
        
        $movie_id = $pdo->lastInsertId();

        // Lưu thể loại vào bảng trung gian
        if (!empty($genres)) {
            $ins_genre = $pdo->prepare("INSERT INTO movie_genre (movie_id, genre_id) VALUES (?, ?)");
            foreach ($genres as $gid) {
                $ins_genre->execute([$movie_id, $gid]);
            }
        }

        $pdo->commit();
        // Chuyển hướng kèm theo tham số status để hiện thông báo
        header("Location: manage-movies.php?status=success");
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        // Nếu lỗi, hãy tạm thời dừng lại để xem thông báo lỗi là gì
        die("Lỗi Database: " . $e->getMessage());
    }
}

// Nếu truy cập trực tiếp file này mà không có hành động cụ thể, đẩy về trang quản lý
header("Location: manage-movies.php");
exit();