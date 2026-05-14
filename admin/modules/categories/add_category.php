
<?php
require_once __DIR__ . '/../../../config/database.php';

$message = '';
$errors = [];

// Đảm bảo cột image tồn tại trong bảng categories
$columnCheck = mysqli_query($conn, "SHOW COLUMNS FROM categories LIKE 'image'");
if ($columnCheck && mysqli_num_rows($columnCheck) === 0) {
    mysqli_query($conn, "ALTER TABLE categories ADD COLUMN image VARCHAR(255) NULL");
}

// Đảm bảo cột product_count tồn tại trong bảng categories
$productCountCheck = mysqli_query($conn, "SHOW COLUMNS FROM categories LIKE 'product_count'");
if ($productCountCheck && mysqli_num_rows($productCountCheck) === 0) {
    mysqli_query($conn, "ALTER TABLE categories ADD COLUMN product_count INT DEFAULT NULL");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $productCount = isset($_POST['product_count']) ? (int)$_POST['product_count'] : null;
    $image = '';

    if ($name === '') {
        $errors[] = 'Vui lòng nhập tên danh mục.';
    }
    if ($description === '') {
        $errors[] = 'Vui lòng nhập mô tả.';
    }

    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $file = $_FILES['image'];
        $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        if (!in_array($file['type'], $allowed)) {
            $errors[] = 'Định dạng ảnh không hợp lệ (JPEG, PNG, GIF, WebP).';
        } elseif ($file['size'] > 5 * 1024 * 1024) {
            $errors[] = 'Kích thước ảnh không vượt quá 5MB.';
        } else {
            $uploadDir = __DIR__ . '/../../../admin/imgs/categories/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $filename = time() . '_' . basename($file['name']);
            $filepath = $uploadDir . $filename;

            if (move_uploaded_file($file['tmp_name'], $filepath)) {
                $image = $filename;
            } else {
                $errors[] = 'Lỗi tải file lên.';
            }
        }
    }

    if (empty($errors)) {
        $name = mysqli_real_escape_string($conn, $name);
        $description = mysqli_real_escape_string($conn, $description);
        $imageValue = $image !== '' ? "'" . mysqli_real_escape_string($conn, $image) . "'" : 'NULL';
        $countValue = $productCount !== null ? (int)$productCount : 'NULL';
        
        $sql = "INSERT INTO categories (name, description, image, product_count) VALUES ('$name', '$description', $imageValue, $countValue)";
        
        if (mysqli_query($conn, $sql)) {
            $message = 'Danh mục được thêm thành công!';
            header('Refresh: 1.5; url=index.php?page_layout=category');
        } else {
            $errors[] = 'Lỗi: ' . mysqli_error($conn);
        }
    }
}
?>
                <div class="card shadow-sm p-4">
                    <h2 class="h5 mb-4">Thêm Danh Mục Mới</h2>
                    <?php if ($message): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <div>- <?php echo htmlspecialchars($error); ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="index.php?page_layout=add_category" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Tên Danh Mục</label>
                            <input type="text" id="category_name" name="name" class="form-control" placeholder="Nhập tên danh mục" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình Ảnh Danh Mục</label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="product_count" class="form-label">Số Sản Phẩm</label>
                            <input type="number" id="product_count" name="product_count" class="form-control" min="0" placeholder="Nhập số sản phẩm" value="<?php echo isset($_POST['product_count']) ? intval($_POST['product_count']) : ''; ?>">
                            <div class="form-text">Để trống nếu muốn dùng số sản phẩm thực tế từ sản phẩm trong danh mục.</div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô Tả Danh Mục</label>
                            <textarea id="description" name="description" class="form-control" rows="4" placeholder="Nhập mô tả chi tiết về danh mục" required></textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Thêm Danh Mục</button>
                            <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">Hủy</button>
                        </div>
                    </form>
                </div>

                
         