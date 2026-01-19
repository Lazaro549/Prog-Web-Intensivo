<?php
echo "<h3>BINGO Numbers:</h3>";
for ($i = 1; $i <= 75; $i++) {
    echo $i . " ";
    if ($i % 15 == 0) echo "<br>";
}
?>