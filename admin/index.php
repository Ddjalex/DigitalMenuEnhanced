<?php
require_once 'session.php';
requireLogin();

$menuFile = __DIR__ . '/../menu_items.json';

if (!file_exists($menuFile)) {
    $defaultMenu = [
        ['id' => 1, 'name' => 'Spring Rolls', 'category' => 'Appetizers', 'description' => 'Crispy vegetable spring rolls served with sweet chili sauce', 'price' => 85.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1529042410759-befb1204b468?w=600&h=400&fit=crop'],
        ['id' => 2, 'name' => 'Edamame', 'category' => 'Appetizers', 'description' => 'Steamed soybeans with sea salt', 'price' => 65.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1583963641308-9bc92b8bed32?w=600&h=400&fit=crop'],
        ['id' => 3, 'name' => 'Gyoza', 'category' => 'Appetizers', 'description' => 'Pan-fried dumplings with a savory filling', 'price' => 95.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1630408377656-ed66ae5a6d1a?w=600&h=400&fit=crop'],
        ['id' => 4, 'name' => 'Teriyaki Chicken', 'category' => 'Main Courses', 'description' => 'Grilled chicken glazed with house-made teriyaki sauce, served with steamed rice and vegetables', 'price' => 245.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1606850003-cf6563e31d85?w=600&h=400&fit=crop'],
        ['id' => 5, 'name' => 'Salmon Sushi Platter', 'category' => 'Main Courses', 'description' => 'Fresh salmon nigiri and rolls with wasabi and pickled ginger', 'price' => 395.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1617196034796-73dfa7b1fd56?w=600&h=400&fit=crop'],
        ['id' => 6, 'name' => 'Vegetable Ramen', 'category' => 'Main Courses', 'description' => 'Rich miso broth with fresh vegetables, noodles, and tofu', 'price' => 185.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1623341214825-9f4f963727da?w=600&h=400&fit=crop'],
        ['id' => 7, 'name' => 'Beef Udon', 'category' => 'Main Courses', 'description' => 'Thick udon noodles with tender beef slices in savory broth', 'price' => 285.00, 'is_available' => 0, 'image' => 'https://images.unsplash.com/photo-1618841557871-b4664fbf0cb3?w=600&h=400&fit=crop'],
        ['id' => 8, 'name' => 'Japanese Green Tea', 'category' => 'Beverages', 'description' => 'Premium sencha green tea', 'price' => 45.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9?w=600&h=400&fit=crop'],
        ['id' => 9, 'name' => 'Iced Matcha Latte', 'category' => 'Beverages', 'description' => 'Creamy matcha green tea latte over ice', 'price' => 75.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1515823064-d6e0c04616a7?w=600&h=400&fit=crop'],
        ['id' => 10, 'name' => 'Fresh Fruit Smoothie', 'category' => 'Beverages', 'description' => 'Blended seasonal fruits with a touch of honey', 'price' => 85.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1505252585461-04db1eb84625?w=600&h=400&fit=crop'],
        ['id' => 11, 'name' => 'Mochi Ice Cream', 'category' => 'Desserts', 'description' => 'Traditional Japanese rice cake with ice cream filling (assorted flavors)', 'price' => 65.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=600&h=400&fit=crop'],
        ['id' => 12, 'name' => 'Matcha Tiramisu', 'category' => 'Desserts', 'description' => 'Italian classic with a Japanese twist - layers of matcha-soaked ladyfingers', 'price' => 95.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=600&h=400&fit=crop'],
        ['id' => 13, 'name' => 'Dorayaki', 'category' => 'Desserts', 'description' => 'Sweet red bean pancake sandwich', 'price' => 55.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1582716401301-b2407dc7563d?w=600&h=400&fit=crop']
    ];
    file_put_contents($menuFile, json_encode($defaultMenu, JSON_PRETTY_PRINT), LOCK_EX);
}

$menuItems = json_decode(file_get_contents($menuFile), true) ?? [];

function handleImageUpload($file) {
    if (!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        return null;
    }
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $actualMimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($actualMimeType, $allowedMimeTypes)) {
        return null;
    }
    
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, $allowedExtensions)) {
        return null;
    }
    
    $uploadsDir = __DIR__ . '/../uploads/';
    if (!file_exists($uploadsDir)) {
        mkdir($uploadsDir, 0755, true);
    }
    
    $filename = uniqid('menu_') . '.' . $extension;
    $destination = $uploadsDir . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return 'uploads/' . $filename;
    }
    
    return null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'add') {
        $imagePath = handleImageUpload($_FILES['image'] ?? null);
        
        $newId = max(array_column($menuItems, 'id')) + 1;
        $newItem = [
            'id' => $newId,
            'name' => $_POST['name'] ?? '',
            'category' => $_POST['category'] ?? '',
            'description' => $_POST['description'] ?? '',
            'price' => (float)($_POST['price'] ?? 0),
            'is_available' => (int)($_POST['is_available'] ?? 1),
            'image' => $imagePath ?? 'https://via.placeholder.com/600x400?text=No+Image'
        ];
        $menuItems[] = $newItem;
        file_put_contents($menuFile, json_encode($menuItems, JSON_PRETTY_PRINT), LOCK_EX);
        header('Location: index.php?success=Item added successfully');
        exit;
    }
    
    if ($action === 'edit') {
        $itemId = (int)$_POST['id'];
        foreach ($menuItems as &$item) {
            if ($item['id'] === $itemId) {
                $item['name'] = $_POST['name'] ?? $item['name'];
                $item['category'] = $_POST['category'] ?? $item['category'];
                $item['description'] = $_POST['description'] ?? $item['description'];
                $item['price'] = (float)($_POST['price'] ?? $item['price']);
                $item['is_available'] = (int)($_POST['is_available'] ?? $item['is_available']);
                
                $newImage = handleImageUpload($_FILES['image'] ?? null);
                if ($newImage) {
                    $item['image'] = $newImage;
                }
                
                break;
            }
        }
        file_put_contents($menuFile, json_encode($menuItems, JSON_PRETTY_PRINT), LOCK_EX);
        header('Location: index.php?success=Item updated successfully');
        exit;
    }
    
    if ($action === 'delete') {
        $itemId = (int)$_POST['id'];
        $menuItems = array_filter($menuItems, function($item) use ($itemId) {
            return $item['id'] !== $itemId;
        });
        $menuItems = array_values($menuItems);
        file_put_contents($menuFile, json_encode($menuItems, JSON_PRETTY_PRINT), LOCK_EX);
        header('Location: index.php?success=Item deleted successfully');
        exit;
    }
}

$categories = array_unique(array_column($menuItems, 'category'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Management - Fuji Cafe Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f7fafc;
            color: #2d3748;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 {
            font-size: 1.75rem;
        }
        
        .header-nav {
            display: flex;
            gap: 15px;
        }
        
        .header-nav a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.1);
        }
        
        .header-nav a:hover, .header-nav a.active {
            background: rgba(255,255,255,0.2);
        }
        
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        .success-message {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .card h2 {
            margin-bottom: 20px;
            color: #1a202c;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-success {
            background: #48bb78;
            color: white;
        }
        
        .btn-danger {
            background: #f56565;
            color: white;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background: #f7fafc;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        
        th {
            font-weight: 600;
            color: #4a5568;
        }
        
        .item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .status-available {
            background: #c6f6d5;
            color: #22543d;
        }
        
        .status-unavailable {
            background: #fed7d7;
            color: #742a2a;
        }
        
        .actions {
            display: flex;
            gap: 8px;
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
        }
        
        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            background: white;
            border-radius: 12px;
            padding: 30px;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #4a5568;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1>🍱 Fuji Cafe Admin</h1>
            <nav class="header-nav">
                <a href="/admin/dashboard.php">📊 Dashboard</a>
                <a href="/admin/index.php" class="active">🍽️ Menu</a>
                <a href="/admin/orders.php">📦 Orders</a>
                <a href="/admin/settings.php">⚙️ Settings</a>
                <a href="/admin/change_password.php">🔒 Password</a>
                <a href="/index.php" target="_blank">👁️ View Site</a>
                <a href="/admin/logout.php">🚪 Logout</a>
            </nav>
        </div>
    </div>
    
    <div class="container">
        <?php if (isset($_GET['success'])): ?>
            <div class="success-message"><?= htmlspecialchars($_GET['success']) ?></div>
        <?php endif; ?>
        
        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h2>Menu Items</h2>
                <button class="btn btn-primary" onclick="openAddModal()">➕ Add New Item</button>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($menuItems as $item): ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($item['image']) ?>" class="item-image" alt="<?= htmlspecialchars($item['name']) ?>"></td>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= htmlspecialchars($item['category']) ?></td>
                            <td>Br <?= number_format($item['price'], 2) ?></td>
                            <td>
                                <span class="status-badge status-<?= $item['is_available'] ? 'available' : 'unavailable' ?>">
                                    <?= $item['is_available'] ? 'Available' : 'Unavailable' ?>
                                </span>
                            </td>
                            <td>
                                <div class="actions">
                                    <button class="btn btn-success" onclick='openEditModal(<?= json_encode($item) ?>)'>Edit</button>
                                    <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?')">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div id="modal" class="modal">
        <div class="modal-content">
            <h2 id="modal-title">Add Menu Item</h2>
            <form id="item-form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" id="form-action" value="add">
                <input type="hidden" name="id" id="form-id">
                
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="form-name" required>
                </div>
                
                <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="category" id="form-category" list="categories" required>
                    <datalist id="categories">
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= htmlspecialchars($cat) ?>">
                        <?php endforeach; ?>
                    </datalist>
                </div>
                
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="form-description" rows="3" required></textarea>
                </div>
                
                <div class="form-group">
                    <label>Price (Br)</label>
                    <input type="number" name="price" id="form-price" step="0.01" required>
                </div>
                
                <div class="form-group">
                    <label>Food Image</label>
                    <input type="file" name="image" id="form-image" accept="image/*">
                    <small style="color: #718096; display: block; margin-top: 5px;">Upload JPG, PNG, or WEBP image (optional)</small>
                </div>
                
                <div class="form-group">
                    <label>Status</label>
                    <select name="is_available" id="form-available" required>
                        <option value="1">Available</option>
                        <option value="0">Unavailable</option>
                    </select>
                </div>
                
                <div style="display: flex; gap: 10px; margin-top: 30px;">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn" onclick="closeModal()" style="background: #e2e8f0; color: #2d3748;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function openAddModal() {
            document.getElementById('modal-title').textContent = 'Add Menu Item';
            document.getElementById('form-action').value = 'add';
            document.getElementById('item-form').reset();
            document.getElementById('modal').classList.add('active');
        }
        
        function openEditModal(item) {
            document.getElementById('modal-title').textContent = 'Edit Menu Item';
            document.getElementById('form-action').value = 'edit';
            document.getElementById('form-id').value = item.id;
            document.getElementById('form-name').value = item.name;
            document.getElementById('form-category').value = item.category;
            document.getElementById('form-description').value = item.description;
            document.getElementById('form-price').value = item.price;
            document.getElementById('form-available').value = item.is_available;
            document.getElementById('modal').classList.add('active');
        }
        
        function closeModal() {
            document.getElementById('modal').classList.remove('active');
        }
        
        document.getElementById('modal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>
</body>
</html>
