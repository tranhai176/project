<div class="card shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h5 mb-0">Chỉnh Sửa Đơn Hàng #ĐH-001</h2>
        <a href="index.php?page_layout=view_order" class="btn btn-secondary">Xem Chi Tiết</a>
    </div>

    <form>
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Thông Tin Khách Hàng</h5>
                <p><strong>Họ Tên:</strong> Nguyễn Văn A</p>
                <p><strong>Email:</strong> nguyenvana@example.com</p>
                <p><strong>SĐT:</strong> 0123 456 789</p>
            </div>
            <div class="col-md-6">
                <h5>Thông Tin Đơn Hàng</h5>
                <p><strong>Ngày Đặt:</strong> 10/05/2026 14:35</p>
                <p><strong>Tổng Tiền:</strong> 520.000₫</p>
                <div class="mb-3">
                    <label for="status" class="form-label"><strong>Trạng Thái:</strong></label>
                    <select class="form-select" id="status" name="status">
                        <option value="pending" selected>Chờ xử lý</option>
                        <option value="processing">Đang xử lý</option>
                        <option value="completed">Hoàn thành</option>
                        <option value="cancelled">Đã hủy</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary">Cập Nhật</button>
            <a href="index.php?page_layout=orders" class="btn btn-secondary">Quay Lại</a>
        </div>
    </form>
</div>