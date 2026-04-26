<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Streaming Phim Hiện Đại</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <header class="glass" id="mainHeader">
        <a href= "index.php" class="logo">Làng Phim.</a>

       <ul class="nav-menu">
            <li><a href="index.php?page=home">Trang chủ</a></li>
            <li><a href="loc-phim">Chủ đề</a></li>
            <li class="mega-menu-trigger">
                <a href="#">Thể loại <i class="ph ph-caret-down"></i></a>
                <div class="mega-menu glass">
                    <a href="loc-phim">Hành Động</a>
                    <a href="loc-phim">Tình Cảm</a>
                    <a href="loc-phim">Viễn Tưởng</a>
                    <a href="loc-phim">Kinh Dị</a>
                    <a href="loc-phim">Hoạt Hình</a>
                    <a href="loc-phim">Hài Hước</a>
                    <a href="loc-phim">Tâm Lý</a>
                    <a href="loc-phim">Tài Liệu</a>
                    <a href="loc-phim">Phiêu Lưu</a>
                    <a href="loc-phim">Anime</a>
                    <a href="loc-phim">Thần Thoại</a>
                    <a href="loc-phim">Chiến Tranh</a>
                    <a href="loc-phim">Cổ Trang</a>
                    <a href="loc-phim">Võ Thuật</a>
                    <a href="loc-phim">Trinh Thám</a>
                </div>
            </li>
            <li><a href="#">Lịch chiếu</a></li>
        </ul>

        <div class="nav-actions">
           <form action="index.php" method="GET">
                <div class="search-box">
                    <i class="ph ph-magnifying-glass"
                        style="position: absolute; left: 10px; top: 10px; color: var(--text-secondary);"></i>
                    <input type="text" id="search_input" name="search" placeholder="Tìm kiếm phim, diễn viên...">
                </div>
                <div id="search-suggestions" class="suggestions-dropdown" ></div>
            </form>


            <a href="index.php?page=login" class="btn-gold" id="loginBtn" style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">
             Đăng nhập
            </a>

            <div class="user-menu" id="userMenu">
                <img src="https://i.pravatar.cc/150?img=11" alt="Avatar" class="avatar">
                <div class="user-dropdown glass">
                    <a href="ho-so"><i class="ph ph-user"></i> Trang cá nhân</a>
                    <a href="#"><i class="ph ph-clock-counter-clockwise"></i> Phim đang xem dở (2)</a>
                    <a href="#"><i class="ph ph-bookmark-simple"></i> Phim đã lưu</a>
                    <a href="#"><i class="ph ph-gear"></i> Cài đặt</a>
                    <hr style="border-color: rgba(255,255,255,0.1); margin: 5px 0;">
                    <a href="#" id="logoutBtn" style="color: #ff4e50;"><i class="ph ph-sign-out"></i> Đăng xuất</a>
                </div>
            </div>
        </div>
    </header>

    
                </div> </div> </div> </div> ```