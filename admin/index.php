<?php 
include_once __DIR__ . '/../core/config.php'; 
require_once __DIR__ . '/../core/auth_admin.php';

try {
    // 2. Lấy số liệu dùng PDO (thay cho mysqli cũ)
    $movie_count = $pdo->query("SELECT COUNT(*) FROM movies")->fetchColumn() ?: 0;
    $episode_count = $pdo->query("SELECT COUNT(*) FROM episodes")->fetchColumn() ?: 0;
    $user_count = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn() ?: 0;
    
    // Tính tổng lượt xem (dùng dấu ? để tránh lỗi nếu chưa có phim nào)
    $view_res = $pdo->query("SELECT SUM(views) FROM movies")->fetchColumn();
    $view_count = $view_res ?: 0;

} catch (PDOException $e) {
    // Nếu có lỗi (ví dụ bảng movies chưa có cột views), gán bằng 0 để trang không bị sập
    $movie_count = $episode_count = $user_count = $view_count = 0;
    // Tạm thời comment dòng dưới nếu muốn soi lỗi thật:
    // die("Lỗi DB: " . $e->getMessage()); 
}
include 'sidebar.php'; 
?>

<div class="main-content">
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
        <div class="card" style="text-align: center;">
            <p style="color: var(--text-muted);">Tổng số phim</p>
            <h2 style="color: var(--primary); font-size: 32px;"><?= number_format($movie_count) ?></h2>
        </div>
        <div class="card" style="text-align: center;">
            <p style="color: var(--text-muted);">Tổng số tập</p>
            <h2 style="color: var(--primary); font-size: 32px;"><?= number_format($episode_count) ?></h2>
        </div>
        <div class="card" style="text-align: center;">
            <p style="color: var(--text-muted);">Thành viên</p>
            <h2 style="color: var(--primary); font-size: 32px;"><?= number_format($user_count) ?></h2>
        </div>
        <div class="card" style="text-align: center;">
            <p style="color: var(--text-muted);">Lượt xem</p>
            <h2 style="color: var(--primary); font-size: 32px;"><?= number_format($view_count) ?></h2>
        </div>
    </div>
</div>