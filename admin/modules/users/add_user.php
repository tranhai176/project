
<?php
require_once __DIR__ . '/../../../config/database.php';

$message = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $fullname = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Validation
    if ($username === '') {
        $errors[] = 'Vui lòng nhập tên đăng nhập.';
    }
    if ($fullname === '') {
        $errors[] = 'Vui lòng nhập họ và tên.';
    }
    if ($email === '') {
        $errors[] = 'Vui lòng nhập email.';
    }
    if ($password === '') {
        $errors[] = 'Vui lòng nhập mật khẩu.';
    }
    if ($password !== $confirmPassword) {
        $errors[] = 'Mật khẩu không trùng khớp.';
    }
    if (strlen($password) < 6) {
        $errors[] = 'Mật khẩu phải có ít nhất 6 ký tự.';
    }

    // Kiểm tra username/email đã tồn tại
    if (empty($errors)) {
        $checkUsername = "SELECT id FROM users WHERE username = '" . mysqli_real_escape_string($conn, $username) . "'";
        $checkEmail = "SELECT id FROM users WHERE email = '" . mysqli_real_escape_string($conn, $email) . "'";
        
        if (mysqli_num_rows(mysqli_query($conn, $checkUsername)) > 0) {
            $errors[] = 'Tên đăng nhập đã tồn tại.';
        }
        if (mysqli_num_rows(mysqli_query($conn, $checkEmail)) > 0) {
            $errors[] = 'Email đã tồn tại.';
        }
    }

    if (empty($errors)) {
        $username = mysqli_real_escape_string($conn, $username);
        $fullname = mysqli_real_escape_string($conn, $fullname);
        $email = mysqli_real_escape_string($conn, $email);
        $phone = mysqli_real_escape_string($conn, $phone);
        $address = mysqli_real_escape_string($conn, $address);
        $password = mysqli_real_escape_string($conn, $password);
        
        $sql = "INSERT INTO users (username, password, email, full_name, phone, address) 
                VALUES ('$username', '$password', '$email', '$fullname', '$phone', '$address')";
        
        if (mysqli_query($conn, $sql)) {
            $message = 'Thêm thành viên thành công!';
            header('Refresh: 1.5; url=index.php?page_layout=user');
        } else {
            $errors[] = 'Lỗi: ' . mysqli_error($conn);
        }
    }
}
?>
                <div class="card shadow-sm p-4">
                    <h2 class="h5 mb-4">Thêm thành viên mới</h2>
                    <?php if ($message): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <div>- <?php echo htmlspecialchars($error); ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <form action="index.php?page_layout=add_user" method="post">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label">Tên đăng nhập</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Nhập tên đăng nhập" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fullname" class="form-label">Họ và Tên</label>
                                <input type="text" id="fullname" name="full_name" class="form-control" placeholder="Nhập họ và tên" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Nhập địa chỉ email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Số Điện Thoại</label>
                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <textarea id="address" name="address" class="form-control" rows="2" placeholder="Nhập địa chỉ" required></textarea>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                            </div>
                            <div class="col-md-6">
                                <label for="confirm_password" class="form-label">Xác Nhận Mật Khẩu</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu" required>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Thêm thành viên</button>
                            <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">Hủy</button>
                        </div>
                    </form>
                </div>

             
            