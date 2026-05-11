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
        <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%;">
            <h3 class="text-center mb-4">Đăng ký tài khoản</h3>
            <form>
                <!-- Họ tên -->
                <div class="mb-3">
                    <label for="fullname" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" id="fullname" placeholder="Nhập họ và tên" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Nhập email" required>
                </div>


                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">Hiện</button>
                    </div>
                </div>
                <!-- Mật khẩu -->


                <!-- Xác nhận mật khẩu -->
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Xác nhận mật khẩu</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Xác nhận mật khẩu" required>
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">Hiện</button>
                    </div>
                </div>

                <!-- Nút đăng ký -->
                <button href="login.php" type="submit" class="btn btn-primary w-100">Đăng ký</button>

                <!-- Link đăng nhập -->
                <p class="text-center mt-3 mb-0">
                    Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a>
                </p>
            </form>
        </div>
    </div>

    <script src="bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleBtn = this;

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleBtn.textContent = 'Ẩn';
                toggleBtn.style.color = '#74ebd5';
            } else {
                passwordInput.type = 'password';
                toggleBtn.textContent = 'Hiện';
                toggleBtn.style.color = '';
            }
        });
    </script>
</html>