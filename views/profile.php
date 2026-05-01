<?php
// Kiểm tra quyền truy cập
if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href='index.php?page=login';</script>";
    exit;
}

// Truy vấn lại database để lấy thông tin mới nhất
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<style>
    .profile-wrapper {
        display: flex; 
        gap: 30px; 
        align-items: flex-start;
    }

    .profile-main-container {
        max-width: 1000px; 
        margin: 100px auto; /* Căn giữa và tạo khoảng cách trên dưới */
        padding: 0 20px;
    }

    /* Xử lý cho điện thoại */
    @media (max-width: 768px) {
        .profile-wrapper {
            flex-direction: column; /* Chuyển thành hàng dọc */
            align-items: center;
        }
        .profile-main-container {
            margin: 20px auto; /* Giảm khoảng cách trên mobile */
        }
        .profile-info-card, .profile-form-card {
            width: 100% !important; /* Chiếm hết chiều ngang */
        }
    }
</style>

<div class="profile-container" style="background: #0b0c10; padding: 20px 0; min-height: 90vh; font-family: sans-serif;">
    <div class="profile-main-container">
        <div class="profile-wrapper">
            
            <div class="profile-info-card" style="flex: 1; background: #1a1d23; border-radius: 15px; padding: 30px; text-align: center; border: 1px solid #333; box-sizing: border-box;">
                <div style="position: relative; display: inline-block;">
                    <div style="width: 100px; height: 100px; border-radius: 50%; background: #ffc107; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; font-size: 40px; color: #000; font-weight: bold;">
                        <?php echo strtoupper(substr($user['full_name'], 0, 1)); ?>
                    </div>
                </div>
                <h2 style="color: #fff; margin: 0 0 5px 0; font-size: 22px;"><?php echo htmlspecialchars($user['full_name']); ?></h2>
                <p style="color: #888; font-size: 14px; margin-bottom: 20px;">@<?php echo htmlspecialchars($user['username']); ?></p>
                <hr style="border: 0; border-top: 1px solid #333; margin: 20px 0;">
                <div style="text-align: left; color: #ccc; font-size: 14px;">
                    <p style="display: flex; align-items: center; gap: 10px;">
                        <span style="color: #ffc107;">🛡️</span> Quyền hạn: <?php echo $user['role'] == 1 ? 'Quản trị viên' : 'Thành viên'; ?>
                    </p>
                </div>
            </div>

            <div class="profile-form-card" style="flex: 2; background: #1a1d23; border-radius: 15px; padding: 30px; border: 1px solid #333; box-sizing: border-box;">
                <h3 style="color: #ffc107; margin: 0 0 25px 0; display: flex; align-items: center; gap: 10px; font-size: 20px;">
                    👤 Cài đặt tài khoản
                </h3>
                
                <form action="api/update_profile.php" method="POST">
                    <div style="margin-bottom: 20px;">
                        <label style="color: #888; display: block; margin-bottom: 8px; font-size: 14px;">Họ và tên</label>
                        <input type="text" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" 
                               style="width: 100%; background: #0b0c10; border: 1px solid #444; padding: 12px; border-radius: 8px; color: #fff; box-sizing: border-box;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="color: #888; display: block; margin-bottom: 8px; font-size: 14px;">Tên đăng nhập (Không thể đổi)</label>
                        <input type="text" value="<?php echo htmlspecialchars($user['username']); ?>" disabled 
                               style="width: 100%; background: #0b0c10; border: 1px solid #222; padding: 12px; border-radius: 8px; color: #555; box-sizing: border-box;">
                    </div>

                    <div style="margin-bottom: 30px;">
                        <label style="color: #888; display: block; margin-bottom: 8px; font-size: 14px;">Đổi mật khẩu mới</label>
                        <input type="password" name="new_password" placeholder="Nhập mật khẩu nếu muốn thay đổi" 
                               style="width: 100%; background: #0b0c10; border: 1px solid #444; padding: 12px; border-radius: 8px; color: #fff; box-sizing: border-box;">
                    </div>

                    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                        <button type="submit" style="background: #ffc107; color: #000; border: none; padding: 12px 25px; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s; flex: 1; min-width: 140px;">
                            Cập nhật ngay
                        </button>
                        <a href="api/logout.php" style="background: #ff4d4d; color: #fff; text-decoration: none; padding: 12px 25px; border-radius: 8px; font-weight: bold; text-align: center; flex: 1; min-width: 140px;">
                            Đăng xuất
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>