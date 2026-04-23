<?php
include_once __DIR__ . '/../core/config.php';

// 1. Xử lý Khóa/Mở khóa
if (isset($_GET['toggle_status']) && isset($_GET['current'])) {
    $id = intval($_GET['toggle_status']);
    $new_status = ($_GET['current'] == 1) ? 0 : 1; // Đảo ngược trạng thái
    
    $sql = "UPDATE users SET status = $new_status WHERE id = $id";
    mysqli_query($conn, $sql);
    header("Location: manage-users.php");
}

// 2. Xử lý Xóa tài khoản
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    // Lưu ý: Không cho phép admin tự xóa chính mình nếu cần thiết
    $sql = "DELETE FROM users WHERE id = $id";
    mysqli_query($conn, $sql);
    header("Location: manage-users.php");
}

?>