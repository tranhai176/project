<?php
require_once 'config/database.php';
$message = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

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
        $errors[] = 'Mật khẩu xác nhận không khớp.';
    }

    if (empty($errors)) {
        $usernameEsc = mysqli_real_escape_string($conn, $username);
        $fullnameEsc = mysqli_real_escape_string($conn, $fullname);
        $emailEsc = mysqli_real_escape_string($conn, $email);
        $phoneEsc = mysqli_real_escape_string($conn, $phone);
        $addressEsc = mysqli_real_escape_string($conn, $address);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $checkSql = "SELECT id FROM users WHERE username = '$usernameEsc' OR email = '$emailEsc' LIMIT 1";
        $checkResult = mysqli_query($conn, $checkSql);
        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            $errors[] = 'Tên đăng nhập hoặc email đã được đăng ký.';
        } else {
            $insertSql = "INSERT INTO users (username, password, email, full_name, phone, address) VALUES ('$usernameEsc', '$passwordHash', '$emailEsc', '$fullnameEsc', '$phoneEsc', '$addressEsc')";
            if (mysqli_query($conn, $insertSql)) {
                $message = 'Đăng ký thành công! Bạn có thể đăng nhập ngay bây giờ.';
            } else {
                $errors[] = 'Lỗi khi lưu dữ liệu. Vui lòng thử lại.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản</title>
    <link href="bootstrap-5.3.8-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<style>
    body {
        background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
    }

    .card {
        border-radius: 10px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="max-width: 540px; width: 100%;">
            <h3 class="text-center mb-4">Đăng ký tài khoản</h3>

            <?php if (!empty($message)): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="register.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập" required value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nhập họ và tên" required value="<?php echo htmlspecialchars($_POST['fullname'] ?? ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <textarea class="form-control" id="address" name="address" rows="2" placeholder="Nhập địa chỉ" required><?php echo htmlspecialchars($_POST['address'] ?? ''); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
                <p class="text-center mt-3 mb-0">Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
            </form>
        </div>
    </div>

    <script src="bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>