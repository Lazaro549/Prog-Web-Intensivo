<?php
$characters = [
    ['name' => 'Albert Einstein', 'clues' => ['Physicist', 'Theory of Relativity', 'Nobel Prize', 'E=mc²']],
    ['name' => 'Leonardo da Vinci', 'clues' => ['Artist', 'Mona Lisa', 'Renaissance', 'Inventor']],
    ['name' => 'Shakespeare', 'clues' => ['Writer', 'Romeo and Juliet', 'English', 'Playwright']],
    ['name' => 'Napoleon', 'clues' => ['Emperor', 'French', 'Waterloo', 'Military']],
    ['name' => 'Mozart', 'clues' => ['Composer', 'Classical Music', 'Austrian', 'Child Prodigy']]
];

$selected = $characters[rand(0, 4)];

if ($_POST && $_POST['guess']) {
    $guess = strtolower($_POST['guess']);
    $answer = strtolower($selected['name']);
    $result = (strpos($answer, $guess) !== false) ? "Correct!" : "Wrong!";
    echo "<h3>$result</h3>";
    echo "Answer: {$selected['name']}<br><br>";
}

echo "<h3>Who Am I?</h3>";
echo "<h4>Clues:</h4>";
foreach ($selected['clues'] as $clue) {
    echo "• $clue<br>";
}
?>

<form method="POST">
    <input type="text" name="guess" placeholder="Your guess" required><br><br>
    <input type="submit" value="Guess">
</form>
