-- ============================================================================
-- Fuji Coffee Digital Menu Database Schema
-- ============================================================================
-- This file documents the database structure for the Fuji Coffee digital menu
-- system. The current implementation uses JSON files for data storage, but this
-- schema can be used for production MySQL/PostgreSQL deployment.
--
-- Date: 2025-11-05
-- ============================================================================

-- ----------------------------------------------------------------------------
-- PRODUCTION DATABASE SCHEMA (MySQL/PostgreSQL)
-- ----------------------------------------------------------------------------

-- Tenants Table (Multi-tenant support)
CREATE TABLE IF NOT EXISTS tenants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Menu Categories Table
CREATE TABLE IF NOT EXISTS menu_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tenant_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE CASCADE,
    INDEX idx_tenant_order (tenant_id, display_order)
);

-- Menu Items Table
CREATE TABLE IF NOT EXISTS menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tenant_id INT NOT NULL,
    category_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(500) NULL,
    is_available TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES menu_categories(id) ON DELETE CASCADE,
    INDEX idx_category (category_id),
    INDEX idx_available (is_available)
);

-- Customer Orders Table
CREATE TABLE IF NOT EXISTS orders (
    id VARCHAR(50) PRIMARY KEY,
    tenant_id INT NOT NULL,
    menu_item_id INT NOT NULL,
    customer_name VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    quantity INT DEFAULT 1,
    total_price DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE CASCADE,
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
);

-- Menu Item Reviews Table
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tenant_id INT NOT NULL,
    menu_item_id INT NOT NULL,
    customer_name VARCHAR(255),
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE CASCADE,
    INDEX idx_item_rating (menu_item_id, rating)
);

-- VIP Customers Table (SMS Marketing)
CREATE TABLE IF NOT EXISTS vip_customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tenant_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) UNIQUE NOT NULL,
    message TEXT,
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE CASCADE,
    INDEX idx_phone (phone)
);

-- Site Settings Table
CREATE TABLE IF NOT EXISTS site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tenant_id INT NOT NULL,
    setting_key VARCHAR(100) NOT NULL,
    setting_value TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE CASCADE,
    UNIQUE KEY unique_tenant_setting (tenant_id, setting_key)
);

-- Admin Users Table
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ----------------------------------------------------------------------------
-- CURRENT JSON FILE STRUCTURE (Development)
-- ----------------------------------------------------------------------------

/*
The current implementation uses JSON files instead of a database.
Below is the structure of each JSON file:

1. menu_items.json
   Structure: Array of menu item objects
   {
     "id": integer,
     "name": string,
     "category": string,
     "description": string,
     "price": float,
     "is_available": integer (0 or 1),
     "image": string (file path or URL)
   }

2. orders.json
   Structure: Array of order objects
   {
     "id": string (unique order ID),
     "item_id": integer,
     "item_name": string,
     "item_price": float,
     "quantity": integer,
     "total": float,
     "customer_name": string,
     "customer_phone": string,
     "status": string ("pending" | "accepted" | "rejected"),
     "timestamp": string (datetime),
     "updated_at": string (datetime)
   }

3. reviews.json
   Structure: Nested object with item IDs as keys
   {
     "item_id": {
       "ratings": [array of integer ratings 1-5],
       "average": float,
       "count": integer
     }
   }

4. vip_customers.json
   Structure: Array of customer objects
   {
     "timestamp": string (datetime),
     "name": string,
     "phone": string (format: "+251XXXXXXXXX"),
     "review": string (optional message),
     "ip_address": string
   }

5. site_settings.json
   Structure: Nested object
   {
     "social_media": {
       "facebook": string (URL),
       "instagram": string (URL),
       "tiktok": string (URL)
     },
     "contact": {
       "phone": string,
       "email": string,
       "address": string
     },
     "neo_digital": {
       "name": string,
       "website": string (URL),
       "logo": string (file path)
     }
   }

6. admin_users.json
   Structure: Single admin user object
   {
     "username": string,
     "password": string (hashed with password_hash())
   }
*/

-- ----------------------------------------------------------------------------
-- MIGRATION NOTES
-- ----------------------------------------------------------------------------

