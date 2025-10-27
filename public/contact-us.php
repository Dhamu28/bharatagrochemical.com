<?php include './../includes/header.php';

$pageTitle = "Contact Us";
$pageImage = "./../assets/images/contact-banner.jpg";
$breadcrumb = [
  ['name' => 'Home', 'url' => './index.php'],
  ['name' => 'Contact Us']
];
include './../includes/page-banner.php';
?>

<section class="py-16 max-w-5xl mx-auto px-4 text-center">
  <h2 class="text-3xl font-semibold text-lime-600 mb-6">Get in Touch</h2>
  <p class="text-gray-700 mb-8">Have a question or want to partner with us? Fill out the form below.</p>
  <form class="grid md:grid-cols-2 gap-6 text-left">
    <input type="text" placeholder="Your Name" class="border rounded-lg p-3 w-full">
    <input type="email" placeholder="Email" class="border rounded-lg p-3 w-full">
    <textarea placeholder="Message" class="md:col-span-2 border rounded-lg p-3 h-32 w-full"></textarea>
    <button class="md:col-span-2 bg-lime-500 hover:bg-lime-600 text-white font-semibold px-8 py-3 rounded transition">
      Send Message
    </button>
  </form>
</section>

<!-- Contact Us Page -->
<section class="bg-white py-16 px-4 md:px-10">
  <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
    <!-- Form Block -->
    <div class="bg-white rounded-2xl shadow-lg border p-8">
      <h2 class="text-2xl md:text-3xl font-bold mb-4 text-lime-700">Let's Connect</h2>
      <form class="space-y-5">
        <div>
          <label class="block text-gray-700 mb-1 font-semibold">Name</label>
          <input type="text" required class="w-full px-4 py-3 rounded-md border border-gray-200 focus:ring-2 focus:ring-lime-400 outline-none" placeholder="Enter your name"/>
        </div>
        <div>
          <label class="block text-gray-700 mb-1 font-semibold">Email</label>
          <input type="email" required class="w-full px-4 py-3 rounded-md border border-gray-200 focus:ring-2 focus:ring-lime-400 outline-none" placeholder="you@email.com"/>
        </div>
        <div>
          <label class="block text-gray-700 mb-1 font-semibold">Message</label>
          <textarea required class="w-full px-4 py-3 rounded-md border border-gray-200 focus:ring-2 focus:ring-lime-400 outline-none h-28 resize-none" placeholder="Type your enquiry"></textarea>
        </div>
        <button type="submit" class="w-full py-3 px-6 font-bold rounded-full bg-lime-600 text-white hover:bg-lime-700 transition">
          Send Enquiry
        </button>
      </form>
    </div>

    <!-- Map & Info -->
    <div>
      <div class="rounded-2xl shadow-lg overflow-hidden mb-6">
        <iframe class="w-full h-64"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14668.040632793979!2d72.16631879487044!3d21.759983997813827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjHCsDQ1JzMzLjYiTiA3MsKwMTEnNDYuOSJF!5e0!3m2!1sen!2sin!4v1615806140745!5m2!1sen!2sin"
          allowfullscreen="" loading="lazy"></iframe>
      </div>
      <div class="bg-lime-50 rounded-2xl p-6 flex flex-col gap-4 shadow space-y-2">
        <div>
          <span class="font-bold text-gray-700 block">Address:</span>
          <span class="text-gray-500">UL-15, 16, 17, Pattani Plaza, Dairy Road, Nilambagh Circle, Bhawnagar - 364002, Gujrat</span>
        </div>
        <div>
          <span class="font-bold text-gray-700 block">Email:</span>
          <span class="text-lime-700">bharatagrochemicals24@gmail.com</span>
        </div>
        <div>
          <span class="font-bold text-gray-700 block">Phone:</span>
          <span class="text-gray-700">+91 8818002155</span>
        </div>
        <div class="flex pt-2 gap-4">
      <a href="#" aria-label="Facebook"><i class="fas fa-phone-alt"></i></a>
      <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
      <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
      <!-- <p class="text-sm text-white text-center">bharatagrochemicals24@gmail.com</p> -->
    </div>
        <div>
          <span class="font-bold text-gray-700 block">Business Hours:</span>
          <span class="text-gray-500">Mon - Sat: 9am - 7pm</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Product Slider (Example, replace with real JS/carousel for interactivity) -->
  <?php
// Fetch your desired featured products (edit the query for logic as needed)
$featured = $db->query("SELECT * FROM products ORDER BY id DESC LIMIT 8");
?>

<div class="max-w-7xl mx-auto mt-16">
  <h3 class="text-2xl font-bold text-lime-700 mb-6 text-center">Featured Products</h3>
  <div class="overflow-x-auto flex space-x-6 pb-4">
    <?php while ($product = $featured->fetchArray(SQLITE3_ASSOC)): ?>
      <div class="bg-white border rounded-xl shadow p-4 min-w-[120px] flex-shrink-0">
        <?php $img = htmlspecialchars($product['image']);?>
        <img src="<?php echo './../assets/images/'.$img;?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="h-28 w-full object-contain mb-2">
        <h4 class="font-semibold text-gray-800"><?php echo htmlspecialchars($product['name']); ?></h4>
        <p class="text-sm text-gray-500"><?php echo htmlspecialchars($product['description']); ?></p>
      </div>
    <?php endwhile; ?>
  </div>
</div>

</section>

<?php include './../includes/footer.php'; ?>