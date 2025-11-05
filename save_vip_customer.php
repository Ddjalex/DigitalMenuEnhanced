<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$name = isset($_POST['customer_name']) ? trim($_POST['customer_name']) : '';
$phone = isset($_POST['customer_phone']) ? trim($_POST['customer_phone']) : '';
$review = isset($_POST['customer_review']) ? trim($_POST['customer_review']) : '';

if (empty($name) || empty($phone)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Name and phone number are required']);
    exit;
}

if (!preg_match('/^[0-9]{9}$/', $phone)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid phone number format. Please enter 9 digits']);
    exit;
}

$fullPhone = '+251' . $phone;

$customer = [
    'timestamp' => date('Y-m-d H:i:s'),
    'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
    'phone' => $fullPhone,
    'review' => htmlspecialchars($review, ENT_QUOTES, 'UTF-8'),
    'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
];

$dataFile = __DIR__ . '/vip_customers.json';

$customers = [];
if (file_exists($dataFile)) {
    $jsonData = file_get_contents($dataFile);
    $customers = json_decode($jsonData, true) ?? [];
}

foreach ($customers as $existing) {
    if ($existing['phone'] === $fullPhone) {
        echo json_encode([
            'success' => true, 
            'message' => 'You are already registered in our VIP club!',
            'already_registered' => true
        ]);
        exit;
    }
}

$customers[] = $customer;

if (file_put_contents($dataFile, json_encode($customers, JSON_PRETTY_PRINT), LOCK_EX)) {
    echo json_encode([
        'success' => true, 
        'message' => 'Successfully joined VIP club! You will receive lunch alerts soon.',
        'customer' => [
            'name' => $customer['name'],
            'phone' => $customer['phone']
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Failed to save data. Please try again.']);
}
?>
