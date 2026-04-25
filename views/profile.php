<?php
session_start();
require_once '../core/config.php';

// Kiểm tra nếu chưa đăng nhập thì đá về trang login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Lấy thông tin người dùng mới nhất từ Database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_data = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Của Tôi | Làng Phim</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        /* CSS đồng bộ với bộ nhận diện thương hiệu Làng Phim */
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #000000; color: #EEEEEE; min-height: 100vh; }
        
        .profile-container { max-width: 1000px; margin: 40px auto; padding: 20px; }
        h1 { margin-bottom: 30px; font-size: 30px; color: #F1C40F; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; }
        
        /* Tab Navigation */
        .tabs { display: flex; border-bottom: 1px solid #222; margin-bottom: 30px; gap: 10px; }
        .tab-btn { 
            background: none; border: none; color: #888; padding: 12px 20px; 
            font-size: 15px; cursor: pointer; transition: 0.3s; font-weight: 600; 
            text-transform: uppercase; border-bottom: 3px solid transparent;
        }
        .tab-btn:hover { color: #FFFFFF; }
        .tab-btn.active { color: #F1C40F; border-bottom: 3px solid #F1C40F; }
        
        /* Tab Content */
        .tab-content { display: none; animation: fadeIn 0.3s ease-in-out; }
        .tab-content.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

        .card-panel { background-color: #0A0A0A; padding: 30px; border-radius: 12px; border: 1px solid #1a1a1a; }
        .card-panel h2 { color: #FFFFFF; margin-bottom: 25px; font-size: 20px; display: flex; align-items: center; gap: 10px; }
        
        /* Form Info */
        .info-group { margin-bottom: 20px; }
        .info-group label { display: block; color: #777; margin-bottom: 8px; font-size: 13px; font-weight: 600; }
        .info-group input { 
            width: 100%; max-width: 450px; padding: 12px 15px; border-radius: 8px; 
            border: 1px solid #333; background-color: #121212; color: #FFFFFF; 
            font-size: 15px; outline: none; transition: 0.3s;
        }
        .info-group input:focus { border-color: #F1C40F; }
        .info-group input[readonly] { background-color: #080808; color: #555; border-color: #222; }
        
        .action-btn { 
            padding: 12px 25px; background-color: #F1C40F; color: #000; border: none; 
            border-radius: 6px; cursor: pointer; font-weight: bold; text-transform: uppercase; 
            transition: 0.3s; display: flex; align-items: center; gap: 8px;
        }
        .action-btn:hover { background-color: #d4ac0d; transform: scale(1.02); }

        /* Watchlist Grid */
        .movie-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 20px; }
        .movie-card { background-color: #111; border-radius: 8px; overflow: hidden; transition: 0.3s; border: 1px solid #1a1a1a; cursor: pointer; }
        .movie-card:hover { border-color: #F1C40F; transform: translateY(-5px); }
        .movie-card img { width: 100%; height: 220px; object-fit: cover; }
        .movie-card-info { padding: 10px; }
        .movie-card-info p { font-size: 14px; font-weight: bold; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        /* VIP Badge */
        .vip-status-box { 
            padding: 40px; border: 1px dashed #F1C40F; border-radius: 12px; 
            background: linear-gradient(145deg, #0d0d0d, #1a1a1a); text-align: center;
        }
        .vip-status-box i { font-size: 50px; color: #F1C40F; margin-bottom: 15px; }
        .vip-status-box h3 { color: #F1C40F; font-size: 22px; margin-bottom: 10px; }
    </style>
</head>
<body>

    <div class="profile-container">
        <h1><i class="ph ph-user-circle"></i> Cài Đặt Tài Khoản</h1>
        
        <div class="tabs">
            <button class="tab-btn active" onclick="openTab(event, 'thong-tin')">Thông tin</button>
            <button class="tab-btn" onclick="openTab(event, 'watchlist')">Phim Đã Lưu</button>
            <button class="tab-btn" onclick="openTab(event, 'goi-vip')">Gói VIP</button>
        </div>

        <div id="thong-tin" class="tab-content active">
            <div class="card-panel">
                <h2><i class="ph ph-fingerprint"></i> Hồ sơ cá nhân</h2>
                <form action="../api/update_profile.php" method="POST">
                    <div class="info-group">
                        <label>TÊN ĐĂNG NHẬP (KHÔNG THỂ THAY ĐỔI)</label>
                        <input type="text" value="<?php echo $user_data['username']; ?>" readonly>
                    </div>
                    <div class="info-group">
                        <label>HỌ VÀ TÊN</label>
                        <input type="text" name="full_name" value="<?php echo $user_data['full_name']; ?>" required>
                    </div>
                    <div class="info-group">
                        <label>ĐỊA CHỈ EMAIL</label>
                        <input type="email" name="email" value="<?php echo $user_data['email']; ?>" required>
                    </div>
                    <button type="submit" class="action-btn">
                        <i class="ph ph-floppy-disk"></i> Lưu thay đổi
                    </button>
                </form>
            </div>
        </div>

        <div id="watchlist" class="tab-content">
            <div class="card-panel">
                <h2><i class="ph ph-bookmarks"></i> Danh sách phim đã lưu</h2>
                <div class="movie-list">
                    <div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500/or06vS3ST0P36C0PbiS07nz73vY.jpg" alt="Phim">
                        <div class="movie-card-info"><p>Avengers: Endgame</p></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="goi-vip" class="tab-content">
            <div class="card-panel">
                <div class="vip-status-box">
                    <i class="ph ph-crown"></i>
                    <h3>Thành viên: <?php echo ($user_data['role'] == 1) ? 'ADMIN' : 'MEMBER'; ?></h3>
                    <p style="margin-bottom: 20px; color: #888;">Ngày tham gia: <?php echo date('d/m/Y', strtotime($user_data['created_at'])); ?></p>
                    <button class="action-btn" style="margin: 0 auto;">Nâng cấp lên PREMIUM</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openTab(evt, tabId) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.remove("active");
            }
            tablinks = document.getElementsByClassName("tab-btn");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(tabId).classList.add("active");
            evt.currentTarget.classList.add("active");
        }
    </script>
</body>
</html>