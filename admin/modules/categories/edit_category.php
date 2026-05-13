
<?php
require_once '../../config/database.php';

if (!isset($conn)) {
    echo '<div class="alert alert-danger">Lỗi kết nối cơ sở dữ liệu.</div>';
    return;
}

$categoryId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "SELECT id, name, description, created_at FROM categories WHERE id = $categoryId";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo '<div class="alert alert-warning">Danh mục không tìm thấy.</div>';
    return;
}

$category = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['category_name'] ?? '');
    $description = mysqli_real_escape_string($conn, $_POST['description'] ?? '');

    $updateSql = "UPDATE categories SET name = '$name', description = '$description' WHERE id = $categoryId";

    if (mysqli_query($conn, $updateSql)) {
        echo '<div class="alert alert-success">Cập nhật danh mục thành công!</div>';
        $category['name'] = $name;
        $category['description'] = $description;
    } else {
        echo '<div class="alert alert-danger">Lỗi: ' . mysqli_error($conn) . '</div>';
    }
}
?>
                <div class="card shadow-sm p-4">
                    <h2 class="h5 mb-4">Chỉnh Sửa Danh Mục</h2>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Tên Danh Mục</label>
                            <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo htmlspecialchars($category['name']); ?>" required>
                        </div>
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