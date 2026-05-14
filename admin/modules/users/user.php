
<?php
require_once __DIR__ . '/../../../config/database.php';

// Xử lý delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = (int)$_POST['delete_id'];
    
    // Xóa thành viên
    $deleteSql = "DELETE FROM users WHERE id = $deleteId";
    if (mysqli_query($conn, $deleteSql)) {
        header('Location: index.php?page_layout=user&msg=deleted');
        exit();
    }
}

$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;
$where = '';
if ($search !== '') {
    $searchEsc = mysqli_real_escape_string($conn, $search);
    $where = "WHERE full_name LIKE '%$searchEsc%' OR email LIKE '%$searchEsc%' OR username LIKE '%$searchEsc%'";
}
$totalSql = "SELECT COUNT(*) AS total FROM users $where";
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
$sql = "SELECT id, username, email, full_name, phone, created_at FROM users $where ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);
?>
                <div class="card shadow-sm p-4">
                    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
                        <div class="alert alert-success">Xóa thành viên thành công!</div>
                    <?php endif; ?>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="h5 mb-1">Danh Sách Thành Viên</h2>
                        </div>
                        <a>
                            <form class="d-flex" role="search" method="GET" action="index.php">
                                <input type="hidden" name="page_layout" value="user">
                                <input class="form-control form-control-sm me-2" type="search" name="q" value="<?php echo htmlspecialchars($search); ?>" placeholder="Tìm kiếm..." aria-label="Search">
                                <button class="btn btn-sm btn-outline-secondary" type="submit">Tìm</button>
                            </form>
                        </a>
                        <a href="index.php?page_layout=add_user" class="btn btn-primary">Thêm Thành Viên</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Họ Tên</th>
                                    <th>Email</th>
                                    <th>Tài Khoản</th>
                                    <th>Điện Thoại</th>
                                    <th>Ngày Tạo</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo htmlspecialchars($row['full_name'] ?? 'N/A'); ?></td>
                                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                                            <td><?php echo htmlspecialchars($row['phone'] ?? 'N/A'); ?></td>
                                            <td><?php echo date('Y-m-d', strtotime($row['created_at'])); ?></td>
                                            <td>
                                                <a href="index.php?page_layout=edit_user&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc muốn xóa thành viên này?')">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Không tìm thấy thành viên nào.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Phân trang -->
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <?php
                                $baseUrl = 'index.php?page_layout=user';
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
                </div>

                
            