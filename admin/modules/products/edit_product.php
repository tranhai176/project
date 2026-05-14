
<?php
global $conn;
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "SELECT p.id, p.name, p.price, p.quantity, p.image, p.description, p.category_id, c.name as category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        WHERE p.id = $productId";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo '<div class="alert alert-warning">Sản phẩm không tìm thấy.</div>';
    return;
}

$product = mysqli_fetch_assoc($result);

// Lấy danh sách danh mục
$categorySql = "SELECT id, name FROM categories ORDER BY name";
$categoryResult = mysqli_query($conn, $categorySql);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['product_name'] ?? '');
    $price = (float)($_POST['price'] ?? 0);
    $quantity = (int)($_POST['stock'] ?? 0);
    $description = mysqli_real_escape_string($conn, $_POST['description'] ?? '');
    $categoryId = (int)($_POST['category'] ?? 0);
    $image = $product['image'];

    if (isset($_POST['remove_image']) && $_POST['remove_image'] === '1') {
        if (!empty($image)) {
            $oldImagePath = __DIR__ . '/../../../admin/imgs/' . $image;
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
            $uploadDir = __DIR__ . '/../../../admin/imgs/';
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
        $updateSql = "UPDATE products SET name = '$name', price = $price, quantity = $quantity, description = '$description', category_id = $categoryId, image = '" . mysqli_real_escape_string($conn, $image) . "' WHERE id = $productId";

        if (mysqli_query($conn, $updateSql)) {
            echo '<div class="alert alert-success">Cập nhật sản phẩm thành công!</div>';
            $product['name'] = $name;
            $product['price'] = $price;
            $product['quantity'] = $quantity;
            $product['description'] = $description;
            $product['category_id'] = $categoryId;
            $product['image'] = $image;
        } else {
            $errors[] = 'Lỗi: ' . mysqli_error($conn);
        }
    }
}
?>
                <div class="card shadow-sm p-4">
                    <h2 class="h5 mb-4">Sửa Thông Tin Sản Phẩm</h2>
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <div>- <?php echo htmlspecialchars($error); ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="product_name" class="form-label">Tên Sản Phẩm</label>
                                <input type="text" id="product_name" name="product_name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="category" class="form-label">Danh Mục</label>
                                <select id="category" name="category" class="form-select" required>
                                    <?php while ($cat = mysqli_fetch_assoc($categoryResult)): ?>
                                        <option value="<?php echo $cat['id']; ?>" <?php echo $product['category_id'] == $cat['id'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($cat['name']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Giá (VNĐ)</label>
                                <input type="number" id="price" name="price" class="form-control" value="<?php echo $product['price']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="stock" class="form-label">Tồn Kho</label>
                                <input type="number" id="stock" name="stock" class="form-control" value="<?php echo $product['quantity']; ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hình Ảnh Hiện Tại</label>
                            <?php if ($product['image']): ?>
                                <div class="mb-3 text-center">
                                    <img src="imgs/<?php echo htmlspecialchars($product['image']); ?>" class="img-fluid rounded" alt="<?php echo htmlspecialchars($product['name']); ?>" width="200px" onerror="this.src='https://via.placeholder.com/200'">
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image" value="1">
                                    <label class="form-check-label" for="remove_image">Xóa ảnh hiện tại</label>
                                </div>
                            <?php else: ?>
                                <div class="mb-3 text-center">
                                    <img src="https://via.placeholder.com/200" class="img-fluid rounded" alt="No image">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Thay Đổi Hình Ảnh</label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô Tả Sản Phẩm</label>
                            <textarea id="description" name="description" class="form-control" rows="4" required><?php echo htmlspecialchars($product['description'] ?? ''); ?></textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                            <a href="index.php?page_layout=product" class="btn btn-outline-secondary">Quay Lại</a>
                        </div>
                    </form>
                </div>