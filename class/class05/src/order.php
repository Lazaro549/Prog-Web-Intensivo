<?php
$order = [
    'id' => 1,
    'total' => 0.00,
    'items' => []
];

if ($_POST) {
    $order['items'][] = $_POST;
    $order['total'] += floatval($_POST['price'] ?? 0);
}

echo json_encode($order);
?>
