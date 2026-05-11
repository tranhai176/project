

                <div class="card shadow-sm p-4">
                    <h2 class="h5 mb-4">Thêm Danh Mục Mới</h2>
                    <form>
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Tên Danh Mục</label>
                            <input type="text" id="category_name" class="form-control" placeholder="Nhập tên danh mục" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Số Lượng</label>
                            <input type="number" id="quantity" class="form-control" placeholder="Nhập số lượng" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô Tả Danh Mục</label>
                            <textarea id="description" class="form-control" rows="4" placeholder="Nhập mô tả chi tiết về danh mục" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="form-label">Trạng Thái</label>
                            <select id="status" class="form-select" required>
                                <option value="active">Hoạt động</option>
                                <option value="inactive">Không hoạt động</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Thêm Danh Mục</button>
                            <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">Hủy</button>
                        </div>
                    </form>
                </div>

                
         