<?php
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove_item'])) {
        $removeId = (int) $_POST['remove_item'];
        if (isset($_SESSION['cart'][$removeId])) {
            unset($_SESSION['cart'][$removeId]);
        }
        header('Location: index.php?page_layout=cart');
        exit();
    }

    if (isset($_POST['update_cart']) && isset($_POST['quantity']) && is_array($_POST['quantity'])) {
        foreach ($_POST['quantity'] as $productId => $qty) {
            $productId = (int) $productId;
            $quantity = max(1, (int) $qty);
            if ($quantity > 0) {
                $_SESSION['cart'][$productId] = $quantity;
            }
        }
        header('Location: index.php?page_layout=cart');
        exit();
    }
}

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
$relatedProducts = [];
if (isset($conn)) {
    $relatedResult = mysqli_query($conn, "SELECT id, name, price, image FROM products ORDER BY id DESC LIMIT 4");
    if ($relatedResult) {
        while ($row = mysqli_fetch_assoc($relatedResult)) {
            $relatedProducts[] = $row;
        }
    }
}
?>
<div class="container-fluid my-5">
    <div class="section-title"><i class="fas fa-shopping-cart"></i> Giỏ hàng của bạn</div>
    <div class="row gy-4">
        <div class="col-lg-8">
            <?php if ($cartEmpty): ?>
                <div class="alert alert-warning page-alert">Giỏ hàng của bạn đang trống. Hãy thêm sản phẩm vào giỏ để tiếp tục mua sắm.</div>
            <?php else: ?>
                <form method="POST" action="index.php?page_layout=cart">
                    <input type="hidden" name="update_cart" value="1">
                    <div class="table-responsive">
                        <table class="table table-borderless cart-table">
                            <thead class="table-light">
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cartItems as $item): ?>
                                    <?php $imagePath = !empty($item['image']) ? 'admin/imgs/' . htmlspecialchars($item['image']) : 'https://via.placeholder.com/150'; ?>
                                    <tr>
                                        <td class="text-center"><img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($item['name']) ?>" width="90" class="rounded"></td>
                                        <td>
                                            <strong><?= htmlspecialchars($item['name']) ?></strong>
                                            <p class="text-muted mb-0">Kho: <?= intval($item['quantity']) ?> sản phẩm</p>
                                        </td>
                                        <td class="fw-bold product-price"><?= number_format($item['price'], 0, ',', '.') ?>₫</td>
                                        <td class="text-center">
                                            <input type="number" name="quantity[<?= $item['id'] ?>]" value="<?= intval($item['quantity_in_cart']) ?>" min="1" class="form-control qty-input mx-auto">
                                        </td>
                                        <td class="fw-bold product-price"><?= number_format($item['subtotal'], 0, ',', '.') ?>₫</td>
                                        <td class="text-end">
                                            <button type="submit" name="remove_item" value="<?= $item['id'] ?>" class="btn btn-danger btn-sm">Xóa</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 text-end">
                        <button type="submit" class="btn btn-primary">Cập nhật giỏ hàng</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>

        <div class="col-lg-4">
            <div class="cart-summary">
                <h5 class="fw-bold mb-4"><i class="fas fa-box"></i> Tổng kết đơn hàng</h5>
                <div class="d-flex justify-content-between mb-3">
                    <span>Tạm tính</span>
                    <strong><?= number_format($cartTotal, 0, ',', '.') ?>₫</strong>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span>Phí vận chuyển</span>
                    <strong class="text-success">Miễn phí</strong>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="fw-bold">Tổng cộng</span>
                    <strong class="text-danger" style="font-size: 1.25rem;"><?= number_format($cartTotal, 0, ',', '.') ?>₫</strong>
                </div>
                <div class="d-grid gap-3">
                    <button onclick="window.location.href='index.php'" class="btn btn-outline-primary">← Quay lại mua sắm</button>
                    <button class="btn btn-success"><i class="fas fa-check"></i> Thanh toán ngay</button>
                </div>
            </div>
        </div>
    </div>

    <div class="related-products my-5">
        <h3 class="mb-4">Sản phẩm liên quan</h3>
        <div class="row g-4">
            <?php if (!empty($relatedProducts)): ?>
                <?php foreach ($relatedProducts as $product): ?>
                    <?php $imagePath = !empty($product['image']) ? 'admin/imgs/' . htmlspecialchars($product['image']) : 'https://via.placeholder.com/240'; ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100">
                            <img src="<?= $imagePath ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>">
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title"><?= htmlspecialchars($product['name']) ?></h6>
                                <p class="product-price mb-3"><?= number_format($product['price'], 0, ',', '.') ?>₫</p>
                                <div class="card-actions mt-auto">
                                    <a href="index.php?page_layout=product-detail&id=<?= $product['id'] ?>" class="btn btn-success btn-sm">XEM CHI TIẾT</a>
                                    <button class="btn btn-primary btn-sm">THÊM VÀO GIỎ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info page-alert">Không có sản phẩm liên quan.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

       