
<?php
// Include database connection
require_once __DIR__ . '/../../../config/database.php';

// Xử lý delete
$deleteError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = (int)$_POST['delete_id'];

    // Lấy danh sách sản phẩm của danh mục để xóa ảnh và order items nếu cần
    $productIds = [];
    $productSql = "SELECT id, image FROM products WHERE category_id = $deleteId";
    $productResult = mysqli_query($conn, $productSql);
    if ($productResult) {
        while ($prod = mysqli_fetch_assoc($productResult)) {
            $productIds[] = (int)$prod['id'];
            if (!empty($prod['image'])) {
                $imgPath = __DIR__ . '/../../../admin/imgs/' . $prod['image'];
                if (file_exists($imgPath)) {
                    unlink($imgPath);
                }
            }
        }
    }

    if (!empty($productIds)) {
        $idsString = implode(', ', $productIds);
        mysqli_query($conn, "DELETE FROM order_items WHERE product_id IN ($idsString)");
        mysqli_query($conn, "DELETE FROM products WHERE id IN ($idsString)");
    }

    $deleteSql = "DELETE FROM categories WHERE id = $deleteId";
    if (mysqli_query($conn, $deleteSql)) {
        header('Location: index.php?page_layout=category&msg=deleted');
        exit();
    } else {
        $deleteError = 'Lỗi khi xóa danh mục: ' . mysqli_error($conn);
    }
}

// Đảm bảo cột product_count tồn tại
$columnCheck = mysqli_query($conn, "SHOW COLUMNS FROM categories LIKE 'product_count'");
if ($columnCheck && mysqli_num_rows($columnCheck) === 0) {
    mysqli_query($conn, "ALTER TABLE categories ADD COLUMN product_count INT DEFAULT NULL");
}

$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 10;
$where = '';
if ($search !== '') {
    $searchEsc = mysqli_real_escape_string($conn, $search);
    $where = "WHERE name LIKE '%$searchEsc%' OR description LIKE '%$searchEsc%'";
}
$countSql = "SELECT COUNT(*) AS total FROM categories c $where";
$countResult = mysqli_query($conn, $countSql);
$totalRows = 0;
if ($countResult && $countRow = mysqli_fetch_assoc($countResult)) {
    $totalRows = (int)$countRow['total'];
}
$totalPages = max(1, (int)ceil($totalRows / $limit));
if ($page > $totalPages) {
    $page = $totalPages;
}
$offset = ($page - 1) * $limit;
$sql = "SELECT c.id, c.name, c.description, c.created_at, c.product_count, COUNT(p.id) as actual_count 
        FROM categories c 
        LEFT JOIN products p ON c.id = p.category_id 
        $where 
        GROUP BY c.id 
        ORDER BY c.created_at DESC 
        LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);
?>

                <div class="card shadow-sm p-4">
                    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
                        <div class="alert alert-success">Xóa danh mục thành công!</div>
                    <?php endif; ?>
                    <?php if (!empty($deleteError)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($deleteError); ?></div>
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
                                            <td><?php echo htmlspecialchars(mb_substr($row['description'] ?? '', 0, 50, 'UTF-8')); ?></td>
                                            <td><span class="badge bg-info"><?php echo $row['product_count'] !== null ? $row['product_count'] : $row['actual_count']; ?></span></td>
                                            <td><?php echo date('Y-m-d', strtotime($row['created_at'])); ?></td>
                                            <td>
                                                <a href="index.php?page_layout=edit_category&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa danh mục sẽ xóa toàn bộ sản phẩm trong danh mục này. Bạn có chắc?')">Xóa</button>
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
                            <?php
                            $baseUrl = 'index.php?page_layout=category';
                            if ($search !== '') {
                                $baseUrl .= '&q=' . urlencode($search);
                            }
                            $prevPage = max(1, $page - 1);
                            $nextPage = min($totalPages, $page + 1);
                            ?>
                            <li class="page-item <?php echo $page === 1 ? 'disabled' : ''; ?>">
                                <a class="page-link" href="<?php echo $baseUrl . '&page=' . $prevPage; ?>" tabindex="-1">Trước</a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?php echo $page === $i ? 'active' : ''; ?>">
                                    <a class="page-link" href="<?php echo $baseUrl . '&page=' . $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?php echo $page === $totalPages ? 'disabled' : ''; ?>">
                                <a class="page-link" href="<?php echo $baseUrl . '&page=' . $nextPage; ?>">Tiếp</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                
          