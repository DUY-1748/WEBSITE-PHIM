
<?php
include_once __DIR__ . '/../core/config.php';
require_once __DIR__ . '/../core/auth_admin.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xử lý đổi Role (Thường/VIP/Admin)
    if (isset($_GET['new_role'])) {
        $new_role = $_GET['new_role'];
        $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE user_id = ?");
        $stmt->execute([$new_role, $id]);
    }

    // Xử lý Khóa/Mở khóa
    if (isset($_GET['toggle_status'])) {
        $current_status = $_GET['toggle_status'];
        $new_status = ($current_status == 1) ? 0 : 1;
        $stmt = $pdo->prepare("UPDATE users SET status = ? WHERE user_id = ?");
        $stmt->execute([$new_status, $id]);
    }

    header("Location: manage-users.php");
    exit();
}
// Xử lý xóa user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: manage-users.php");
    exit();
}
?>