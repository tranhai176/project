<?php
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!isset($conn) || !$conn) {
    include_once 'config/database.php';
}
if (!$conn) {
    echo '<div class="container-fluid my-4 px-4"><div class="alert alert-danger">Không thể kết nối tới cơ sở dữ liệu.</div></div>';
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = (int)$_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? max(1, (int)$_POST['quantity']) : 1;
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

$product = null;
if ($productId > 0) {
    $sql = "SELECT p.id, p.name, p.price, p.quantity, p.image, p.description, c.name AS category_name
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.id = $productId
            LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    }
}
if (!$product) {
    echo '<div class="container-fluid my-4 px-4"><div class="alert alert-warning">Sản phẩm không tồn tại hoặc đã bị xóa.</div></div>';
    return;
}
$imagePath = !empty($product['image']) ? 'admin/imgs/' . htmlspecialchars($product['image']) : 'https://via.placeholder.com/600x400';
$stockStatus = $product['quantity'] > 0 ? 'Còn hàng' : 'Hết hàng';
?>

<!-- Chi tiết sản phẩm -->
<div class="container-fluid my-4 px-4">
    <div class="row g-4 align-items-start">
        <!-- Ảnh sản phẩm -->
        <div class="col-lg-5">
            <div class="product-image-container shadow-sm rounded-3 bg-white p-3">
                <img src="<?php echo $imagePath; ?>" class="img-fluid rounded-2 mb-3 product-main-img" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
        </div>
        <!-- Thông tin sản phẩm -->
        <div class="col-lg-7">
            <div class="product-info bg-white rounded-3 shadow-sm p-4">
                <h1 class="product-title mb-2"><?php echo htmlspecialchars($product['name']); ?></h1>
                <div class="product-badges">
                    <span class="product-badge"><i class="fas fa-hashtag"></i> Mã: <?php echo $product['id']; ?></span>
                    <span class="product-badge"><i class="fas fa-check"></i> <?php echo $stockStatus; ?></span>
                    <span class="product-badge"><i class="fas fa-star"></i> 4.8 (245 đánh giá)</span>
                </div>
                <hr>
                <div class="price-section mb-4">
                    <p class="text-muted mb-1">Giá bán</p>
                    <h2 class="price-large"><?php echo number_format($product['price'], 0, ',', '.'); ?>₫</h2>
                    <?php if ($product['quantity'] > 0): ?>
                        <p class="text-muted small">Kho: <?php echo $product['quantity']; ?> sản phẩm</p>
                    <?php else: ?>
                        <p class="text-muted small">Hiện tại sản phẩm đang tạm hết hàng</p>
                    <?php endif; ?>
                </div>
                <hr>
                <div class="quantity-section mb-4">
                    <label class="fw-bold mb-2 d-block"><i class="fas fa-box"></i> Số lượng:</label>
                    <div class="d-flex gap-2 align-items-center">
                        <button class="btn btn-outline-secondary" type="button" onclick="document.querySelector('.qty-input').value = Math.max(1, parseInt(document.querySelector('.qty-input').value) - 1)">−</button>
                        <input type="number" value="1" min="1" class="form-control qty-input text-center qty-input-custom" style="width: 80px;">
                        <button class="btn btn-outline-secondary" type="button" onclick="document.querySelector('.qty-input').value = parseInt(document.querySelector('.qty-input').value) + 1">+</button>
                        <span class="text-muted ms-2">Kho: <?php echo $product['quantity']; ?> sản phẩm</span>
                    </div>
                </div>
                <hr>
                <div class="delivery-section mb-4">
                    <label class="fw-bold mb-3 d-block"><i class="fas fa-map-marker-alt"></i> THÔNG TIN NHẬN HÀNG</label>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control" placeholder="Nhập số điện thoại..." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" placeholder="Nhập họ và tên..." required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Địa chỉ giao hàng</label>
                            <textarea class="form-control" rows="2" placeholder="Nhập địa chỉ chi tiết (số nhà, đường phố, phường/xã, quận/huyện, tỉnh/thành phố)..." required></textarea>
                        </div>
                    </div>
                </div>
                <div class="action-buttons mb-4">
                    <form method="POST" class="flex-fill">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" name="add_to_cart" class="btn btn-primary btn-sm w-100">THÊM VÀO GIỎ HÀNG</button>
                                        </form>
                    <button class="btn btn-danger"><i class="fas fa-bolt"></i> MUA NGAY</button>
                </div>
                <hr>
                <div class="policies">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="policy-item">
                                <i class="fas fa-check"></i>
                                <div>
                                    <strong>Chính hãng 100%</strong>
                                    <p class="text-muted small mb-0">Cam kết hàng chính hãng</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="policy-item">
                                <i class="fas fa-truck"></i>
                                <div>
                                    <strong>Miễn phí vận chuyển</strong>
                                    <p class="text-muted small mb-0">Trên toàn quốc</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="policy-item">
                                <i class="fas fa-sync"></i>
                                <div>
                                    <strong>Đổi trả 72h</strong>
                                    <p class="text-muted small mb-0">Không phí đổi trả</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="policy-item">
                                <i class="fas fa-phone"></i>
                                <div>
                                    <strong>Hỗ trợ 24/7</strong>
                                    <p class="text-muted small mb-0">0123-456-789</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mô tả sản phẩm -->
        <div class="col-12">
            <div class="description mt-5 p-4 bg-white rounded-3 shadow-sm">
                <h4 class="fw-bold mb-3"><i class="fas fa-file-alt"></i> MÔ TẢ CHI TIẾT SẢN PHẨM</h4>
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary fw-bold mb-2">Tên sản phẩm</h6>
                        <p><?php echo htmlspecialchars($product['name']); ?></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary fw-bold mb-2">Danh mục</h6>
                        <p><?php echo htmlspecialchars($product['category_name'] ?? 'Chưa phân loại'); ?></p>
                    </div>
                </div>
                <hr>
                <h6 class="text-primary fw-bold mb-2">Giới thiệu</h6>
                <p><?php echo nl2br(htmlspecialchars($product['description'] ?? 'Chưa có mô tả.')); ?></p>
            </div>

            <!-- Bình luận sản phẩm -->
            <div class="comments mt-5 p-4 bg-white rounded-3 shadow-sm">
                <h4 class="fw-bold mb-4"><i class="fas fa-comments"></i> Bình luận (245)</h4>

                <!-- Form nhập bình luận -->
                <form class="mb-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Viết bình luận của bạn</label>
                        <textarea class="form-control rounded-2" rows="3" placeholder="Chia sẻ trải nghiệm của bạn với sản phẩm này..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary fw-bold"><i class="fas fa-paper-plane"></i> Gửi bình luận</button>
                </form>

                <hr>

                <!-- Danh sách bình luận -->
                <div class="comments-list">
                    <div class="comment-item mb-3 pb-3 border-bottom">
                        <div class="d-flex gap-3">
                            <div class="avatar-circle avatar-pink"></div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <strong>Nguyễn Văn A</strong>
                                    <span class="text-warning"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span>
                                </div>
                                <p class="text-muted small mb-2">15/04/2026</p>
                                <p class="mb-0">Sản phẩm dùng rất tiện, chất lượng tốt, giá hợp lý. Sẽ mua lại lần sau.</p>
                            </div>
                        </div>
                    </div>
                    <div class="comment-item pb-3">
                        <div class="d-flex gap-3">
                            <div class="avatar-circle avatar-blue"></div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <strong>Trần Thị B</strong>
                                    <span class="text-warning"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span>
                                </div>
                                <p class="text-muted small mb-2">16/04/2026</p>
                                <p class="mb-0">Giá hợp lý, giao hàng nhanh. Packaging đẹp, khách hàng rất hài lòng.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Footer --> -->