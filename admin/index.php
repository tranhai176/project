<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location:login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email === 'admin@gmail.com' && $password === '12345') {
        $_SESSION['admin'] = true;
        $_SESSION['user_login'] = [
            'user_full' => 'Admin',
            'user_level' => 1
        ];
        header('Location: index.php');
        exit();
    }

    header('Location:login.php?error=1');
    exit();
}

if (!isset($_SESSION['admin'])) {
    header('Location:login.php');
    exit();
}

if (isset($_SESSION['user_login']['user_level'])) {
    if ($_SESSION['user_login']['user_level'] == 1) {
        define('ADMIN', true);
    } elseif ($_SESSION['user_login']['user_level'] == 2) {
        define('STAFF', true);
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css">

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 sidebar p-4">
                <div class="brand mb-4">ADMIN</div>
                <nav class="nav flex-column gap-2">
                    <a class="nav-link" href="index.php">Dashboard</a>
                    <a class="nav-link" href="index.php?page_layout=user">Quản lý thành viên</a>
                    <a class="nav-link" href="index.php?page_layout=category">Quản lý danh mục</a>
                    <a class="nav-link" href="index.php?page_layout=product">Quản lý sản phẩm</a>
                    <a class="nav-link" href="index.php?page_layout=orders">Quản lý đơn hàng</a>
                    <a class="nav-link" href="index.php?page_layout=comment">Quản lý bình luận</a>
                    <a class="nav-link" href="index.php?page_layout=adds">Quản lý quảng cáo</a>
                    <a class="nav-link" href="index.php?page_layout=setting">Cấu hình</a>
                </nav>
            </div>
            <div class="col-lg-9 p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                    <div>
                        <h1 class="h3">
                            <?php
                            if (!isset($_GET['page_layout'])) {
                                echo 'Dashboard Quản Lý Cửa Hàng';
                            } elseif ($_GET['page_layout'] == 'user') {
                                echo 'Quản Lý Thành Viên';
                            } elseif ($_GET['page_layout'] == 'add_user') {
                                echo 'Thêm Thành Viên Mới';
                            } elseif ($_GET['page_layout'] == 'edit_user') {
                                echo 'Chỉnh Sửa Thành Viên';
                            } elseif ($_GET['page_layout'] == 'category') {
                                echo 'Quản Lý Danh Mục';
                            } elseif ($_GET['page_layout'] == 'add_category') {
                                echo 'Thêm Danh Mục Mới';
                            } elseif ($_GET['page_layout'] == 'edit_category') {
                                echo 'Chỉnh Sửa Danh Mục';
                            } elseif ($_GET['page_layout'] == 'product') {
                                echo 'Quản Lý Sản Phẩm';
                            } elseif ($_GET['page_layout'] == 'add_product') {
                                echo 'Thêm Sản Phẩm Mới';
                            } elseif ($_GET['page_layout'] == 'edit_product') {
                                echo 'Chỉnh Sửa Sản Phẩm';
                            } elseif ($_GET['page_layout'] == 'orders') {
                                echo 'Quản Lý Đơn Hàng';
                            } elseif ($_GET['page_layout'] == 'view_order') {
                                echo 'Xem Chi Tiết Đơn Hàng';
                            } elseif ($_GET['page_layout'] == 'edit_order') {
                                echo 'Chỉnh Sửa Đơn Hàng';
                            } else {
                                echo '404 - Trang Không Tìm Thấy';
                            }
                            ?>
                        </h1>
                        <p class="text-muted mb-0">
                            <?php
                            if (!isset($_GET['page_layout'])) {
                                echo 'Trang quản trị viên cho hệ thống bán hàng.';
                            } elseif ($_GET['page_layout'] == 'user') {
                                echo 'Danh sách thành viên đang sử dụng hệ thống.';
                            } elseif ($_GET['page_layout'] == 'add_user') {
                                echo 'Thêm thành viên mới vào hệ thống.';
                            } elseif ($_GET['page_layout'] == 'edit_user') {
                                echo 'Chỉnh sửa thông tin thành viên.';
                            } elseif ($_GET['page_layout'] == 'category') {
                                echo 'Danh sách danh mục sản phẩm.';
                            } elseif ($_GET['page_layout'] == 'add_category') {
                                echo 'Thêm danh mục sản phẩm mới.';
                            } elseif ($_GET['page_layout'] == 'edit_category') {
                                echo 'Chỉnh sửa thông tin danh mục.';
                            } elseif ($_GET['page_layout'] == 'product') {
                                echo 'Danh sách sản phẩm trong kho.';
                            } elseif ($_GET['page_layout'] == 'add_product') {
                                echo 'Thêm sản phẩm mới vào kho.';
                            } elseif ($_GET['page_layout'] == 'edit_product') {
                                echo 'Chỉnh Sửa Sản Phẩm';
                            } elseif ($_GET['page_layout'] == 'orders') {
                                echo 'Danh sách đơn hàng từ khách hàng.';
                            } elseif ($_GET['page_layout'] == 'view_order') {
                                echo 'Xem chi tiết đơn hàng.';
                            } else {
                                echo 'Trang bạn đang tìm kiếm không tồn tại.';
                            }
                            ?>
                        </p>
                    </div>
                    <div class="d-flex gap-2 mt-3 mt-md-0">
                        <button class="btn btn-outline-secondary">
                            <?php
                            if (isset($_SESSION['user_login'])) {
                                echo $_SESSION['user_login']['user_full'];
                            }
                            ?>
                        </button>
                        <a href="#profile" class="btn btn-outline-primary">Hồ Sơ</a>
                        <a href="index.php?logout" class="btn btn-outline-danger">Đăng Xuất</a>
                    </div>
                </div>

                <?php
                if (isset($_GET['page_layout'])) {
                    switch ($_GET['page_layout']) {
                        case 'user':
                            include_once 'modules/users/user.php';
                            break;
                        case 'add_user':
                            include_once 'modules/users/add_user.php';
                            break;
                        case 'edit_user':
                            include_once 'modules/users/edit_user.php';
                            break;
                        case 'category':
                            include_once 'modules/categories/category.php';
                            break;
                        case 'add_category':
                            include_once 'modules/categories/add_category.php';
                            break;
                        case 'edit_category':
                            include_once 'modules/categories/edit_category.php';
                            break;
                        case 'product':
                            include_once 'modules/products/product.php';
                            break;
                        case 'add_product':
                            include_once 'modules/products/add_product.php';
                            break;
                        case 'edit_product':
                            include_once 'modules/products/edit_product.php';
                            break;
                        case 'orders':
                            include_once 'modules/orders/order.php';
                            break;
                        case 'view_order':
                            include_once 'modules/orders/view_order.php';
                            break;
                        case 'edit_order':
                            include_once 'modules/orders/edit_order.php';
                            break;
                        default:
                            include_once '404.php';
                            break;
                    }
                } else {
                ?>
                    <div id="overview" class="mb-4">
                        <div class="card border-0 shadow-sm p-4 mb-4">
                            <h2 class="h5">Dashboard Quản Lý Cửa Hàng</h2>
                            <p>Trang tổng quan dành cho quản trị viên cửa hàng. Bạn có thể gán thêm dữ liệu và liên kết sau khi tích hợp toàn bộ hệ thống.</p>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6 col-xl-3">
                            <div class="card shadow-sm h-100 p-4">
                                <h3 class="h6">Sản Phẩm Trong Kho</h3>
                                <p class="text-muted">Số lượng sản phẩm hiện có.</p>
                                <div class="display-6 fw-bold">256</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card shadow-sm h-100 p-4">
                                <h3 class="h6">Đơn Hàng Hôm Nay</h3>
                                <p class="text-muted">Theo dõi số lượng đơn hàng trong ngày.</p>
                                <div class="display-6 fw-bold">42</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card shadow-sm h-100 p-4">
                                <h3 class="h6">Khách Hàng Mới</h3>
                                <p class="text-muted">Số lượng khách hàng đăng ký mới.</p>
                                <div class="display-6 fw-bold">15</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card shadow-sm h-100 p-4">
                                <h3 class="h6">Yêu Cầu Hỗ Trợ</h3>
                                <p class="text-muted">Các yêu cầu hỗ trợ từ khách hàng.</p>
                                <div class="display-6 fw-bold">7</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-center text-muted">
                        &copy; 2026 Quản Lý Cửa Hàng.
                    </div>



                <?php
                }
                ?>
            </div>
        </div>
    </div>
    </div>
    <script src="../bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>