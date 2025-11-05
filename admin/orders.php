<?php
require_once 'session.php';
requireLogin();

$ordersFile = __DIR__ . '/../orders.json';

if (!file_exists($ordersFile)) {
    file_put_contents($ordersFile, json_encode([], JSON_PRETTY_PRINT), LOCK_EX);
}

$orders = json_decode(file_get_contents($ordersFile), true) ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['order_id'] ?? '';
    $action = $_POST['action'] ?? '';
    
    if ($action === 'accept' || $action === 'reject') {
        foreach ($orders as &$order) {
            if ($order['id'] === $orderId) {
                $order['status'] = $action === 'accept' ? 'accepted' : 'rejected';
                $order['updated_at'] = date('Y-m-d H:i:s');
                break;
            }
        }
        file_put_contents($ordersFile, json_encode($orders, JSON_PRETTY_PRINT), LOCK_EX);
        header('Location: orders.php?success=Order ' . $action . 'ed successfully');
        exit;
    }
}

usort($orders, function($a, $b) {
    return strcmp($b['timestamp'], $a['timestamp']);
});

$pendingOrders = array_filter($orders, fn($o) => $o['status'] === 'pending');
$acceptedOrders = array_filter($orders, fn($o) => $o['status'] === 'accepted');
$rejectedOrders = array_filter($orders, fn($o) => $o['status'] === 'rejected');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management - Fuji Cafe Admin</title>
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
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .stat-card h3 {
            font-size: 0.9rem;
            color: #718096;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-card .number {
            font-size: 2.5rem;
            font-weight: 700;
        }
        
        .stat-pending .number { color: #ed8936; }
        .stat-accepted .number { color: #48bb78; }
        .stat-rejected .number { color: #f56565; }
        
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
        
        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: capitalize;
        }
        
        .status-pending {
            background: #feebc8;
            color: #7c2d12;
        }
        
        .status-accepted {
            background: #c6f6d5;
            color: #22543d;
        }
        
        .status-rejected {
            background: #fed7d7;
            color: #742a2a;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-right: 8px;
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
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #a0aec0;
        }
        
        .empty-state::before {
            content: '📦';
            display: block;
            font-size: 4rem;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1>🍱 Fuji Cafe Admin</h1>
            <nav class="header-nav">
                <a href="index.php">Menu</a>
                <a href="orders.php" class="active">Orders</a>
                <a href="settings.php">⚙️ Settings</a>
                <a href="change_password.php">🔒 Password</a>
                <a href="../index.php" target="_blank">View Site</a>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </div>
    
    <div class="container">
        <?php if (isset($_GET['success'])): ?>
            <div class="success-message"><?= htmlspecialchars($_GET['success']) ?></div>
        <?php endif; ?>
        
        <div class="stats">
            <div class="stat-card stat-pending">
                <h3>Pending Orders</h3>
                <div class="number"><?= count($pendingOrders) ?></div>
            </div>
            <div class="stat-card stat-accepted">
                <h3>Accepted Orders</h3>
                <div class="number"><?= count($acceptedOrders) ?></div>
            </div>
            <div class="stat-card stat-rejected">
                <h3>Rejected Orders</h3>
                <div class="number"><?= count($rejectedOrders) ?></div>
            </div>
        </div>
        
        <div class="card">
            <h2>All Orders (<?= count($orders) ?> total)</h2>
            
            <?php if (empty($orders)): ?>
                <div class="empty-state">
                    <p>No orders yet</p>
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date & Time</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><small><?= htmlspecialchars(substr($order['id'], -8)) ?></small></td>
                                <td><?= date('M d, Y H:i', strtotime($order['timestamp'])) ?></td>
                                <td><?= htmlspecialchars($order['item_name']) ?></td>
                                <td><?= $order['quantity'] ?></td>
                                <td>Br <?= number_format($order['total_price'], 2) ?></td>
                                <td><?= htmlspecialchars($order['customer_name']) ?></td>
                                <td><?= htmlspecialchars($order['customer_phone']) ?></td>
                                <td>
                                    <span class="status-badge status-<?= $order['status'] ?>">
                                        <?= $order['status'] ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($order['status'] === 'pending'): ?>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                            <input type="hidden" name="action" value="accept">
                                            <button type="submit" class="btn btn-success">Accept</button>
                                        </form>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit" class="btn btn-danger">Reject</button>
                                        </form>
                                    <?php else: ?>
                                        <small style="color: #a0aec0;">No actions</small>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
