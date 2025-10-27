<?php
$db = new SQLite3(__DIR__ . '/../database/store.db');
// User Table
$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT,
    email TEXT UNIQUE,
    password TEXT
);");
// Admin Table
$db->exec("CREATE TABLE IF NOT EXISTS admins (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE,
    password TEXT
);");

// Insert default admin if not exists
$adminCount = $db->querySingle("SELECT COUNT(*) FROM admins");
if ($adminCount == 0) {
    $defaultPass = password_hash('admin123', PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
    $stmt->bindValue(1, 'admin');
    $stmt->bindValue(2, $defaultPass);
    $stmt->execute();
}
// Add products

$db->exec("CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    price REAL,
    description TEXT,
    image TEXT,
    stock INTEGER,
    category TEXT,
    brand TEXT,
    color TEXT,
    visible INTEGER DEFAULT 1
);");

// Categories table
$db->exec("CREATE TABLE IF NOT EXISTS categories (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT UNIQUE,
  image TEXT
);");

// $categories = [
//   ['name' => 'Insecticide', 'image' => 'airconditioner.png'],
//   ['name' => 'Herbicide', 'image' => 'airconditioner.png'],
//   ['name' => 'Fertilizer', 'image' => 'airconditioner.png'],
//   ['name' => 'Fertilizer', 'image' => 'airconditioner.png'],
//   ['name' => 'Bio Fertilizer', 'image' => 'airconditioner.png'],
//   ['name' => 'PGR', 'image' => 'airconditioner.png'],
//   ['name' => 'Fungicide', 'image' => 'airconditioner.png']
// ];
// foreach ($categories as $cat) {
//   $stmt = $db->prepare("INSERT OR IGNORE INTO categories (name, image) VALUES (?, ?)");
//   $stmt->bindValue(1, $cat['name']);
//   $stmt->bindValue(2, $cat['image']);
//   $stmt->execute();
// }

// Cart table
$db->exec("CREATE TABLE IF NOT EXISTS carts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    product_id INTEGER,
    category TEXT,
    brand TEXT,
    quantity INTEGER
);");

// Order table 
$db->exec("CREATE TABLE IF NOT EXISTS orders (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    name TEXT,
    email TEXT,
    mobile TEXT,
    address TEXT,
    landmark TEXT,
    pincode TEXT,
    state TEXT,
    district TEXT,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP
);");

// Order Items
$db->exec("CREATE TABLE IF NOT EXISTS order_items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    order_id INTEGER,
    product_id INTEGER,
    quantity INTEGER,
    category TEXT,
    brand TEXT,
    price REAL
);");
