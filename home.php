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
    .card-img-top {
        object-fit: cover;
        height: 150px;
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
                            <a href="login.php" class="user-link flex-grow-1"><i class="bi bi-person me-1"></i>Đăng nhập/Đăng ký</a>
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



            <div class="container-fluid mt-3">
                <div class="row">
                    <!-- Sidebar -->
                    <aside class="col-md-3 col-lg-2 border-end">
                        <h5>Danh mục sản phẩm</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cat1">
                            <label class="form-check-label" for="cat1">Sản phẩm nổi bật</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cat2">
                            <label class="form-check-label" for="cat2">Tất cả sản phẩm</label>
                        </div>


                        <h5 class="mt-3">Nhà cung cấp</h5>
                        <ul class="list-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="supplier1">
                                <label class="form-check-label" for="supplier1">Duy Tân</label><br>
                                <input class="form-check-input" type="checkbox" id="supplier2">
                                <label class="form-check-label" for="supplier2">Công ty TNHH Nhựa Việt Nhật</label><br>
                            </div>
                        </ul>

                        <h5>Lọc giá</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="price1">
                            <label class="form-check-label" for="price1">Dưới 100.000₫</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="price2">
                            <label class="form-check-label" for="price2">100.000₫ - 200.000₫</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="price3">
                            <label class="form-check-label" for="price3">200.000₫ - 400.000₫</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="price4">
                            <label class="form-check-label" for="price4">Trên 400.000₫</label>
                        </div>
                        <button class="btn btn-outline-info btn-sm mt-2">Áp dụng</button>
                    </aside>

                    <!-- Main product list -->
                    <main class="col-md-9 col-lg-10">
                        <div class="row g-3">
                            <!-- Cột 1: Hộp Giấy -->
                            <div class="col-lg-2 d-flex flex-column">
                                <h5 class="mb-3 product-column-title">Hộp Giấy</h5>
                                <div class="card mb-3 h-100 d-flex flex-column">
                                    <img src="admin/imgs/hop-dung-giay-nhua-chu-nhat.jpg" class="card-img-top"
                                        alt="Hộp Giấy Tre Vuông">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title">8741 Hộp Giấy Tre Vuông 24/H 72/T</h6>
                                        <p class="text-danger fw-bold">45,000₫</p>
                                        <div class="product-actions d-flex gap-2">
                                            <a href="product-detail.php" class="btn btn-success">XEM CHI TIẾT</a>
                                            <button class="btn btn-primary flex-fill text-nowrap">THÊM VÀO GIỎ HÀNG</button>
                                        </div>

                                    </div>
                                </div>
                                <div class="card mb-3 h-100 d-flex flex-column">
                                    <img src="admin/imgs/hop-giay-may.jpg" class="card-img-top"
                                        alt="Hộp Giấy Mây 2123 SI">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title">Hộp Giấy Mây 2123 SI</h6>
                                        <p class="text-danger fw-bold">17,500₫</p>
                                        <div class="product-actions d-flex gap-2">
                                            <a href="product-detail.php" class="btn btn-success">XEM CHI TIẾT</a>
                                            <button class="btn btn-primary flex-fill text-nowrap">THÊM VÀO GIỎ HÀNG</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cột 2: Bàn Chải -->
                            <div class="col-lg-2 d-flex flex-column">
                                <h5 class="mb-3 product-column-title">Bàn Chải</h5>
                                <div class="card mb-3 h-100 d-flex flex-column">
                                    <img src="admin/imgs/Ban-chai-018-TT.png" class="card-img-top"
                                        alt="Bàn Chải 018 TT">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title">Bàn Chải 018 TT (30/B)</h6>
                                        <p class="text-danger fw-bold">18,000₫</p>
                                        <div class="product-actions d-flex gap-2">
                                            <a href="product-detail.php" class="btn btn-success">XEM CHI TIẾT</a>
                                            <button class="btn btn-primary flex-fill text-nowrap">THÊM VÀO GIỎ HÀNG</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 h-100 d-flex flex-column">
                                    <img src="admin/imgs/Ban-chai-1405.png" class="card-img-top" alt="Bàn Chải 1405">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title">Bàn Chải 1405 160/T 40/H</h6>
                                        <p class="text-danger fw-bold">19,500₫</p>
                                        <div class="product-actions d-flex gap-2">
                                            <a href="product-detail.php" class="btn btn-success">XEM CHI TIẾT</a>
                                            <button class="btn btn-primary flex-fill text-nowrap">THÊM VÀO GIỎ HÀNG</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cột 3: Bàn -->
                            <div class="col-lg-2 d-flex flex-column">
                                <h5 class="mb-3 product-column-title">Bàn</h5>
                                <div class="card mb-3 h-100 d-flex flex-column">
                                    <img src="admin/imgs/nhua-do.jpg" class="card-img-top"
                                        alt="Bàn Nhựa Đỏ Nhỏ">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title">Bàn Nhựa Đỏ Nhỏ</h6>
                                        <p class="text-danger fw-bold">85,000₫</p>
                                        <div class="product-actions d-flex gap-2">
                                            <a href="product-detail.php" class="btn btn-success">XEM CHI TIẾT</a>
                                            <button class="btn btn-primary flex-fill text-nowrap">THÊM VÀO GIỎ HÀNG</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 h-100 d-flex flex-column">
                                    <img src="admin/imgs/nhua-xanh.jpg" class="card-img-top"
                                        alt="Bàn Nhựa Xanh Chữ Nhật">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title">Bàn Nhựa Xanh Chữ Nhật</h6>
                                        <p class="text-danger fw-bold">250,000₫</p>
                                        <div class="product-actions d-flex gap-2">
                                            <a href="product-detail.php" class="btn btn-success">XEM CHI TIẾT</a>
                                            <button class="btn btn-primary flex-fill text-nowrap">THÊM VÀO GIỎ HÀNG</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cột 4: Ghế -->
                            <div class="col-lg-2 d-flex flex-column">
                                <h5 class="mb-3 product-column-title">Ghế</h5>
                                <div class="card mb-3 h-100 d-flex flex-column">
                                    <img src="admin/imgs/ghe-do.jpg" class="card-img-top"
                                        alt="Ghế Nhựa Đỏ">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title">Ghế Nhựa Đỏ</h6>
                                        <p class="text-danger fw-bold">50,000₫</p>
                                        <div class="product-actions d-flex gap-2">
                                            <a href="product-detail.php" class="btn btn-success">XEM CHI TIẾT</a>
                                            <button class="btn btn-primary flex-fill text-nowrap">THÊM VÀO GIỎ HÀNG</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 h-100 d-flex flex-column">
                                    <img src="admin/imgs/ghe-xanh.jpg" class="card-img-top"
                                        alt="Ghế Nhựa Xanh">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title">Ghế Nhựa Xanh</h6>
                                        <p class="text-danger fw-bold">120,000₫</p>
                                        <div class="product-actions d-flex gap-2">
                                            <a href="product-detail.php" class="btn btn-success">XEM CHI TIẾT</a>
                                            <button class="btn btn-primary flex-fill text-nowrap">THÊM VÀO GIỎ HÀNG</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cột 5: Bát -->
                            <div class="col-lg-2 d-flex flex-column">
                                <h5 class="mb-3 product-column-title">Bát</h5>
                                <div class="card mb-3 h-100 d-flex flex-column">
                                    <img src="admin/imgs/bat-5.5.jpg" class="card-img-top"
                                        alt="Bát 2141 SI 300/T 10/B">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title">Bát 2141 SI 300/T 10/B</h6>
                                        <p class="text-danger fw-bold">5,500₫</p>
                                        <div class="product-actions d-flex gap-2">
                                            <a href="product-detail.php" class="btn btn-success">XEM CHI TIẾT</a>
                                            <button class="btn btn-primary flex-fill text-nowrap">THÊM VÀO GIỎ HÀNG</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 h-100 d-flex flex-column">
                                    <img src="admin/imgs/bat-phip.jpg" class="card-img-top"
                                        alt="Bát Phíp 6828 Vn 10/B 120/T">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title">Bát Phíp 6828 Vn 10/B 120/T</h6>
                                        <p class="text-danger fw-bold">10,000₫</p>
                                        <div class="product-actions d-flex gap-2">
                                            <a href="product-detail.php" class="btn btn-success">XEM CHI TIẾT</a>
                                            <button class="btn btn-primary flex-fill text-nowrap">THÊM VÀO GIỎ HÀNG</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cột 6: Thùng rác -->
                            <div class="col-lg-2 d-flex flex-column">
                                <h5 class="mb-3 product-column-title">Thùng rác</h5>
                                <div class="card mb-3 h-100 d-flex flex-column">
                                    <img src="admin/imgs/bat-rac-hong.jpg" class="card-img-top"
                                        alt="Bật Rác Tròn 66 - 2766 Sl">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title">Bật Rác Tròn 66 - 2766 Sl</h6>
                                        <p class="text-danger fw-bold">245,000₫</p>
                                        <div class="product-actions d-flex gap-2">
                                            <a href="product-detail.php" class="btn btn-success">XEM CHI TIẾT</a>
                                            <button class="btn btn-primary flex-fill text-nowrap">THÊM VÀO GIỎ HÀNG</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 h-100 d-flex flex-column">
                                    <img src="admin/imgs/bat-rac-vuong-hokori.png" class="card-img-top"
                                        alt="Bật Rác Vuông 10L Hokori 8061 Vn 3/D">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title">Bật Rác Vuông 10L Hokori 8061 Vn 3/D</h6>
                                        <p class="text-danger fw-bold">173,000₫</p>
                                        <div class="product-actions d-flex gap-2">
                                            <a href="product-detail.php" class="btn btn-success">XEM CHI TIẾT</a>
                                            <button class="btn btn-primary flex-fill text-nowrap">THÊM VÀO GIỎ HÀNG</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>

        <!-- Phân trang -->
        <nav aria-label="Page navigation" class="px-4">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Trước</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Tiếp</a>
                </li>
            </ul>
        </nav>



        <div id="contact" class="bg-dark text-light py-4">
            <div class="container-fluid text-center px-4">
                <p class="mb-1">&copy; 2026 Cửa Hàng Bán đồ nhựa . Bảo lưu mọi quyền.</p>
                <p class="mb-1">Địa chỉ: 123 Đường Đời, TP. Hà Nội</p>
                <p class="mb-0">Điện thoại: 0123-456-789 | Email: info@nhuashop.com</p>
            </div>
        </div>
        <!-- Bootstrap JS -->
        <script src="bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>