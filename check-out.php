<?php


if (!isset($conn)) {
    include_once 'config/database.php';
}

$orderSuccess = '';
$orderError = '';

$cartItems = [];
$cartTotal = 0;
if (!empty($_SESSION['cart']) && is_array($_SESSION['cart']) && isset($conn)) {
    $cartIds = array_map('intval', array_keys($_SESSION['cart']));
    if (!empty($cartIds)) {
        $idList = implode(',', $cartIds);
        $query = "SELECT id, name, price, quantity, image FROM products WHERE id IN ($idList)";
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $row['quantity_in_cart'] = isset($_SESSION['cart'][$row['id']]) ? max(1, intval($_SESSION['cart'][$row['id']])) : 1;
                $row['subtotal'] = $row['price'] * $row['quantity_in_cart'];
                $cartTotal += $row['subtotal'];
                $cartItems[] = $row;
            }
        }
    }
}

$cartEmpty = empty($cartItems);

$loggedIn = !empty($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $full_name = $loggedIn ? trim($_SESSION['full_name'] ?? '') : trim($_POST['full_name'] ?? '');
    $email = $loggedIn ? trim($_SESSION['email'] ?? '') : trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $notes = trim($_POST['notes'] ?? '');
    $payment = trim($_POST['payment'] ?? 'COD');

    if ($cartEmpty) {
        $orderError = 'Giỏ hàng trống.';
    } elseif (empty($address) || empty($phone) || empty($full_name) || (!$loggedIn && empty($email))) {
        $orderError = 'Vui lòng nhập đầy đủ thông tin giao hàng.';
    } elseif (!$loggedIn && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $orderError = 'Vui lòng nhập email hợp lệ.';
    } else {
        $user_id = 0;
        if ($loggedIn) {
            $user_id = (int) $_SESSION['user_id'];
        } else {
            $emailEscaped = mysqli_real_escape_string($conn, $email);
            $userCheckSql = "SELECT id, full_name, email, phone, address FROM users WHERE email = '$emailEscaped' LIMIT 1";
            $userCheckResult = mysqli_query($conn, $userCheckSql);
            if ($userCheckResult && mysqli_num_rows($userCheckResult) > 0) {
                $userData = mysqli_fetch_assoc($userCheckResult);
                $user_id = (int) $userData['id'];
                $_SESSION['user_id'] = $user_id;
                $_SESSION['full_name'] = $userData['full_name'];
                $_SESSION['email'] = $userData['email'];
                $_SESSION['phone'] = $userData['phone'];
                $_SESSION['address'] = $userData['address'];
            } else {
                $usernameBase = preg_replace('/[^a-z0-9]/', '', strtolower(pathinfo($email, PATHINFO_FILENAME)));
                $usernameBase = $usernameBase ?: 'guest';
                $username = substr($usernameBase . '_' . time(), 0, 90);
                $password = bin2hex(random_bytes(8));
                $fullNameEsc = mysqli_real_escape_string($conn, $full_name);
                $phoneEsc = mysqli_real_escape_string($conn, $phone);
                $addressEsc = mysqli_real_escape_string($conn, $address);
                $insertUserSql = "INSERT INTO users (username, password, email, full_name, phone, address) VALUES ('" . mysqli_real_escape_string($conn, $username) . "', '" . mysqli_real_escape_string($conn, $password) . "', '$emailEscaped', '$fullNameEsc', '$phoneEsc', '$addressEsc')";
                if (mysqli_query($conn, $insertUserSql)) {
                    $user_id = mysqli_insert_id($conn);
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['full_name'] = $full_name;
                    $_SESSION['email'] = $email;
                    $_SESSION['phone'] = $phone;
                    $_SESSION['address'] = $address;
                } else {
                    $orderError = 'Lỗi khi tạo tài khoản khách hàng: ' . mysqli_error($conn);
                }
            }
        }

        if ($user_id > 0 && empty($orderError)) {
            $phoneEsc = mysqli_real_escape_string($conn, $phone);
            $addressEsc = mysqli_real_escape_string($conn, $address);
            $notesEsc = mysqli_real_escape_string($conn, $notes);

            // Calculate total again for safety
            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item['subtotal'];
            }

            $total = (float) $total;
            $notesDb = $notesEsc . ' | Phương thức: ' . mysqli_real_escape_string($conn, $payment) . ' | ĐT: ' . $phoneEsc . ' | Địa chỉ: ' . $addressEsc;
            $insertSql = "INSERT INTO orders (user_id, total, status, notes) VALUES ($user_id, $total, 'pending', '" . mysqli_real_escape_string($conn, $notesDb) . "')";
            if (mysqli_query($conn, $insertSql)) {
                $order_id = mysqli_insert_id($conn);
                $ok = true;
                foreach ($cartItems as $item) {
                    $pid = (int) $item['id'];
                    $qty = (int) $item['quantity_in_cart'];
                    $price = (float) $item['price'];
                    $itSql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ($order_id, $pid, $qty, $price)";
                    if (!mysqli_query($conn, $itSql)) {
                        $ok = false;
                    } else {
                        // decrement product stock
                        mysqli_query($conn, "UPDATE products SET quantity = GREATEST(0, quantity - $qty) WHERE id = $pid");
                    }
                }

                if ($ok) {
                    unset($_SESSION['cart']);
                    header('Location: index.php?page_layout=order-history&id=' . $order_id);
                    exit();
                } else {
                    $orderError = 'Lỗi khi lưu chi tiết đơn hàng.';
                }
            } else {
                if (empty($orderError)) {
                    $orderError = 'Lỗi khi tạo đơn hàng: ' . mysqli_error($conn);
                }
            }
        }
    }
}
?>
<div class="container-fluid my-5 px-0">
    <div class="section-title px-4"><i class="fas fa-credit-card"></i> Thanh toán</div>
    <div class="row gy-4 gx-0">
        <div class="col-12">
            <?php if (!empty($orderError)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($orderError); ?></div>
            <?php endif; ?>
            <?php if (!empty($orderSuccess)): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($orderSuccess); ?></div>
                <div class="mb-3">
                    <a href="index.php" class="btn btn-outline-primary">Quay về trang chủ</a>
                </div>
            <?php else: ?>
                <?php if ($cartEmpty): ?>
                    <div class="alert alert-warning">Giỏ hàng trống. Vui lòng thêm sản phẩm trước khi thanh toán.</div>
                <?php else: ?>
                    <form method="POST" action="index.php?page_layout=check-out">
                        <input type="hidden" name="place_order" value="1">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3">Thông tin giao hàng</h5>
                                <?php if ($loggedIn): ?>
                                    <div class="mb-3">
                                        <label class="form-label">Họ tên</label>
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($_SESSION['full_name'] ?? ''); ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>" disabled>
                                    </div>
                                <?php else: ?>
                                    <div class="mb-3">
                                        <label class="form-label">Họ tên</label>
                                        <input type="text" name="full_name" class="form-control" value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                                    </div>
                                <?php endif; ?>
                                <div class="mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($_POST['phone'] ?? $_SESSION['phone'] ?? ''); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Địa chỉ</label>
                                    <textarea name="address" class="form-control" required><?php echo htmlspecialchars($_POST['address'] ?? $_SESSION['address'] ?? ''); ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ghi chú</label>
                                    <textarea name="notes" class="form-control"><?php echo htmlspecialchars($_POST['notes'] ?? ''); ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phương thức thanh toán</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="payment" id="pay_cod" value="COD" checked>
                                            <label class="form-check-label" for="pay_cod">Thanh toán khi nhận hàng (COD)</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="payment" id="pay_bank" value="Bank">
                                            <label class="form-check-label" for="pay_bank">Chuyển khoản</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3">Chi tiết đơn hàng</h5>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th class="text-center">Số lượng</th>
                                                <th class="text-end">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($cartItems as $item): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                                                    <td class="text-center"><?php echo intval($item['quantity_in_cart']); ?></td>
                                                    <td class="text-end"><?php echo number_format($item['subtotal'], 0, ',', '.'); ?>₫</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div>Tổng</div>
                                    <div class="fw-bold text-danger"><?php echo number_format($cartTotal, 0, ',', '.'); ?>₫</div>
                                </div>
                                <div class="mt-4 d-flex gap-2">
                                    <button type="submit" class="btn btn-success">Đặt hàng</button>
                                    <a href="index.php?page_layout=cart" class="btn btn-outline-secondary">Quay về giỏ hàng</a>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </div>

    </div>

</div>