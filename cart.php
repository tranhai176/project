<div class="container my-5">
                <h2 class="mb-4">Giỏ hàng của bạn</h2>
                <div class="row">
                    <!-- Bảng sản phẩm -->
                    <div class="col-md-8">
                        <table class="table table-bordered cart-table bg-white shadow-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><img src="admin/imgs/hop-dung-giay-nhua-chu-nhat.jpg" alt="Hộp Giấy" width="80" class="rounded"></td>
                                    <td>Hộp Giấy Tre Vuông</td>
                                    <td>45,000₫</td>
                                    <td><input type="number" value="1" min="1" class="form-control w-75 mx-auto"></td>
                                    <td>45,000₫</td>
                                    <td><button class="btn btn-danger btn-sm">Xóa</button></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><img src="admin/imgs/hop-dung-giay-nhua-chu-nhat.jpg" alt="Bàn Chải" width="80" class="rounded"></td>
                                    <td>Bàn Chải 018 TT</td>
                                    <td>18,000₫</td>
                                    <td><input type="number" value="2" min="1" class="form-control w-75 mx-auto"></td>
                                    <td>36,000₫</td>
                                    <td><button class="btn btn-danger btn-sm">Xóa</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tổng kết giỏ hàng -->
                    <div class="col-md-4">
                        <div class="cart-summary border rounded shadow-sm p-4 bg-white">
                            <h5 class="fw-bold mb-3"><i class="fas fa-box"></i> Tổng kết</h5>
                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <strong>81,000₫</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Phí vận chuyển:</span>
                                <strong class="text-success">Miễn phí</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold">Tổng cộng:</span>
                                <strong class="text-danger" style="font-size: 18px;">81,000₫</strong>
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <button onclick="window.location.href='index.php'" class="btn btn-outline-primary">← Quay lại mua sắm</button>
                                <button class="btn btn-outline-success"><i class="fas fa-check"></i> Thanh toán ngay</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sản phẩm liên quan -->
            <div class="related-products my-5">
                <h3 class="mb-4">Sản phẩm liên quan</h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card mb-3 h-100 d-flex flex-column">
                            <img src="admin/imgs/hop-giay-may.jpg" class="card-img-top"
                                alt="Hộp Giấy Mây 2123 SI">
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title">Hộp Giấy Mây 2123 SI</h6>
                                <p class="text-danger fw-bold">17,500₫</p>
                                <div class="product-actions">
                                    <a href="product-detail.php" class="btn btn-success">XEM CHI TIẾT</a>
                                    <button class="btn btn-primary w-100">THÊM VÀO GIỏ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mb-3 h-100 d-flex flex-column">
                            <img src="admin/imgs/Ban-chai-1405.png" class="card-img-top" alt="Bàn Chải 1405">
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title">Bàn Chải 1405 160/T 40/H</h6>
                                <p class="text-danger fw-bold">19,500₫</p>
                                <div class="product-actions">
                                    <a href="product-detail.php" class="btn btn-success">XEM CHI TIẾT</a>
                                    <button class="btn btn-primary w-100">THÊM VÀO GIỏ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
       