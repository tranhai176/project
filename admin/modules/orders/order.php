
                <div class="card shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h5 mb-0">Danh Sách Đơn Hàng</h2>
                        <form class="d-flex" role="search" method="GET" action="index.php">
                            <input type="hidden" name="page_layout" value="orders">
                            <input class="form-control form-control-sm me-2" type="search" name="q" placeholder="Tìm kiếm..." aria-label="Search">
                            <button class="btn btn-sm btn-outline-secondary" type="submit">Tìm</button>
                        </form>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-sm btn-warning text-dark me-2">Chờ xử lý</button>
                        <button type="button" class="btn btn-sm btn-info text-dark me-2">Đang xử lý</button>
                        <button type="button" class="btn btn-sm btn-primary me-2">Hoàn thành</button>
                        <button type="button" class="btn btn-sm btn-success me-2">Đã giao</button>
                        <button type="button" class="btn btn-sm btn-danger">Đã hủy</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Mã Đơn Hàng</th>
                                    <th>Khách Hàng</th>
                                    <th>Ngày Đặt</th>
                                    <th>Tổng Tiền</th>
                                    <th>Trạng Thái</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ĐH-001</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>2026-04-10</td>
                                    <td>520,000₫</td>
                                    <td><span class="badge bg-warning text-dark">Chờ xử lý</span></td>
                                    <td class="d-flex gap-1">
                                        <a href="index.php?page_layout=view_order&id=1" class="btn btn-sm btn-outline-primary">Xem</a>
                                        <a href="index.php?page_layout=edit_order&id=1" class="btn btn-sm btn-outline-secondary">Sửa</a>
                                        <button onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" class="btn btn-sm btn-outline-danger">Xóa</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ĐH-002</td>
                                    <td>Nguyễn Văn B</td>
                                    <td>2026-04-09</td>
                                    <td>245,000₫</td>
                                    <td><span class="badge bg-info text-dark">Đang xử lý</span></td>
                                    <td class="d-flex gap-1">
                                        <a href="index.php?page_layout=view_order&id=2" class="btn btn-sm btn-outline-primary">Xem</a>
                                        <a href="index.php?page_layout=edit_order&id=2" class="btn btn-sm btn-outline-secondary">Sửa</a>
                                        <button onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" class="btn btn-sm btn-outline-danger">Xóa</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ĐH-003</td>
                                    <td>Trần Thị C</td>
                                    <td>2026-04-08</td>
                                    <td>155,500₫</td>
                                    <td><span class="badge bg-success">Đã giao</span></td>
                                    <td class="d-flex gap-1">
                                        <a href="index.php?page_layout=view_order&id=3" class="btn btn-sm btn-outline-primary">Xem</a>
                                        <a href="index.php?page_layout=edit_order&id=3" class="btn btn-sm btn-outline-secondary">Sửa</a>
                                        <button onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" class="btn btn-sm btn-outline-danger">Xóa</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ĐH-004</td>
                                    <td>Lê Văn D</td>
                                    <td>2026-04-07</td>
                                    <td>350,000₫</td>
                                    <td><span class="badge bg-primary">Hoàn thành</span></td>
                                    <td class="d-flex gap-1">
                                        <a href="index.php?page_layout=view_order&id=4" class="btn btn-sm btn-outline-primary">Xem</a>
                                        <a href="index.php?page_layout=edit_order&id=4" class="btn btn-sm btn-outline-secondary">Sửa</a>
                                        <button onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" class="btn btn-sm btn-outline-danger">Xóa</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ĐH-005</td>
                                    <td>Phạm Thị E</td>
                                    <td>2026-04-06</td>
                                    <td>125,000₫</td>
                                    <td><span class="badge bg-danger">Đã hủy</span></td>
                                    <td class="d-flex gap-1">
                                        <a href="index.php?page_layout=view_order&id=5" class="btn btn-sm btn-outline-primary">Xem</a>
                                        <a href="index.php?page_layout=edit_order&id=5" class="btn btn-sm btn-outline-secondary">Sửa</a>
                                        <button class="btn btn-sm btn-outline-danger">Xóa</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ĐH-006</td>
                                    <td>Hoàng Văn F</td>
                                    <td>2026-04-05</td>
                                    <td>420,000₫</td>
                                    <td><span class="badge bg-success">Đã giao</span></td>
                                    <td class="d-flex gap-1">
                                        <a href="index.php?page_layout=view_order&id=6" class="btn btn-sm btn-outline-primary">Xem</a>
                                        <a href="index.php?page_layout=edit_order&id=6" class="btn btn-sm btn-outline-secondary">Sửa</a>
                                        <button class="btn btn-sm btn-outline-danger">Xóa</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Phân trang -->
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Trước</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Tiếp</a>
                            </li>
                        </ul>
                    </nav>
                </div>
