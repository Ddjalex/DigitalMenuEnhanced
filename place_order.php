<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$itemId = isset($_POST['item_id']) ? (int)$_POST['item_id'] : 0;
$customerName = isset($_POST['customer_name']) ? trim($_POST['customer_name']) : '';
$customerPhone = isset($_POST['customer_phone']) ? trim($_POST['customer_phone']) : '';
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

if (empty($itemId) || empty($customerName) || empty($customerPhone) || $quantity < 1) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'All fields are required']);
    exit;
}

$menuFile = __DIR__ . '/menu_items.json';

if (!file_exists($menuFile)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Menu not available']);
    exit;
}

$menuItems = json_decode(file_get_contents($menuFile), true) ?? [];

$item = null;
foreach ($menuItems as $menuItem) {
    if ($menuItem['id'] === $itemId) {
        $item = $menuItem;
        break;
    }
}

if (!$item) {
    http_response_code(404);
    echo json_encode(['success' => false, 'error' => 'Item not found']);
    exit;
}

if (!$item['is_available']) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'This item is currently unavailable']);
    exit;
}

$itemName = $item['name'];
$itemPrice = (float)$item['price'];

if (!preg_match('/^[0-9]{9}$/', $customerPhone)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid phone number format. Please enter 9 digits']);
    exit;
}

$fullPhone = '+251' . $customerPhone;

$order = [
    'id' => uniqid('order_'),
    'timestamp' => date('Y-m-d H:i:s'),
    'item_id' => $itemId,
    'item_name' => htmlspecialchars($itemName, ENT_QUOTES, 'UTF-8'),
    'item_price' => (float)$itemPrice,
    'quantity' => $quantity,
    'total_price' => (float)$itemPrice * $quantity,
    'customer_name' => htmlspecialchars($customerName, ENT_QUOTES, 'UTF-8'),
    'customer_phone' => $fullPhone,
    'status' => 'pending',
    'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
];

$ordersFile = __DIR__ . '/orders.json';

$orders = [];
if (file_exists($ordersFile)) {
    $jsonData = file_get_contents($ordersFile);
    $orders = json_decode($jsonData, true) ?? [];
}

$orders[] = $order;

if (file_put_contents($ordersFile, json_encode($orders, JSON_PRETTY_PRINT), LOCK_EX)) {
    echo json_encode([
        'success' => true, 
        'message' => 'Order placed successfully! We will contact you shortly.',
        'order_id' => $order['id']
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Failed to place order. Please try again.']);
}
?>
