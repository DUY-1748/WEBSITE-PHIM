<?php 
include_once __DIR__ . '/../core/config.php'; 
require_once __DIR__ . '/../core/auth_admin.php';

try {
    // Giữ nguyên các biến thống kê cũ
    $movie_count = $pdo->query("SELECT COUNT(*) FROM movies")->fetchColumn() ?: 0;
    $user_count = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn() ?: 0;
    $vip_count = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 2")->fetchColumn() ?: 0;
    $total_revenue = $vip_count * 50000; 
    $view_count = $pdo->query("SELECT SUM(views) FROM movies")->fetchColumn() ?: 0;

    // --- DỮ LIỆU MỚI CHO CÁC BIỂU ĐỒ BỔ SUNG ---

    // 1. Thống kê doanh thu nạp tiền theo tuần (Demo)
    $revenue_weekly_labels = ["Tuần 1", "Tuần 2", "Tuần 3", "Tuần 4"];
    $revenue_weekly_data = [1500000, 2800000, 2100000, 4500000];

    // 2. Thống kê Top Phim (Xem nhiều vs Xem ít)
    // Thực tế: SELECT title, views FROM movies ORDER BY views DESC LIMIT 5
    $top_movies_labels = ["Oppenheimer", "Dune 2", "Exhuma", "Lật Mặt 7", "Mai"];
    $top_movies_views = [15000, 12000, 9500, 8000, 7500];
    
    $least_movies_labels = ["Phim rác 1", "Phim cũ 2", "Demo phim"];
    $least_movies_views = [10, 5, 2];

    // 3. Thống kê bình luận (Top phim được thảo luận nhiều nhất)
    $comment_stats_labels = ["Oppenheimer", "Exhuma", "Mai", "Dune 2", "Avatar"];
    $comment_stats_count = [120, 85, 60, 45, 30];

} catch (PDOException $e) {
    // Xử lý lỗi
}
include_once __DIR__ . '/../includes/sidebar.php'; 
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="main-content">
    <h2 style="margin-bottom: 25px; color: #fff;">Báo cáo chi tiết hệ thống</h2>
    
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 25px;">
        <div class="chart-box">
            <h4><i class="fas fa-chart-line" style="color: #eab308;"></i> Tăng trưởng lượt xem</h4>
            <div style="height: 300px;"><canvas id="growthChart"></canvas></div>
        </div>
        <div class="chart-box">
            <h4><i class="fas fa-chart-pie" style="color: #eab308;"></i> Phân bổ thể loại</h4>
            <div style="height: 300px;"><canvas id="genreChart"></canvas></div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
        <div class="chart-box">
            <h4><i class="fas fa-hand-holding-usd" style="color: #2ecc71;"></i> Doanh thu nạp tiền (VNĐ)</h4>
            <div style="height: 250px;"><canvas id="revenueChart"></canvas></div>
        </div>
        <div class="chart-box">
            <h4><i class="fas fa-comments" style="color: #3498db;"></i> Top thảo luận (Bình luận)</h4>
            <div style="height: 250px;"><canvas id="commentChart"></canvas></div>
        </div>
    </div>

    <div class="chart-box" style="margin-bottom: 25px;">
        <h4><i class="fas fa-film" style="color: #eab308;"></i> Phân tích hiệu suất phim (Lượt xem)</h4>
        <div style="height: 350px;"><canvas id="moviePerformanceChart"></canvas></div>
    </div>
</div>

<style>
    .main-content { padding: 20px; background: #0f1014; min-height: 100vh; color: #fff; }
    .chart-box { background: #1a1c24; padding: 20px; border-radius: 15px; border: 1px solid #2d2f39; }
    .chart-box h4 { margin-top: 0; margin-bottom: 20px; font-size: 16px; font-weight: 500; }
</style>

<script>
Chart.defaults.color = '#888';

// --- BIỂU ĐỒ 1 & 2 (Giữ nguyên cấu trúc bạn đã ổn) ---
new Chart(document.getElementById('growthChart'), {
    type: 'line',
    data: {
        labels: ["Tháng 11", "Tháng 12", "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4"],
        datasets: [{ label: 'Lượt xem', data: [1200, 1900, 3000, 5000, 2000, 4500], borderColor: '#eab308', backgroundColor: 'rgba(234, 179, 8, 0.1)', fill: true, tension: 0.4 }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

new Chart(document.getElementById('genreChart'), {
    type: 'doughnut',
    data: {
        labels: ['Hành động', 'Kinh dị', 'Tình cảm'],
        datasets: [{ data: [55, 25, 20], backgroundColor: ['#eab308', '#3498db', '#e74c3c'], borderWidth: 0 }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

// --- BIỂU ĐỒ 3: Doanh thu nạp tiền (Bar Chart) ---
new Chart(document.getElementById('revenueChart'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($revenue_weekly_labels) ?>,
        datasets: [{
            label: 'VNĐ',
            data: <?= json_encode($revenue_weekly_data) ?>,
            backgroundColor: '#2ecc71',
            borderRadius: 5
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

// --- BIỂU ĐỒ 4: Thống kê bình luận (Horizontal Bar Chart) ---
new Chart(document.getElementById('commentChart'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($comment_stats_labels) ?>,
        datasets: [{
            label: 'Số bình luận',
            data: <?= json_encode($comment_stats_count) ?>,
            backgroundColor: '#3498db',
            borderRadius: 5
        }]
    },
    options: {
        indexAxis: 'y', // Chuyển thành biểu đồ ngang cho dễ đọc tên phim
        responsive: true,
        maintainAspectRatio: false
    }
});

// --- BIỂU ĐỒ 5: Hiệu suất phim (Radar hoặc Grouped Bar) ---
new Chart(document.getElementById('moviePerformanceChart'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($top_movies_labels) ?>,
        datasets: [{
            label: 'Lượt xem cao nhất',
            data: <?= json_encode($top_movies_views) ?>,
            backgroundColor: 'rgba(234, 179, 8, 0.7)',
            borderColor: '#eab308',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: { beginAtZero: true, grid: { color: '#2d2f39' } }
        }
    }
});
</script>