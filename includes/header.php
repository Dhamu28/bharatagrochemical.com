<?php
require_once __DIR__ . '/bootstrap.php';
$categories = $db->query("SELECT DISTINCT category FROM products WHERE category IS NOT NULL");
$is_logged = is_logged_in();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Basic SEO -->
  <title>Bharat Agro Chemicals - Certified Agrochemicals, Fertilizers & Farming Solutions</title>
  <meta name="description" content="Shop certified agrochemicals, fertilizers, and crop solutions with Bharat Agro Chemicals. Boost your harvests with research-backed products, sustainable farming, and expert agronomy support across India.">
  <meta name="keywords" content="Bharat Agro Chemicals, agriculture, fertilizers, agrochemicals, crop solutions, sustainable farming, bio-fertilizer, PGR, herbicide, insecticide, India, certified products, farm support">
  <meta name="author" content="Bharat Agro Chemicals">

  <!-- Canonical -->
  <link rel="canonical" href="https://bharatagrochemicals.com/" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="Bharat Agro Chemicals - Certified Agrochemicals & Fertilizer Solutions">
  <meta property="og:description" content="Empowering farmers with certified agrochemicals, fertilizers, and crop solutions. Backed by science, trusted by growers across India.">
  <meta property="og:url" content="https://bharatagrochemicals.com/">
  <meta property="og:image" content="https://bharatagrochemicals.com/assets/images/og-banner.webp">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Bharat Agro Chemicals - Certified Agrochemicals & Sustainable Farming">
  <meta name="twitter:description" content="Sustainable agrochemicals, fertilizers, and crop protection for modern Indian agriculture. Trusted, research-driven, and field-tested.">
  <meta name="twitter:image" content="https://bharatagrochemicals.com/assets/images/og-banner.webp">

  <!-- Favicon -->
  <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="/assets/images/apple-touch-icon.png">

  <!-- Robots -->
  <meta name="robots" content="index, follow">


  <!-- Tailwind or other CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/swiper@10/swiper-bundle.min.css" />
  <script src="https://unpkg.com/swiper@10/swiper-bundle.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <style>
    /* Smooth transitions */
    .transition-all {
      transition: all 0.3s ease-in-out;
    }
  </style>
</head>

