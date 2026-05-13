-- =====================================
-- Database: xe_shop (Plastic Items Store)
-- =====================================

-- Drop existing tables if they exist
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS users;

-- =====================================
-- Table: categories
-- =====================================
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================
-- Table: products
-- =====================================
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT DEFAULT 0,
    category_id INT NOT NULL,
    description TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================
-- Table: users
-- =====================================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    full_name VARCHAR(150),
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================
-- Table: orders
-- =====================================
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(12, 2) NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    notes TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================
-- Table: order_items
-- =====================================
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================
-- Insert Categories
-- =====================================
INSERT INTO categories (name, description) VALUES
('Gia dụng nhà bếp', 'Các sản phẩm nhựa tiện dụng cho nhà bếp'),
('Vệ sinh cá nhân', 'Sản phẩm vệ sinh và chăm sóc cá nhân'),
('Chứa đựng', 'Hộp, thùng, lọ nhựa chứa đựng'),
('Dụng cụ làm sạch', 'Chổi, chùi rửa, dụng cụ vệ sinh');

-- =====================================
-- Insert Products
-- =====================================
INSERT INTO products (name, price, quantity, category_id, description, image) VALUES
('Bàn Nhựa Xanh', 250000, 45, 1, 'Bàn nhựa màu xanh, chắc chắn, dễ lau chùi, thích hợp dùng trong gia đình hoặc ngoài trời', 'nhua-xanh.jpg'),
('Bàn Nhựa Đỏ', 85000, 20, 1, 'Bàn nhựa màu đỏ, nhỏ gọn, tiện lợi cho không gian hẹp', 'nhua-do.jpg'),
('Bát Phíp 6828 Vn 10/B 120/T', 10000, 15, 1, 'Bát phíp bền đẹp, nhẹ, dễ vệ sinh, phù hợp dùng trong bữa ăn hàng ngày', 'bat-phip.jpg'),
('Hộp Giấy Mây 2123 SI', 17500, 120, 2, 'Hộp giấy mây tiện dụng, dùng để đựng khăn giấy, trang trí bàn ăn hoặc phòng khách', 'hop-giay-may.jpg'),
('Bát 2141 SI 300/T 10/B', 5500, 60, 2, 'Bát nhựa nhỏ gọn, thích hợp dùng để đựng gia vị hoặc món ăn nhẹ', 'bat-5.5.jpg'),
('Bàn Chải 018 TT (30/B)', 65000, 80, 2, 'Bàn chải vệ sinh đa năng, lông cứng, dùng để chà rửa sàn và các bề mặt khó làm sạch', 'Ban-chai-018-TT.png'),
('8741 Hộp Giấy Tre Vuông 24/H 72/T', 45000, 100, 3, 'Hộp giấy tre vuông, thiết kế đẹp mắt, thân thiện môi trường, dùng để đựng khăn giấy', 'hop-dung-giay-nhua-chu-nhat.jpg'),
('Ghế Nhựa Xanh', 120000, 25, 3, 'Ghế nhựa màu xanh, chắc chắn, dễ di chuyển, phù hợp cho phòng ăn hoặc ngoài trời', 'ghe-xanh.jpg'),
('Ghế Nhựa Đỏ', 50000, 150, 3, 'Ghế nhựa màu đỏ, nhẹ, bền, dễ xếp chồng để tiết kiệm không gian', 'ghe-do.jpg'),
('Bật Rác Vuông 10L Hokori 8061 Vn 3/D', 173000, 200, 4, 'Thùng rác vuông dung tích 10 lít, thiết kế nắp đậy kín, giữ vệ sinh và ngăn mùi hiệu quả', 'bat-rac-vuong-hokori.png'),
('Bật Rác Tròn 66 - 2766 Sl', 245000, 35, 4, 'Thùng rác tròn dung tích lớn, chất liệu nhựa bền, thích hợp cho văn phòng hoặc gia đình', 'bat-rac-hong.jpg'),
('Bàn Chải 1405 160/T 40/H', 19500, 90, 4, 'Bàn chải vệ sinh bồn tắm, tay cầm dài, dễ dàng làm sạch các góc khuất', 'Ban-chai-1405.png');


