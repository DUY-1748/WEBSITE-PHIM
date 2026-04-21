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
        <div class="logo">Làng Phim.</div>

       <ul class="nav-menu">
            <li><a href="home">Trang chủ</a></li>
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
            <div class="search-box">
                <i class="ph ph-magnifying-glass"
                    style="position: absolute; left: 10px; top: 10px; color: var(--text-secondary);"></i>
                <input type="text" placeholder="Tìm kiếm phim, diễn viên...">
            </div>

            <button class="btn-gold" id="loginBtn">Đăng nhập</button>

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

    <div class="modal-overlay" id="authModal">
        <div class="auth-modal glass" id="authBox">
            <i class="ph ph-x close-modal" id="closeModal"></i>
            
            <div class="auth-views-container" id="authViews">
                
                <div class="auth-view login-view">
                    <div class="auth-header">
                        <h2>Đăng Nhập</h2>
                        <p style="color: var(--text-secondary); font-size: 14px;">Đăng nhập để xem tiếp phim đang dở</p>
                    </div>

                    <form id="loginForm">
                        <div class="form-group" id="emailGroup">
                            <label>Địa chỉ Email</label>
                            <input type="email" id="emailInput" placeholder="VD: member@moviebasket.com">
                            <div class="error-msg">Email không được để trống</div>
                        </div>
                        <div class="form-group" id="passwordGroup">
                            <label>Mật khẩu</label>
                            <input type="password" id="passInput" placeholder="••••••••">
                            <div class="error-msg">Sai mật khẩu! Hãy thử lại.</div>
                        </div>

                        <button type="submit" class="btn-primary">Đăng Nhập <i class="ph ph-arrow-right"></i></button>
                    </form>

                    <div class="auth-divider">
                        <span style="background: var(--card-bg); padding: 0 10px; color: var(--text-secondary); font-size: 12px; position: relative; z-index: 1;">Hoặc</span>
                    </div>

                    <button class="btn-social">
                        <img src="https://img.icons8.com/color/48/000000/google-logo.png" style="width: 20px;" alt="Google">
                        Đăng nhập với Google
                    </button>

                    <div class="auth-footer">
                        Chưa có tài khoản? <span id="switchToRegister" style="cursor: pointer; color: var(--primary-color);">Đăng ký ngay</span>
                    </div>
                </div>

                <div class="auth-view register-view">
                    <div class="auth-header">
                        <h2>Đăng Ký</h2>
                        <p style="color: var(--text-secondary); font-size: 14px;">Tạo tài khoản để trải nghiệm trọn vẹn</p>
                    </div>
                    
                    <form id="registerForm">
                        <div class="form-group">
                            <label>Tên hiển thị</label>
                            <input type="text" placeholder="VD: Làng Phim User">
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ Email</label>
                            <input type="email" placeholder="VD: member@moviebasket.com">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" placeholder="••••••••">
                        </div>

                        <button type="submit" class="btn-primary">Đăng Ký</button>
                    </form>

                    <div class="auth-footer">
                        Đã có tài khoản? <span id="switchToLogin" style="cursor: pointer; color: var(--primary-color);">Đăng nhập</span>
                    </div>
                </div> </div> </div> </div> ```