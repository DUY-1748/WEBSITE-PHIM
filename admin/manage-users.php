<?php 
include_once __DIR__ . '/../core/config.php';
include 'sidebar.php'; 
?>
<div class="main-content">
    <div class="card">
        <h3><i class="fas fa-user-shield"></i> Danh sách Thành viên</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên tài khoản</th>
                    <th>Quyền</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM users ORDER BY user_id DESC");
                while($row = $stmt->fetch()): 
                    $status_text = ($row['status'] == 1) ? "Hoạt động" : "Bị khóa";
                    $status_color = ($row['status'] == 1) ? "#2ecc71" : "#e74c3c";
                    $action_text = ($row['status'] == 1) ? "Khóa" : "Mở khóa";
                    $btn_color = ($row['status'] == 1) ? "#e67e22" : "#2ecc71";
                ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><strong><?= htmlspecialchars($row['username']) ?></strong></td>
                    <td><span class="badge"><?= $row['role'] ?></span></td>
                    <td><span style="color: <?= $status_color ?>; font-weight: bold;"><?= $status_text ?></span></td>
                    <td>
                        <a href="process-user.php?toggle=<?= $row['id'] ?>&status=<?= $row['status'] ?>" 
                           style="padding: 5px 10px; background: <?= $btn_color ?>; color:white; border-radius:3px; text-decoration:none; font-size:12px;">
                           <?= $action_text ?>
                        </a>
                        <a href="process-user.php?delete=<?= $row['id'] ?>" 
                           onclick="return confirm('Xóa vĩnh viễn tài khoản này?')"
                           style="padding: 5px 10px; background: #e74c3c; color:white; border-radius:3px; text-decoration:none; font-size:12px; margin-left:5px;">
                           Xóa
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>