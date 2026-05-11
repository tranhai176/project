
                <div class="card shadow-sm p-4">
                    <h2 class="h5 mb-4">Sửa Thông Tin Sản Phẩm</h2>
                    <form action="index.php?page_layout=product" method="post">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="product_name" class="form-label">Tên Sản Phẩm</label>
                                <input type="text" id="product_name" class="form-control" value="Hộp Giấy Tre Vuông 24/H 72/T" required>
                            </div>
                            <div class="col-md-6">
                                <label for="category" class="form-label">Danh Mục</label>
                                <select id="category" class="form-select" required>
                                    <option value="category1" selected>Hộp Giấy</option>
                                    <option value="category2">Bàn chải</option>
                                    <option value="category3">Bàn</option>
                                    <option value="category4">Ghế</option>
                                    <option value="category5">Thùng rác</option>
                                    <option value="category6">Bát</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Giá (VNĐ)</label>
                                <input type="number" id="price" class="form-control" value="50000" required>
                            </div>
                            <div class="col-md-6">
                                <label for="stock" class="form-label">Tồn Kho</label>
                                <input type="number" id="stock" class="form-control" value="100" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hình Ảnh Hiện Tại</label>
                            <div class="mb-3 text-center">
                                <img src="admin/imgs/hop-dung-giay-nhua-chu-nhat.jpg" class="img-fluid rounded" alt="Sản Phẩm" width="500px">
                            </div>
                            <label for="image" class="form-label">Thay đổi Hình Ảnh (để trống nếu không đổi)</label>
                            <input class="form-control" type="file" id="image" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô Tả Sản Phẩm</label>
                            <textarea id="description" class="form-control" rows="4" required>Sản phẩm nhựa chất lượng cao, an toàn và bền durable cho nhiều ứng dụng.</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="form-label">Trạng Thái</label>
                            <select id="status" class="form-select" required>
                                <option value="active" selected>Còn hàng</option>
                                <option value="inactive">Hết hàng</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                            <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">Hủy</button>
                        </div>
                    </form>
                </div>

                
           