-- =====================================
-- Insert Users
-- =====================================
INSERT INTO users (username, password, email, full_name, phone, address) VALUES
('admin', 'admin123', 'admin@plasticstore.com', 'Quản Trị Viên', '0399999999', 'Hà Nội'),
('nguyenvana', 'password123', 'nguyenvana@example.com', 'Nguyễn Văn A', '0912345678', '123 Đường Trần Hưng Đạo, TP.HCM'),
('tranthib', 'password456', 'tranthib@example.com', 'Trần Thị B', '0987654321', '456 Đường Nguyễn Huệ, Hà Nội'),
('levanc', 'password789', 'levanc@example.com', 'Lê Văn C', '0901234567', '789 Đường Tây Sơn, Đà Nẵng'),
('phamthid', 'password321', 'phamthid@example.com', 'Phạm Thị D', '0911111111', '321 Đường Hải Phòng, Hải Phòng');

-- =====================================
-- Insert Orders
-- =====================================
INSERT INTO orders (user_id, total, status, notes, order_date) VALUES
(2, 505000, 'pending', 'Chờ xác nhận', DATE_SUB(NOW(), INTERVAL 0 DAY)),
(3, 260000, 'processing', 'Đang chuẩn bị hàng', DATE_SUB(NOW(), INTERVAL 1 DAY)),
(2, 345000, 'completed', 'Hoàn tất', DATE_SUB(NOW(), INTERVAL 3 DAY)),
(4, 420000, 'delivered', 'Đã giao hàng', DATE_SUB(NOW(), INTERVAL 5 DAY)),
(5, 180000, 'pending', 'Chờ xác nhận', DATE_SUB(NOW(), INTERVAL 2 DAY)),
(2, 750000, 'processing', 'Đang xử lý', DATE_SUB(NOW(), INTERVAL 4 DAY)),
(3, 290000, 'cancelled', 'Đã hủy', DATE_SUB(NOW(), INTERVAL 6 DAY)),
(4, 620000, 'delivered', 'Đã giao hàng', DATE_SUB(NOW(), INTERVAL 7 DAY));

-- =====================================
-- Insert Order Items
-- =====================================
INSERT INTO order_items (order_id, product_id, quantity, price) VALUES
-- Order 1: 505,000
(1, 1, 2, 85000),
(1, 4, 1, 95000),
(1, 7, 3, 75000),
-- Order 2: 260,000
(2, 2, 1, 385000),
(2, 6, 1, 65000),
-- Order 3: 345,000
(3, 3, 1, 250000),
(3, 5, 2, 45000),
(3, 9, 1, 35000),
-- Order 4: 420,000
(4, 1, 3, 85000),
(4, 8, 1, 180000),
(4, 10, 1, 125000),
-- Order 5: 180,000
(5, 7, 2, 75000),
(5, 6, 1, 65000),
-- Order 6: 750,000
(6, 2, 1, 385000),
(6, 4, 2, 95000),
(6, 5, 3, 45000),
(6, 11, 1, 120000),
-- Order 7: 290,000
(7, 3, 1, 250000),
(7, 9, 1, 35000),
-- Order 8: 620,000
(8, 1, 2, 85000),
(8, 8, 2, 180000),
(8, 12, 1, 55000);

-- =====================================
-- Create Indexes for Better Performance
-- =====================================
CREATE INDEX idx_products_category ON products(category_id);
CREATE INDEX idx_orders_user ON orders(user_id);
CREATE INDEX idx_orders_status ON orders(status);
CREATE INDEX idx_orders_date ON orders(order_date);
CREATE INDEX idx_order_items_order ON order_items(order_id);
CREATE INDEX idx_order_items_product ON order_items(product_id);
