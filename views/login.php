<div class="auth-container">
    <div class="auth-box glass">
        <div class="auth-header">
            <h1>Chào mừng trở lại!</h1>
            <p>Đăng nhập để trải nghiệm không gian điện ảnh riêng của bạn.</p>
        </div>

        <form action="api/login_submit.php" method="POST" class="auth-form">
            <div class="input-group">
                <i class="ph ph-envelope"></i>
                <input type="text" name="username" placeholder="Tên người dùng " required>
            </div>

            <div class="input-group">
                <i class="ph ph-lock"></i>
                <input type="password" name="password" placeholder="Mật khẩu" required>
            </div>

            <div class="auth-options">
                <label><input type="checkbox"> Ghi nhớ tôi</label>
                <a href="#">Quên mật khẩu?</a>
            </div>

            <button type="submit" name="login" class="btn-login-submit">
                Đăng Nhập <i class="ph ph-sign-in"></i>
            </button>
        </form>

        <div class="auth-divider">
            <span>Hoặc đăng nhập với</span>
        </div>

        <div class="social-login">
            <button class="btn-google">
                <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google"> Google
            </button>
        </div>

        <div class="auth-footer">
            Bạn mới đến Làng Phim? <a href="index.php?page=register">Đăng ký ngay</a>
        </div>
    </div>
</div>