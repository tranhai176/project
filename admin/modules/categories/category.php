
<?php
// Include database connection
require_once __DIR__ . '/../../../config/database.php';

// Xử lý delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = (int)$_POST['delete_id'];
    
    // Xóa danh mục
    $deleteSql = "DELETE FROM categories WHERE id = $deleteId";
    if (mysqli_query($conn, $deleteSql)) {
        header('Location: index.php?page_layout=category&msg=deleted');
        exit();
    }
}

$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$where = '';
if ($search !== '') {
    $searchEsc = mysqli_real_escape_string($conn, $search);
    $where = "WHERE name LIKE '%$searchEsc%' OR description LIKE '%$searchEsc%'";
}
$sql = "SELECT c.id, c.name, c.description, c.created_at, COUNT(p.id) as product_count 
        FROM categories c 
        LEFT JOIN products p ON c.id = p.category_id 
        $where 
        GROUP BY c.id 
        ORDER BY c.created_at DESC";
$result = mysqli_query($conn, $sql);
?>
                <div class="card shadow-sm p-4">
                    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
                        <div class="alert alert-success">Xóa danh mục thành công!</div>
                    <?php endif; ?>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h5 mb-0">Danh Sách Danh Mục</h2>
                        <a>
                            <form class="d-flex" role="search" method="GET" action="index.php">
                                <input type="hidden" name="page_layout" value="category">
                                <input class="form-control form-control-sm me-2" type="search" name="q" value="<?php echo htmlspecialchars($search); ?>" placeholder="Tìm kiếm..." aria-label="Search">
                                <button class="btn btn-sm btn-outline-secondary" type="submit">Tìm</button>
                            </form>
                        </a>
                        <a href="index.php?page_layout=add_category" class="btn btn-primary">Thêm Danh Mục</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Danh Mục</th>
                                    <th>Mô Tả</th>
                                    <th>Số Sản Phẩm</th>
                                    <th>Ngày Tạo</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                                            <td><?php echo htmlspecialchars(substr($row['description'] ?? '', 0, 50)); ?></td>
                                            <td><span class="badge bg-info"><?php echo $row['product_count']; ?></span></td>
                                            <td><?php echo date('Y-m-d', strtotime($row['created_at'])); ?></td>
                                            <td>
                                                <a href="index.php?page_layout=edit_category&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Không tìm thấy danh mục nào.</td>
                                    </tr>
                                <?php endif; ?>
                            
                        </table>
                    </div>
                    <!-- Phân trang -->
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Trước</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Tiếp</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                
          