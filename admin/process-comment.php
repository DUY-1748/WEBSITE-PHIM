<?php
include_once __DIR__ . '/../core/config.php';
require_once __DIR__ . '/../core/auth_admin.php'; // Bảo mật: chỉ admin mới được xóa

if (isset($_GET['delete'])) {
    $comment_id = $_GET['delete'];

    try {
        // Thực hiện xóa bình luận dựa trên ID
        $stmt = $pdo->prepare("DELETE FROM comment_history WHERE comment_id = ?");
        $stmt->execute([$comment_id]);

        // Xóa xong quay lại trang quản lý bình luận
        header("Location: manage-comments.php?success=deleted");
        exit();
    } catch (PDOException $e) {
        die("Lỗi xóa bình luận: " . $e->getMessage());
    }
} else {
    // Nếu không có ID thì quay về trang quản lý
    header("Location: manage-comments.php");
    exit();
}