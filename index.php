<?php
ob_start();
session_start();
include_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sieuthinhua</title>
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
            <div class="container-fluid py-3 border-bottom px-4">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        <h3 class="fw-bold text-danger">Sieuthinhua.vn</h3>
                    </div>
                    <div class="col-md-6 text-center">
                        <h5 class="fw-bold">SIÊU THỊ NHỰA - VẠN SỰ LỰA CHỌN</h5>
                        <p>HỆ THỐNG CỬA HÀNG UY TÍN</p>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-wrap user-links py-2 px-3 gap-2">
                            <a href="login.php" class="user-link flex-grow-1"><i class="bi bi-person me-1"></i>Đăng nhập/Đăng ký</a>
                            <a href="#" class="user-link flex-grow-1"><i class="bi bi-gear me-1"></i>Tài khoản</a>
                            <a href="index.php?page_layout=cart" class="user-link flex-grow-1"><i class="bi bi-cart me-1"></i>Giỏ hàng</a>
                            <a href="contact.php" class="user-link flex-grow-1 text-warning fw-bold"><i class="bi bi-telephone me-1"></i>Liên hệ</a>
                        </div>
                        <form class="d-flex mt-2">
                            <input class="form-control form-control-sm me-2 search-input" type="search" placeholder="Tìm kiếm..."
                                aria-label="Search">
                            <button class="btn btn-sm search-btn" type="submit">Tìm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Khung chứa danh mục + cam kết -->
        <div class="container-fluid my-3 px-4">
            <div class="border rounded p-3 shadow-sm bg-white">
                <div class="row align-items-center text-center">
                    <!-- Accordion danh mục sản phẩm -->
                    <div class="col-md-3">
                        <div class="accordion accordion-overlay" id="accordionDanhMuc">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne">
                                        Danh mục sản phẩm
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionDanhMuc">
                                    <div class="accordion-body p-2">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Hộp Giấy Tre Vuông</li>
                                            <li class="list-group-item">Bàn Chải</li>
                                            <li class="list-group-item">Bàn</li>
                                            <li class="list-group-item">Ghế</li>
                                            <li class="list-group-item">Bát</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Các cam kết dịch vụ -->
                    <div class="col-md-3">
                        <i class="fas fa-check"></i> Đảm bảo chất lượng
                    </div>
                    <div class="col-md-3">
                        <i class="fas fa-truck"></i> Miễn phí vận chuyển
                    </div>
                    <div class="col-md-3">
                        <i class="fas fa-box"></i> Mở hộp kiểm tra nhận hàng
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