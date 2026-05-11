<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sieuthinhua</title>
    <link rel="stylesheet" href="bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <style>
        .fa-check-camket {
            color: #28a745;
            font-size: 1.5em;
            margin-right: 10px;
        }

        .fa-box accordion-button::after {
            display: none;
        }

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

        .fa-phone {
            color: #ff00bb;
            font-size: 1.5em;
            margin-right: 10px;
        }

        .fa-sync {
            color: #00b3ff;
            font-size: 1.5em;
            margin-right: 10px;
        }

        .fa-file-alt {
            color: #ff7b00;
            font-size: 1.5em;
            margin-right: 10px;
        }

        .fa-comments {
            color: #00f7ff;
            font-size: 1.5em;
            margin-right: 10px;
        }
        .fa-check-1
        {
            color: #ff0000;
            font-size: 1em;
            margin-right: 5px;
        }
        .fa-star-1
        {
            color: #ffcc00;
            font-size: 1em;
            margin-right: 5px;
        }
        .fa-map-marker-alt {
            color: #ff00cc;
            font-size: 1.5em;
            margin-right: 10px;
        }
    </style>
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


            <!-- Chi tiết sản phẩm -->
            <div class="container-fluid my-4 px-4">
                <div class="row g-4">
                    <!-- Ảnh sản phẩm -->
                    <div class="col-lg-5">
                        <div class="product-image-container shadow-sm rounded-3 bg-white p-3">
                            <img src="admin/imgs/hop-dung-giay-nhua-chu-nhat.jpg" class="img-fluid rounded-2 mb-3 product-main-img" alt="Hộp Giấy Tre Vuông">
                        </div>
                    </div>
                    <!-- Thông tin sản phẩm -->
                    <div class="col-lg-7">
                        <div class="product-info bg-white rounded-3 shadow-sm p-4">
                            <h1 class="product-title mb-2">8741 Hộp Giấy Tre Vuông 24/H 72/T</h1>
                            <div class="d-flex gap-3 mb-3 flex-wrap">
                                <span class="badge bg-light text-dark">Mã: 6925956387415</span>
                                <span class="badge bg-success"><i class="fas fa-check fa-check-1"></i> Còn hàng</span>
                                <span class="badge bg-primary text-white"><i class="fas fa-star fa-star-1"></i> 4.8 (245 đánh giá)</span>
                            </div>
                            <hr>
                            <div class="price-section mb-4">
                                <p class="text-muted mb-1">Giá bán</p>
                                <h2 class="price-large">45,000₫</h2>
                                <p class="text-muted small">Giá gốc: <s>50,000₫</s> (Tiết kiệm 10%)</p>
                            </div>
                            <hr>
                            <div class="quantity-section mb-4">
                                <label class="fw-bold mb-2 d-block"><i class="fas fa-box"></i> Số lượng:</label>
                                <div class="d-flex gap-2 align-items-center">
                                    <button class="btn btn-outline-secondary" onclick="document.querySelector('.qty-input').value = Math.max(1, parseInt(document.querySelector('.qty-input').value) - 1)">−</button>
                                    <input type="number" value="1" min="1" class="form-control qty-input text-center" style="max-width: 60px;">
                                    <button class="btn btn-outline-secondary" onclick="document.querySelector('.qty-input').value = parseInt(document.querySelector('.qty-input').value) + 1">+</button>
                                    <span class="text-muted ms-2">Kho: 150 sản phẩm</span>
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
                            <div class="action-buttons d-flex gap-2 mb-4">
                                <button class="btn btn-cart flex-grow-1"><i class="fas fa-shopping-cart"></i> THÊM VÀO GIỎ</button>
                                <button class="btn btn-danger flex-grow-1"><i class="fas fa-bolt"></i> MUA NGAY</button>
                            </div>
                            <hr>
                            <div class="policies">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="policy-item">
                                            <i class="fa-solid fa-check fa-check-camket"></i>
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
                            </hr>
                        </div>
                    </div>

                    <!-- Mô tả sản phẩm -->
                    <div class="description mt-5 p-4 bg-white rounded-3 shadow-sm">
                        <h4 class="fw-bold mb-3"><i class="fas fa-file-alt"></i> MÔ TẢ CHI TIẾT SẢN PHẨM</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-primary fw-bold mb-2">Tên sản phẩm</h6>
                                <p>Hộp Dụng Khăn Giấy Ăn Giấy Vệ Sinh Phong Cách Danshari</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-primary fw-bold mb-2">Chất liệu</h6>
                                <p>Nhựa PP với nắp gỗ nhân tạo cao cấp</p>
                            </div>
                        </div>
                        <hr>
                        <h6 class="text-primary fw-bold mb-2">Giới thiệu</h6>
                        <p>Sản phẩm có bề ngoài đẹp mắt, thiết kế trang nhã, kích thước nhỏ gọn. Sản phẩm dùng để đựng giấy ăn, giấy vệ sinh, thích hợp nhiều không gian trong phòng khách, phòng ngủ hoặc văn phòng.</p>
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
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #ff3399, #ff1493); flex-shrink: 0;"></div>
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
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #007bff, #0056b3); flex-shrink: 0;"></div>
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

                <!-- Footer -->
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