
<?php
require_once __DIR__ . '/../../../config/database.php';

if (!isset($conn)) {
    echo '<div class="alert alert-danger">Lỗi kết nối cơ sở dữ liệu.</div>';
    return;
}

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

$categoryId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "SELECT id, name, description, created_at, image, product_count FROM categories WHERE id = $categoryId";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo '<div class="alert alert-warning">Danh mục không tìm thấy.</div>';
    return;
}

$category = mysqli_fetch_assoc($result);
$image = $category['image'] ?? '';
$productCount = $category['product_count'];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['category_name'] ?? '');
    $description = mysqli_real_escape_string($conn, $_POST['description'] ?? '');
    $productCount = isset($_POST['product_count']) && $_POST['product_count'] !== '' ? (int)$_POST['product_count'] : null;

    if (isset($_POST['remove_image']) && $_POST['remove_image'] === '1') {
        if (!empty($image)) {
            $oldImagePath = __DIR__ . '/../../../admin/imgs/categories/' . $image;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $image = '';
    }

    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $file = $_FILES['image'];
        $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        if (!in_array($file['type'], $allowed)) {
            $errors[] = 'Định dạng ảnh không hợp lệ. Chỉ chấp nhận JPEG, PNG, GIF, WebP.';
        } elseif ($file['size'] > 5 * 1024 * 1024) {
            $errors[] = 'Kích thước ảnh không được vượt quá 5MB.';
        } else {
            $uploadDir = __DIR__ . '/../../../admin/imgs/categories/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $filename = time() . '_' . basename($file['name']);
            $filepath = $uploadDir . $filename;

            if (move_uploaded_file($file['tmp_name'], $filepath)) {
                if (!empty($image)) {
                    $oldImagePath = $uploadDir . $image;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $image = $filename;
            } else {
                $errors[] = 'Lỗi tải file lên.';
            }
        }
    }

    if (empty($errors)) {
        $imageEsc = $image !== '' ? "'" . mysqli_real_escape_string($conn, $image) . "'" : 'NULL';
        $countValue = $productCount !== null ? (int)$productCount : 'NULL';
        $updateSql = "UPDATE categories SET name = '$name', description = '$description', image = $imageEsc, product_count = $countValue WHERE id = $categoryId";

        if (mysqli_query($conn, $updateSql)) {
            echo '<div class="alert alert-success">Cập nhật danh mục thành công!</div>';
            $category['name'] = $name;
            $category['description'] = $description;
            $category['image'] = $image;
            $category['product_count'] = $productCount;
        } else {
            $errors[] = 'Lỗi: ' . mysqli_error($conn);
        }
    }
}
?>
                <div class="card shadow-sm p-4">
                    <h2 class="h5 mb-4">Chỉnh Sửa Danh Mục</h2>
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <div>- <?php echo htmlspecialchars($error); ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Tên Danh Mục</label>
                            <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo htmlspecialchars($category['name']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình Ảnh Danh Mục</label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="product_count" class="form-label">Số Sản Phẩm</label>
                            <input type="number" id="product_count" name="product_count" class="form-control" min="0" value="<?php echo htmlspecialchars($category['product_count'] ?? ''); ?>" placeholder="Để trống nếu muốn dùng số thực tế">
                            <div class="form-text">Giữ trống để hiển thị số sản phẩm thực tế trong danh mục.</div>
                        </div>
                        <?php if (!empty($category['image'])): ?>
                            <div class="mb-3">
                                <label class="form-label">Ảnh Hiện Tại</label>
                                <div>
                                    <img src="imgs/categories/<?php echo htmlspecialchars($category['image']); ?>" alt="Ảnh danh mục" class="img-fluid rounded" style="max-width: 220px;">
                                </div>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image" value="1">
                                <label class="form-check-label" for="remove_image">Xóa ảnh hiện tại</label>
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô Tả Danh Mục</label>
                            <textarea id="description" name="description" class="form-control" rows="4" required><?php echo htmlspecialchars($category['description'] ?? ''); ?></textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
                            <a href="index.php?page_layout=category" class="btn btn-outline-secondary">Quay Lại</a>
                        </div>
                    </form>
                </div>