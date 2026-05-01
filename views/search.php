<?php
include_once 'core/config.php';

// 1. Lấy từ khóa tìm kiếm 
$search_query = isset($_GET['search']) ? trim($_GET['search']) : ''; 
$results = [];

if (!empty($search_query)) {
    /**
     * 2. SQL Tối ưu:
     * - Tìm trong 'title' và 'overview'.
     * - ORDER BY CASE: Đưa những phim có tên khớp chính xác hoặc khớp từ đầu lên trước để giảm kết quả loãng.
     * - LIMIT 15: Giới hạn 15 kết quả.
     */
    $sql = "SELECT * FROM movies 
            WHERE title LIKE ? OR overview LIKE ? 
            ORDER BY 
                CASE 
                    WHEN title = ? THEN 1             -- Khớp chính xác tên phim
                    WHEN title LIKE ? THEN 2          -- Khớp từ đầu tên phim
                    ELSE 3 
                END, 
                created_at DESC 
            LIMIT 15";

    $stmt = $pdo->prepare($sql);
    $searchTerm = "%$search_query%"; // Tìm chứa từ khóa
    $exactTerm = $search_query;      // Khớp chính xác
    $prefixTerm = "$search_query%";  // Khớp từ đầu

    $stmt->execute([$searchTerm, $searchTerm, $exactTerm, $prefixTerm]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="container" style="padding-top: 100px; min-height: 80vh;">
    <h2 style="margin-bottom: 25px; font-size: 22px;">
        Kết quả cho: <span style="color: var(--primary);">"<?= htmlspecialchars($search_query) ?>"</span>
    </h2>

    <?php if (empty($results)): ?>
        <div style="text-align: center; padding: 80px 20px;">
            <i class="ph ph-magnifying-glass" style="font-size: 64px; opacity: 0.2;"></i>
            <p style="margin-top: 15px; color: #888;">Không tìm thấy phim phù hợp.</p>
        </div>
    <?php else: ?>
        <div class="movie-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 20px;">
            <?php foreach ($results as $movie): 
                $path = $movie['poster_path'];
                
                /**
                 * 3. LOGIC XỬ LÝ ẢNH 2 NGUỒN:
                 */
                if (empty($path)) {
                    $img_url = "assets/images/no-poster.jpg";
                } elseif (strpos($path, 'http') === 0) {
                    // TH1: Nếu là link web đầy đủ
                    $img_url = $path;
                } elseif (strpos($path, '/') === 0 && strlen($path) > 20) {
                    // TH2: Nếu là mã ảnh TMDB (bắt đầu bằng /)
                    // Nối với server ảnh của TMDB
                    $img_url = "https://image.tmdb.org/t/p/w500" . $path;
                } else {
                    // TH3: Nếu là ảnh tự upload (lưu trong thư mục uploads/posters/)
                    // ltrim để xóa dấu / ở đầu nếu có, tránh lỗi // (double slash)
                    $img_url = "uploads/posters/" . ltrim($path, '/');
                }
            ?>
                <a href="index.php?page=movie-detail&id=<?= $movie['id'] ?>" class="movie-card" style="text-decoration: none; color: white; display: block;">
                    <div style="position: relative; border-radius: 8px; overflow: hidden; aspect-ratio: 2/3; background: #1a1a1a; border: 1px solid rgba(255,255,255,0.05);">
                        <img src="<?= $img_url ?>" 
                             style="width:100%; height:100%; object-fit:cover;" 
                             alt="<?= htmlspecialchars($movie['title']) ?>"
                             onerror="this.src='assets/images/no-poster.jpg';">
                        
                        <div style="position: absolute; top: 8px; right: 8px; background: rgba(0,0,0,0.8); padding: 2px 6px; border-radius: 4px; font-size: 11px; display: flex; align-items: center; gap: 4px;">
                            <i class="ph ph-star-fill" style="color: #ffc107;"></i> <?= number_format($movie['rating'], 1) ?>
                        </div>
                    </div>
                    <h4 style="margin-top: 10px; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 500;">
                        <?= htmlspecialchars($movie['title']) ?>
                    </h4>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>