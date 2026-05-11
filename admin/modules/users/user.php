

                <div class="card shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="h5 mb-1">Danh Sách Thành Viên</h2>
                        </div>
                        <a>
                            <form class="d-flex" role="search">
                                <input class="form-control form-control-sm me-2" type="search" placeholder="Tìm kiếm..." aria-label="Search">
                                <a class="btn btn-sm btn-outline-secondary" type="submit">Tìm</a>
                            </form>
                        </a>
                        <a href="index.php?page_layout=add_user" class="btn btn-primary">Thêm Thành Viên</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Họ Tên</th>
                                    <th>Email</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Trạng Thái</th>
                                    <th>Ngày Tạo</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>nguyenvana@gmail.com</td>
                                    <td>0123-456-789</td>
                                    <td><span class="badge bg-success">Hoạt động</span></td>
                                    <td>2024-01-15</td>
                                    <td>
                                        <a href="index.php?page_layout=edit_user&id=1" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                        <a href="#" onclick="return confirm('Bạn có chắc muốn xóa thành viên này?')" class="btn btn-sm btn-outline-danger">Xóa</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Nguyễn Văn B</td>
                                    <td>nguyenvanb@gmail.com</td>
                                    <td>0987-654-321</td>
                                    <td><span class="badge bg-success">Hoạt động</span></td>
                                    <td>2024-02-20</td>
                                    <td>
                                        <a href="index.php?page_layout=edit_user&id=2" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                        <a href="#" onclick="return confirm('Bạn có chắc muốn xóa thành viên này?')" class="btn btn-sm btn-outline-danger">Xóa</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Nguyễn Văn C</td>
                                    <td>nguyenvanc@gmail.com</td>
                                    <td>0912-345-678</td>
                                    <td><span class="badge bg-secondary">Không hoạt động</span></td>
                                    <td>2024-03-10</td>
                                    <td>
                                        <a href="index.php?page_layout=edit_user&id=3" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                        <a href="#" onclick="return confirm('Bạn có chắc muốn xóa thành viên này?')" class="btn btn-sm btn-outline-danger">Xóa</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Nguyễn Văn D</td>
                                    <td>nguyenvand@gmail.com</td>
                                    <td>0901-234-567</td>
                                    <td><span class="badge bg-success">Hoạt động</span></td>
                                    <td>2024-04-05</td>
                                    <td>
                                        <a href="index.php?page_layout=edit_user&id=4" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                        <a href="#" onclick="return confirm('Bạn có chắc muốn xóa thành viên này?')" class="btn btn-sm btn-outline-danger">Xóa</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Trần Thị E</td>
                                    <td>tranthie@gmail.com</td>
                                    <td>0934-567-890</td>
                                    <td><span class="badge bg-success">Hoạt động</span></td>
                                    <td>2024-04-12</td>
                                    <td>
                                        <a href="index.php?page_layout=edit_user&id=5" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                        <a href="#" onclick="return confirm('Bạn có chắc muốn xóa thành viên này?')" class="btn btn-sm btn-outline-danger">Xóa</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Lê Văn F</td>
                                    <td>levanf@gmail.com</td>
                                    <td>0945-678-901</td>
                                    <td><span class="badge bg-success">Hoạt động</span></td>
                                    <td>2024-04-18</td>
                                    <td>
                                        <a href="index.php?page_layout=edit_user&id=6" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                        <a href="#" onclick="return confirm('Bạn có chắc muốn xóa thành viên này?')" class="btn btn-sm btn-outline-danger">Xóa</a>
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
                </div>

                
            