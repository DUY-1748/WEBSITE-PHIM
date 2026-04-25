<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập | Làng Phim</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        
        body { 
            background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('https://source.unsplash.com/1600x900/?cinema,movie');
            background-size: cover;
            background-position: center;
            color: #FFFFFF; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
        }
        
        .auth-container { 
            background-color: rgba(18, 18, 18, 0.95); 
            padding: 40px; 
            border-radius: 12px; 
            width: 100%; 
            max-width: 400px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
            border: 1px solid rgba(241, 196, 15, 0.1); /* Viền vàng mờ */
        }
        
        h2 { margin-bottom: 25px; font-size: 28px; font-weight: 800; color: #F1C40F; text-align: center; text-transform: uppercase; letter-spacing: 2px;}
        
        .form-group { margin-bottom: 20px; position: relative; }
        
        /* Icon trong input */
        .form-group i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #888; font-size: 20px; }

        input { 
            width: 100%; 
            padding: 14px 15px 14px 45px; 
            border: 1px solid #333; 
            border-radius: 8px; 
            background-color: #0c0c0c; 
            color: #FFFFFF; 
            font-size: 15px; 
            outline: none; 
            transition: 0.3s; 
        }
        input:focus { border-color: #F1C40F; box-shadow: 0 0 8px rgba(241, 196, 15, 0.2); }
        
        .btn-submit { 
            width: 100%; 
            padding: 14px; 
            background-color: #F1C40F; 
            color: #000; 
            border: none; 
            border-radius: 8px; 
            font-size: 16px; 
            font-weight: bold; 
            cursor: pointer; 
            text-transform: uppercase; 
            transition: 0.3s;
        }
        .btn-submit:hover { background-color: #d4ac0d; transform: translateY(-2px); }

        /* Nút Google */
        .auth-divider { text-align: center; margin: 20px 0; color: #666; font-size: 14px; position: relative; }
        .auth-divider::before { content: ""; position: absolute; left: 0; top: 50%; width: 40%; border-bottom: 1px solid #333; }
        .auth-divider::after { content: ""; position: absolute; right: 0; top: 50%; width: 40%; border-bottom: 1px solid #333; }

        .btn-google {
            width: 100%;
            padding: 12px;
            background-color: #fff;
            color: #000;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: 0.3s;
        }
        .btn-google:hover { background-color: #f1f1f1; }
        
        .auth-links { margin-top: 25px; color: #888; font-size: 14px; text-align: center; }
        .auth-links a { color: #F1C40F; text-decoration: none; font-weight: bold; margin-left: 5px; }
        .auth-links a:hover { text-decoration: underline; }

        .back-home { display: block; margin-top: 15px; text-align: center; color: #666; text-decoration: none; font-size: 13px; }
        .back-home:hover { color: #888; }
    </style>
</head>
<body>
    <div class="auth-container">
        <h2>Đăng Nhập</h2>
        
        <form action="../api/process_login.php" method="POST">
            <div class="form-group">
                <i class="ph ph-user"></i>
                <input type="text" name="username" placeholder="Email hoặc Tên người dùng" required>
            </div>
            <div class="form-group">
                <i class="ph ph-lock"></i>
                <input type="password" name="password" placeholder="Mật khẩu" required>
            </div>
            <button type="submit" class="btn-submit">Đăng Nhập</button>
        </form>

        <div class="auth-divider">Hoặc</div>

        <button type="button" class="btn-google">
            <img src="https://img.icons8.com/color/48/000000/google-logo.png" style="width: 20px;" alt="Google">
            Đăng nhập với Google
        </button>

        <div class="auth-links">
            Mới tham gia Làng Phim? <a href="register.php">Đăng ký ngay.</a>
        </div>

        <a href="../index.php" class="back-home"><i class="ph ph-arrow-left"></i> Quay lại trang chủ</a>
    </div>
</body>
</html>