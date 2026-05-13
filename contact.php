<?php
$contactMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';
    
    if ($name && $email && $phone && $subject && $message) {
        $contactMessage = '<div class="alert alert-success">Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm.</div>';
    } else {
        $contactMessage = '<div class="alert alert-danger">Vui lòng điền đầy đủ tất cả các trường.</div>';
    }
}
?>
<!-- Content container -->
        <div class="container-fluid mt-4 contact-page">
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
                    <?php if (!empty($contactMessage)) echo $contactMessage; ?>
                    <div class="contact-box">
                        <div class="contact-header">
                            <div class="icon-box">
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <h4>Gửi tin nhắn cho chúng tôi</h4>
                        </div>

                        <form method="POST" class="contact-form">
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="name">Họ và tên <span>*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Nhập họ và tên của bạn" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email <span>*</span></label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email của bạn" required>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="phone">Điện thoại <span>*</span></label>
                                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="subject">Chủ đề <span>*</span></label>
                                    <select id="subject" name="subject" class="form-control" required>
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
                                <textarea id="message" name="message" class="form-control" rows="6" placeholder="Nhập nội dung tin nhắn của bạn..." required></textarea>
                            </div>

                            <button type="submit" class="submit-btn">
                                <i class="fas fa-paper-plane"></i> Gửi tin nhắn
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



