<?php
// Đảm bảo session được bắt đầu để kiểm tra đăng nhập
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
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
        <a href="index.php" class="logo">Làng Phim.</a>

        <ul class="nav-menu">
            <li><a href="index.php?page=home">Trang chủ</a></li>
            <li><a href="index.php?page=category">Chủ đề</a></li>
            <li class="mega-menu-trigger">
                <a href="#">Thể loại <i class="ph ph-caret-down"></i></a>
                <div class="mega-menu glass">
                    <a href="index.php?page=category&genre=hanh-dong">Hành Động</a>
                    <a href="index.php?page=category&genre=tinh-cam">Tình Cảm</a>
                    <a href="index.php?page=category&genre=vien-tuong">Viễn Tưởng</a>
                    <a href="index.php?page=category&genre=kinh-di">Kinh Dị</a>
                    <a href="index.php?page=category&genre=hoat-hinh">Hoạt Hình</a>
                    <a href="index.php?page=category&genre=hai-huoc">Hài Hước</a>
                    <a href="index.php?page=category&genre=tam-ly">Tâm Lý</a>
                    <a href="index.php?page=category&genre=tai-lieu">Tài Liệu</a>
                    <a href="index.php?page=category&genre=phieu-luu">Phiêu Lưu</a>
                    <a href="index.php?page=category&genre=anime">Anime</a>
                    <a href="index.php?page=category&genre=than-thoai">Thần Thoại</a>
                    <a href="index.php?page=category&genre=chien-tranh">Chiến Tranh</a>
                    <a href="index.php?page=category&genre=co-trang">Cổ Trang</a>
                    <a href="index.php?page=category&genre=vo-thuat">Võ Thuật</a>
                    <a href="index.php?page=category&genre=trinh-tham">Trinh Thám</a>
                </div>
            </li>
            <li><a href="#">Lịch chiếu</a></li>
        </ul>

        <div class="nav-actions">
            <form action="index.php" method="GET">
                <input type="hidden" name="page" value="search">
                <div class="search-box">
                    <i class="ph ph-magnifying-glass" style="position: absolute; left: 10px; top: 10px; color: var(--text-secondary);"></i>
                    <input type="text" id="search_input" name="search" placeholder="Tìm kiếm phim, diễn viên...">
                </div>
                <div id="search-suggestions" class="suggestions-dropdown"></div>
            </form>

          <?php if (isset($_SESSION['user_id'])): ?>
    <div class="user-menu" id="userMenu">
        <div style="display: flex; align-items: center; gap: 10px;">
            <span style="color: white; font-weight: 500; font-size: 14px;">
                <?php echo $_SESSION['username']; ?>
            </span>
            
            <div class="avatar-circle">
                <?php 
                    // Lấy chữ cái đầu tiên của tên (ví dụ: "Nguyen" lấy chữ "N")
                    $firstLetter = strtoupper(substr($_SESSION['username'], 0, 1));
                    echo $firstLetter;
                ?>
            </div>
        </div>
                    
                    <div class="user-dropdown">
                        <a href="index.php?page=profile"><i class="ph ph-user"></i> Trang cá nhân</a>
                        <a href="index.php?page=bookmarks"><i class="ph ph-bookmark-simple"></i> Phim đã lưu</a>
                        <a href="index.php?page=services"><i class="ph ph-crown"></i> Gói dịch vụ</a>
                        <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.1); margin: 5px 0;">
                        <a href="api/logout.php" style="color: #ff4d4d !important;"><i class="ph ph-sign-out"></i> Đăng xuất</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="index.php?page=login" class="btn-gold" id="loginBtn" style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">
                    Đăng nhập
                </a>
            <?php endif; ?>
        </div>
    </header>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('login_status') === 'success' || urlParams.get('success') === 'login') {
            const userData = {
                username: "<?php echo $_SESSION['username'] ?? ''; ?>",
                role: "<?php echo $_SESSION['role'] ?? ''; ?>"
            };

            if (userData.username) {
                sessionStorage.setItem('user', JSON.stringify(userData));
                const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?page=home";
                window.history.replaceState({ path: cleanUrl }, '', cleanUrl);
            }
        }
    </script>