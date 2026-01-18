<?php
function celsiusToFahrenheit($celsius) {
    return ($celsius * 9/5) + 32;
}

function fahrenheitToCelsius($fahrenheit) {
    return ($fahrenheit - 32) * 5/9;
}

// Example usage
$temp_c = 25;
$temp_f = celsiusToFahrenheit($temp_c);
echo "$temp_c°C = $temp_f°F\n";

$temp_f = 77;
$temp_c = fahrenheitToCelsius($temp_f);
echo "$temp_f°F = $temp_c°C\n";
?>
