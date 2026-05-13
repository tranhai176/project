
<?php
require_once __DIR__ . '/../../../config/database.php';

if (!isset($conn)) {
    die('Database connection not initialized');
}

// Xử lý delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = (int)$_POST['delete_id'];
    
    // Lấy thông tin sản phẩm để xóa ảnh
    $productSql = "SELECT image FROM products WHERE id = $deleteId";
    $productResult = mysqli_query($conn, $productSql);
    
    if ($productResult && $row = mysqli_fetch_assoc($productResult)) {
        // Xóa file ảnh nếu tồn tại
        if (!empty($row['image'])) {
            $imgPath = __DIR__ . '/../../../admin/imgs/' . $row['image'];
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }
    }
    
    // Xóa sản phẩm khỏi DB
    $deleteSql = "DELETE FROM products WHERE id = $deleteId";
    if (mysqli_query($conn, $deleteSql)) {
        header('Location: index.php?page_layout=product&msg=deleted');
        exit();
    }
}

$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$where = '';
if ($search !== '') {
    $searchEsc = mysqli_real_escape_string($conn, $search);
    $where = "WHERE p.name LIKE '%$searchEsc%' OR c.name LIKE '%$searchEsc%'";
}
$sql = "SELECT p.id, p.name, p.price, p.quantity, p.image, c.name as category_name, c.id as category_id 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        $where 
        ORDER BY p.id DESC";
$result = mysqli_query($conn, $sql);
?>
                <div class="card shadow-sm p-4">
                    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
                        <div class="alert alert-success">Xóa sản phẩm thành công!</div>
                    <?php endif; ?>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h5 mb-0">Danh Sách Sản Phẩm</h2>
                        <a>
                            <form class="d-flex" role="search" method="GET" action="index.php">
                                <input type="hidden" name="page_layout" value="product">
                                <input class="form-control form-control-sm me-2" type="search" name="q" value="<?php echo htmlspecialchars($search); ?>" placeholder="Tìm kiếm..." aria-label="Search">
                                <button class="btn btn-sm btn-outline-secondary" type="submit">Tìm</button>
                            </form>
                        </a>
                        <a href="index.php?page_layout=add_product" class="btn btn-primary">Thêm Sản Phẩm</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hình Ảnh</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Danh Mục</th>
                                    <th>Giá</th>
                                    <th>Tồn Kho</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td>
                                                <?php if ($row['image']): ?>
                                                    <img src="imgs/<?php echo htmlspecialchars($row['image']); ?>" class="img-fluid rounded" alt="<?php echo htmlspecialchars($row['name']); ?>" width="60px" onerror="this.src='https://via.placeholder.com/60'">
                                                <?php else: ?>
                                                    <img src="https://via.placeholder.com/60" class="img-fluid rounded" alt="No image">
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['category_name'] ?? 'N/A'); ?></td>
                                            <td><?php echo number_format($row['price'], 0, ',', '.'); ?>₫</td>
                                            <td>
                                                <?php if ($row['quantity'] > 0): ?>
                                                    <span class="badge bg-success"><?php echo $row['quantity']; ?></span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Hết</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="index.php?page_layout=edit_product&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Không tìm thấy sản phẩm nào.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
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
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Tiếp</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                
            </div>
        </div>
    </div>
