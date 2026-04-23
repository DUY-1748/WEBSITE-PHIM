<?php 
// Sử dụng đường dẫn tuyệt đối để PHP luôn tìm thấy file db-config.php
include_once __DIR__ . '/../core/config.php'; 

// Kiểm tra nếu kết nối thất bại
if (!$conn) {
    die("<div style='color:red; padding:20px;'>Lỗi: Không thể kết nối database. Kiểm tra lại file db-config.php!</div>");
}

include 'sidebar.php'; 
?>
<div class="main-content">
    <div class="card">
        <h3>Quản lý Bình luận</h3>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Phim</th>
                    <th>Nội dung</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT c.*, u.username, m.movie_name 
                        FROM comments c 
                        JOIN users u ON c.user_id = u.id 
                        JOIN movies m ON c.movie_id = m.id";
                $res = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['movie_name'] ?></td>
                    <td><?= $row['content'] ?></td>
                    <td>
                        <a href="process-comment.php?hide=<?= $row['id'] ?>">Ẩn</a> | 
                        <a href="process-comment.php?delete=<?= $row['id'] ?>" style="color:red">Xóa</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>