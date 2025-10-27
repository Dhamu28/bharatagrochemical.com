<?php
// /public/login.php
require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/auth.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $message = login_user($email, $password);
    if ($message === 'Login successful.') {
        header("Location: index.php");
        exit();
    }
}
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>
    <section class="max-w-7xl mx-auto py-12">
        <form method="post" class="bg-white p-6 rounded shadow-md w-full max-w-4xl mx-auto">
            <h1 class="text-xl font-bold mb-4">Login</h1>
            <?php if ($message): ?><p class="text-red-500 mb-2"><?= htmlspecialchars($message) ?></p><?php endif; ?>
            <input type="email" name="email" placeholder="Email" required class="border p-2 mb-3 w-full">
            <input type="password" name="password" placeholder="Password" required class="border p-2 mb-3 w-full">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Login</button>
            <p class="mt-4 text-sm">Don't have an account? <a href="register.php" class="text-blue-500">Register</a></p>
        </form>
    </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
