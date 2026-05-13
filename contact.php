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

    

    .fa-home me-1 {
        color: #000000;
        font-size: 1.5em;
        margin-right: 10px;

    }

    .fa-shopping-cart {
        color: #000000;
        font-size: 1.5em;
        margin-right: 10px;

    }

    .page-title {
        animation: fadeInDown 0.8s ease;
    }

    .support-badge {
        display: inline-block;
        background: linear-gradient(135deg, #ff3399 0%, #ff1493 100%);
        padding: 2px 16px;
        border-radius: 50px;
        margin-bottom: 15px;
    }

    .support-badge span {
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .support-badge i {
        margin-right: 6px;
    }

    .main-heading {
        background: linear-gradient(135deg, #ff3399 0%, #ff1493 100%);
        background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 900;
        font-size: 56px;
        margin: 20px 0 0;
        letter-spacing: -1px;
    }

    .sub-heading {
        color: #666;
        font-size: 18px;
        margin-top: 15px;
        font-weight: 500;
    }

    .contact-box {
        background: linear-gradient(135deg, #ffffff 0%, #f8fbff 100%);
        border: 1px solid #e8f0ff;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        animation: slideInRight 0.6s ease;
    }

    .contact-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 35px;
    }

    .icon-box {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #ff3399 0%, #ff1493 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 24px;
    }

    .contact-form label {
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 10px;
        display: block;
    }

    .contact-form input,
    .contact-form select,
    .contact-form textarea {
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        padding: 14px 16px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #fff;
        width: 100%;
    }

    .contact-form textarea {
        font-family: 'Roboto', sans-serif;
        resize: none;
    }

    .submit-btn {
        background: linear-gradient(135deg, #ff3399 0%, #ff1493 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 16px 40px;
        font-weight: 700;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 51, 153, 0.3);
        width: 100%;
        letter-spacing: 0.5px;
    }

    .me-1 {
        color: #000000;
        font-size: 14px;
    }

    .me-2 {
        color: #00ff3c;
        font-size: 14px;
    }

    .me-3 {
        color: #ff00f2;
        font-size: 14px;
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
                        <p>HỆ THỐNG CỬA HÀNG UY TÍN</p>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-between user-links py-2 px-3 gap-2">
                            <a href="index.php" class="user-link">
                                Trang chủ
                            </a>
                            <a href="cart.php" class="user-link">
                                Giỏ hàng
                            </a>
                            <a href="contact.php" class="user-link">
                                Liên hệ
                            </a>
                        </div>
                        <form class="d-flex mt-2">
                            <input class="form-control form-control-sm me-2 search-input" type="search" placeholder="Tìm kiếm..." aria-label="Search">
                            <button class="btn btn-sm search-btn" type="submit">Tìm</button>
                        </form>
                    </div>
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
        <!-- Content container -->
        <div class="container-fluid mt-4">
            <!-- Page Title -->
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <div class="page-title">
                        <div class="support-badge">
                            <span><i class="fas fa-phone"></i> HỖ TRỢ 24/7</span>
                        </div>
                        <h1 class="main-heading">LIÊN HỆ VỚI CHÚNG TÔI</h1>
                        <p class="sub-heading">Chúng tôi luôn sẵn sàng giải đáp mọi thắc mắc của bạn</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="row g-5">
                <div class="col-lg-12">
                    <div class="contact-box">
                        <div class="contact-header">
                            <div class="icon-box">
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <h4>Gửi tin nhắn cho chúng tôi</h4>
                        </div>

                        <form method="POST" onsubmit="handleSubmit(event)" class="contact-form">
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="name">Họ và tên <span>*</span></label>
                                    <input type="text" id="name" name="name" placeholder="Nhập họ và tên của bạn" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email <span>*</span></label>
                                    <input type="email" id="email" name="email" placeholder="Nhập email của bạn" required>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="phone">Điện thoại <span>*</span></label>
                                    <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="subject">Chủ đề <span>*</span></label>
                                    <select id="subject" name="subject" required>
                                        <option value="">Chọn chủ đề</option>
                                        <option value="inquiry">Tư vấn sản phẩm</option>
                                        <option value="order">Theo dõi đơn hàng</option>
                                        <option value="complaint">Khiếu nại</option>
                                        <option value="feedback">Phản hồi</option>
                                        <option value="other">Khác</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="message">Nội dung tin nhắn <span>*</span></label>
                                <textarea id="message" name="message" rows="6" placeholder="Nhập nội dung tin nhắn của bạn..." required></textarea>
                            </div>

                            <button type="submit" class="submit-btn">
                                <i class="fas fa-paper-plane"></i> Gửi tin nhắn
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



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