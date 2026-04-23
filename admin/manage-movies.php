<?php 
include_once __DIR__ . '/../core/config.php';
include 'sidebar.php'; 
?>

<style>
    /* Khung chứa các checkbox */
    .genre-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr); /* Chia 4 cột cho gọn */
        gap: 12px;
        background: #1a1a1a;
        padding: 15px;
        border-radius: 5px;
        border: 1px solid #333;
        margin: 10px 0 20px 0;
    }

    /* CSS quan trọng để sửa lỗi lệch hàng */
    .genre-item {
        color: #ddd;
        font-size: 14px;
        display: flex;            /* Kích hoạt Flexbox */
        align-items: center;      /* Căn giữa checkbox và chữ theo chiều dọc */
        cursor: pointer;
        transition: 0.2s;
        line-height: 1;           /* Đảm bảo chiều cao dòng không gây lệch */
    }

    .genre-item:hover {
        color: var(--primary);
    }

    .genre-item input {
        margin: 0 8px 0 0;        /* Xóa margin thừa, chỉ để margin-right 8px */
        width: 16px;
        height: 16px;
        cursor: pointer;
        accent-color: var(--primary);
        flex-shrink: 0;           /* Không cho checkbox bị bóp méo */
    }

    .form-label {
        color: var(--primary);
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    table img {
        object-fit: cover;
        box-shadow: 0 2px 5px rgba(0,0,0,0.5);
    }
</style>

<div class="main-content">
    <div class="card">
        <h3><i class="fas fa-plus"></i> Thêm Phim Mới</h3>
        <form action="process-movie.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="movie_name" placeholder="Tên phim" required style="margin-bottom:10px; width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff;">
            
            <input type="text" name="director" placeholder="Đạo diễn" required style="margin-bottom:10px; width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff;">
            
            <label class="form-label">Chọn Poster phim:</label>
            <input type="file" name="poster" required style="margin-bottom:15px; color: #ccc;">
            
            <label class="form-label">Thể loại phim:</label>
            <div class="genre-grid">
                <label class="genre-item"><input type="checkbox" name="genre[]" value="Hành động">Hành động</label>
                <label class="genre-item"><input type="checkbox" name="genre[]" value="Tình cảm">Tình cảm</label>
                <label class="genre-item"><input type="checkbox" name="genre[]" value="Kinh dị">Kinh dị</label>
                <label class="genre-item"><input type="checkbox" name="genre[]" value="Hoạt hình">Hoạt hình</label>
                <label class="genre-item"><input type="checkbox" name="genre[]" value="Viễn tưởng">Viễn tưởng</label>
                <label class="genre-item"><input type="checkbox" name="genre[]" value="Võ thuật">Võ thuật</label>
                <label class="genre-item"><input type="checkbox" name="genre[]" value="Hài hước">Hài hước</label>
                <label class="genre-item"><input type="checkbox" name="genre[]" value="Tâm lý">Tâm lý</label>
                <label class="genre-item"><input type="checkbox" name="genre[]" value="Phiêu lưu">Phiêu lưu</label>
                <label class="genre-item"><input type="checkbox" name="genre[]" value="Thần thoại">Thần thoại</label>
                <label class="genre-item"><input type="checkbox" name="genre[]" value="Chiến tranh">Chiến tranh</label>
                <label class="genre-item"><input type="checkbox" name="genre[]" value="Tài liệu">Tài liệu</label>
            </div>
            
            <button type="submit" name="add_movie" class="btn-submit" style="width: 100%; padding: 12px; font-weight: bold;">Lưu Phim</button>
        </form>
    </div>

    <div class="card">
        <h3>Danh Sách Phim</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Poster</th>
                    <th>Tên Phim</th>
                    <th>Thể loại</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM movies ORDER BY id DESC");
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><img src="../assets/img/<?= $row['poster'] ?>" width="50" height="70" style="border-radius:4px;"></td>
                        <td style="font-weight: bold; color: var(--primary);"><?= $row['movie_name'] ?></td>
                        <td style="font-size: 13px; color: #ccc;"><?= $row['genre'] ?></td>
                        <td>
                            <a href="edit-movie.php?id=<?= $row['id'] ?>" style="color: #3498db; text-decoration:none; margin-right: 15px;">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            
                            <a href="process-movie.php?delete=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa phim này?')" style="color: #ff4444; text-decoration:none;">
                                <i class="fas fa-trash"></i> Xóa
                            </a>
                        </td>
                      
                    </tr>
                    <?php endwhile;
                } else {
                    echo "<tr><td colspan='5' style='text-align:center;'>Chưa có phim nào trong hệ thống</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>