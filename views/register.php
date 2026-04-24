<?php if (isset($_GET['error'])): ?>
    <div class="error-message">
        <?php 
            if ($_GET['error'] == 'username_taken') {
                echo '<p style="color: #ff4d4d; background: rgba(255, 77, 77, 0.1); margin-top : 60px;padding: 10px; border-radius: 8px; font-size: 14px; text-align: center; border: 1px solid #ff4d4d;">
                        <i class="ph ph-warning-circle"></i> Tên tài khoản này đã tồn tại rồi!
                      </p>';
            } elseif ($_GET['error'] == 'empty_fields') {
                echo '<p style="color: #ff4d4d; text-align: center;">Vui lòng điền đầy đủ thông tin.</p>';
            } elseif ($_GET['error'] == 'password_mismatch') {
                echo '<p style="color: #ff4d4d; text-align: center;">Mật khẩu xác nhận không khớp.</p>';
            } elseif ($_GET['error'] == 'system_error') {
                echo '<p style="color: #ff4d4d; text-align: center;">Đã xảy ra lỗi hệ thống. Vui lòng thử lại sau.</p>';
            }
        ?>
    </div>
<?php endif; ?>
<div class="auth-container">
    <div class="auth-box glass">
        <div class="auth-header">
            <h1>Gia nhập Làng Phim</h1>
            <p>Tạo tài khoản để lưu lại những bộ phim yêu thích và nhận thông báo mới nhất.</p>
        </div>

        <form action="api/register_submit.php" method="POST" class="auth-form">
            <div class="input-group">
                <i class="ph ph-user"></i>
                <input type="text" name="username" placeholder="Tên hiển thị của bạn" required>
            </div>

            <div class="input-group">
                <i class="ph ph-identification-card"></i>
                <input type="text" name="full_name" placeholder="Họ và tên của bạn" required>
            </div>


            <div class="input-group">
                <i class="ph ph-lock"></i>
                <input type="password" name="password" placeholder="Mật khẩu" required>
            </div>

            <div class="input-group">
                <i class="ph ph-shield-check"></i>
                <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu" required>
            </div>

            <div class="auth-options">
                <label style="display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" required> 
                    <span>Tôi đồng ý với <a href="#" style="color: var(--primary); text-decoration: underline;">Điều khoản</a></span>
                </label>
            </div>

            <button type="submit" name="register" class="btn-login-submit">
                Tạo Tài Khoản <i class="ph ph-user-plus"></i>
            </button>
        </form>

        <div class="auth-divider">
            <span>Hoặc đăng ký nhanh với</span>
        </div>

        <div class="social-login">
            <button class="btn-google">
                <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google"> Google
            </button>
        </div>

        <div class="auth-footer">
            Đã là thành viên Làng Phim? <a href="index.php?page=login">Đăng nhập ngay</a>
        </div>
    </div>
    <script>
    // Tự động ẩn thông báo lỗi sau 3 giây
    setTimeout(function() {
        let errorBox = document.querySelector('.error-message');
        if (errorBox) {
            errorBox.style.display = 'none';
        }
    }, 10000);
</script>
</div>