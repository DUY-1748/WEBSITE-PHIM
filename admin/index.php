<?php 
include_once __DIR__ . '/../core/config.php'; 

// Lấy số liệu thực tế từ các bảng
$movie_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM movies"))['total'] ?? 0;
$episode_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM episodes"))['total'] ?? 0;
$user_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'] ?? 0;
$view_res = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(views) as total FROM movies"));
$view_count = $view_res['total'] ?? 0;

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