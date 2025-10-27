<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    $stmt = $db->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bindValue(1, $user);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

    if ($result && password_verify($pass, $result['password'])) {
        $_SESSION['admin_id'] = $result['id'];
        $_SESSION['admin_username'] = $result['username'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid login.";
    }
}
require_once __DIR__ . '/../includes/header.php';

?>
<section class="max-w-7xl px-8 mx-auto py-12">
  <form method="post" class="bg-white p-6 rounded shadow w-full max-w-sm space-y-4">
    <h1 class="text-xl font-bold text-center">Admin Login</h1>
    <?php if ($error): ?><div class="text-red-500"><?= $error ?></div><?php endif; ?>
    <input type="text" name="username" placeholder="Username" class="border p-2 w-full rounded" required>
    <input type="password" name="password" placeholder="Password" class="border p-2 w-full rounded" required>
    <button class="bg-blue-600 text-white px-4 py-2 w-full rounded">Login</button>
  </form>
</section>
  <?php require_once __DIR__ . '/../includes/footer.php';?>

