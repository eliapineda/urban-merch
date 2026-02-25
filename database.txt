CREATE DATABASE IF NOT EXISTS tienda_db;

USE tienda_db;


CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 username VARCHAR(80) NOT NULL,
 email VARCHAR(120) NOT NULL UNIQUE,
 password_hash VARCHAR(255) NOT NULL,
 role ENUM('admin', 'customer') DEFAULT 'customer' NOT NULL
);

CREATE TABLE products (
 id INT AUTO_INCREMENT PRIMARY KEY,
 product_name VARCHAR(150) NOT NULL,
 description TEXT,
 price DECIMAL(10, 2) NOT NULL,
 FULLTEXT KEY idx_product_name_description (product_name, description)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE product_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    is_main TINYINT(1) DEFAULT 0,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT CHECK (rating >= 0 AND rating <= 5),
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    UNIQUE KEY unique_cart_item (user_id, product_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);


INSERT INTO products (product_name, description, price) VALUES
('CD First Album', 'Primer album de estudio de un artista emergente. Cuenta con 15 pistas. Formato MD de Sony.', 20),
('Gorra', 'Gorra de la cantante americana Lana del Rey. De algodon, color negro.', 15),
('Sudadera', 'Sudadera negra con capucha de The Cranberries. Album: no need to argue ', 35);

INSERT INTO product_images (product_id, image_path, is_main) VALUES
(1, 'uploads/products/1/cd_first_album.jpg', 1),
(2, 'uploads/products/2/gorra_ldr_1.jpg', 1),
(2, 'uploads/products/2/gorra_ldr_2.jpg', 0),
(2, 'uploads/products/2/gorra_ldr_3.jpg', 0),
(2, 'uploads/products/2/gorra_ldr_4.jpg', 0),
(3, 'uploads/products/3/sudadera_2.jpg', 1),
(3, 'uploads/products/3/sudadera_1.jpg', 0);

INSERT INTO users (username, email, password_hash, role) VALUES
('admin', 'admin@gmail.com', '$2y$10$TvOGt/MzbtjddzUjw5g/.OsR0kQlc7ACiZw8TRHP6xOdCmILufcl2', 'admin');
