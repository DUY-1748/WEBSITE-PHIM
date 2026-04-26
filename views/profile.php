<?php
// Kiểm tra quyền truy cập
if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href='index.php?page=login';</script>";
    exit;
}

// Truy vấn lại database để lấy thông tin mới nhất (bao gồm Full Name)
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<div class="profile-container" style="background: #0b0c10; padding: 50px 0; min-height: 90vh;">
    <div class="container" style="max-width: 1000px; margin: 100px;">
        <div style="display: flex; gap: 30px; align-items: flex-start;">
            
            <div style="flex: 1; background: #1a1d23; border-radius: 15px; padding: 30px; text-align: center; border: 1px solid #333;">
                <div style="position: relative; display: inline-block;">
                    <div style="width: 120px; height: 120px; border-radius: 50%; background: var(--primary, #ffc107); margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; font-size: 48px; color: #000; font-weight: bold;">
                        <?php echo strtoupper(substr($user['full_name'], 0, 1)); ?>
                    </div>
                </div>
                <h2 style="color: #fff; margin-bottom: 5px;"><?php echo $user['full_name']; ?></h2>
                <p style="color: #888; font-size: 14px;">@<?php echo $user['username']; ?></p>
                <hr style="border: 0; border-top: 1px solid #333; margin: 20px 0;">
                <div style="text-align: left; color: #ccc;">
                    <p><i class="ph ph-shield-check" style="color: #ffc107;"></i> Quyền hạn: <?php echo $user['role'] == 1 ? 'Quản trị viên' : 'Thành viên'; ?></p>
                </div>
            </div>

            <div style="flex: 2; background: #1a1d23; border-radius: 15px; padding: 40px; border: 1px solid #333;">
                <h3 style="color: #ffc107; margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
                    <i class="ph ph-user-focus"></i> Cài đặt tài khoản
                </h3>
                
                <form action="api/update_profile.php" method="POST">
                    <div style="margin-bottom: 20px;">
                        <label style="color: #888; display: block; margin-bottom: 8px;">Họ và tên</label>
                        <input type="text" name="full_name" value="<?php echo $user['full_name']; ?>" 
                               style="width: 100%; background: #0b0c10; border: 1px solid #444; padding: 12px; border-radius: 8px; color: #fff;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="color: #888; display: block; margin-bottom: 8px;">Tên đăng nhập (Không thể đổi)</label>
                        <input type="text" value="<?php echo $user['username']; ?>" disabled 
                               style="width: 100%; background: #0b0c10; border: 1px solid #222; padding: 12px; border-radius: 8px; color: #555;">
                    </div>

                    <div style="margin-bottom: 30px;">
                        <label style="color: #888; display: block; margin-bottom: 8px;">Đổi mật khẩu mới</label>
                        <input type="password" name="new_password" placeholder="Nhập mật khẩu nếu muốn thay đổi" 
                               style="width: 100%; background: #0b0c10; border: 1px solid #444; padding: 12px; border-radius: 8px; color: #fff;">
                    </div>

                    <div style="display: flex; gap: 15px;">
                        <button type="submit" style="background: #ffc107; color: #000; border: none; padding: 12px 30px; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s;">
                            Cập nhật ngay
                        </button>
                        <a href="api/logout.php" style="background: #ff4d4d; color: #fff; text-decoration: none; padding: 12px 30px; border-radius: 8px; font-weight: bold;">
                            Đăng xuất
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>