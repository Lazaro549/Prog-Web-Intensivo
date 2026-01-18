<?php

// Simple if-else decision
$price = 100;
if ($price > 50) {
    echo "Expensive product\n";
} else {
    echo "Cheap product\n";
}

// Multiple conditions with elseif
$category = "electronics";
if ($category == "books") {
    $shipping = 5;
} elseif ($category == "electronics") {
    $shipping = 15;
} else {
    $shipping = 10;
}

// Switch statement for payment methods
$paymentMethod = "credit_card";
switch ($paymentMethod) {
    case "credit_card":
        $fee = 0.03;
        break;
    case "debit_card":
        $fee = 0.02;
        break;
    case "cash":
        $fee = 0;
        break;
    default:
        $fee = 0.05;
}

// Ternary operator for quick decisions
$stock = 5;
$status = ($stock > 0) ? "Available" : "Out of stock";

// Null coalescing operator
$discount = $_GET['discount'] ?? 0;

echo "Shipping: $shipping\n";
echo "Fee: $fee\n";
echo "Status: $status\n";
echo "Discount: $discount%\n";

?>