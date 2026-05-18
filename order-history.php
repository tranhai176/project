<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($conn)) {
    require_once 'config/database.php';
}

$loggedIn = !empty($_SESSION['user_id']);
$orderList = [];
$orderDetail = null;
$orderItems = [];
$cancelMessage = '';
$cancelError = '';
$userId = $loggedIn ? (int) $_SESSION['user_id'] : 0;

if ($loggedIn && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order_id'])) {
    $cancelId = (int) $_POST['cancel_order_id'];
    if ($cancelId <= 0) {
        $cancelError = 'Mã đơn hàng không hợp lệ.';
    } else {
        $checkSql = "SELECT status FROM orders WHERE id = $cancelId AND user_id = $userId LIMIT 1";
        $checkResult = mysqli_query($conn, $checkSql);
        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            $orderRow = mysqli_fetch_assoc($checkResult);
            $status = $orderRow['status'];
            if (in_array($status, ['pending', 'processing'])) {
                if (mysqli_query($conn, "UPDATE orders SET status = 'cancelled' WHERE id = $cancelId")) {
                    $cancelMessage = 'Đơn hàng đã được hủy thành công.';
                } else {
                    $cancelError = 'Lỗi hủy đơn hàng: ' . mysqli_error($conn);
                }
            } else {
                $cancelError = 'Đơn hàng đang không thể hủy.';
            }
        } else {
            $cancelError = 'Đơn hàng không tồn tại hoặc không thuộc về bạn.';
        }
    }
}

if ($loggedIn) {
    $userId = (int) $_SESSION['user_id'];
    $orderSql = "SELECT o.*, u.full_name, u.email FROM orders o LEFT JOIN users u ON o.user_id = u.id WHERE o.user_id = $userId ORDER BY o.order_date DESC";
    $orderResult = mysqli_query($conn, $orderSql);
    if ($orderResult) {
        while ($row = mysqli_fetch_assoc($orderResult)) {
            $orderList[] = $row;
        }
    }

    if (isset($_GET['id'])) {
        $orderId = (int) $_GET['id'];
        if ($orderId > 0) {
            $detailSql = "SELECT o.*, u.full_name, u.email, u.phone, u.address FROM orders o LEFT JOIN users u ON o.user_id = u.id WHERE o.id = $orderId AND o.user_id = $userId LIMIT 1";
            $detailResult = mysqli_query($conn, $detailSql);
            if ($detailResult && mysqli_num_rows($detailResult) > 0) {
                $orderDetail = mysqli_fetch_assoc($detailResult);
            }
        }
    }
}

