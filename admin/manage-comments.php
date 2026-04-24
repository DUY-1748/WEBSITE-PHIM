<?php 
include_once __DIR__ . '/../core/config.php'; 
include 'sidebar.php'; 
?>

<div class="main-content">
    <div class="card">
        <h3><i class="fas fa-comments"></i> Quản lý Bình luận</h3>
        <div style="overflow-x: auto; margin-top: 20px;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; border-bottom: 2px solid #333;">
                        <th style="padding: 12px;">Người dùng</th>
                        <th style="padding: 12px;">Phim</th>
                        <th style="padding: 12px;">Nội dung</th>
                        <th style="padding: 12px; text-align: center;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Sử dụng comment_id theo đúng cấu trúc bảng comment_history của bạn
                    $sql = "SELECT c.comment_id, c.content, u.username, m.title 
                            FROM comment_history c 
                            JOIN users u ON c.user_id = u.user_id 
                            JOIN movies m ON c.movie_id = m.id 
                            ORDER BY c.comment_id DESC";
                    
                    try {
                        $stmt = $pdo->query($sql);
                        while($row = $stmt->fetch()): ?>
                        <tr style="border-bottom: 1px solid #222;">
                            <td style="padding: 12px;">
                                <strong style="color: var(--primary);"><?= htmlspecialchars($row['username']) ?></strong>
                            </td>
                            <td style="padding: 12px; color: #ccc;"><?= htmlspecialchars($row['title']) ?></td>
                            <td style="padding: 12px; max-width: 400px; color: #bbb; line-height: 1.5;">
                                <?= nl2br(htmlspecialchars($row['content'])) ?>
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <a href="process-comment.php?delete=<?= $row['comment_id'] ?>" 
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này không?')" 
                                   style="color: #e74c3c; text-decoration: none; font-size: 14px;">
                                    <i class="fas fa-trash-alt"></i> Xóa
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; 
                    } catch (PDOException $e) {
                        echo "<tr><td colspan='4' style='padding: 20px; text-align: center; color: #e74c3c;'>Lỗi: " . $e->getMessage() . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>