<?php
include_once __DIR__ . '/../core/config.php';
require_once __DIR__ . '/../core/auth_admin.php';

$status = "";

// 1. Xử lý đổi Role
if (isset($_GET['id']) && isset($_GET['new_role'])) {
    $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE user_id = ?");
    if($stmt->execute([$_GET['new_role'], $_GET['id']])) $status = "role_updated";
}

// 2. Xử lý Khóa/Mở khóa
if (isset($_GET['id']) && isset($_GET['toggle_status'])) {
    $new_status = ($_GET['toggle_status'] == 1) ? 0 : 1;
    $stmt = $pdo->prepare("UPDATE users SET status = ? WHERE user_id = ?");
    if($stmt->execute([$new_status, $_GET['id']])) $status = "status_changed";
}

// 3. Xử lý Xóa người dùng
if (isset($_GET['delete'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
        if($stmt->execute([$_GET['delete']])) {
            header("Location: manage-users.php?msg=deleted");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: manage-users.php?msg=error");
        exit();
    }
}

// Quay về kèm theo thông báo cụ thể
header("Location: manage-users.php?msg=" . $status);
exit();
?>