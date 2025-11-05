<?php
header('Content-Type: application/json');

$reviewsFile = __DIR__ . '/reviews.json';

if (!file_exists($reviewsFile)) {
    echo json_encode([]);
    exit;
}

$reviews = json_decode(file_get_contents($reviewsFile), true) ?? [];

$itemRatings = [];
foreach ($reviews as $review) {
    $itemId = $review['item_id'];
    if (!isset($itemRatings[$itemId])) {
        $itemRatings[$itemId] = ['total' => 0, 'count' => 0];
    }
    $itemRatings[$itemId]['total'] += $review['rating'];
    $itemRatings[$itemId]['count']++;
}

$result = [];
foreach ($itemRatings as $itemId => $data) {
    $result[$itemId] = [
        'average' => round($data['total'] / $data['count'], 1),
        'count' => $data['count']
    ];
}

echo json_encode($result);
?>
