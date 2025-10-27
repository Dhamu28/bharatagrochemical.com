<?php
// /public/checkout.php
require_once __DIR__ . '/../includes/bootstrap.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $address = $_POST['address'] ?? '';
    $landmark = $_POST['landmark'] ?? '';
    $pincode = $_POST['pincode'] ?? '';
    $state = $_POST['state'] ?? '';
    $district = $_POST['district'] ?? '';
// echo "<pre>";
// print_r($_POST);
// exit;

    $db->exec("BEGIN");
    $stmt = $db->prepare("INSERT INTO orders (user_id, name, email, mobile, address, landmark, pincode, state, district) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bindValue(1, $user_id);
    $stmt->bindValue(2, $name);
    $stmt->bindValue(3, $email);
    $stmt->bindValue(4, $mobile);
    $stmt->bindValue(5, $address);
    $stmt->bindValue(6, $landmark);
    $stmt->bindValue(7, $pincode);
    $stmt->bindValue(8, $state);
    $stmt->bindValue(9, $district);
    $stmt->execute();
    $order_id = $db->lastInsertRowID();

    $ids = implode(',', array_keys($_SESSION['cart']));
    $results = $db->query("SELECT * FROM products WHERE id IN ($ids)");

    while ($product = $results->fetchArray(SQLITE3_ASSOC)) {
        $pid = $product['id'];
        $quantity = $_SESSION['cart'][$pid];
        $price = $product['price'];
        $stmt = $db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bindValue(1, $order_id);
        $stmt->bindValue(2, $pid);
        $stmt->bindValue(3, $quantity);
        $stmt->bindValue(4, $price);
        $stmt->execute();

        $new_stock = $product['stock'] - $quantity;
        $update = $db->prepare("UPDATE products SET stock = ? WHERE id = ?");
        $update->bindValue(1, $new_stock);
        $update->bindValue(2, $pid);
        $update->execute();
    }

    $db->exec("COMMIT");
    $_SESSION['cart'] = [];
    header("Location: success.php");
    exit();
}
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>

  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
  <script>
    async function fetchPincodeDetails(pincode) {
      if (pincode.length !== 6) return;
      const response = await fetch(`https://api.postalpincode.in/pincode/${pincode}`);
      const data = await response.json();
      const record = data[0]?.PostOffice?.[0];
      if (record) {
        document.getElementById('state').value = record.State;
        document.getElementById('district').value = record.District;
      }
    }
  </script>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Checkout Information</h1>
    <form method="post" class="bg-white p-6 rounded shadow space-y-4">
      <input type="text" name="name" placeholder="Your Name" required class="w-full border p-2 rounded">
      <input type="email" name="email" placeholder="Email Address" required class="w-full border p-2 rounded">
      <input type="text" name="mobile" placeholder="Mobile Number" required class="w-full border p-2 rounded">
      <textarea name="address" placeholder="Full Address" required class="w-full border p-2 rounded"></textarea>
      <input type="text" name="landmark" placeholder="Landmark (optional)" class="w-full border p-2 rounded">
      <input type="text" name="pincode" placeholder="Pincode" required class="w-full border p-2 rounded" oninput="fetchPincodeDetails(this.value)">
      <input type="text" id="state" name="state" placeholder="State" readonly class="w-full border p-2 rounded bg-gray-100">
      <input type="text" id="district" name="district" placeholder="District" readonly class="w-full border p-2 rounded bg-gray-100">
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Place Order</button>
    </form>
  </div>
</body>

<?php include __DIR__ . '/../includes/footer.php'; ?>

</html>
