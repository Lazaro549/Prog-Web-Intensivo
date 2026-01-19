<!DOCTYPE html>
<html>
<head>
    <title>Cinema Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="result-container">
        <img src="cinema.jpg" alt="Cinema" class="cinema-img">
        <?php
        if ($_POST) {
            $name = $_POST['name'] ?? '';
            $number = $_POST['number'] ?? 1;
            $operation = $_POST['operation'] ?? '';
            $styled = $_POST['styled'] ?? '';
            
            echo "<h1>Welcome to Cinema, " . htmlspecialchars($name) . "!</h1>";
            
            $class = $styled ? 'styled-output' : 'plain-output';
            
            echo "<div class='$class'>";
            
            if ($operation == 'multiply') {
                echo "<h3>Cinema Seats - Table of $number:</h3>";
                for ($i = 1; $i <= 10; $i++) {
                    echo "Row $i: $number x $i = " . ($number * $i) . " seats<br>";
                }
            } elseif ($operation == 'count') {
                echo "<h3>Cinema Countdown to $number:</h3>";
                for ($i = 1; $i <= $number; $i++) {
                    echo "$i ";
                }
            } elseif ($operation == 'pattern') {
                echo "<h3>Cinema Screen Pattern ($number rows):</h3>";
                for ($i = 1; $i <= $number; $i++) {
                    for ($j = 1; $j <= $i; $j++) {
                        echo "🎬 ";
                    }
                    echo "<br>";
                }
            }
            
            echo "</div>";
        }
        ?>
        <a href="index.html" class="back-link">Back to Cinema Form</a>
    </div>
</body>
</html>
