

                <div class="card shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h5 mb-0">Danh Sách Sản Phẩm</h2>
                        <a>
                            <form class="d-flex" role="search">
                                <input class="form-control form-control-sm me-2" type="search" placeholder="Tìm kiếm..." aria-label="Search">
                                <a class="btn btn-sm btn-outline-secondary" type="submit">Tìm</a>
                            </form>
                        </a>
                        <a href="index.php?page_layout=add_product" class="btn btn-primary">Thêm Sản Phẩm</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hình Ảnh</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Danh Mục</th>
                                    <th>Giá</th>
                                    <th>Tồn Kho</th>
                                    <th>Trạng Thái</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><img src="imgs/hop-dung-giay-nhua-chu-nhat.jpg" class="img-fluid rounded" alt="Hộp Giấy" width= 100px></td>
                                    <td>Hộp Giấy Tre Vuông 24/H 72/T</td>
                                    <td>Hộp Giấy</td>
                                    <td>45,000₫</td>
                                    <td>150</td>
                                    <td><span class="badge bg-success">Còn hàng</span></td>
                                    <td>
                                        <a href="index.php?page_layout=edit_product&id=1" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                        <a href="#" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" class="btn btn-sm btn-outline-danger">Xóa</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><img src="imgs/hop-giay-may.jpg" class="img-fluid rounded" alt="Hộp Giấy" width= 100px></td>
                                    <td>Hộp Giấy Mây 2123 SI</td>
                                    <td>Hộp Giấy</td>
                                    <td>17,500₫</td>
                                    <td>200</td>
                                    <td><span class="badge bg-success">Còn hàng</span></td>
                                    <td>
                                        <a href="index.php?page_layout=edit_product&id=2" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                        <a href="#" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" class="btn btn-sm btn-outline-danger">Xóa</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><img src="imgs/Ban-chai-018-TT.png" class="img-fluid rounded" alt="Bàn Chải" width= 100px></td>
                                    <td>Bàn Chải 018 TT (30/B)</td>
                                    <td>Bàn Chải</td>
                                    <td>18,000₫</td>
                                    <td>0</td>
                                    <td><span class="badge bg-secondary">Hết hàng</span></td>
                                    <td>
                                        <a href="index.php?page_layout=edit_product&id=3" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                        <a href="#" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" class="btn btn-sm btn-outline-danger">Xóa</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><img src="imgs/nhua-do.jpg" class="img-fluid rounded" alt="Bàn" width= 100px></td>
                                    <td>Bàn Nhựa Đỏ Nhỏ</td>
                                    <td>Bàn</td>
                                    <td>85,000₫</td>
                                    <td>45</td>
                                    <td><span class="badge bg-success">Còn hàng</span></td>
                                    <td>
                                        <a href="index.php?page_layout=edit_product&id=4" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                        <a href="#" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" class="btn btn-sm btn-outline-danger">Xóa</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><img src="imgs/ghe-do.jpg" class="img-fluid rounded" alt="Ghế" width= 100px></td>
                                    <td>Ghế Nhựa Đỏ</td>
                                    <td>Ghế</td>
                                    <td>50,000₫</td>
                                    <td>80</td>
                                    <td><span class="badge bg-success">Còn hàng</span></td>
                                    <td>
                                        <a href="index.php?page_layout=edit_product&id=5" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                        <a href="#" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" class="btn btn-sm btn-outline-danger">Xóa</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><img src="imgs/bat-5.5.jpg" class="img-fluid rounded" alt="Bát" width= 100px></td>
                                    <td>Bát 2141 SI 300/T 10/B</td>
                                    <td>Bát</td>
                                    <td>5,500₫</td>
                                    <td>500</td>
                                    <td><span class="badge bg-success">Còn hàng</span></td>
                                    <td>
                                        <a href="index.php?page_layout=edit_product&id=6" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                        <a href="#" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" class="btn btn-sm btn-outline-danger">Xóa</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td><img src="imgs/bat-rac-hong.jpg" class="img-fluid rounded" alt="Thùng rác" width= 100px></td>
                                    <td>Bật Rác Tròn 66 - 2766 Sl</td>
                                    <td>Thùng rác</td>
                                    <td>245,000₫</td>
                                    <td>25</td>
                                    <td><span class="badge bg-success">Còn hàng</span></td>
                                    <td>
                                        <a href="index.php?page_layout=edit_product&id=7" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                        <a href="#" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" class="btn btn-sm btn-outline-danger">Xóa</a>
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
        </div>
    </div>
