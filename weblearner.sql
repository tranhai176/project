-- Bảng sản phẩm
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT DEFAULT 0,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Bảng danh mục sản phẩm
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

-- Bảng người dùng
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    full_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng đơn hàng
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2) NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Bảng chi tiết đơn hàng
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Thêm dữ liệu mẫu cho categories
INSERT INTO categories (name, description)
VALUES 
('Đồ nhựa gia dụng', 'Các sản phẩm nhựa dùng trong gia đình'),
('Đồ vệ sinh cá nhân', 'Bàn chải, khăn giấy, sản phẩm chăm sóc cá nhân');

-- Thêm dữ liệu mẫu cho products
INSERT INTO products (name, price, quantity, category_id)
VALUES 
('Hộp Giấy Tre Vuông', 45000, 10, 1),
('Bàn Chải 018 TT', 18000, 50, 2),
('Bàn Chải 1405', 19500, 30, 2);

-- Thêm dữ liệu mẫu cho users
INSERT INTO users (username, password, email, full_name)
VALUES 
('hai123', 'matkhau123', 'hai@example.com', 'Nguyễn Văn Hải'),
('thao456', 'matkhau456', 'thao@example.com', 'Trần Thị Thảo');

-- Thêm dữ liệu mẫu cho orders
INSERT INTO orders (user_id, total, status)
VALUES 
(1, 65000, 'completed'),
(2, 18000, 'pending');

-- Thêm dữ liệu mẫu cho order_items
INSERT INTO order_items (order_id, product_id, quantity, price)
VALUES 
(1, 1, 1, 45000),  -- Hộp Giấy Tre Vuông
(1, 2, 2, 20000),  -- Bàn Chải 018 TT
(2, 2, 1, 18000);  -- Bàn Chải 018 TT
