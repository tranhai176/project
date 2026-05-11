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
<style>
    .product-actions .btn-primary {
        font-size: 13px;
    }
    .fa-star {
        color: #ffcc00;
        font-size: 1.5em;
            margin-right: 10px;
    }
    .fa-box {
        color: #b2cfdd;
        font-size: 1.5em;
            margin-right: 10px;
    }
    .fa-truck {
        color: #00ffee;
        font-size: 1.5em;
            margin-right: 10px;
    }
     .fa-check {
        color: #ff3300;
        font-size: 1.5em;
            margin-right: 10px;
    }
</style>
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
                        <p>HỆ THỐNG CỬA HÀNG UY TÍN <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></p>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-wrap user-links py-2 px-3 gap-2">
                            <a href="admin/login.php" class="user-link flex-grow-1"><i class="bi bi-person me-1"></i>Đăng nhập/Đăng ký</a>
                            <a href="#" class="user-link flex-grow-1"><i class="bi bi-gear me-1"></i>Tài khoản</a>
                            <a href="cart.php" class="user-link flex-grow-1"><i class="bi bi-cart me-1"></i>Giỏ hàng</a>
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


            <div class="container my-5">
                <h2 class="mb-4">Giỏ hàng của bạn</h2>
                <div class="row">
                    <!-- Bảng sản phẩm -->
                    <div class="col-md-8">
                        <table class="table table-bordered cart-table bg-white shadow-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><img src="admin/imgs/hop-dung-giay-nhua-chu-nhat.jpg" alt="Hộp Giấy" width="80" class="rounded"></td>
                                    <td>Hộp Giấy Tre Vuông</td>
                                    <td>45,000₫</td>
                                    <td><input type="number" value="1" min="1" class="form-control w-75 mx-auto"></td>
                                    <td>45,000₫</td>
                                    <td><button class="btn btn-danger btn-sm">Xóa</button></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><img src="admin/imgs/hop-dung-giay-nhua-chu-nhat.jpg" alt="Bàn Chải" width="80" class="rounded"></td>
                                    <td>Bàn Chải 018 TT</td>
                                    <td>18,000₫</td>
                                    <td><input type="number" value="2" min="1" class="form-control w-75 mx-auto"></td>
                                    <td>36,000₫</td>
                                    <td><button class="btn btn-danger btn-sm">Xóa</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tổng kết giỏ hàng -->
                    <div class="col-md-4">
                        <div class="cart-summary border rounded shadow-sm p-4 bg-white">
                            <h5 class="fw-bold mb-3"><i class="fas fa-box"></i> Tổng kết</h5>
                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <strong>81,000₫</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Phí vận chuyển:</span>
                                <strong class="text-success">Miễn phí</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold">Tổng cộng:</span>
                                <strong class="text-danger" style="font-size: 18px;">81,000₫</strong>
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <button onclick="window.location.href='index.php'" class="btn btn-outline-primary">← Quay lại mua sắm</button>
                                <button class="btn btn-outline-success"><i class="fas fa-check"></i> Thanh toán ngay</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sản phẩm liên quan -->
            <div class="related-products my-5">
                <h3 class="mb-4">Sản phẩm liên quan</h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card mb-3 h-100 d-flex flex-column">
                            <img src="admin/imgs/hop-giay-may.jpg" class="card-img-top"
                                alt="Hộp Giấy Mây 2123 SI">
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title">Hộp Giấy Mây 2123 SI</h6>
                                <p class="text-danger fw-bold">17,500₫</p>
                                <div class="product-actions">
                                    <a href="product-detail.php" class="btn btn-success">XEM CHI TIẾT</a>
                                    <button class="btn btn-primary w-100">THÊM VÀO GIỏ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mb-3 h-100 d-flex flex-column">
                            <img src="admin/imgs/Ban-chai-1405.png" class="card-img-top" alt="Bàn Chải 1405">
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title">Bàn Chải 1405 160/T 40/H</h6>
                                <p class="text-danger fw-bold">19,500₫</p>
                                <div class="product-actions">
                                    <a href="product-detail.php" class="btn btn-success">XEM CHI TIẾT</a>
                                    <button class="btn btn-primary w-100">THÊM VÀO GIỏ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div id="contact" class="bg-dark text-light py-4">
            <div class="container-fluid text-center">
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