<body class="bg-white font-light text-lg text-gray-700 md:text-xl leading-relaxed">

  <!-- Topbar: Responsive Helpline, Certification, Socials -->
  <div class="bg-gray-900 py-2 text-white">
    <div class="max-w-7xl mx-auto flex justify-between items-center gap-4 px-4">
      <div class="w-full md:w-auto flex-1 flex justify-center md:justify-start">
        <p class="text-xs sm:text-sm text-white text-center">Helpline No. 8818002155</p>
      </div>
      <div class="w-full md:w-auto flex-1 flex justify-center">
        <p class="text-xs sm:text-sm hidden md:block font-semibold text-white text-center">An ISO 9001:2015 Certified Company</p>
      </div>
      <div class="w-full md:w-auto flex-1 flex justify-center md:justify-end gap-4 mt-2 md:mt-0">
        <a href="#" aria-label="Phone" class="hover:text-lime-400 text-lg"><i class="fas fa-phone-alt"></i></a>
        <a href="#" aria-label="YouTube" class="hover:text-lime-400 text-lg"><i class="fab fa-youtube"></i></a>
        <a href="#" aria-label="Instagram" class="hover:text-lime-400 text-lg"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </div>

 <!-- header -->
  <header class="sticky top-0 z-50 bg-white shadow-md">
    <!-- Checkbox must be FIRST, so peer works -->
    <input type="checkbox" id="menuToggle" class="hidden peer" />

    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
      <!-- Logo -->
      <div class="flex items-center gap-2">
        <a href="#">
          <img src="http://localhost/bharatagro/assets/images/logo.png"
               alt="Bharat Agro Chemicals"
               class="w-32 object-contain" />
        </a>
      </div>

      <!-- Desktop Menu -->
      <nav class="hidden md:flex flex-1 justify-center">
        <ul class="flex items-center gap-8">
          <li><a href="#" class="hover:text-lime-600 transition">Home</a></li>
          <li><a href="../public/about.php" class="hover:text-lime-600 transition">About Us</a></li>
          <li class="relative group">
            <div class="flex items-center hover:text-lime-600 cursor-pointer">
              <a href="../public/product.php">Our Products</a>
              <svg class="ml-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </div>
            <!-- Dropdown -->
            <ul class="absolute left-0 top-full bg-white shadow-lg rounded py-2 w-48 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition duration-200 z-20">
              <?php while ($cat = $categories->fetchArray(SQLITE3_ASSOC)): ?>
                <li>
                  <a href="../public/product.php?category=<?= urlencode($cat['category']) ?>"
                     class="block px-4 py-2 hover:bg-lime-100 whitespace-nowrap">
                    <?= htmlspecialchars($cat['category']) ?>
                  </a>
                </li>
              <?php endwhile; ?>
            </ul>
          </li>
          <li><a href="#gallery" class="hover:text-lime-600 transition">Gallery</a></li>
          <li><a href="contact-us.php" class="hover:text-lime-600 transition">Contact</a></li>
        </ul>
      </nav>

      <!-- Contact-Now (Desktop only) -->
      <div class="hidden md:block">
        <a href="#contact"
           class="inline-block bg-blue-900 text-sm text-lime-400 px-8 py-3 rounded shadow hover:bg-lime-400 hover:text-blue-900 transition">
          Contact-Now
        </a>
      </div>

      <!-- Mobile Toggle -->
      <label for="menuToggle" class="md:hidden cursor-pointer text-3xl text-green-700 select-none">
        <span class="peer-checked:hidden">☰</span>
        <span class="hidden peer-checked:inline">✕</span>
      </label>
    </div>

    <!-- Mobile Menu (must be sibling of the checkbox input) -->
    <div
      class="max-w-7xl mx-auto px-4 md:hidden
             overflow-hidden transition-[max-height,opacity,padding] duration-300 ease-in-out
             max-h-0 opacity-0 py-0
             peer-checked:max-h-[calc(100vh-64px)] peer-checked:opacity-100 peer-checked:py-6"
    >
      <div class="bg-white rounded-lg shadow-inner flex flex-col items-start gap-4 text-lg ">
        <a href="#" class="w-full block px-2 py-2 hover:text-lime-600 transition">Home</a>
        <a href="../public/about.php" class="w-full block px-2 py-2 hover:text-lime-600 transition">About Us</a>

        <div class="w-full">
          <div class="px-2 py-2 flex items-center justify-between hover:text-lime-600 transition cursor-default">
            <span>Our Products</span>
          </div>
          <ul class="border-t mt-1">
            <?php while ($cat = $categories->fetchArray(SQLITE3_ASSOC)): ?>
              <li>
                <a href="../public/product.php?category=<?= urlencode($cat['category']) ?>"
                   class="block px-4 py-2 hover:bg-lime-100 whitespace-nowrap">
                  <?= htmlspecialchars($cat['category']) ?>
                </a>
              </li>
            <?php endwhile; ?>
          </ul>
        </div>

        <a href="#gallery" class="w-full block px-2 py-2 hover:text-lime-600 transition">Gallery</a>
        <a href="contact-us.php" class="w-full block px-2 py-2 hover:text-lime-600 transition">Contact</a>

        <div class="w-full px-2 mt-2">
          <a href="#contact"
             class="block w-full text-center bg-blue-900 text-sm text-lime-400 font-semibold px-4 py-3 rounded shadow hover:bg-lime-400 hover:text-blue-900 transition">
            Contact-Now
          </a>
        </div>
      </div>
    </div>
  </header>
