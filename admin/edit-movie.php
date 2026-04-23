<?php 
include_once __DIR__ . '/../core/config.php';
include 'sidebar.php'; 

// Lấy ID phim cần sửa
if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM movies WHERE id = $id");
    $movie = mysqli_fetch_assoc($result);
    
    // Chuyển chuỗi thể loại thành mảng để kiểm tra checkbox (VD: "Kinh dị, Tâm lý")
    $current_genres = explode(", ", $movie['genre']);
}
?>

<style>
    /* Khung chứa các checkbox */
    .genre-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr); 
        gap: 15px;
        background: #1a1a1a;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #333;
        margin-top: 10px;
    }

    /* CSS để fix lỗi lệch hàng */
    .genre-item {
        display: flex;            /* Ép checkbox và chữ nằm trên 1 hàng */
        align-items: center;      /* Căn giữa theo chiều dọc */
        gap: 10px;                /* Khoảng cách giữa checkbox và chữ */
        color: #ddd;
        font-size: 14px;
        cursor: pointer;
        line-height: 1;           /* Tránh chiều cao dòng làm lệch vị trí */
    }

    .genre-item input[type="checkbox"] {
        width: 17px;
        height: 17px;
        margin: 0;                /* Xóa bỏ margin mặc định của trình duyệt */
        cursor: pointer;
        accent-color: var(--primary); /* Màu vàng */
        flex-shrink: 0;           /* Giữ ô vuông không bị móp */
    }

    .genre-item:hover {
        color: var(--primary);
    }
</style>

<div class="main-content">
    <div class="card">
        <h3><i class="fas fa-edit"></i> Chỉnh Sửa Phim: <?= htmlspecialchars($movie['movie_name']) ?></h3>
        <form action="process-movie.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">

            <label class="form-label">Tên phim:</label>
            <input type="text" name="movie_name" value="<?= htmlspecialchars($movie['movie_name']) ?>" class="input-field" required>

            <label class="form-label">Tác giả / Đạo diễn:</label>
            <input type="text" name="director" value="<?= htmlspecialchars($movie['director']) ?>" class="input-field" required>

            <label class="form-label">Poster hiện tại:</label><br>
            <img src="../assets/img/<?= $movie['poster'] ?>" width="100" style="border-radius:5px; margin-bottom: 10px;">
            <input type="file" name="poster" class="input-field" style="border: none;">
            <small style="color: #888;">(Để trống nếu không muốn thay đổi poster)</small>

            <label class="form-label">Thể loại phim:</label>
            <div class="genre-grid">
                <?php 
                $all_genres = ["Hành động", "Tình cảm", "Kinh dị", "Hoạt hình", "Viễn tưởng", "Võ thuật", "Hài hước", "Tâm lý", "Phiêu lưu", "Thần thoại", "Chiến tranh", "Tài liệu"];
                foreach($all_genres as $g): 
                    $checked = in_array($g, $current_genres) ? "checked" : "";
                ?>
                    <label class="genre-item">
                        <input type="checkbox" name="genre[]" value="<?= $g ?>" <?= $checked ?>> <?= $g ?>
                    </label>
                <?php endforeach; ?>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" name="update_movie" class="btn-submit" style="flex: 1; padding: 12px;">Cập Nhật Thay Đổi</button>
                <a href="manage-movies.php" style="flex: 1; background: #444; color: #fff; text-align: center; padding: 12px; text-decoration: none; border-radius: 5px;">Hủy Bỏ</a>
            </div>
        </form>
    </div>
</div>