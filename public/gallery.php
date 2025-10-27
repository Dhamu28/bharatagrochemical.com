<?php include 'includes/header.php'; ?>

<?php
$pageTitle = "Our Products";
$pageImage = "./assets/images/product-banner.jpg";
$breadcrumb = [
  ['name' => 'Home', 'url' => './index.php'],
  ['name' => 'Products']
];
include 'includes/page-banner.php';
?>

<!-- Product grid -->
<section class="py-16 max-w-7xl mx-auto px-4">
  <h2 class="text-3xl font-semibold text-lime-600 mb-8 text-center">Explore Our Product Range</h2>
  <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8">
    <!-- Your product cards here -->
  </div>
</section>

<?php
// Fetch all product images (and names for captions)
$products = $db->query("SELECT image, name FROM products WHERE image IS NOT NULL AND image != '' ORDER BY id DESC");
?>

<section class="max-w-6xl mx-auto px-4 py-12">
  <h1 class="text-3xl md:text-4xl font-bold text-gray-900 text-center mb-10">Photo Gallery</h1>
  <div class="columns-1 sm:columns-2 md:columns-3 gap-6 space-y-6">
    <?php while ($row = $products->fetchArray(SQLITE3_ASSOC)): ?>
      <div class="break-inside-avoid rounded-lg overflow-hidden shadow hover:shadow-lg transition mb-6 bg-white">
        <img 
          src="<?php echo htmlspecialchars($row['image']); ?>" 
          alt="<?php echo isset($row['name']) ? htmlspecialchars($row['name']) : 'Product Image'; ?>"
          class="w-full object-cover mb-2 transition hover:opacity-95" />
        <?php if (!empty($row['name'])): ?>
          <div class="px-4 pb-4 pt-1 text-gray-700 text-sm text-center"><?php echo htmlspecialchars($row['name']); ?></div>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </div>
</section>


<?php include 'includes/footer.php'; ?>
