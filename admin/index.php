<?php
require_once __DIR__ . '../../includes/bootstrap.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Pagination logic
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$perPage = 15;
$offset = ($page - 1) * $perPage;
$totalProducts = $db->querySingle("SELECT COUNT(*) FROM products");
$totalPages = ceil($totalProducts / $perPage);

// Fetch paginated products
$products = $db->query("SELECT * FROM products ORDER BY id DESC LIMIT $perPage OFFSET $offset");

// Fetch categories with images
$catList = $db->query("SELECT name, image FROM categories");
$categories = $db->query("SELECT name FROM categories");
$brands = ['Bharat Agro Chemicals'];
// $colors = ['Black','White','Red','Blue','Green','Yellow','Gray','Pink','Purple','Gold','Silver'];


// Handle product update
if (isset($_POST['update_product'])) {
    $stmt = $db->prepare("UPDATE products SET name = ?, price = ?, description = ?, stock = ?, category = ?, brand = ?  WHERE id = ?");
    $stmt->bindValue(1, $_POST['name']);
    $stmt->bindValue(2, $_POST['price']);
    $stmt->bindValue(3, $_POST['description']);
    $stmt->bindValue(4, $_POST['stock']);
    $stmt->bindValue(5, $_POST['category']);
    $stmt->bindValue(6, $_POST['brand']);
    $stmt->bindValue(8, $_POST['product_id']);
    $stmt->execute();
    header("Location: index.php?tab=products&page=$page");
    exit();
}

// Handle product delete
if (isset($_POST['delete_product'])) {
    $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bindValue(1, $_POST['product_id']);
    $stmt->execute();
    header("Location: index.php?tab=products&page=$page");
    exit();
}

// Handle Add Product
if (isset($_POST['add_product']) && isset($_FILES['image_file'])) {
    $img = $_FILES['image_file'];
    $imgName = time() . '_' . basename($img['name']);
    $targetPath = __DIR__ . '/../assets/images/' . $imgName;

    if (move_uploaded_file($img['tmp_name'], $targetPath)) {
        $stmt = $db->prepare("INSERT INTO products (name, price, description, image, stock, category, brand) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $_POST['name']);
        $stmt->bindValue(2, $_POST['price']);
        $stmt->bindValue(3, $_POST['description']);
        $stmt->bindValue(4, $imgName);
        $stmt->bindValue(5, $_POST['stock']);
        $stmt->bindValue(6, $_POST['category']);
        $stmt->bindValue(7, $_POST['brand']);
        $stmt->execute();
        header("Location: index.php?tab=products");
        exit();
    }
}

// Handle Add Category
if (isset($_POST['add_category']) && isset($_FILES['category_image'])) {
    $name = trim($_POST['category_name']);
    $img = $_FILES['category_image'];
    $filename = time() . '_' . basename($img['name']);
    $path = __DIR__ . '/../assets/images/categories/' . $filename;

    if (move_uploaded_file($img['tmp_name'], $path)) {
        $stmt = $db->prepare("INSERT OR IGNORE INTO categories (name, image) VALUES (?, ?)");
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $filename);
        $stmt->execute();
        header("Location: index.php?tab=categories");
        exit();
    }
}

