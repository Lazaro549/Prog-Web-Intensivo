<?php
$symbols = ['🍒', '🍋', '🍊', '🔔', '⭐', '💎'];
$payouts = [
    '🍒🍒🍒' => 100,
    '🍋🍋🍋' => 200,
    '🍊🍊🍊' => 300,
    '🔔🔔🔔' => 500,
    '⭐⭐⭐' => 1000,
    '💎💎💎' => 5000
];

$results = [];
for ($i = 0; $i < 10; $i++) {
    $spin = [
        $symbols[rand(0, 5)],
        $symbols[rand(0, 5)],
        $symbols[rand(0, 5)]
    ];
    $combination = implode('', $spin);
    $payout = $payouts[$combination] ?? 0;
    $results[] = ['spin' => $spin, 'payout' => $payout];
}

echo "<h3>Jackpot Results:</h3>";
foreach ($results as $i => $result) {
    echo "Spin " . ($i + 1) . ": " . implode(' ', $result['spin']) . " - Payout: $" . $result['payout'] . "<br>";
}
?>
