<?php
// Ensure database connection exists
require_once __DIR__ . '/../../../config/database.php';

if (!isset($conn) || !$conn) {
    echo '<div class="alert alert-danger">Lỗi kết nối cơ sở dữ liệu.</div>';
    return;
}

// Truy vấn chi tiết đơn hàng
$orderId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$orderSql = "SELECT o.*, u.full_name, u.email, u.phone, u.address 
             FROM orders o 
             LEFT JOIN users u ON o.user_id = u.id 
             WHERE o.id = $orderId";
$orderResult = mysqli_query($conn, $orderSql);

if (!$orderResult || mysqli_num_rows($orderResult) === 0) {
    echo '<div class="alert alert-warning">Đơn hàng không tìm thấy.</div>';
    return;
}

$order = mysqli_fetch_assoc($orderResult);

$itemsSql = "SELECT oi.*, p.name as product_name 
             FROM order_items oi 
             LEFT JOIN products p ON oi.product_id = p.id 
             WHERE oi.order_id = $orderId";
$itemsResult = mysqli_query($conn, $itemsSql);

$statusLabel = [
    'pending' => 'Chờ xử lý',
    'processing' => 'Đang xử lý',
    'completed' => 'Hoàn thành',
    'delivered' => 'Đã giao',
    'cancelled' => 'Đã hủy'
];

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
?>
<div class="card shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h5 mb-0">Chi Tiết Đơn Hàng #<?php echo $order['id']; ?></h2>
        <a href="index.php?page_layout=edit_order&id=<?php echo $order['id']; ?>" class="btn btn-primary">Chỉnh Sửa</a>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Thông Tin Khách Hàng</h5>
            <p><strong>Họ Tên:</strong> <?php echo htmlspecialchars($order['full_name'] ?? 'N/A'); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($order['email'] ?? 'N/A'); ?></p>
            <p><strong>Điện Thoại:</strong> <?php echo htmlspecialchars($order['phone'] ?? 'N/A'); ?></p>
            <p><strong>Địa Chỉ:</strong> <?php echo htmlspecialchars($order['address'] ?? 'N/A'); ?></p>
        </div>
        <div class="col-md-6">
            <h5>Thông Tin Đơn Hàng</h5>
            <p><strong>Ngày Đặt:</strong> <?php echo date('d/m/Y H:i', strtotime($order['order_date'])); ?></p>
            <p><strong>Tổng Tiền:</strong> <?php echo number_format($order['total'], 0, ',', '.'); ?>₫</p>
            <p><strong>Ghi Chú:</strong> <?php echo htmlspecialchars($order['notes'] ?? 'Không có'); ?></p>
            <p><strong>Trạng Thái:</strong> <span class="badge bg-<?php echo badgeClass($order['status']); ?>"><?php echo $statusLabel[$order['status']] ?? $order['status']; ?></span></p>
        </div>
    </div>

    <h5>Chi Tiết Sản Phẩm</h5>
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Tên Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Giá</th>
                    <th>Thành Tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($itemsResult && mysqli_num_rows($itemsResult) > 0): ?>
                    <?php while ($item = mysqli_fetch_assoc($itemsResult)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['product_name'] ?? 'N/A'); ?></td>
                            <td><?php echo (int)$item['quantity']; ?></td>
                            <td><?php echo number_format($item['price'], 0, ',', '.'); ?>₫</td>
                            <td><?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?>₫</td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">Không có sản phẩm trong đơn hàng.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="index.php?page_layout=orders" class="btn btn-secondary">Quay Lại</a>
    </div>
</div>