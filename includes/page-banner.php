<?php
// Page Banner – universal for all pages
$pageTitle = $pageTitle ?? 'Page Title';
$pageImage = $pageImage ?? './../assets/images/banner-default.jpg';
$breadcrumb = $breadcrumb ?? [
  ['name' => 'Home', 'url' => './index.php'],
  ['name' => $pageTitle]
];
?>

<section class="relative h-[260px] md:h-[340px] flex items-center justify-center text-center text-white overflow-hidden">
  <!-- Background Image -->
  <img src="<?= $pageImage ?>" alt="<?= htmlspecialchars($pageTitle) ?>"
       class="absolute inset-0 w-full h-full object-cover" />
  <div class="absolute inset-0 bg-black/50"></div>

  <!-- Grass Decoration (Optional) -->
  <div class="absolute top-0 left-0 w-full h-8 md:h-10 bg-[url('./assets/images/grass-top.png')] bg-repeat-x bg-cover"></div>

  <!-- Text Content -->
  <div class="relative z-10 px-4">
    <h1 class="text-3xl md:text-5xl font-bold mb-3"><?= htmlspecialchars($pageTitle) ?></h1>
    <nav class="text-sm md:text-base">
      <?php foreach ($breadcrumb as $i => $crumb): ?>
        <?php if ($i > 0): ?>
          <span class="mx-2 text-gray-300">/</span>
        <?php endif; ?>

        <?php if (!empty($crumb['url'])): ?>
          <a href="<?= $crumb['url'] ?>" class="hover:text-lime-400"><?= htmlspecialchars($crumb['name']) ?></a>
        <?php else: ?>
          <span class="text-lime-400"><?= htmlspecialchars($crumb['name']) ?></span>
        <?php endif; ?>
      <?php endforeach; ?>
    </nav>
  </div>
</section>