// Determine active tab
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dhamutech-Commerce Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .tab-content { display: none; }
        .tab-content.active { display: block; }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md flex flex-col">
            <div class="p-6 flex items-center space-x-2">
                <span class="bg-green-600 rounded-full w-8 h-8 flex items-center justify-center text-white font-bold text-lg">DS</span>
                <span class="font-bold text-xl text-green-700">D-Store</span>
            </div>
            <nav class="flex-1 px-4 space-y-2">
                <a href="?tab=dashboard" class="flex items-center p-2 rounded <?= $tab=='dashboard'?'bg-green-100 text-green-700 font-semibold':'hover:bg-green-50' ?>">
                    <img src="../assets/icons/dashboard.png" alt="dashboard" class="w-6 h-6 me-2">
                    Dashboard
                </a>
                <a href="?tab=products" class="flex items-center p-2 rounded <?= $tab=='products'?'bg-green-100 text-green-700 font-semibold':'hover:bg-green-50' ?>">
                    <img src="../assets/icons/products.png" alt="products" class="w-6 h-6 me-2">
                    Products
                </a>
                <a href="?tab=categories" class="flex items-center p-2 rounded <?= $tab=='categories'?'bg-green-100 text-green-700 font-semibold':'hover:bg-green-50' ?>">
                    <img src="../assets/icons/category.png" alt="categories" class="w-6 h-6 me-2">
                    Categories
                </a>
                <a href="?tab=brands" class="flex items-center p-2 rounded <?= $tab=='brands'?'bg-green-100 text-green-700 font-semibold':'hover:bg-green-50' ?>">
                    <img src="../assets/icons/brand.png" alt="brands" class="w-6 h-6 me-2">
                    Brands
                </a>
            </nav>
            <div class="p-4 mt-auto">
                <a href="logout.php" class="w-full block bg-green-600 text-white py-2 rounded hover:bg-green-700 text-center">Logout</a>
            </div>  
        </aside>
        <!-- Main Content -->
            <!-- Dashboard Tab -->
            <div class="tab-content <?= $tab=='dashboard'?'active':'' ?>" id="dashboard">
            <main class="flex-1 p-8">   
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold">Dashboard</h1>
                </div>
                <div class="grid grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded shadow flex flex-col items-start">
                        <span class="text-gray-500">Total Products</span>
                        <span class="text-2xl font-bold text-green-700 mt-2"><?= $totalProducts ?></span>
                        <span class="text-xs text-green-500 mt-1">+5% this month</span>
                    </div>
                    <div class="bg-white p-6 rounded shadow flex flex-col items-start">
                        <span class="text-gray-500">Total In Stock</span>
                        <span class="text-2xl font-bold text-green-700 mt-2"><?= $totalProducts ?></span>
                        <span class="text-xs text-green-500 mt-1">+8% this month</span>
                    </div>
                    <div class="bg-white p-6 rounded shadow flex flex-col items-start">
                        <span class="text-gray-500">Out Of Stock</span>
                        <span class="text-2xl font-bold text-green-700 mt-2">0</span>
                        <span class="text-xs text-green-500 mt-1">+0% this month</span>
                    </div>
                    <div class="bg-white p-6 rounded shadow flex flex-col items-start">
                        <span class="text-gray-500">Pending Orders</span>
                        <span class="text-2xl font-bold text-green-700 mt-2">5</span>
                        <span class="text-xs text-red-500 mt-1">-1% this month</span>
                    </div>
                </div>
                
                <div class="grid grid-cols-3 gap-6 mb-8">
                    <!-- Analytics -->
                    <div class="bg-white p-6 rounded shadow col-span-2">
                        <h2 class="text-lg font-semibold mb-4">Sales Analytics</h2>
                        <div class="flex items-end space-x-4 h-32">
                            <div class="w-8 bg-green-200 h-12 rounded"></div>
                            <div class="w-8 bg-green-400 h-20 rounded"></div>
                            <div class="w-8 bg-green-600 h-28 rounded"></div>
                            <div class="w-8 bg-green-400 h-16 rounded"></div>
                            <div class="w-8 bg-green-200 h-10 rounded"></div>
                            <div class="w-8 bg-green-100 h-8 rounded"></div>
                            <div class="w-8 bg-green-100 h-6 rounded"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-xs text-gray-500">
                            <span>Sun</span><span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span>
                        </div>
                    </div>
                    <!-- Reminders / Quick Actions -->
                    <div class="bg-white p-6 rounded shadow flex flex-col justify-between">
                        <div>
                            <h2 class="text-lg font-semibold mb-2">Reminders</h2>
                            <div class="mb-4">
                                <span class="block text-gray-700 font-medium">Restock Inventory</span>
                                <span class="block text-xs text-gray-400">Today, 3:00 PM</span>
                            </div>
                            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full">View Details</button>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-6 mb-8">
                    <!-- Team Collaboration -->
                    <div class="bg-white p-6 rounded shadow col-span-2">
                        <h2 class="text-lg font-semibold mb-4">Order Status</h2>
                        <ul>
                            <li class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-2">
                                    <span class="w-8 h-8 bg-green-200 rounded-full flex items-center justify-center font-bold">A</span>
                                    <span>Alex Doe</span>
                                </div>
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">Completed</span>
                            </li>
                            <li class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-2">
                                    <span class="w-8 h-8 bg-green-200 rounded-full flex items-center justify-center font-bold">B</span>
                                    <span>Ben Smith</span>
                                </div>
                                <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded">In Progress</span>
                            </li>
                            <li class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-2">
                                    <span class="w-8 h-8 bg-green-200 rounded-full flex items-center justify-center font-bold">C</span>
                                    <span>Chris Lee</span>
                                </div>
                                <span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded">Pending</span>
                            </li>
                        </ul>
                    </div>
                    <!-- Project Progress -->
                    <div class="bg-white p-6 rounded shadow flex flex-col items-center justify-center">
                        <h2 class="text-lg font-semibold mb-4">Order Fulfillment</h2>
                        <div class="relative w-24 h-24">
                            <svg class="w-full h-full" viewBox="0 0 36 36">
                                <path class="text-green-200" stroke-width="4" stroke="currentColor" fill="none" d="M18 2.0845
                                    a 15.9155 15.9155 0 0 1 0 31.831
                                    a 15.9155 15.9155 0 0 1 0 -31.831"/>
                                <path class="text-green-600" stroke-width="4" stroke-dasharray="60, 100" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845
                                    a 15.9155 15.9155 0 0 1 0 31.831"/>
                            </svg>
                            <span class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-green-700">60%</span>
                        </div>
                        <span class="text-xs text-gray-500 mt-2">Orders Fulfilled</span>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-6 mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <!-- Categories Section -->
                        <section>
                            <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
                                Categories
                            </h2>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                                <?php while ($cat = $catList->fetchArray(SQLITE3_ASSOC)): ?>
                                    <div class="bg-white rounded shadow p-4 flex flex-col items-center hover:shadow-lg transition">
                                        <img src="http://localhost/bharatagro/assets/images/categories/<?= htmlspecialchars($cat['image']) ?>" alt="<?= htmlspecialchars($cat['name']) ?>" class="w-16 object-cover mb-2">
                                        <span class="font-semibold text-green-700"><?= htmlspecialchars($cat['name']) ?></span>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </section>
                        <!-- Brands Section -->
                        <section>
                            <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                                <svg class="w-7 h-7 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 2l2 7h7l-5.5 4 2 7-5.5-4-5.5 4 2-7L3 9h7z" /></svg>
                                Brands
                            </h2>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                                <?php foreach ($brands as $brand): 
                                    $imgBase = "http://localhost/bharatagro/assets/images/logo";
                                    $imgSrc = $imgBase . ".png";
                            
                                ?>
                                    <div class="bg-white rounded shadow hover:shadow-lg transition p-4 flex flex-col items-center">
                                        <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars(ucwords(str_replace('-', ' ', $brand))) ?>" class="h-24 object-contain">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    </div>
                </div>
            </main>
            </div>
            <!-- Products Tab -->
            <div class="tab-content <?= $tab=='products'?'active':'' ?>" id="products">
            <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold mb-4">Products</h2>
                <div class="overflow-x-auto p-6 rounded shadow bg-white">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr>
                            <th class="p-2 border">Image</th>
                            <th class="p-2 border">Name</th>
                            <th class="p-2 border">Price</th>
                            <th class="p-2 border">Description</th>
                            <th class="p-2 border">Stock</th>
                            <th class="p-2 border">Category</th>
                            <th class="p-2 border">Brand</th>
                            <!-- <th class="p-2 border">Color</th> -->
                            <th class="p-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $products->fetchArray(SQLITE3_ASSOC)): ?>
                        <tr class="">
                            <form method="post" action="?tab=products&page=<?= $page ?>">
                                <td class="p-2 border"><img src="../assets/images/<?= htmlspecialchars($row['image']) ?>" class="w-12"></td>
                                <td class="p-2 border"><input name="name" value="<?= htmlspecialchars($row['name']) ?>" class="border p-1 w-full rounded"></td>
                                <td class="p-2 border"><input name="price" value="<?= $row['price'] ?>" class="border p-1 w-full rounded"></td>
                                <td class="p-2 border"><input name="description" value="<?= htmlspecialchars($row['description']) ?>" class="border p-1 w-full rounded"></td>
                                <td class="p-2 border"><input name="stock" value="<?= $row['stock'] ?>" class="border p-1 w-full rounded"></td>
                                <td class="p-2 border"><input name="category" value="<?= htmlspecialchars($row['category']) ?>" class="border p-1 w-full rounded"></td>
                                <td class="p-2 border"><input name="brand" value="<?= htmlspecialchars($row['brand']) ?>" class="border p-1 w-full rounded"></td>
                                <!-- <td class="p-2 border"><input name="color" value="<?= htmlspecialchars($row['color']) ?>" class="border p-1 w-full rounded"></td> -->
                                <td class="p-2 border flex gap-1">
                                    <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                                    <button type="submit" name="update_product" class="bg-blue-600 text-white px-2 py-1 rounded text-xs">Save</button>
                                    <button type="submit" name="delete_product" class="bg-red-600 text-white px-2 py-1 rounded text-xs" onclick="return confirm('Delete this product?');">Delete</button>
                                </td>
                            </form>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                </div>
                <!-- Export CSV Button -->
                <div class="mt-4 flex justify-between items-center">
                    <a href="?tab=products&export_csv=1" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Export CSV</a>
                    <!-- Pagination -->
                    <div class="flex gap-2">
                        <?php if ($page > 1): ?>
                            <a href="?tab=products&page=<?= $page-1 ?>" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">&laquo; Prev</a>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?tab=products&page=<?= $i ?>" class="px-3 py-1 rounded <?= $i==$page?'bg-green-600 text-white':'bg-gray-200 hover:bg-gray-300' ?>"><?= $i ?></a>
                        <?php endfor; ?>
                        <?php if ($page < $totalPages): ?>
                            <a href="?tab=products&page=<?= $page+1 ?>" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Next &raquo;</a>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Add Product Form -->
                <div class="mt-8 max-w-2xl bg-white rounded shadow p-6">
                    <h3 class="text-lg font-semibold mb-4">Add New Product</h3>
                    <form method="post" enctype="multipart/form-data" class="space-y-3">
                        <input type="text" name="name" placeholder="Product Name" required class="w-full border p-2 rounded">
                        <input type="text" name="price" placeholder="Price" required class="w-full border p-2 rounded">
                        <textarea name="description" placeholder="Description" class="w-full border p-2 rounded"></textarea>
                        <input type="file" name="image_file" accept="image/*" required class="w-full border p-2 rounded">
                        <input type="number" name="stock" placeholder="Stock Quantity" required class="w-full border p-2 rounded">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <select name="category" required class="border p-2 rounded">
                                <option value="">Select Category</option>
                                <?php
                                $catOptions = $db->query("SELECT name FROM categories");
                                while ($cat = $catOptions->fetchArray(SQLITE3_ASSOC)): ?>
                                    <option value="<?= htmlspecialchars($cat['name']) ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                <?php endwhile; ?>
                            </select>
                            <select name="brand" required class="border p-2 rounded">
                                <option value="">Select Brand</option>
                                <?php foreach ($brands as $b): ?>
                                    <option value="<?= $b ?>"><?= ucwords(str_replace('-', ' ', $b)) ?></option>
                                <?php endforeach; ?>
                            </select>
                           <!--  <select name="color" required class="border p-2 rounded">
                                <option value="">Select Color</option>
                                <?php foreach ($colors as $clr): ?>
                                    <option value="<?= $clr ?>"><?= $clr ?></option>
                                <?php endforeach; ?>
                            </select> -->
                        </div>
                        <button type="submit" name="add_product" class="bg-green-600 text-white px-4 py-2 rounded">Add Product</button>
                    </form>
                </div>
            </div>
            </div>
            <!-- Categories Tab -->
            <div class="tab-content <?= $tab=='categories'?'active':'' ?>" id="categories">
            <div class="flex-1 p-8">   
            <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
                    Categories
                </h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-6">
                    <?php while ($cat = $catList->fetchArray(SQLITE3_ASSOC)): ?>
                        <div class="bg-white rounded shadow p-4 flex flex-col items-center hover:shadow-lg transition">
                            <img src="http://localhost/bharatagro/assets/images/categories/<?= htmlspecialchars($cat['image']) ?>" alt="<?= htmlspecialchars($cat['name']) ?>" class="w-16 object-cover mb-2">
                            <span class="font-semibold text-green-700"><?= htmlspecialchars($cat['name']) ?></span>
                        </div>
                    <?php endwhile; ?>
                </div>
                <!-- Add Category Form -->
                <div class="mt-8 max-w-md bg-white rounded shadow p-6">
                    <h3 class="text-lg font-semibold mb-4">Add New Category</h3>
                    <form method="post" enctype="multipart/form-data" class="space-y-3">
                        <input type="text" name="category_name" placeholder="Category Name" required class="w-full border p-2 rounded">
                        <input type="file" name="category_image" accept="image/*" required class="w-full border p-2 rounded">
                        <button type="submit" name="add_category" class="bg-green-600 text-white px-4 py-2 rounded">Add Category</button>
                    </form>
                </div>
            </div>
            </div>
            <!-- Brands Tab -->
            <div class="tab-content <?= $tab=='brands'?'active':'' ?>" id="brands">
            <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                    <svg class="w-7 h-7 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 2l2 7h7l-5.5 4 2 7-5.5-4-5.5 4 2-7L3 9h7z" /></svg>
                    Brands
                </h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                    <?php foreach ($brands as $brand):
                      
                    ?>
                        <div class="bg-white rounded shadow hover:shadow-lg transition p-4 flex flex-col items-center">
                            <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars(ucwords(str_replace('-', ' ', $brand))) ?>" class="h-20 object-contain">
                            <span class="font-semibold text-yellow-700"><?= htmlspecialchars(ucwords(str_replace('-', ' ', $brand))) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            </div>
    </div>
</body>
</html>