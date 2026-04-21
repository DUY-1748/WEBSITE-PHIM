<?php 
include_once __DIR__ . '/../core/config.php';
include 'sidebar.php'; 
?>

<style>
    .input-field { width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff; margin-bottom: 15px; border-radius: 4px; }
    .msg-success { background: #2ecc71; color: white; padding: 10px; border-radius: 4px; margin-bottom: 15px; text-align: center; }
</style>

<div class="main-content">
    <div class="card">
        <h3><i class="fas fa-plus-circle"></i> Cập Nhật Tập Phim</h3>
        
        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'added'): ?>
            <div class="msg-success">Đã cập nhật tập phim mới thành công vào Database!</div>
        <?php endif; ?>

        <form action="process-episode.php" method="POST">
            <label style="color: #f1c40f; font-size: 14px;">Chọn phim:</label>
            <select name="movie_id" class="input-field" required>
                <option value="">-- Chọn bộ phim --</option>
                <?php
                // Lấy danh sách phim từ database để đổ vào dropdown
                $movies = mysqli_query($conn, "SELECT id, movie_name FROM movies ORDER BY movie_name ASC");
                while($m = mysqli_fetch_assoc($movies)) {
                    echo "<option value='{$m['id']}'>{$m['movie_name']}</option>";
                }
                ?>
            </select>

            <label style="color: #f1c40f; font-size: 14px;">Tập số:</label>
            <input type="text" name="episode_number" class="input-field" placeholder="Ví dụ: 1 hoặc Tập 1" required>
            
            <label style="color: #f1c40f; font-size: 14px;">Link video:</label>
            <input type="text" name="video_url" class="input-field" placeholder="Dán link Youtube/Drive/Server tại đây..." required>

            <button type="submit" name="add_episode" class="btn-submit" style="width: 150px; font-weight: bold;">Cập Nhật</button>
        </form>
    </div>

    <div class="card" style="margin-top: 20px;">
        <h3><i class="fas fa-list"></i> Danh sách tập phim hiện có</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Phim</th>
                    <th>Số Tập</th>
                    <th>Link</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT e.*, m.movie_name FROM episodes e JOIN movies m ON e.movie_id = m.id ORDER BY e.id DESC";
                $res = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><strong><?= $row['movie_name'] ?></strong></td>
                    <td><?= $row['episode_number'] ?></td>
                    <td><a href="<?= $row['video_url'] ?>" target="_blank" style="color: #3498db;">Link xem</a></td>
                    <td>
                        <a href="process-episode.php?delete=<?= $row['id'] ?>" onclick="return confirm('Xóa tập này?')" style="color:#e74c3c;">Xóa</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>