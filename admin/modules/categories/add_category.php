
<?php
require_once __DIR__ . '/../../../config/database.php';

$message = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($name === '') {
        $errors[] = 'Vui lòng nhập tên danh mục.';
    }
    if ($description === '') {
        $errors[] = 'Vui lòng nhập mô tả.';
    }

    if (empty($errors)) {
        $name = mysqli_real_escape_string($conn, $name);
        $description = mysqli_real_escape_string($conn, $description);
        
        $sql = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";
        
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
                    <form method="post" action="index.php?page_layout=add_category">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Tên Danh Mục</label>
                            <input type="text" id="category_name" name="name" class="form-control" placeholder="Nhập tên danh mục" required>
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

                
         