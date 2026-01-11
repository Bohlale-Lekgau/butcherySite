-- Create the database
CREATE DATABASE mphenama_butchery;
USE mphenama_butchery;

-- Create the categories table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT
);

-- Create the products table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255),
    stock_quantity INT NOT NULL DEFAULT 0,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Create the customers table
CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    address TEXT,
    city VARCHAR(50),
    postal_code VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the orders table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

-- Create the order_items table
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Create the contact_submissions table
CREATE TABLE contact_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample data into categories
INSERT INTO categories (name, description) VALUES
('Beef', 'High-quality beef products'),
('Pork', 'Fresh pork cuts'),
('Poultry', 'Chicken and other poultry products');

-- Insert sample data into products
INSERT INTO products (category_id, name, description, price, image_url, stock_quantity) VALUES
(1, 'Ribeye Steak', 'Prime cut ribeye steak', 250.00, 'images/products/ribeye-steak.jpg', 50),
(1, 'Sirloin Steak', 'Tender sirloin steak', 220.00, 'images/products/sirloin-steak.jpg', 40),
(2, 'Pork Chops', 'Juicy pork chops', 90.00, 'images/products/pork-chops.jpg', 60),
(2, 'Pork Belly', 'Succulent pork belly', 100.00, 'images/products/pork-belly.jpg', 30),
(3, 'Whole Chicken', 'Fresh whole chicken', 60.00, 'images/products/whole-chicken.jpg', 75),
(3, 'Chicken Breast', 'Boneless chicken breast', 80.00, 'images/products/chicken-breast.jpg', 100);

-- Insert sample data into customers
INSERT INTO customers (first_name, last_name, email, phone, address, city, postal_code) VALUES
('John', 'Doe', 'john.doe@example.com', '0123456789', '123 Main St', 'Johannesburg', '2000'),
('Jane', 'Smith', 'jane.smith@example.com', '0987654321', '456 Oak Ave', 'Pretoria', '0002');

-- Insert sample data into orders
INSERT INTO orders (customer_id, total_amount, status) VALUES
(1, 530.00, 'processing'),
(2, 240.00, 'pending');

-- Insert sample data into order_items
INSERT INTO order_items (order_id, product_id, quantity, price) VALUES
(1, 1, 1, 250.00),
(1, 3, 2, 90.00),
(2, 5, 2, 60.00),
(2, 6, 1, 80.00);

-- Insert sample data into contact_submissions
INSERT INTO contact_submissions (name, email, subject, message) VALUES
('Mike Johnson', 'mike.johnson@example.com', 'Product Inquiry', 'I would like to know if you offer bulk discounts on your products.'),
('Sarah Williams', 'sarah.williams@example.com', 'Feedback', 'I recently purchased some of your pork chops and they were excellent! Keep up the great work.');