

                <div class="card shadow-sm p-4">
                    <h2 class="h5 mb-4">Thêm Sản Phẩm Mới</h2>
                    <form>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="product_name" class="form-label">Tên Sản Phẩm</label>
                                <input type="text" id="product_name" class="form-control" placeholder="Nhập tên sản phẩm" required>
                            </div>
                            <div class="col-md-6">
                                <label for="category" class="form-label">Danh Mục</label>
                                <select id="category" class="form-select" required>
                                    <option value="">Chọn danh mục</option>
                                    <option value="sedan">Sedan</option>
                                    <option value="suv">SUV</option>
                                    <option value="pickup">Bán tải</option>
                                    <option value="sports">Xe thể thao</option>
                                    <option value="electric">Xe điện</option>
                                    <option value="mpv">MPV</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Giá (VNĐ)</label>
                                <input type="number" id="price" class="form-control" placeholder="Nhập giá sản phẩm" required>
                            </div>
                            <div class="col-md-6">
                                <label for="stock" class="form-label">Tồn Kho</label>
                                <input type="number" id="stock" class="form-control" placeholder="Nhập số lượng tồn kho" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình Ảnh Sản Phẩm</label>
                            <input class="form-control" type="file" id="image" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô Tả Sản Phẩm</label>
                            <textarea id="description" class="form-control" rows="4" placeholder="Nhập mô tả chi tiết về sản phẩm" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="form-label">Trạng Thái</label>
                            <select id="status" class="form-select" required>
                                <option value="active">Còn hàng</option>
                                <option value="inactive">Hết hàng</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
                            <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">Hủy</button>
                        </div>
                    </form>
                </div>

                
    
