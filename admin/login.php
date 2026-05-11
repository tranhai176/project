<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập Admin</title>
    <link href="../bootstrap-5.3.8-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Roboto', sans-serif;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .login-card .card-body {
            padding: 40px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control,
        .input-group .btn {
            border-radius: 8px;
            border: 2px solid #e0e0e0;
            padding: 12px 14px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #74ebd5;
            box-shadow: 0 0 0 0.2rem rgba(116, 235, 213, 0.25);
            background-color: #fff;
        }

        .input-group .btn-outline-secondary {
            border: 2px solid #e0e0e0;
            color: #666;
            font-weight: 600;
            font-size: 13px;
        }

        .input-group .btn-outline-secondary:hover {
            border-color: #74ebd5;
            color: #74ebd5;
            background-color: transparent;
        }

        .btn-primary {
            background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
            border: none;
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 8px;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
            font-size: 15px;
            color: #fff;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(116, 235, 213, 0.4);
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        .card-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #e0e0e0;
            padding: 16px;
        }

        .text-center h1 {
            background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .alert-dismissible {
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="card login-card">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h1 class="h4 fw-bold">Đăng Nhập Admin</h1>
                    <p class="text-muted mb-0 small">Nhập thông tin để vào trang quản trị.</p>
                </div>

                <form method="post" action="./index.php">
                    <?php if (!empty($login_error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($login_error); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="admin@gmail.com" autocomplete="username" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">Hiện</button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ghi nhớ</label>
                        </div>
                        <a href="#" class="small text-decoration-none">Quên mật khẩu?</a>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                    <p class="text-center mt-3 mb-0">
                        Chưa có tài khoản? <a href="login.php">Đăng ký</a>
                    </p>
                </form>
            </div>

            <div class="card-footer text-center">
                <small>&copy; 2026 ADMIN SIÊU THỊ NHỰA</small>
            </div>
        </div>
    </div>

    <script src="../bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
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
</body>

</html>