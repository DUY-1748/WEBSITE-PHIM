<?php
include_once __DIR__ . '/../core/config.php';

// Xử lý thay đổi trạng thái
if (isset($_GET['toggle'])) {
    $id = $_GET['toggle'];
    $new_status = ($_GET['status'] == 1) ? 0 : 1;
    
    $stmt = $pdo->prepare("UPDATE users SET status = ? WHERE id = ?");
    $stmt->execute([$new_status, $id]);
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