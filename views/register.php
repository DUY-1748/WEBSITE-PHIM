<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký | Làng Phim</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Roboto, Arial, sans-serif; }
        body { 
            background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('https://source.unsplash.com/1600x900/?cinema,theater');
            background-size: cover; background-position: center;
            color: #FFFFFF; display: flex; justify-content: center; align-items: center; min-height: 100vh; 
        }
        .auth-container { 
            background-color: rgba(18, 18, 18, 0.95); padding: 40px; border-radius: 12px; 
            width: 100%; max-width: 420px; box-shadow: 0 10px 30px rgba(0,0,0,0.8);
            border: 1px solid rgba(241, 196, 15, 0.1);
        }
        h2 { margin-bottom: 25px; font-size: 28px; font-weight: 800; color: #F1C40F; text-align: center; text-transform: uppercase; letter-spacing: 2px;}
        .form-group { margin-bottom: 18px; position: relative; }
        .form-group i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #888; font-size: 20px; }
        input { 
            width: 100%; padding: 14px 15px 14px 45px; border: 1px solid #333; border-radius: 8px; 
            background-color: #0c0c0c; color: #FFFFFF; font-size: 15px; outline: none; transition: 0.3s; 
        }
        input:focus { border-color: #F1C40F; box-shadow: 0 0 8px rgba(241, 196, 15, 0.2); }
        .btn-submit { 
            width: 100%; padding: 14px; background-color: #F1C40F; color: #000; border: none; 
            border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; 
            text-transform: uppercase; transition: 0.3s; margin-top: 10px;
        }
        .btn-submit:hover { background-color: #d4ac0d; transform: translateY(-2px); }
        .auth-links { margin-top: 25px; color: #888; font-size: 14px; text-align: center; }
        .auth-links a { color: #F1C40F; text-decoration: none; font-weight: bold; margin-left: 5px; }
        .auth-links a:hover { text-decoration: underline; }
        .back-home { display: block; margin-top: 15px; text-align: center; color: #666; text-decoration: none; font-size: 13px; }
    </style>
</head>
<body>
    <div class="auth-container">
        <h2>Đăng Ký</h2>
        <form action="../api/process_register.php" method="POST">
            <div class="form-group">
                <i class="ph ph-identification-card"></i>
                <input type="text" name="full_name" placeholder="Họ và tên" required>
            </div>
            <div class="form-group">
                <i class="ph ph-user"></i>
                <input type="text" name="username" placeholder="Tên đăng nhập" required>
            </div>
            <div class="form-group">
                <i class="ph ph-envelope"></i>
                <input type="email" name="email" placeholder="Địa chỉ Email" required>
            </div>
            <div class="form-group">
                <i class="ph ph-lock"></i>
                <input type="password" name="password" placeholder="Mật khẩu" required>
            </div>
            <div class="form-group">
                <i class="ph ph-lock-key"></i>
                <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu" required>
            </div>
            <button type="submit" class="btn-submit">Tạo tài khoản</button>
        </form>

        <div class="auth-links">
            Đã có tài khoản? <a href="login.php">Đăng nhập ngay.</a>
        </div>
        <a href="../index.php" class="back-home"><i class="ph ph-arrow-left"></i> Quay lại trang chủ</a>
    </div>
</body>
</html>