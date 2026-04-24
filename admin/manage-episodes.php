<?php 
include_once __DIR__ . '/../core/config.php';
include 'sidebar.php'; 
?>
<div class="main-content">
    <div class="card">
        <h3><i class="fas fa-plus-circle"></i> Cập Nhật Tập Phim</h3>
        <form action="process-episode.php" method="POST">
            <label style="color: #f1c40f;">Chọn phim:</label>
            <select name="movie_id" class="input-field" required style="width: 100%; padding: 10px; margin-bottom:15px; background:#222; color:#fff;">
                <option value="">-- Chọn bộ phim --</option>
                <?php
                $stmt = $pdo->query("SELECT id, title FROM movies ORDER BY title ASC");
                while($m = $stmt->fetch()) {
                    echo "<option value='{$m['id']}'>".htmlspecialchars($m['title'])."</option>";
                }
                ?>
            </select>
            <input type="text" name="episode_number" placeholder="Ví dụ: Tập 1" class="input-field" required>
            <input type="text" name="video_url" placeholder="Link phim (Iframe/URL)" class="input-field" required>
            <button type="submit" name="add_episode" class="btn-submit">Thêm Tập Phim</button>
        </form>
    </div>
</div>