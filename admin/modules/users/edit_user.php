
<?php
$userId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "SELECT id, username, email, full_name, phone, address FROM users WHERE id = $userId";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo '<div class="alert alert-warning">Người dùng không tìm thấy.</div>';
    return;
}

$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname'] ?? '');
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $phone = mysqli_real_escape_string($conn, $_POST['phone'] ?? '');
    $address = mysqli_real_escape_string($conn, $_POST['address'] ?? '');
    $password = $_POST['password'] ?? '';

    $updateSql = "UPDATE users SET full_name = '$fullname', email = '$email', phone = '$phone', address = '$address'";
    if (!empty($password)) {
        $hashedPassword = mysqli_real_escape_string($conn, $password);
        $updateSql .= ", password = '$hashedPassword'";
    }
    $updateSql .= " WHERE id = $userId";

    if (mysqli_query($conn, $updateSql)) {
        echo '<div class="alert alert-success">Cập nhật thông tin thành công!</div>';
        $user['full_name'] = $fullname;
        $user['email'] = $email;
        $user['phone'] = $phone;
        $user['address'] = $address;
    } else {
        echo '<div class="alert alert-danger">Lỗi: ' . mysqli_error($conn) . '</div>';
    }
}
?>
                <div class="card shadow-sm p-4">
                    <h2 class="h5 mb-4">Chỉnh Sửa Thông Tin Thành Viên</h2>
                    <form method="POST">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="fullname" class="form-label">Họ và Tên</label>
                                <input type="text" id="fullname" name="fullname" class="form-control" value="<?php echo htmlspecialchars($user['full_name'] ?? ''); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Số Điện Thoại</label>
                                <input type="tel" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label">Địa Chỉ</label>
                                <input type="text" id="address" name="address" class="form-control" value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật Khẩu Mới (để trống nếu không đổi)</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới">
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                            <a href="index.php?page_layout=user" class="btn btn-outline-secondary">Quay Lại</a>
                        </div>
                    </form>
                </div>