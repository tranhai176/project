

                <div class="card shadow-sm p-4">
                    <h2 class="h5 mb-4">Chỉnh Sửa Thông Tin Thành Viên</h2>
                    <form action="index.php?page_layout=user" method="post">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="fullname" class="form-label">Họ và Tên</label>
                                <input type="text" id="fullname" class="form-control" value="Nguyễn Văn A" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" value="nguyenvana@example.com" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Số Điện Thoại</label>
                                <input type="tel" id="phone" class="form-control" value="0123-456-789" required>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Trạng Thái</label>
                                <select id="status" class="form-select" required>
                                    <option value="active" selected>Hoạt động</option>
                                    <option value="inactive">Không hoạt động</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật Khẩu Mới (để trống nếu không đổi)</label>
                            <input type="password" id="password" class="form-control" placeholder="Nhập mật khẩu mới">
                        </div>
                        <div class="mb-4">
                            <label for="confirm_password" class="form-label">Xác Nhận Mật Khẩu Mới</label>
                            <input type="password" id="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu mới">
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                            <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">Hủy</button>
                        </div>
                    </form>
                </div>

                
           