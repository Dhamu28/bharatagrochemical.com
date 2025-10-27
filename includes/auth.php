<?php
require_once __DIR__ . '/db.php';

function login_user($email, $password) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bindValue(1, $email);
    $user = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['user_id'] = $user['id']; 

        error_log('Logged in as: ' . $user['username']);
error_log('SESSION after login: ' . print_r($_SESSION, true));

        return 'Login successful.';
    }
    return 'Invalid email or password.';
}

function register_user($username, $email, $password) {
    global $db;
    $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bindValue(1, $email);
    $exists = $stmt->execute()->fetchArray();

    if ($exists) return 'Email already registered.';

    $hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bindValue(1, $username);
    $stmt->bindValue(2, $email);
    $stmt->bindValue(3, $hash);
    $stmt->execute();

    return 'Registration successful.';
}

function is_logged_in() {
    return isset($_SESSION['user']);
}

function current_user() {
    return $_SESSION['user'] ?? 'Guest';
}

function logout_user() {
    session_destroy();
}
