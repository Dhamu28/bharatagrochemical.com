<?php include './../includes/header.php';

$pageTitle = "About Us";
$pageImage = "./../assets/images/contact-banner.jpg";
$breadcrumb = [
  ['name' => 'Home', 'url' => './index.php'],
  ['name' => 'About Us']
];
include './../includes/page-banner.php';
?>
<!-- Page content here -->
<section class="py-16 max-w-6xl mx-auto px-4">
  <h2 class="text-3xl font-semibold text-lime-600 mb-4">Who We Are</h2>
  <p class="text-gray-700 leading-relaxed">
    Bharat Agro Chemicals is committed to sustainable agriculture, delivering high-quality agrochemical products to farmers nationwide.
  </p>
</section>

<section class="bg-white py-12 relative">
  <div class="max-w-7xl mx-auto px-4 md:px-6">
    <div class="bg-white md:rounded-2xl md:shadow-xl flex flex-col md:flex-row min-h-[420px] relative overflow-visible">
      
      <!-- Left: Text Content -->
      <div class="w-full md:w-1/2 flex flex-col justify-center py-10 px-4 md:px-12 relative z-10">
          About Us
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 mt-2 leading-tight">
          Bringing Smiles to Our Farmers with Bharat Agro Chemicals!
        </h1>
        <p class="text-gray-600 text-base mb-6 font-light leading-relaxed">
          The company is focused on the three direct and most foundational inputs of farming seeds, fertilisers and pesticides. Along with ensuring that our products are 100% Organic, we focus on making them farmer friendly in application. Besides easy application, we ensure that our products are priced competitively in the market.
        </p>
        <a href="/about" class="inline-block bg-yellow-300 hover:bg-yellow-400 text-gray-900 font-semibold rounded-full px-8 py-4 shadow transition">More About</a>
      </div>

      <!-- Right: Main Image -->
      <div class="w-full md:w-1/2 flex justify-center items-center relative mt-10 md:mt-0">
        <div class="relative z-10">
          <img src="./../assets/images/about-farmers.webp" alt="Farmers Bharat Agro" class="rounded-xl shadow-lg object-cover w-full md:w-[410px] h-[340px]"/>
        </div>
        <!-- Top right Certified Badge -->
        <img src="./../assets/images/certified.jpg" alt="Certified Organic" class="absolute -top-10 -right-10 w-40 h-40 object-contain hidden md:block">
      </div>
    </div>
    <!-- Stats Row below card -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-7 mt-10 text-center max-w-4xl mx-auto">
      <div>
        <div class="text-3xl font-extrabold text-gray-900">100+</div>
        <div class="text-xs font-semibold tracking-wide text-gray-500 mt-1 uppercase">DEDICATED HANDS</div>
      </div>
      <div>
        <div class="text-3xl font-extrabold text-gray-900">100%</div>
        <div class="text-xs font-semibold tracking-wide text-gray-500 mt-1 uppercase">Organic Product</div>
      </div>
      <div>
        <div class="text-3xl font-extrabold text-gray-900">100+</div>
        <div class="text-xs font-semibold tracking-wide text-gray-500 mt-1 uppercase">Happy Customers</div>
      </div>
      <div>
        <div class="text-3xl font-extrabold text-gray-900">20+</div>
        <div class="text-xs font-semibold tracking-wide text-gray-500 mt-1 uppercase">Years Experience</div>
      </div>
    </div>
  </div>
</section>


<section class="relative bg-white py-16 overflow-hidden">
  <!-- Subtle Leafy Background Pattern -->
  <div class="absolute inset-0 opacity-5 bg-[url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22120%22 height=%22120%22 fill=%22none%22><path d=%22M60 0C45 15 20 40 5 60C20 70 45 95 60 120C75 95 100 70 115 60C95 40 75 15 60 0Z%22 stroke=%22%2390EE90%22 stroke-width=%223%22 fill=%22none%22 stroke-linecap=%22round%22/></svg>')] bg-repeat bg-[length:250px_250px]"></div>

  <div class="relative max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 z-10">
    <!-- Left: Image -->
    <div class="flex justify-center items-center">
      <img src="./../assets/images/og-banner.webp" alt="About Bharat Agro Chemicals" class="rounded-2xl shadow-lg object-cover w-full md:w-[80%]" />
    </div>

    <!-- Right: Text -->
    <div class="flex flex-col justify-center">
      <p class="uppercase text-lime-600 tracking-wide font-semibold mb-3 text-sm">About Us</p>
      <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
        Nurturing Growth, Harvesting Prosperity
      </h2>
      <p class="text-gray-700 leading-relaxed mb-4">
        <strong>Bharat Agro Chemicals</strong> is a progressive agricultural solutions provider, dedicated to 
        empowering farmers through science-backed formulations and sustainable growth practices.  
        Established with a vision to revolutionize Indian agriculture, we specialize in high-quality 
        <strong>insecticides, herbicides, fertilizers, bio-fertilizers, fungicides, and plant growth regulators (PGRs)</strong>.
      </p>

      <p class="text-gray-700 leading-relaxed mb-4">
        We believe in nurturing the soil while protecting the environment. Every product we develop 
        is rigorously tested to ensure it meets international quality and safety standards, delivering
        unmatched performance while preserving ecological balance.
      </p>

      <p class="text-gray-700 leading-relaxed mb-4">
        Our mission is driven by a simple truth – healthy crops begin with healthy soil. Through innovative 
        <strong>research, organic inputs, and eco-friendly formulations</strong>, we strive to restore soil vitality, 
        improve crop yields, and ensure long-term rural prosperity.
      </p>

      <div class="mt-6">
        <h3 class="text-2xl font-semibold text-lime-700 mb-3">Our Commitment</h3>
        <ul class="list-disc ml-5 space-y-2 text-gray-700">
          <li>Eco-friendly and residue-free agrochemical formulations</li>
          <li>Farmer-centric innovation and technology-driven development</li>
          <li>Field-tested solutions ensuring crop safety and efficiency</li>
          <li>Dedicated agricultural support and agronomy guidance</li>
          <li>Affordable, accessible, and sustainable farming practices</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- Vision Section -->
<section class="relative bg-lime-50 py-16 mt-10">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Our Vision</h2>
    <p class="text-lg text-gray-700 max-w-3xl mx-auto leading-relaxed">
      At <strong>Bharat Agro Chemicals</strong>, our vision is to 
      <span class="text-lime-600 font-semibold">transform agriculture into a sustainable, technology-driven ecosystem</span> 
      that protects soil health, boosts productivity, and empowers farmers to achieve self-reliance.
    </p>
    <p class="text-lg text-gray-700 max-w-3xl mx-auto leading-relaxed mt-4">
      We aspire to create a future where every farmer grows with confidence, every field thrives naturally, 
      and every harvest sustains generations to come.
    </p>
  </div>
</section>
<?php include './../includes/footer.php'; ?>