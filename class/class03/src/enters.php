<?php
$name = "World";
$number = 42;

echo "Hello, " . $name . "!\n";
echo "Number: " . $number . "\n";

if ($number > 40) {
    echo "Number is greater than 40\n";
}

$fruits = ["apple", "banana", "orange"];
foreach ($fruits as $fruit) {
    echo "Fruit: " . $fruit . "\n";
}
?>
