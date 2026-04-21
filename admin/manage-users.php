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
                // Lấy danh sách user từ database
                $result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
                
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)): 
                        $status_text = ($row['status'] == 1) ? "Hoạt động" : "Bị khóa";
                        $status_color = ($row['status'] == 1) ? "#2ecc71" : "#e74c3c";
                        $action_text = ($row['status'] == 1) ? "Khóa" : "Mở khóa";
                        $action_btn_color = ($row['status'] == 1) ? "#e67e22" : "#2ecc71";
                ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><strong><?= htmlspecialchars($row['username']) ?></strong></td>
                    <td><span class="badge"><?= $row['role'] ?></span></td>
                    <td><span style="color: <?= $status_color ?>; font-weight: bold;"><?= $status_text ?></span></td>
                    <td>
                        <a href="process-user.php?toggle_status=<?= $row['id'] ?>&current=<?= $row['status'] ?>" 
                           class="btn-submit" 
                           style="padding: 5px 10px; background: <?= $action_btn_color ?>; font-size: 12px; text-decoration: none; border-radius: 3px;">
                           <?= $action_text ?>
                        </a>

                        <a href="process-user.php?delete=<?= $row['id'] ?>" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn tài khoản này?')"
                           style="padding: 5px 10px; background: #e74c3c; font-size: 12px; color: white; text-decoration: none; border-radius: 3px; margin-left: 5px;">
                           Xóa
                        </a>
                    </td>
                </tr>
                <?php 
                    endwhile; 
                } else {
                    echo "<tr><td colspan='5' style='text-align:center;'>Chưa có thành viên nào.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
