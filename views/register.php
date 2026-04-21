<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký | Làng Phim</title>
    <style>
        /* Sử dụng lại CSS của trang Đăng Nhập để đồng bộ hoàn toàn */
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
        body { background-color: #000000; color: #FFFFFF; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .auth-container { background-color: rgba(18, 18, 18, 0.9); padding: 50px; border-radius: 8px; width: 100%; max-width: 420px; box-shadow: 0 4px 15px rgba(0,0,0,0.5); }
        h2 { margin-bottom: 28px; font-size: 30px; font-weight: bold; color: #F1C40F; text-align: center; text-transform: uppercase; letter-spacing: 1px; }
        .form-group { margin-bottom: 18px; }
        input { width: 100%; padding: 14px 18px; border: 1px solid #333; border-radius: 4px; background-color: #121212; color: #FFFFFF; font-size: 16px; outline: none; transition: 0.3s; }
        input:focus { border-color: #F1C40F; background-color: #1a1a1a; }
        .btn-submit { width: 100%; padding: 14px; background-color: #F1C40F; color: #000000; border: none; border-radius: 4px; font-size: 16px; font-weight: bold; cursor: pointer; margin-top: 15px; text-transform: uppercase; letter-spacing: 1px; transition: 0.3s; }
        .btn-submit:hover { background-color: #d4ac0d; }
        .auth-links { margin-top: 20px; color: #888888; font-size: 14px; text-align: center; }
        .auth-links a { color: #F1C40F; text-decoration: none; font-weight: bold; }
        .auth-links a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="auth-container">
        <h2>Đăng Ký</h2>
        <form>
            <div class="form-group">
                <input type="text" placeholder="Họ và tên" required>
            </div>
            <div class="form-group">
                <input type="email" placeholder="Địa chỉ Email" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Mật khẩu" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Nhập lại mật khẩu" required>
            </div>
            <button type="submit" class="btn-submit">Đăng Ký</button>
        </form>
        <div class="auth-links">
            Đã có tài khoản? <a href="dang-nhap.html">Đăng nhập ngay.</a>
        </div>
    </div>
</body>
</html>
