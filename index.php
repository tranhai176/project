<?php
ob_start();
session_start();
include_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siêu thị nhựa</title>
    <link rel="stylesheet" href="bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main-wrapper">
        <!-- Thanh hotline -->
        <div class="top-bar d-flex justify-content-between">
            <div>Hotline: 0123.456.789 (7h - 23h, 24/7)</div>
            <div><a href="#" class="text-white text-decoration-none">Hệ thống cửa hàng</a></div>
        </div>

        <!-- Logo + Banner + Tìm kiếm -->
        <div class="header-section">
            <a href="index.php" class="home-btn-header"><i class="fas fa-home"></i></a>
            <div class="container-fluid py-3 border-bottom px-4">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        <h3 class="fw-bold text-danger">Siêu thị nhựa</h3>
                    </div>
                    <div class="col-md-6 text-center">
                        <h5 class="fw-bold">SIÊU THỊ NHỰA - VẠN SỰ LỰA CHỌN</h5>
                        <p>HỆ THỐNG CỬA HÀNG UY TÍN</p>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-nowrap user-links py-2 px-2 gap-1">
                            <a href="login.php" class="user-link"><i class="fas fa-user"></i><span>Đăng nhập/Đăng ký</span></a>
                            <a href="#" class="user-link"><i class="fas fa-user-cog"></i><span>Tài khoản</span></a>
                            <a href="index.php?page_layout=cart" class="user-link"><i class="fas fa-shopping-cart"></i><span>Giỏ</span></a>
                            <a href="index.php?page_layout=contact" class="user-link text-warning fw-bold"><i class="fas fa-phone"></i><span>Liên hệ</span></a>
                        </div>
                        <form class="d-flex mt-2" method="GET" action="index.php">
                            <input type="hidden" name="page_layout" value="home">
                            <input class="form-control form-control-sm me-2 search-input" type="search" name="q" placeholder="Tìm kiếm..."
                                aria-label="Search">
                            <button class="btn btn-sm search-btn" type="submit">Tìm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Khung chứa danh mục + cam kết -->
        <div class="container-fluid my-3 px-4">
            <div class="section-card">
                <div class="row align-items-center text-center features-row gx-3">
                    <div class="col-md-4">
                        <div class="feature-item">
                            <i class="fas fa-list"></i>
                            <span>Danh mục sản phẩm đa dạng</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Cam kết chất lượng</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-item">
                            <i class="fas fa-truck-fast"></i>
                            <span>Giao hàng nhanh chóng</span>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_GET['page_layout'])) {
                switch ($_GET['page_layout']) {
                    case 'home':
                        include_once 'home.php';
                        break;
                    case 'product-detail':
                        include_once 'product-detail.php';
                        break;
                    case 'cart':
                        include_once 'cart.php';
                        break;
                    case 'contact':
                        include_once 'contact.php';
                        break;
                    default:
                        include_once 'home.php';
                        break;
                }
            } else {
                include_once 'home.php';
            }
            ?>
        </div>

        <div id="contact" class="bg-dark text-light py-4">
            <div class="container-fluid text-center px-4">
                <p class="mb-1">&copy; 2026 Cửa Hàng Bán đồ nhựa . Bảo lưu mọi quyền.</p>
                <p class="mb-1">Địa chỉ: 123 Đường Đời, TP. Hà Nội</p>
                <p class="mb-0">Điện thoại: 0123-456-789 | Email: info@nhuashop.com</p>
            </div>
        </div>
    </div>
        <!-- Bootstrap JS -->
        <script src="bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>