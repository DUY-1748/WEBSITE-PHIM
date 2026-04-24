<?php 
include_once __DIR__ . '/../core/config.php';
include 'sidebar.php'; 
?>

<style>
    /* Khung chứa các checkbox */
    .genre-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr); /* Chia 4 cột cho gọn */
        gap: 12px;
        background: #1a1a1a;
        padding: 15px;
        border-radius: 5px;
        border: 1px solid #333;
        margin: 10px 0 20px 0;
    }

    /* CSS quan trọng để sửa lỗi lệch hàng */
    .genre-item {
        color: #ddd;
        font-size: 14px;
        display: flex;            /* Kích hoạt Flexbox */
        align-items: center;      /* Căn giữa checkbox và chữ theo chiều dọc */
        cursor: pointer;
        transition: 0.2s;
        line-height: 1;           /* Đảm bảo chiều cao dòng không gây lệch */
    }

    .genre-item:hover {
        color: var(--primary);
    }

    .genre-item input {
        margin: 0 8px 0 0;        /* Xóa margin thừa, chỉ để margin-right 8px */
        width: 16px;
        height: 16px;
        cursor: pointer;
        accent-color: var(--primary);
        flex-shrink: 0;           /* Không cho checkbox bị bóp méo */
    }

    .form-label {
        color: var(--primary);
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        margin-top: 15px;
    }

    .input-custom {
        margin-bottom: 15px; 
        width: 100%; 
        padding: 12px; 
        background: #222; 
        border: 1px solid #444; 
        color: #fff; 
        border-radius: 5px;
        outline: none;
    }

    .input-custom:focus {
        border-color: var(--primary);
    }

    table img {
        object-fit: cover;
        box-shadow: 0 2px 5px rgba(0,0,0,0.5);
    }
</style>

<div class="main-content">
    <div class="card">
        <h3><i class="fas fa-plus-circle"></i> Thêm Phim Mới</h3>
        
        <form action="process-movie.php" method="POST" enctype="multipart/form-data">
            <label class="form-label">Tên phim:</label>
            <input type="text" name="title" class="input-custom" placeholder="Nhập tên phim..." required>
            
            <label class="form-label">Tác giả / Đạo diễn:</label>
<input type="text" name="author" class="input-custom" placeholder="Nhập tên tác giả hoặc đạo diễn...">
            <label class="form-label">Mô tả nội dung:</label>
            <textarea name="overview" class="input-custom" style="height: 100px; resize: none;" placeholder="Tóm tắt nội dung phim..."></textarea>
            
            <label class="form-label">Chọn Poster phim:</label>
            <input type="file" name="poster_file" required style="margin-bottom:15px; color: #ccc;">
            
            <label class="form-label">Thể loại phim:</label>
            <div class="genre-grid">
                <?php
                // Lấy danh sách thể loại từ bảng genres đã tạo
                $stmt = $pdo->query("SELECT * FROM genres ORDER BY name ASC");
                while ($genre = $stmt->fetch()):
                ?>
                    <label class="genre-item">
                        <input type="checkbox" name="genres[]" value="<?= $genre['id'] ?>">
                        <?= htmlspecialchars($genre['name']) ?>
                    </label>
                <?php endwhile; ?>
            </div>

            <div style="margin-top: 20px; background: #252525; padding: 20px; border-radius: 10px; border-left: 4px solid var(--primary);">
                <label class="form-label" style="margin-top: 0;">
                    <i class="fas fa-star"></i> Điểm Đánh giá: 
                    <span id="ratingDisplay" style="color: var(--primary); font-size: 20px; font-weight: bold; margin-left: 10px;">8.0</span>
                </label>
                <div style="display: flex; align-items: center; gap: 15px; margin-top: 10px;">
                    <span style="color: #666;">0</span>
                    <input type="range" name="rating" min="0" max="10" step="0.1" value="8.0" 
                           style="flex-grow: 1; accent-color: var(--primary); cursor: pointer;" 
                           oninput="document.getElementById('ratingDisplay').innerText = this.value">
                    <span style="color: #666;">10</span>
                </div>
            </div>
            
            <button type="submit" name="add_movie_action" class="btn-submit" style="margin-top: 25px; width: 100%;">
                <i class="fas fa-save"></i> Lưu phim và Cập nhật hệ thống
            </button>
        </form>
    </div>
</div>