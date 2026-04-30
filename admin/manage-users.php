<?php 
include_once __DIR__ . '/../core/config.php';
include_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../core/auth_admin.php';
?>

<div class="main-content">
    <div class="card">
        <h3><i class="fas fa-users"></i> Quản lý người dùng</h3>
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
                    $u_role = $row['role'];
                ?>
                <tr>
                    <td><?= $u_id ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td>
                        <select onchange="location.href='process-user.php?id=<?= $u_id ?>&new_role=' + this.value">
                            <option value="0" <?= $u_role == 0 ? 'selected' : '' ?>>Thường</option>
                            <option value="2" <?= $u_role == 2 ? 'selected' : '' ?>>VIP</option>
                            <option value="1" <?= $u_role == 1 ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </td>
                    <td>
                        <?= ($u_status == 1) ? '<span style="color: #2ecc71;">Hoạt động</span>' : '<span style="color: #e74c3c;">Bị khóa</span>' ?>
                    </td>
                    <td>
                        <a href="process-user.php?id=<?= $u_id ?>&toggle_status=<?= $u_status ?>" 
                           style="padding: 8px 10px; background: <?= ($u_status == 1 ? '#e67e22' : '#2ecc71') ?>; color:white; border-radius:3px; text-decoration:none; font-size:12px;">
                           <?= ($u_status == 1 ? 'Khóa tài khoản' : 'Mở khóa') ?>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>