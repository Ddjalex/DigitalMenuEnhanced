<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$itemId = isset($_POST['item_id']) ? trim($_POST['item_id']) : '';
$rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
$customerName = isset($_POST['customer_name']) ? trim($_POST['customer_name']) : 'Anonymous';

if (empty($itemId) || $rating < 1 || $rating > 5) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid rating']);
    exit;
}

$review = [
    'id' => uniqid('review_'),
    'timestamp' => date('Y-m-d H:i:s'),
    'item_id' => $itemId,
    'rating' => $rating,
    'customer_name' => htmlspecialchars($customerName, ENT_QUOTES, 'UTF-8'),
    'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
];

$reviewsFile = __DIR__ . '/reviews.json';

$reviews = [];
if (file_exists($reviewsFile)) {
    $jsonData = file_get_contents($reviewsFile);
    $reviews = json_decode($jsonData, true) ?? [];
}

$reviews[] = $review;

if (file_put_contents($reviewsFile, json_encode($reviews, JSON_PRETTY_PRINT), LOCK_EX)) {
    echo json_encode([
        'success' => true, 
        'message' => 'Thank you for your review!'
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Failed to save review. Please try again.']);
}
?>
