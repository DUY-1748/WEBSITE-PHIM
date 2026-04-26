<?php
session_start();

// 1. Xóa toàn bộ Session trên Server
$_SESSION = array();
session_destroy();

// 2. Dùng JavaScript để xóa sessionStorage và chuyển hướng
//  để giao diện cập nhật ngay lập tức
echo "<script>
    sessionStorage.removeItem('user');
    window.location.href = '../index.php?page=home';
</script>";
exit;
?>