<?php 
include_once __DIR__ . '/../core/config.php';
include_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../core/auth_admin.php';
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="main-content">
    <div class="card">
        <h3><i class="fas fa-users"></i> Quản lý người dùng</h3>
        
        <?php if (isset($_GET['msg'])): ?>
            <script>
                const msg = "<?= $_GET['msg'] ?>";
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });

                if (msg === 'deleted') {
                    Swal.fire('Đã xóa!', 'Người dùng đã bị xóa khỏi hệ thống.', 'success');
                } else if (msg === 'status_changed') {
                    Toast.fire({ icon: 'success', title: 'Đã cập nhật trạng thái!' });
                } else if (msg === 'role_updated') {
                    Toast.fire({ icon: 'success', title: 'Đã thay đổi cấp bậc!' });
                } else if (msg === 'error') {
                    Swal.fire('Lỗi!', 'Không thể xóa người dùng (có thể do dữ liệu liên quan).', 'error');
                }
            </script>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên tài khoản</th>
                    <th>Cấp bậc</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $pdo->query("SELECT * FROM users ORDER BY user_id DESC");
                while($row = $result->fetch(PDO::FETCH_ASSOC)): 
                    $u_id = $row['user_id'];
                    $u_status = $row['status'] ?? 1;
                ?>
                <tr>
                    <td><?= $u_id ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td>
                        <select onchange="location.href='process-user.php?id=<?= $u_id ?>&new_role=' + this.value">
                            <option value="0" <?= $row['role'] == 0 ? 'selected' : '' ?>>Thường</option>
                            <option value="2" <?= $row['role'] == 2 ? 'selected' : '' ?>>VIP</option>
                            <option value="1" <?= $row['role'] == 1 ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </td>
                    <td><?= ($u_status == 1) ? '<span style="color:#2ecc71;">Hoạt động</span>' : '<span style="color:#e74c3c;">Bị khóa</span>' ?></td>
                    <td>
                        <a href="process-user.php?id=<?= $u_id ?>&toggle_status=<?= $u_status ?>" style="padding: 8px 10px; background: <?= ($u_status == 1 ? '#e67e22' : '#2ecc71') ?>; color:white; border-radius:3px; text-decoration:none; font-size:12px;">
                            <?= ($u_status == 1 ? 'Khóa' : 'Mở') ?>
                        </a>

                        <button onclick="confirmDelete(<?= $u_id ?>)" style="padding: 8px 10px; background: #e74c3c; color:white; border-radius:3px; border:none; cursor:pointer; font-size:12px;">
                            Xóa
                        </button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
// Hàm xác nhận trước khi gửi lệnh xóa đi
function confirmDelete(userId) {
    Swal.fire({
        title: 'Xác nhận xóa?',
        text: "Bạn sẽ không thể khôi phục lại tài khoản này!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Đồng ý xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'process-user.php?delete=' + userId;
        }
    })
}
</script>