if ($orderDetail) {
    $orderIdForItems = (int) $orderDetail['id'];
    $itemSql = "SELECT oi.*, p.name FROM order_items oi LEFT JOIN products p ON oi.product_id = p.id WHERE oi.order_id = $orderIdForItems";
    $itemResult = mysqli_query($conn, $itemSql);
    if ($itemResult) {
        while ($item = mysqli_fetch_assoc($itemResult)) {
            $orderItems[] = $item;
        }
    }
}
?>
<div class="container-fluid my-5">
    <div class="section-title"><i class="fas fa-history"></i> Kiểm tra đơn hàng</div>
    <div class="row gy-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title mb-4">Theo dõi đơn hàng đã đặt</h4>
                    <div class="mb-4">
                        <p class="mb-0">Danh sách đơn hàng đã đặt của bạn sẽ được hiển thị bên dưới.</p>
                    </div>
                    <?php if (!empty($cancelMessage)): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($cancelMessage); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($cancelError)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($cancelError); ?></div>
                    <?php endif; ?>

                    <?php if ($loggedIn && count($orderList) > 0): ?>
                        <div class="mb-4">
                            <h5 class="mb-3">Danh sách đơn hàng của bạn</h5>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Mã đơn</th>
                                            <th>Ngày đặt</th>
                                            <th>Trạng thái</th>
                                            <th>Tổng</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orderList as $order): ?>
                                            <tr>
                                                <td>#<?php echo intval($order['id']); ?></td>
                                                <td><?php echo date('d/m/Y H:i', strtotime($order['order_date'])); ?></td>
                                                <td>
                                                    <span class="badge bg-<?php echo $order['status'] === 'completed' ? 'success' : ($order['status'] === 'delivered' ? 'info' : ($order['status'] === 'processing' ? 'warning' : ($order['status'] === 'cancelled' ? 'danger' : 'secondary'))); ?>">
                                                        <?php echo htmlspecialchars(ucfirst($order['status'])); ?>
                                                    </span>
                                                </td>
                                                <td><?php echo number_format($order['total'], 0, ',', '.'); ?>₫</td>
                                                <td>
                                            <div class="d-flex gap-2">
                                                <a href="index.php?page_layout=order-history&id=<?php echo intval($order['id']); ?>" class="btn btn-sm btn-outline-primary">Xem</a>
                                                <?php if (in_array($order['status'], ['pending', 'processing'])): ?>
                                                    <form method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');">
                                                        <input type="hidden" name="cancel_order_id" value="<?php echo intval($order['id']); ?>">
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">Xóa</button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php elseif ($loggedIn): ?>
                        <div class="alert alert-info">Bạn chưa có đơn hàng nào. Hãy thêm sản phẩm và đặt hàng ngay.</div>
                    <?php endif; ?>

                    <?php if ($orderDetail): ?>
                        <div class="card border-light shadow-sm mb-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-wrap gap-2 mb-3">
                                    <div>
                                        <h5 class="mb-1">Đơn hàng #<?php echo intval($orderDetail['id']); ?></h5>
                                        <p class="mb-0 text-muted">Ngày đặt: <?php echo date('d/m/Y H:i', strtotime($orderDetail['order_date'])); ?></p>
                                    </div>
                                    <div>
                                        <span class="badge bg-<?php echo $orderDetail['status'] === 'completed' ? 'success' : ($orderDetail['status'] === 'delivered' ? 'info' : ($orderDetail['status'] === 'processing' ? 'warning' : ($orderDetail['status'] === 'cancelled' ? 'danger' : 'secondary'))); ?> py-2 px-3 fs-7">
                                            <?php echo htmlspecialchars(ucfirst($orderDetail['status'])); ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Khách hàng:</strong> <?php echo htmlspecialchars($orderDetail['full_name'] ?? 'Khách hàng'); ?></p>
                                        <p class="mb-1"><strong>Email:</strong> <?php echo htmlspecialchars($orderDetail['email'] ?? ''); ?></p>
                                        <p class="mb-0"><strong>Điện thoại:</strong> <?php echo htmlspecialchars($orderDetail['phone'] ?? ''); ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Địa chỉ:</strong> <?php echo nl2br(htmlspecialchars($orderDetail['address'] ?? '')); ?></p>
                                        <p class="mb-0"><strong>Tổng tiền:</strong> <?php echo number_format($orderDetail['total'], 0, ',', '.'); ?>₫</p>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th class="text-center">Số lượng</th>
                                                <th class="text-end">Giá</th>
                                                <th class="text-end">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($orderItems as $item): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($item['name'] ?? 'Sản phẩm'); ?></td>
                                                    <td class="text-center"><?php echo intval($item['quantity']); ?></td>
                                                    <td class="text-end"><?php echo number_format($item['price'], 0, ',', '.'); ?>₫</td>
                                                    <td class="text-end"><?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?>₫</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <?php if (!empty($orderDetail['notes'])): ?>
                                    <div class="mt-4">
                                        <p class="mb-1"><strong>Ghi chú:</strong></p>
                                        <p><?php echo nl2br(htmlspecialchars($orderDetail['notes'])); ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if (in_array($orderDetail['status'], ['pending', 'processing'])): ?>
                                    <form method="POST" class="mt-4" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');">
                                        <input type="hidden" name="cancel_order_id" value="<?php echo intval($orderDetail['id']); ?>">
                                        <button type="submit" class="btn btn-danger">Hủy đơn hàng</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
