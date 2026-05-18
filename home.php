<?php
if (!isset($conn) || !$conn) {
    include_once 'config/database.php';
}
if (!$conn) {
    die("Connection failed: Database connection is not available.");
}

// Xử lý thêm vào giỏ hàng
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

$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$categoryFilter = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$whereClauses = [];
if ($search !== '') {
    $searchEsc = mysqli_real_escape_string($conn, $search);
    $whereClauses[] = "(p.name LIKE '%$searchEsc%' OR c.name LIKE '%$searchEsc%')";
}
if ($categoryFilter > 0) {
    $whereClauses[] = "p.category_id = $categoryFilter";
}
$where = '';
if (!empty($whereClauses)) {
    $where = 'WHERE ' . implode(' AND ', $whereClauses);
}
$products = [];
$sql = "SELECT p.id, p.name, p.price, p.quantity, p.image, p.description, c.name AS category_name
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        $where
        ORDER BY p.id DESC";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
}
$categories = [];
$categorySql = "SELECT id, name FROM categories ORDER BY name";
$categoryResult = mysqli_query($conn, $categorySql);
if ($categoryResult) {
    while ($row = mysqli_fetch_assoc($categoryResult)) {
        $categories[] = $row;
    }
}
?>
<div class="container-fluid mt-3">
    <div class="row mb-4">
        <div class="col-12">
            <div class="section-title"><i class="fas fa-th-large"></i> Sản phẩm nổi bật</div>
        </div>
    </div>
    <div class="row">
        <!-- Sidebar -->
        <aside class="col-md-4 col-lg-3 border-end">
            <h5>Danh mục sản phẩm</h5>
            <?php if (!empty($categories)): ?>
                <div class="list-group mb-4">
                    <a href="index.php?page_layout=home" class="list-group-item list-group-item-action<?php echo $categoryFilter === 0 ? ' active' : ''; ?>">Tất cả sản phẩm</a>
                    <?php foreach ($categories as $cat): ?>
                        <a href="index.php?page_layout=home&category=<?php echo $cat['id']; ?>" class="list-group-item list-group-item-action<?php echo $categoryFilter === (int)$cat['id'] ? ' active' : ''; ?>">
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">Không có danh mục.</p>
            <?php endif; ?>

            <div class="section-card mb-4">
                <h5 class="mb-3">Nhà cung cấp</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Duy Tân</li>
                    <li class="list-group-item">Công ty TNHH Nhựa Việt Nhật</li>
                </ul>
            </div>

            <div class="section-card">
                <h5 class="mb-3">Lọc giá</h5>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="price1">
                    <label class="form-check-label" for="price1">Dưới 100.000₫</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="price2">
                    <label class="form-check-label" for="price2">100.000₫ - 200.000₫</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="price3">
                    <label class="form-check-label" for="price3">200.000₫ - 400.000₫</label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="price4">
                    <label class="form-check-label" for="price4">Trên 400.000₫</label>
                </div>
                <button class="btn btn-outline-info btn-sm w-100">Áp dụng</button>
            </div>
        </aside>

        <!-- Main product list -->
        <main class="col-md-8 col-lg-9">
            <div class="row g-3">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-sm-6 col-lg-4 d-flex">
                            <div class="card mb-3 flex-fill">
                                <?php $imagePath = !empty($product['image']) ? 'admin/imgs/' . htmlspecialchars($product['image']) : 'https://via.placeholder.com/300x200'; ?>
                                <img src="<?php echo $imagePath; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h6>
                                    <p class="text-danger fw-bold mb-2"><?php echo number_format($product['price'], 0, ',', '.'); ?>₫</p>
                                    <p class="text-muted small mb-2"><?php echo htmlspecialchars($product['category_name'] ?? 'Không xác định'); ?></p>
                                    <p class="mb-3"><?php echo htmlspecialchars(mb_strimwidth($product['description'] ?? '', 0, 80, '...')); ?></p>
                                    <div class="mt-auto d-flex gap-2">
                                        <a href="index.php?page_layout=product-detail&id=<?php echo $product['id']; ?>" class="btn btn-outline-success btn-sm">XEM CHI TIẾT</a>
                                        <form method="POST" class="flex-fill">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" name="add_to_cart" class="btn btn-outline-primary btn-sm w-100">THÊM VÀO GIỎ HÀNG</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-warning">Không tìm thấy sản phẩm nào.</div>
                    </div>
                <?php endif; ?>
            </div>

            <nav aria-label="Page navigation" class="px-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Trước</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#">Tiếp</a></li>
                </ul>
            </nav>
        </main>
    </div>
</div>