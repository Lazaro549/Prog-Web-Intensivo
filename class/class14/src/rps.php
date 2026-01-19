<?php
if ($_POST) {
    $player = $_POST['choice'];
    $computer = ['rock', 'paper', 'scissors'][rand(0, 2)];
    
    if ($player == $computer) {
        $result = "Tie!";
    } elseif (
        ($player == 'rock' && $computer == 'scissors') ||
        ($player == 'paper' && $computer == 'rock') ||
        ($player == 'scissors' && $computer == 'paper')
    ) {
        $result = "You Win!";
    } else {
        $result = "Computer Wins!";
    }
    
    echo "<h3>Result:</h3>";
    echo "You: $player<br>";
    echo "Computer: $computer<br>";
    echo "<strong>$result</strong><br><br>";
}
?>

<h3>Rock Paper Scissors</h3>
<form method="POST">
    <input type="radio" name="choice" value="rock" required> Rock
    <input type="radio" name="choice" value="paper"> Paper
    <input type="radio" name="choice" value="scissors"> Scissors<br><br>
    <input type="submit" value="Play">
</form>
