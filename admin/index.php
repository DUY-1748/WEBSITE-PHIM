<?php 
include_once __DIR__ . '/../core/config.php'; 
require_once __DIR__ . '/../core/auth_admin.php';

try {
    // 1. Thống kê cơ bản
    $movie_count = $pdo->query("SELECT COUNT(*) FROM movies")->fetchColumn() ?: 0;
    $user_count = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn() ?: 0;
    
    // 2. Thống kê doanh thu VIP (Giả sử role = 2 là User VIP, mỗi gói là 50.000đ)
    // Nếu bạn có bảng thanh toán riêng, hãy thay đổi câu truy vấn này
    $vip_count = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 2")->fetchColumn() ?: 0;
    $total_revenue = $vip_count * 50000; 

    // 3. Tổng lượt xem
    $view_count = $pdo->query("SELECT SUM(views) FROM movies")->fetchColumn() ?: 0;

} catch (PDOException $e) {
    $movie_count = $user_count = $total_revenue = $view_count = 0;
}
include_once __DIR__ . '/../includes/sidebar.php'; 
?>

<div class="main-content">
    <h2 style="margin-bottom: 25px; color: #fff;">Bảng điều khiển hệ thống</h2>
    
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
        
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(52, 152, 219, 0.1); color: #3498db;">
                <i class="fas fa-film"></i>
            </div>
            <div class="stat-info">
                <h3><?= number_format($movie_count) ?></h3>
                <p>Tổng số phim</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(46, 204, 113, 0.1); color: #2ecc71;">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3><?= number_format($user_count) ?></h3>
                <p>Thành viên</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(241, 196, 15, 0.1); color: #f1c40f;">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stat-info">
                <h3><?= number_format($view_count) ?></h3>
                <p>Tổng lượt xem</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(155, 89, 182, 0.1); color: #9b59b6;">
                <i class="fas fa-crown"></i>
            </div>
            <div class="stat-info">
                <h3 style="color: #e74c3c;"><?= number_format($total_revenue) ?>đ</h3>
                <p>Doanh thu VIP</p>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 20px; background: #1e1e1e; border-radius: 12px;">
        <h3><i class="fas fa-chart-line"></i> Biểu đồ tăng trưởng (Demo)</h3>
        <div style="height: 300px; display: flex; align-items: flex-end; gap: 15px; padding-top: 20px;">
            <div class="bar" style="height: 40%; width: 40px; background: var(--primary); border-radius: 5px 5px 0 0;" title="Tháng 1"></div>
            <div class="bar" style="height: 60%; width: 40px; background: var(--primary); border-radius: 5px 5px 0 0;" title="Tháng 2"></div>
            <div class="bar" style="height: 85%; width: 40px; background: var(--primary); border-radius: 5px 5px 0 0;" title="Tháng 3"></div>
            <div class="bar" style="height: 70%; width: 40px; background: var(--primary); border-radius: 5px 5px 0 0;" title="Tháng 4"></div>
        </div>
    </div>
</div>

<style>
.stat-card {
    background: #1e1e1e;
    padding: 20px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 15px;
    border: 1px solid #333;
    transition: transform 0.3s ease;
}
.stat-card:hover { transform: translateY(-5px); }
.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}
.stat-info h3 { margin: 0; font-size: 22px; color: #fff; }
.stat-info p { margin: 5px 0 0; color: #888; font-size: 14px; }
.bar { position: relative; cursor: pointer; }
.bar:hover { opacity: 0.8; }
</style>