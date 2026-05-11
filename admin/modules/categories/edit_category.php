

                <div class="card shadow-sm p-4">
                    <h2 class="h5 mb-4">Chỉnh Sửa Danh Mục</h2>
                    <form action="index.php?page_layout=category" method="post">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Tên Danh Mục</label>
                            <input type="text" id="category_name" class="form-control" value="Xe Sedan" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Số Lượng</label>
                            <input type="number" id="quantity" class="form-control" placeholder="Nhập số lượng" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô Tả Danh Mục</label>
                            <textarea id="description" class="form-control" rows="4" required>Danh mục xe sedan cao cấp với thiết kế sang trọng và tiện nghi hiện đại.</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="form-label">Trạng Thái</label>
                            <select id="status" class="form-select" required>
                                <option value="active" selected>Hoạt động</option>
                                <option value="inactive">Không hoạt động</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
                            <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">Hủy</button>
                        </div>
                    </form>
                </div>

                
           