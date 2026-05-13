<?php
// Include database connection
require_once __DIR__ . '/../../../config/database.php';

// Truy vấn đơn hàng để chỉnh sửa
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

// Xử lý cập nhật trạng thái
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
    $newStatus = mysqli_real_escape_string($conn, $_POST['status']);
    $updateSql = "UPDATE orders SET status = '$newStatus' WHERE id = $orderId";
    if (mysqli_query($conn, $updateSql)) {
        $order['status'] = $newStatus;
        echo '<div class="alert alert-success">Cập nhật trạng thái thành công!</div>';
    } else {
        echo '<div class="alert alert-danger">Lỗi: ' . mysqli_error($conn) . '</div>';
    }
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
        <h2 class="h5 mb-0">Chỉnh Sửa Đơn Hàng #<?php echo $order['id']; ?></h2>
        <a href="index.php?page_layout=view_order&id=<?php echo $order['id']; ?>" class="btn btn-secondary">Xem Chi Tiết</a>
    </div>

    <form method="POST">
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
                <div class="mb-3">
                    <label for="status" class="form-label"><strong>Trạng Thái:</strong></label>
                    <select class="form-select" id="status" name="status">
                        <option value="pending" <?php echo $order['status'] === 'pending' ? 'selected' : ''; ?>>Chờ xử lý</option>
                        <option value="processing" <?php echo $order['status'] === 'processing' ? 'selected' : ''; ?>>Đang xử lý</option>
                        <option value="completed" <?php echo $order['status'] === 'completed' ? 'selected' : ''; ?>>Hoàn thành</option>
                        <option value="delivered" <?php echo $order['status'] === 'delivered' ? 'selected' : ''; ?>>Đã giao</option>
                        <option value="cancelled" <?php echo $order['status'] === 'cancelled' ? 'selected' : ''; ?>>Đã hủy</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="index.php?page_layout=orders" class="btn btn-secondary">Quay Lại</a>
        </div>
    </form>
</div>