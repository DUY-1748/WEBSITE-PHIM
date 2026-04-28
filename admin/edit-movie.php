<?php 
include_once __DIR__ . '/../core/config.php';
include_once __DIR__ . '/../includes/sidebar.php';

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // 1. Lấy thông tin phim
    $stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
    $stmt->execute([$id]);
    $movie = $stmt->fetch();
    
    if (!$movie) {
        die("Không tìm thấy phim!");
    }

    // 2. Lấy tất cả danh sách thể loại để hiển thị checkbox
    $stmt_all_genres = $pdo->query("SELECT * FROM genres ORDER BY name ASC");
    $all_genres = $stmt_all_genres->fetchAll();

    // 3. Lấy các ID thể loại mà phim này hiện đang có
    $stmt_curr = $pdo->prepare("SELECT genre_id FROM movie_genre WHERE movie_id = ?");
    $stmt_curr->execute([$id]);
    $current_genre_ids = $stmt_curr->fetchAll(PDO::FETCH_COLUMN);
}
?>

<div class="main-content">
    <div class="card">
        <h3><i class="fas fa-edit"></i> Chỉnh sửa phim: <?= htmlspecialchars($movie['title']) ?></h3>
        
        <form action="process-movie.php" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
            <input type="hidden" name="id" value="<?= $movie['id'] ?>">

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #ccc;">Tên phim:</label>
                <input type="text" name="title" class="input-field" 
                       value="<?= htmlspecialchars($movie['title']) ?>" 
                       style="width: 100%; padding: 10px; background: #1a1a1a; border: 1px solid #333; color: #fff; border-radius: 4px;" required>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #ccc;">Mô tả (Overview):</label>
                <textarea name="overview" class="input-field" 
                          style="width: 100%; height: 100px; padding: 10px; background: #1a1a1a; border: 1px solid #333; color: #fff; border-radius: 4px; resize: vertical;"><?= htmlspecialchars($movie['overview']) ?></textarea>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #ccc;">Thể loại phim:</label>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 12px; background: #111; padding: 15px; border-radius: 6px; border: 1px solid #333;">
                    <?php foreach ($all_genres as $genre): ?>
                        <label style="display: flex; align-items: center; cursor: pointer; font-size: 13px; color: #bbb; user-select: none;">
                            <input type="checkbox" name="genres[]" value="<?= $genre['id'] ?>" 
                                <?= in_array($genre['id'], $current_genre_ids) ? 'checked' : '' ?>
                                style="margin: 0 8px 0 0; width: 16px; height: 16px; accent-color: var(--primary); cursor: pointer;">
                            <span style="line-height: 1;"><?= htmlspecialchars($genre['name']) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div style="display: flex; gap: 30px; align-items: flex-start; margin-bottom: 25px;">
                <div class="form-group" style="flex: 0 0 150px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #ccc;">Poster:</label>
                    <div style="width: 130px; height: 190px; border-radius: 6px; overflow: hidden; border: 2px solid #333; background: #000;">
                        <?php 
                        $poster = trim($movie['poster_path'] ?? '');
                        // Logic hiển thị ảnh giống trang danh sách để không bị lỗi ảnh local
                        if (filter_var($poster, FILTER_VALIDATE_URL)) { $final_url = $poster; }
                        elseif (str_starts_with($poster, '/')) { $final_url = "https://image.tmdb.org/t/p/w500" . $poster; }
                        else { $final_url = "../uploads/posters/" . ltrim($poster, '/'); }
                        ?>
                        <img src="<?= $final_url ?>" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='../assets/images/no-poster.png';">
                    </div>
                    <input type="file" name="poster_file" style="margin-top: 10px; font-size: 11px; color: #888;">
                </div>

           <div class="form-group" style="flex: 1;">
    <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #ccc;">Điểm đánh giá (Rating):</label>
    <div style="display: flex; align-items: center; gap: 12px;">
        
        <div style="display: flex; align-items: center; background: #1a1a1a; border: 1px solid #333; border-radius: 4px; width: 130px; padding-left: 12px; transition: border-color 0.3s;">
            
            <i class="fas fa-star" style="color: #f1c40f; font-size: 14px; flex-shrink: 0;"></i>
            
            <input type="number" step="0.1" name="rating" min="0" max="10"
                   value="<?= htmlspecialchars($movie['rating']) ?>" 
                   style="padding :28px 0px 10px 10px ;background: transparent; border: none; color: #f1c40f; border-radius: 4px; font-weight: bold; font-size: 16px; outline: none; -moz-appearance: textfield;">
        </div>
        
        <span style="color: #666; font-size: 13px;">/ 10</span>
    </div>
</div>
                    <p style="margin-top: 15px; font-size: 12px; color: #555; font-style: italic;">
                        * Lưu ý: Khi lưu thay đổi, hệ thống sẽ cập nhật lại thông tin phim và danh sách thể loại tương ứng.
                    </p>
                </div>
            </div>

            <hr style="border: 0; border-top: 1px solid #333; margin-bottom: 20px;">

            <button type="submit" name="update_movie" class="btn-submit" 
                    style="background: var(--primary); color: #000; border: none; padding: 12px 30px; border-radius: 4px; font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-save"></i> Lưu thay đổi
            </button>
        </form>
    </div>
</div>