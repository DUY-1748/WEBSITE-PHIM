<div class="auth-container">
    <div class="auth-box glass">
        <div class="auth-header">
            <h1>Chào mừng trở lại!</h1>
            
            <?php 
                // Kiểm tra các lỗi được gửi từ api/login_submit.php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'account_locked') {
                        echo '<p style="color: #ff4d4d; background: rgba(255, 77, 77, 0.1); padding: 10px; border-radius: 8px; font-size: 14px; text-align: center; border: 1px solid #ff4d4d; margin-bottom: 15px;">
                                <i class="ph ph-lock-laminated"></i> Tài khoản của bạn đã bị khóa bởi Admin. Vui lòng liên hệ hỗ trợ!
                              </p>';
                    } elseif ($_GET['error'] == 'invalid_credentials') {
                        echo '<p style="color: #ff4d4d; background: rgba(255, 77, 77, 0.1); padding: 10px; border-radius: 8px; font-size: 14px; text-align: center; border: 1px solid #ff4d4d; margin-bottom: 15px;">
                                <i class="ph ph-warning-circle"></i> Tên đăng nhập hoặc mật khẩu không chính xác.
                              </p>';
                    }
                }
            ?>

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