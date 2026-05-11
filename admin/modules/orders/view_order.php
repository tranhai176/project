<div class="card shadow-sm p-4">
    <h2 class="h5 mb-4">Chi Tiết Đơn Hàng</h2>
    <div class="mb-3">
        <label class="form-label">Mã Đơn Hàng</label>
        <input type="text" class="form-control" value="ĐH-001" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">Khách Hàng</label>
        <input type="text" class="form-control" value="Nguyễn Văn A" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">Ngày Đặt</label>
        <input type="text" class="form-control" value="2026-04-10" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">Tổng Tiền</label>
        <input type="text" class="form-control" value="520,000₫" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">Trạng Thái</label>
        <input type="text" class="form-control" value="Chờ xử lý" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">Sản Phẩm Đã Mua</label>
        <ul class="list-group">
            <li class="list-btn-group-vertical list-group-item d-flex justify-content-between align-items-center">
                Hộp Giấy Tre Vuông 24/H 72/T
                <span class="badge bg-primary rounded-pill">2</span>
            </li>
            <li class="list-btn-group-vertical list-group-item d-flex justify-content-between align-items-center">
                Bàn Chải 018 TT (30/B)
                <span class="badge bg-primary rounded-pill">1</span>
            </li>
        </ul>
    </div>
    <div class="d-flex gap-2">
        <a href="index.php?page_layout=edit_order&id=1" class="btn btn-outline-secondary">Sửa Trạng Thái</a>
        <button class="btn btn-outline-danger" onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')">Xóa Đơn Hàng</button>
    </div>
</div>