<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Của Tôi | Làng Phim</title>
    <style>
        /* CSS CHUNG (Đồng bộ Làng Phim) */
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
        body { background-color: #000000; color: #EEEEEE; } /* Nền đen, chữ xám nhạt */
        
        .profile-container { max-width: 1100px; margin: 50px auto; padding: 20px; }
        h1 { margin-bottom: 35px; font-size: 32px; color: #FFFFFF; font-weight: bold;}
        
        /* Chỉnh style cho Tab (Đồng bộ màu vàng gold) */
        .tabs { display: flex; border-bottom: 2px solid #222; margin-bottom: 30px; }
        .tab-btn { background: none; border: none; color: #AAAAAA; padding: 12px 25px; font-size: 16px; cursor: pointer; transition: 0.3s; margin-right: 5px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;}
        .tab-btn:hover { color: #FFFFFF; background-color: #111; }
        
        /* Tab active dùng màu vàng gold */
        .tab-btn.active { color: #F1C40F; border-bottom: 3px solid #F1C40F; }
        
        /* Chỉnh style cho nội dung Tab */
        .tab-content { display: none; padding: 25px; background-color: #0A0A0A; border-radius: 8px; border: 1px solid #1a1a1a; box-shadow: 0 4px 10px rgba(0,0,0,0.3); }
        .tab-content.active { display: block; animation: fadeIn 0.4s; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        /* Style bên trong các mục */
        .tab-content h2 { color: #FFFFFF; margin-bottom: 20px; font-size: 22px; }
        .info-group { margin-bottom: 20px; }
        .info-group label { display: block; color: #AAAAAA; margin-bottom: 8px; font-size: 14px; }
        
        /* Input tối đồng bộ */
        .info-group input { width: 100%; max-width: 450px; padding: 12px; border-radius: 4px; border: 1px solid #333; background-color: #121212; color: #FFFFFF; font-size: 16px; outline: none; }
        .info-group input:focus { border-color: #F1C40F; }
        .info-group input[readonly] { color: #777777; border-color: #222; cursor: not-allowed; }
        
        /* Movie List */
        .movie-list { display: flex; gap: 20px; flex-wrap: wrap; }
        .movie-card { width: 160px; background-color: #111; padding: 10px; border-radius: 6px; text-align: center; border: 1px solid #1a1a1a; transition: 0.3s; }
        .movie-card:hover { border-color: #F1C40F; transform: translateY(-5px); } /* Highlight màu vàng khi hover phim */
        .movie-card img { width: 100%; height: 230px; object-fit: cover; border-radius: 4px; margin-bottom: 12px; background-color: #333;}
        .movie-card p { color: #FFFFFF; font-size: 14px; font-weight: bold; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .movie-card small { color: #AAAAAA; font-size: 12px; }
        
        /* Gói VIP (Đồng bộ màu vàng gold) */
        .vip-status { padding: 30px; border: 2px solid #F1C40F; border-radius: 8px; display: inline-block; background-color: #0D0D0D; text-align: center;}
        .vip-status h3 { color: #F1C40F; margin-bottom: 15px; font-size: 20px; text-transform: uppercase; letter-spacing: 1px;}
        .vip-status p { color: #FFFFFF; font-size: 16px; line-height: 1.6; }
        .vip-status p strong { color: #F1C40F; }
        
        /* Nút bấm chung màu vàng gold */
        button.action-btn { padding: 12px 24px; background-color: #F1C40F; color: #000000; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; transition: 0.3s; font-size: 14px; }
        button.action-btn:hover { background-color: #d4ac0d; }
        .save-btn-container { margin-top: 10px; }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Cài Đặt Tài Khoản</h1>
        
        <div class="tabs">
            <button class="tab-btn active" onclick="openTab(event, 'thong-tin')">Thông tin cá nhân</button>
            <button class="tab-btn" onclick="openTab(event, 'watchlist')">Phim Đã Lưu</button>
            <button class="tab-btn" onclick="openTab(event, 'lich-su')">Lịch Sử Xem</button>
            <button class="tab-btn" onclick="openTab(event, 'goi-vip')">Hạn Dùng VIP</button>
        </div>

        <div id="thong-tin" class="tab-content active">
            <h2>Hồ sơ của tôi</h2>
            <div class="info-group">
                <label>Họ và Tên</label>
                <input type="text" value="Trường Học"> </div>
            <div class="info-group">
                <label>Email</label>
                <input type="email" value="truonghoc@gmail.com" readonly>
            </div>
            <div class="save-btn-container">
                <button class="action-btn">Cập nhật hồ sơ</button>
            </div>
        </div>

        <div id="watchlist" class="tab-content">
            <h2>Danh sách phim đang theo dõi</h2>
            <div class="movie-list">
                <div class="movie-card">
                    <img src="" alt="Poster"> <p>Avenger: Endgame</p>
                </div>
                <div class="movie-card">
                    <img src="" alt="Poster">
                    <p>Mai (2024)</p>
                </div>
                 <div class="movie-card">
                    <img src="" alt="Poster">
                    <p>Lật Mặt 7</p>
                </div>
            </div>
        </div>

        <div id="lich-su" class="tab-content">
            <h2>Lịch sử xem gần đây</h2>
            <div class="movie-list">
                <div class="movie-card">
                    <img src="" alt="Poster">
                    <p>Vợ Cũ Báo Thù</p> <small>Đang xem tập 3</small>
                 </div>
                 <div class="movie-card">
                    <img src="" alt="Poster">
                    <p>Hành Tinh Cát</p>
                    <small>Đã xem xong</small>
                </div>
            </div>
        </div>

        <div id="goi-vip" class="tab-content">
            <h2>Trạng thái gói dịch vụ</h2>
            <div class="vip-status">
                <h3>Thành viên VIP PREMIUM</h3>
                <p>Kích hoạt: <strong>01/10/2025</strong></p>
                <p>Hết hạn: <strong>01/10/2026</strong></p>
                <p>Còn lại: <strong>166 ngày</strong></p>
                <br>
                <button class="action-btn">Gia hạn gói VIP</button>
            </div>
        </div>

    </div>

    <script>
        function openTab(evt, tabId) {
            var tabContent = document.getElementsByClassName("tab-content");
            for (var i = 0; i < tabContent.length; i++) {
                tabContent[i].style.display = "none";
                tabContent[i].classList.remove("active");
            }

            var tabLinks = document.getElementsByClassName("tab-btn");
            for (var i = 0; i < tabLinks.length; i++) {
                tabLinks[i].className = tabLinks[i].className.replace(" active", "");
            }

            document.getElementById(tabId).style.display = "block";
            document.getElementById(tabId).classList.add("active");
            evt.currentTarget.className += " active";
        }
    </script>
</body>
</html>
