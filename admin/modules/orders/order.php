
<?php
// Truy vấn danh sách đơn hàng
require_once __DIR__ . '/../../../config/database.php';

if (!isset($conn)) {
    die('Database connection not established');
}

$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$statusFilter = isset($_GET['status']) ? trim($_GET['status']) : '';
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$where = [];
if ($search !== '') {
    $searchEsc = mysqli_real_escape_string($conn, $search);
    $where[] = "(o.id LIKE '%$searchEsc%' OR u.full_name LIKE '%$searchEsc%' OR u.email LIKE '%$searchEsc%')";
}
if ($statusFilter !== '') {
    $statusEsc = mysqli_real_escape_string($conn, $statusFilter);
    $where[] = "o.status = '$statusEsc'";
}
$whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$totalSql = "SELECT COUNT(*) AS total FROM orders o LEFT JOIN users u ON o.user_id = u.id $whereSql";
$totalResult = mysqli_query($conn, $totalSql);
$totalRows = 0;
if ($totalResult && $rowCount = mysqli_fetch_assoc($totalResult)) {
    $totalRows = (int)$rowCount['total'];
}
$totalPages = max(1, (int)ceil($totalRows / $limit));
if ($page > $totalPages) {
    $page = $totalPages;
    $offset = ($page - 1) * $limit;
}

$sql = "SELECT o.id, o.user_id, o.order_date, o.total, o.status, u.full_name, u.email 
        FROM orders o 
        LEFT JOIN users u ON o.user_id = u.id 
        $whereSql 
        ORDER BY o.order_date DESC 
        LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

function badgeClass($status) {
    $classes = [
        'pending' => 'warning text-dark',
        'processing' => 'info text-dark',
        'completed' => 'primary',
        'delivered' => 'success',
        'cancelled' => 'danger'
    ];
    return $classes[$status] ?? 'secondary';
}

$statusLabel = [
    'pending' => 'Chờ xử lý',
    'processing' => 'Đang xử lý',
    'completed' => 'Hoàn thành',
    'delivered' => 'Đã giao',
    'cancelled' => 'Đã hủy'
];
?>
<div class="card shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h5 mb-0">Danh Sách Đơn Hàng</h2>
                        <form class="d-flex" role="search" method="GET" action="index.php">
                            <input type="hidden" name="page_layout" value="orders">
                            <?php if ($statusFilter !== ''): ?>
                                <input type="hidden" name="status" value="<?php echo htmlspecialchars($statusFilter); ?>">
                            <?php endif; ?>
                            <input class="form-control form-control-sm me-2" type="search" name="q" value="<?php echo htmlspecialchars($search); ?>" placeholder="Tìm kiếm..." aria-label="Search">
                            <button class="btn btn-sm btn-outline-secondary" type="submit">Tìm</button>
                        </form>
                    </div>
                    <div class="mb-3">
                        <a href="index.php?page_layout=orders" class="btn btn-sm btn-warning text-dark me-2<?php echo $statusFilter === '' ? ' active' : ''; ?>">Tất cả</a>
                        <a href="index.php?page_layout=orders&status=pending" class="btn btn-sm btn-warning text-dark me-2<?php echo $statusFilter === 'pending' ? ' active' : ''; ?>">Chờ xử lý</a>
                        <a href="index.php?page_layout=orders&status=processing" class="btn btn-sm btn-info text-dark me-2<?php echo $statusFilter === 'processing' ? ' active' : ''; ?>">Đang xử lý</a>
                        <a href="index.php?page_layout=orders&status=completed" class="btn btn-sm btn-primary me-2<?php echo $statusFilter === 'completed' ? ' active' : ''; ?>">Hoàn thành</a>
                        <a href="index.php?page_layout=orders&status=delivered" class="btn btn-sm btn-success me-2<?php echo $statusFilter === 'delivered' ? ' active' : ''; ?>">Đã giao</a>
                        <a href="index.php?page_layout=orders&status=cancelled" class="btn btn-sm btn-danger<?php echo $statusFilter === 'cancelled' ? ' active' : ''; ?>">Đã hủy</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Mã Đơn Hàng</th>
                                    <th>Khách Hàng</th>
                                    <th>Ngày Đặt</th>
                                    <th>Tổng Tiền</th>
                                    <th>Trạng Thái</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td>#<?php echo $row['id']; ?></td>
                                            <td><?php echo htmlspecialchars($row['full_name'] ?? 'Khách lạ'); ?></td>
                                            <td><?php echo date('Y-m-d', strtotime($row['order_date'])); ?></td>
                                            <td><?php echo number_format($row['total'], 0, ',', '.'); ?>₫</td>
                                            <td><span class="badge bg-<?php echo badgeClass($row['status']); ?>"><?php echo $statusLabel[$row['status']] ?? $row['status']; ?></span></td>
                                            <td class="d-flex gap-1">
                                                <a href="index.php?page_layout=view_order&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary">Xem</a>
                                                <a href="index.php?page_layout=edit_order&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-secondary">Sửa</a>
                                                <button onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')" class="btn btn-sm btn-outline-danger">Xóa</button>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Không tìm thấy đơn hàng nào.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Phân trang -->
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <?php
                                $baseUrl = 'index.php?page_layout=orders';
                                if ($search !== '') {
                                    $baseUrl .= '&q=' . urlencode($search);
                                }
                                if ($statusFilter !== '') {
                                    $baseUrl .= '&status=' . urlencode($statusFilter);
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
                    </div>
                    <!-- Phân trang -->
                    
                </div>
