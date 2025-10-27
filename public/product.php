<?php
require_once __DIR__ . '/../includes/header.php';

$pageTitle = "Products";
$pageImage = "./../assets/images/contact-banner.jpg";
$breadcrumb = [
  ['name' => 'Home', 'url' => './index.php'],
  ['name' => 'Products']
];
include './../includes/page-banner.php';
// Fetch all products (or modify query for paginated/category-specific results)
$products = $db->query("SELECT * FROM products ORDER BY id DESC");

?>

<section class="min-h-screen py-16">
  <div class="max-w-7xl mx-auto px-4 md:px-6">
    <!-- Page Heading -->
    <div class="py-12 relative">
      <div class="-z-10 absolute inset-0 flex pointer-events-none select-none">
        <span class="uppercase text-[7vw] sm:text-[6vw] md:text-[5vw] font-extrabold text-gray-100 opacity-80 pt-8">
          Our
        </span>
      </div>
      <p class="text-2xl font-light text-gray-700 mb-2 -mt-4 uppercase">Products</p>
      <h2 class="text-4xl sm:text-5xl font-semibold md:text-6xl text-lime-600 leading-tight pt-12">
        Explore Our Agrochemical Solutions
      </h2>
        <p class="mt-3 text-gray-600 max-w-2xl">
          From certified fertilizers to eco-safe insecticides, every product is backed by rigorous research for healthier crops and sustainable yields.
        </p>
      </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php
        while ($product = $products->fetchArray(SQLITE3_ASSOC)):
          // Optional: You can generate a slug or brand/logo as needed
          // $brandSlug = strtolower(str_replace(' ', '-', $product['brand']));
          // $brandImg = "../assets/brands/{$brandSlug}.png";
          $img = htmlspecialchars($product['image']);
          $name = htmlspecialchars($product['name']);
          $desc = htmlspecialchars($product['description'] ?? '');
          $badge = $product['badge'] ?? htmlspecialchars($product['category']);
          $badgeColor = ($badge == "Best Seller") ? 'bg-blue-600' : 'bg-lime-600';
          $category = htmlspecialchars($product['category'] ?? '');
          $detailsUrl = "product.php?id=" . (int)$product['id'];
      ?>
      <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition transform hover:-translate-y-1 flex flex-col overflow-hidden">
        <div class="h-52 w-full flex flex-col items-center border border-bottom border-gray-100 justify-center relative group">
          <img src="<?php echo './../assets/images/'.$img; ?>" alt="<?php echo $name; ?>" class="h-48 object-contain" />
          <span class="absolute top-3 right-3 <?php echo $badgeColor; ?> text-white text-xs font-semibold px-3 py-1 rounded-full">
            <?php echo htmlspecialchars($badge); ?>
          </span>
        </div>
        <div class="p-6 flex-1 flex flex-col">
          <h2 class="text-xl font-bold text-gray-900"><?php echo $name; ?></h2>
          <p class="text-gray-600 my-2 flex-1"><?php echo $desc; ?></p>
          <div class="flex items-center justify-between mt-4">
            <?php if ($category): ?>
            <div class="flex items-center space-x-2 text-sm text-lime-700 font-bold">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20"><circle cx="10" cy="10" r="7"></circle></svg>
              <span><?php echo $category; ?></span>
            </div>
            <?php endif; ?>
            <a href="<?php echo $detailsUrl; ?>" class="text-lime-700 font-semibold hover:underline">Details</a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>


<?php require_once __DIR__ . '/../includes/footer.php';?>