/*
To migrate from JSON files to database:

1. Create all tables using the schema above
2. Insert a default tenant record
3. Parse menu_items.json and insert into menu_items table
   - Create categories from unique category values
   - Map category names to category_id foreign keys
4. Parse orders.json and insert into orders table
5. Parse reviews.json and insert into reviews table
6. Parse vip_customers.json and insert into vip_customers table
7. Parse site_settings.json and insert into site_settings table
   - Flatten nested structure with dot notation keys
   - Example: "social_media.facebook" = "https://facebook.com/..."
8. Parse admin_users.json and insert into admin_users table
9. Update PHP code to use PDO/MySQLi instead of file_get_contents/file_put_contents
10. Update environment variables for database connection

Database connection environment variables:
- DB_HOST (default: localhost)
- DB_PORT (default: 3306 for MySQL, 5432 for PostgreSQL)
- DB_DATABASE (database name)
- DB_USERNAME
- DB_PASSWORD
*/

-- ----------------------------------------------------------------------------
-- SAMPLE DATA (for testing)
-- ----------------------------------------------------------------------------

-- Insert sample tenant
INSERT INTO tenants (name, slug) VALUES ('Fuji Coffee', 'fuji-coffee');

-- Insert sample categories
INSERT INTO menu_categories (tenant_id, name, display_order) VALUES
(1, 'Appetizers', 1),
(1, 'Main Courses', 2),
(1, 'Beverages', 3),
(1, 'Desserts', 4);

-- Insert sample menu items (adjust category_id based on your IDs)
INSERT INTO menu_items (tenant_id, category_id, name, description, price, image_url, is_available) VALUES
(1, 1, 'Spring Rolls', 'Crispy vegetable spring rolls served with sweet chili sauce', 85.00, 'https://images.unsplash.com/photo-1529042410759-befb1204b468?w=600&h=400&fit=crop', 1),
(1, 2, 'Teriyaki Chicken', 'Grilled chicken glazed with house-made teriyaki sauce, served with steamed rice and vegetables', 245.00, 'https://images.unsplash.com/photo-1606850003-cf6563e31d85?w=600&h=400&fit=crop', 1),
(1, 3, 'Japanese Green Tea', 'Premium sencha green tea', 45.00, 'https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9?w=600&h=400&fit=crop', 1),
(1, 4, 'Mochi Ice Cream', 'Traditional Japanese rice cake with ice cream filling (assorted flavors)', 65.00, 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=600&h=400&fit=crop', 1);

-- Insert sample admin user (password: 'password')
INSERT INTO admin_users (username, password_hash, email) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@fujicoffee.com');

-- ----------------------------------------------------------------------------
-- INDEXES FOR PERFORMANCE
-- ----------------------------------------------------------------------------

-- Additional indexes for common queries
CREATE INDEX idx_menu_items_available ON menu_items(is_available, tenant_id);
CREATE INDEX idx_orders_status_date ON orders(status, created_at);
CREATE INDEX idx_vip_customers_tenant ON vip_customers(tenant_id, created_at);

-- Full-text search index for menu items (MySQL)
-- ALTER TABLE menu_items ADD FULLTEXT INDEX idx_fulltext_search (name, description);

-- ----------------------------------------------------------------------------
-- VIEWS FOR COMMON QUERIES
-- ----------------------------------------------------------------------------

-- View: Menu items with category name and review stats
CREATE OR REPLACE VIEW menu_items_full AS
SELECT 
    mi.id,
    mi.name,
    mi.description,
    mi.price,
    mi.image_url,
    mi.is_available,
    mc.name AS category_name,
    COUNT(r.id) AS review_count,
    AVG(r.rating) AS average_rating
FROM menu_items mi
LEFT JOIN menu_categories mc ON mi.category_id = mc.id
LEFT JOIN reviews r ON mi.id = r.menu_item_id
GROUP BY mi.id, mi.name, mi.description, mi.price, mi.image_url, mi.is_available, mc.name;

-- View: Order summary with customer and item details
CREATE OR REPLACE VIEW orders_summary AS
SELECT 
    o.id,
    o.customer_name,
    o.customer_phone,
    mi.name AS item_name,
    o.quantity,
    o.total_price,
    o.status,
    o.created_at,
    o.updated_at
FROM orders o
JOIN menu_items mi ON o.menu_item_id = mi.id;
