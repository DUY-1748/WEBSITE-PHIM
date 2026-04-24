<?php 
include_once __DIR__ . '/../core/config.php';
include 'sidebar.php'; 
?>
<div class="main-content">
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3><i class="fas fa-film"></i> Danh sách phim</h3>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Poster</th>
                    <th>Tên Phim</th>
                    <th>Thể loại</th>
                    <th>Rating</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
                <?php
                // Truy vấn danh sách phim
                $result = $pdo->query("SELECT * FROM movies ORDER BY id DESC");
                if ($result && $result->rowCount() > 0):
                    while($row = $result->fetch(PDO::FETCH_ASSOC)): 
                        // Logic xử lý đường dẫn Poster
                        $poster = trim($row['poster_path'] ?? '');
                        $final_url = "";

                        if (!empty($poster)) {
                            if (filter_var($poster, FILTER_VALIDATE_URL)) {
                                $final_url = $poster;
                            } elseif (str_starts_with($poster, '/')) {
                                $final_url = "https://image.tmdb.org/t/p/w500" . $poster;
                            } else {
                                // Kiểm tra nếu là ảnh upload local
                                if (str_contains($poster, 'uploads/')) {
                                    $final_url = "../" . ltrim($poster, '/');
                                } else {
                                    $final_url = "../uploads/posters/" . ltrim($poster, '/');
                                }
                            }
                        }
                ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td>
                            <div style="width: 60px; height: 85px; background: #222; border-radius: 4px; overflow: hidden; display: flex; align-items: center; justify-content: center; border: 1px solid #333;">
                                <?php if (!empty($final_url)): ?>
                                    <img src="<?= $final_url ?>" 
                                         style="width: 100%; height: 100%; object-fit: cover;"
                                         alt="Poster"
                                         onerror="this.onerror=null; this.src='../assets/images/no-poster.png';">
                                <?php else: ?>
                                    <span style="color:#444; font-size:10px;">N/A</span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td style="font-weight: bold; color: var(--primary);">
                            <?= htmlspecialchars($row['title']) ?>
                        </td>

                        <td>
                            <div style="display: flex; flex-wrap: wrap; gap: 5px;">
                                <?php
                                // Lấy danh sách các thể loại của phim này từ bảng trung gian movie_genre
                                $stmt_genres = $pdo->prepare("
                                    SELECT g.name 
                                    FROM genres g 
                                    JOIN movie_genre mg ON g.id = mg.genre_id 
                                    WHERE mg.movie_id = ?
                                ");
                                $stmt_genres->execute([$row['id']]);
                                $genres = $stmt_genres->fetchAll(PDO::FETCH_COLUMN);

                                if (!empty($genres)) {
                                    foreach ($genres as $genre_name) {
                                        echo "<span style='background: #333; color: var(--primary); padding: 2px 8px; border-radius: 10px; font-size: 11px; border: 1px solid #444;'>$genre_name</span>";
                                    }
                                } else {
                                    echo "<span style='color: #666; font-size: 11px;'>Chưa có thể loại</span>";
                                }
                                ?>
                            </div>
                        </td>

                        <td style="color: #f1c40f;">
                            <i class="fas fa-star"></i> <?= $row['rating'] ?>
                        </td>

                        <td>
                            <a href="edit-movie.php?id=<?= $row['id'] ?>" style="color: #3498db; margin-right: 15px; text-decoration:none;">
                                <i class="fas fa-edit"></i> Sửa
                            </a>

                            <a href="process-movie.php?delete=<?= $row['id'] ?>" 
                               onclick="return confirm('Bạn có chắc muốn xóa phim này?')" 
                               style="color: #ff4444; text-decoration:none;">
                                <i class="fas fa-trash"></i> Xóa
                            </a>
                        </td>
                    </tr>
                <?php endwhile; 
                else: ?>
                    <tr><td colspan="6" style="text-align:center;">Chưa có phim nào trong hệ thống</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>