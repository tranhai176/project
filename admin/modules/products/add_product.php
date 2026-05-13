<?php
require_once __DIR__ . '/../../../config/database.php';

$message = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = (float)($_POST['price'] ?? 0);
    $quantity = (int)($_POST['quantity'] ?? 0);
    $category_id = (int)($_POST['category_id'] ?? 0);
    $description = trim($_POST['description'] ?? '');
    $image = '';

    // Kiểm tra validation
    if ($name === '') {
        $errors[] = 'Vui lòng nhập tên sản phẩm.';
    }
    if ($price <= 0) {
        $errors[] = 'Giá phải lớn hơn 0.';
    }
    if ($category_id <= 0) {
        $errors[] = 'Vui lòng chọn danh mục.';
    }
    if (!isset($_FILES['image']) || $_FILES['image']['size'] === 0) {
        $errors[] = 'Vui lòng chọn hình ảnh.';
    }

    // Xử lý upload file
    if (empty($errors) && isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        
        if (!in_array($file['type'], $allowed)) {
            $errors[] = 'Định dạng ảnh không hợp lệ (JPEG, PNG, GIF, WebP).';
        } elseif ($file['size'] > 5 * 1024 * 1024) {
            $errors[] = 'Kích thước ảnh không vượt quá 5MB.';
        } else {
            $uploadDir = __DIR__ . '/../../../admin/imgs/';
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

    if (empty($errors) && !empty($image)) {
        $name = mysqli_real_escape_string($conn, $name);
        $description = mysqli_real_escape_string($conn, $description);
        
        $sql = "INSERT INTO products (name, price, quantity, category_id, description, image) 
                VALUES ('$name', $price, $quantity, $category_id, '$description', '$image')";
        
        if (mysqli_query($conn, $sql)) {
            $message = 'Sản phẩm được thêm thành công!';
            header('Refresh: 1.5; url=index.php?page_layout=products');
        } else {
            $errors[] = 'Lỗi: ' . mysqli_error($conn);
        }
    }
}

// Lấy danh sách danh mục
$categorySql = "SELECT id, name FROM categories ORDER BY name";
$categoryResult = mysqli_query($conn, $categorySql);
?>
                <div class="card shadow-sm p-4">
                    <h2 class="h5 mb-4">Thêm Sản Phẩm Mới</h2>
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
                    <form method="post" action="index.php?page_layout=add_product" enctype="multipart/form-data">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="product_name" class="form-label">Tên Sản Phẩm</label>
                                <input type="text" id="product_name" name="name" class="form-control" placeholder="Nhập tên sản phẩm" required>
                            </div>
                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Danh Mục</label>
                                <select id="category_id" name="category_id" class="form-select" required>
                                    <option value="">Chọn danh mục</option>
                                    <?php while ($cat = mysqli_fetch_assoc($categoryResult)): ?>
                                        <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Giá (VNĐ)</label>
                                <input type="number" id="price" name="price" class="form-control" placeholder="Nhập giá sản phẩm" step="0.01" required>
                            </div>
                            <div class="col-md-6">
                                <label for="quantity" class="form-label">Tồn Kho</label>
                                <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Nhập số lượng tồn kho" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình Ảnh Sản Phẩm</label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô Tả Sản Phẩm</label>
                            <textarea id="description" name="description" class="form-control" rows="4" placeholder="Nhập mô tả chi tiết về sản phẩm" required></textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
                            <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">Hủy</button>
                        </div>
                    </form>
                </div>

                
    
