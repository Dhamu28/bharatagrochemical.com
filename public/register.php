<?php
// /public/register.php
require_once __DIR__ . '/../includes/auth.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $message = register_user($username, $email, $password);
    if ($message === 'Registration successful.') {
        header("Location: login.php");
        exit();
    }
}
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>

    <section class="max-w-7xl mx-auto py-12">
        <form method="post" class="bg-white p-6 mx-auto rounded shadow-md w-full max-w-4xl">
            <h1 class="text-xl font-bold mb-4">Register</h1>
            <?php if ($message): ?><p class="text-red-500 mb-2"><?= htmlspecialchars($message) ?></p><?php endif; ?>
            <input type="text" name="username" placeholder="Username" required class="border p-2 mb-3 w-full">
            <input type="email" name="email" placeholder="Email" required class="border p-2 mb-3 w-full">
            <input type="password" name="password" placeholder="Password" required class="border p-2 mb-3 w-full">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded w-full">Register</button>
            <p class="mt-4 text-sm">Already have an account? <a href="login.php" class="text-blue-500">Login</a></p>
        </form>
    </section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
