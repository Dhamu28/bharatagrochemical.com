<?php
require_once __DIR__ . '/../includes/header.php';

$category = $_GET['category'] ?? null;
$products = $category
  ? $db->query("SELECT * FROM products WHERE category = '$category' AND visible = 1")
  : $db->query("SELECT * FROM products WHERE visible = 1");
?>
<section class="py-12">
  <div class="max-w-7xl mx-auto px-4">
    <h1 class="text-3xl font-bold text-[#0a1f44] mb-6"><?= $category ? htmlspecialchars($category) : 'All Products' ?></h1>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
      <?php $has = false; while ($p = $products->fetchArray(SQLITE3_ASSOC)): $has = true; ?>
        <div class="bg-white p-4 rounded shadow text-center">
          <a href="/public/product.php?id=<?= urlencode(strtolower(str_replace(' ', '-', $p['id']))) ?>">
            <img src="../assets/images/<?= htmlspecialchars($p['image']) ?>" class="h-52 w-full object-cover mb-2">
            <h4 class="font-semibold text-sm"><?= htmlspecialchars($p['name']) ?></h4>
            <p class="text-xs text-gray-500 mb-2">₹<?= number_format($p['price'], 2) ?></p>
          </a>
          <form action="cart.php" method="post">
            <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
            <input type="number" name="quantity" value="1" min="1" max="<?= $p['stock'] ?>" class="border w-14 p-1 text-center rounded text-xs">
            <button type="submit" name="add_to_cart" class="bg-blue-500 text-white px-2 py-1 rounded text-xs mt-1">Add</button>
          </form>
        </div>
      <?php endwhile; ?>
      <?php if (!$has): ?><p>No products found.</p><?php endif; ?>
    </div>
  </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
