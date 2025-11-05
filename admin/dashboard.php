<?php
require_once 'session.php';
requireLogin();

$menuFile = __DIR__ . '/../menu_items.json';
$ordersFile = __DIR__ . '/../orders.json';
$reviewsFile = __DIR__ . '/../reviews.json';

$menuItems = json_decode(file_get_contents($menuFile), true) ?? [];
$orders = json_decode(file_get_contents($ordersFile), true) ?? [];
$reviews = json_decode(file_get_contents($reviewsFile), true) ?? [];

$totalItems = count($menuItems);
$availableItems = count(array_filter($menuItems, fn($item) => $item['is_available']));
$totalOrders = count($orders);
$pendingOrders = count(array_filter($orders, fn($o) => $o['status'] === 'pending'));
$acceptedOrders = count(array_filter($orders, fn($o) => $o['status'] === 'accepted'));
$rejectedOrders = count(array_filter($orders, fn($o) => $o['status'] === 'rejected'));

$totalRevenue = 0;
foreach ($orders as $order) {
    if ($order['status'] === 'accepted') {
        $totalRevenue += $order['total_price'];
    }
}

usort($orders, function($a, $b) {
    return strcmp($b['timestamp'], $a['timestamp']);
});

$recentOrders = array_slice($orders, 0, 5);
$totalReviews = 0;
$reviewCount = 0;
foreach ($reviews as $itemReviews) {
    foreach ($itemReviews as $review) {
        $totalReviews += $review['rating'];
        $reviewCount++;
    }
}
$averageRating = $reviewCount > 0 ? round($totalReviews / $reviewCount, 1) : 0;

$adminName = getAdminName();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Fuji Cafe Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        
        .header {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 {
            font-size: 2rem;
            color: #1a202c;
            font-weight: 700;
        }
        
        .welcome-text {
            font-size: 1rem;
            color: #718096;
            margin-top: 5px;
        }
        
        .header-nav {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        
        .nav-btn {
            padding: 12px 24px;
            background: #f7fafc;
            color: #2d3748;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .nav-btn:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .nav-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-radius: 0 0 0 100%;
        }
        
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        
        .stat-label {
            font-size: 0.875rem;
            color: #718096;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        
        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a202c;
            margin-bottom: 5px;
        }
        
        .stat-change {
            font-size: 0.85rem;
            color: #48bb78;
            font-weight: 600;
        }
        
        .stat-change.negative {
            color: #f56565;
        }
        
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .card h2 {
            font-size: 1.5rem;
            color: #1a202c;
            margin-bottom: 20px;
            font-weight: 700;
        }
        
        .order-item {
            padding: 15px;
            border-left: 4px solid #e2e8f0;
            margin-bottom: 15px;
            background: #f7fafc;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .order-item:hover {
            border-left-color: #667eea;
            background: #edf2f7;
            transform: translateX(5px);
        }
        
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        
        .order-id {
            font-weight: 700;
            color: #2d3748;
        }
        
        .order-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        
        .status-pending {
            background: #fef5e7;
            color: #d68910;
        }
        
        .status-accepted {
            background: #d4edda;
            color: #155724;
        }
        
        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }
        
        .order-details {
            font-size: 0.875rem;
            color: #718096;
            margin-top: 5px;
        }
        
        .quick-actions {
            display: grid;
            gap: 12px;
        }
        
        .action-btn {
            padding: 15px 20px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .action-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .action-secondary {
            background: #f7fafc;
            color: #2d3748;
            border: 2px solid #e2e8f0;
        }
        
        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #a0aec0;
        }
        
        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 10px;
        }
        
        @media (max-width: 968px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                gap: 20px;
            }
            
            .header-nav {
                width: 100%;
                justify-content: center;
            }
        }
        
        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .nav-btn {
                font-size: 0.875rem;
                padding: 10px 16px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="header">
            <div>
                <h1>🍱 Fuji Cafe Admin</h1>
                <div class="welcome-text">Welcome back, <?= htmlspecialchars($adminName) ?>!</div>
            </div>
            <nav class="header-nav">
                <a href="/admin/dashboard.php" class="nav-btn active">📊 Dashboard</a>
                <a href="/admin/index.php" class="nav-btn">🍽️ Menu</a>
                <a href="/admin/orders.php" class="nav-btn">📦 Orders</a>
                <a href="/admin/settings.php" class="nav-btn">⚙️ Settings</a>
                <a href="/admin/change_password.php" class="nav-btn">🔒 Password</a>
                <a href="/index.php" target="_blank" class="nav-btn">👁️ View Site</a>
                <a href="/admin/logout.php" class="nav-btn">🚪 Logout</a>
            </nav>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">🍽️</div>
                <div class="stat-label">Menu Items</div>
                <div class="stat-value"><?= $totalItems ?></div>
                <div class="stat-change"><?= $availableItems ?> available</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">📦</div>
                <div class="stat-label">Total Orders</div>
                <div class="stat-value"><?= $totalOrders ?></div>
                <div class="stat-change"><?= $pendingOrders ?> pending</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-label">Revenue</div>
                <div class="stat-value">Br <?= number_format($totalRevenue, 2) ?></div>
                <div class="stat-change"><?= $acceptedOrders ?> accepted orders</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">⭐</div>
                <div class="stat-label">Average Rating</div>
                <div class="stat-value"><?= $averageRating ?></div>
                <div class="stat-change"><?= $reviewCount ?> reviews</div>
            </div>
        </div>
        
        <div class="content-grid">
            <div class="card">
                <h2>📋 Recent Orders</h2>
                <?php if (empty($recentOrders)): ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">📭</div>
                        <p>No orders yet</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($recentOrders as $order): ?>
                        <div class="order-item">
                            <div class="order-header">
                                <span class="order-id">Order #<?= htmlspecialchars(substr($order['id'], 0, 8)) ?></span>
                                <span class="order-status status-<?= htmlspecialchars($order['status']) ?>">
                                    <?= htmlspecialchars($order['status']) ?>
                                </span>
                            </div>
                            <div class="order-details">
                                <strong><?= htmlspecialchars($order['customer_name']) ?></strong> - 
                                <?= htmlspecialchars($order['item_name']) ?> × <?= $order['quantity'] ?>
                            </div>
                            <div class="order-details">
                                Br <?= number_format($order['total_price'], 2) ?> • 
                                <?= date('M j, Y g:i A', strtotime($order['timestamp'])) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div class="card">
                <h2>⚡ Quick Actions</h2>
                <div class="quick-actions">
                    <a href="/admin/index.php" class="action-btn action-primary">
                        ➕ Add Menu Item
                    </a>
                    <a href="/admin/orders.php" class="action-btn action-secondary">
                        📦 View All Orders
                    </a>
                    <a href="/admin/settings.php" class="action-btn action-secondary">
                        ⚙️ Site Settings
                    </a>
                    <a href="/index.php" target="_blank" class="action-btn action-secondary">
                        👁️ Preview Website
                    </a>
                </div>
                
                <div style="margin-top: 30px; padding: 20px; background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%); border-radius: 12px; border-left: 4px solid #667eea;">
                    <h3 style="font-size: 1rem; color: #2d3748; margin-bottom: 8px;">💡 Quick Tip</h3>
                    <p style="font-size: 0.875rem; color: #718096; line-height: 1.6;">
                        Keep your menu updated with fresh items and attractive images to increase customer engagement and orders!
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
