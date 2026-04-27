<?php
// Bắt đầu session để kiểm tra quyền đăng nhập khi thêm bình luận
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../core/config.php';

/**
 * --- PHẦN 1: LẤY DANH SÁCH BÌNH LUẬN (GET) ---
 * Dành cho tất cả mọi người (kể cả khách)
 */
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['movie_id'])) {
    header('Content-Type: application/json');
    $movie_id = $_GET['movie_id'];

    try {
        // JOIN với bảng users để lấy username hiển thị icon và tên
        $stmt = $pdo->prepare("
            SELECT c.*, u.username 
            FROM comment_history c 
            JOIN users u ON c.user_id = u.user_id 
            WHERE c.movie_id = ? 
            ORDER BY c.created_at DESC
        ");
        $stmt->execute([$movie_id]);
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($comments);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit();
}

/**
 * --- PHẦN 2: THÊM BÌNH LUẬN MỚI (POST) ---
 * Chỉ dành cho người dùng đã đăng nhập
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
    header('Content-Type: application/json');

    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Bạn cần đăng nhập để bình luận!']);
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $movie_id = $_POST['movie_id'];
    $content = trim($_POST['content']);

    if (empty($content)) {
        echo json_encode(['status' => 'error', 'message' => 'Nội dung không được để trống!']);
        exit();
    }

    try {
        // Lưu vào bảng comment_history đồng bộ với GitHub
        $stmt = $pdo->prepare("INSERT INTO comment_history (user_id, movie_id, content, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$user_id, $movie_id, $content]);

        echo json_encode(['status' => 'success']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit();
}

/**
 * --- PHẦN 3: XÓA BÌNH LUẬN (Dành cho Admin) ---
 * Kiểm tra quyền admin trước khi cho phép xóa
 */
if (isset($_GET['delete'])) {
    require_once __DIR__ . '/../core/auth_admin.php'; 
    $comment_id = $_GET['delete'];
    try {
        $stmt = $pdo->prepare("DELETE FROM comment_history WHERE comment_id = ?");
        $stmt->execute([$comment_id]);
        header("Location: manage-comments.php?success=deleted");
        exit();
    } catch (PDOException $e) {
        die("Lỗi xóa bình luận: " . $e->getMessage());
    }
}

// Nếu không có tham số hợp lệ, quay về trang quản lý
header("Location: manage-comments.php");
exit();