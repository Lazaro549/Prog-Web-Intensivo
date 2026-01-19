<?php
if ($_POST) {
    $question = $_POST['question'] ?? '';
    $difficulty = $_POST['difficulty'] ?? '';
    $multiple_choice = $_POST['multiple_choice'] ?? '';
    $category = $_POST['category'] ?? '';
    
    echo "<h3>Question Created:</h3>";
    echo "Question: " . htmlspecialchars($question) . "<br>";
    echo "Difficulty: " . htmlspecialchars($difficulty) . "<br>";
    echo "Multiple Choice: " . ($multiple_choice ? 'Yes' : 'No') . "<br>";
    echo "Category: " . htmlspecialchars($category) . "<br>";
}
?>

<form method="POST">
    <textarea name="question" placeholder="Enter your question" required></textarea><br><br>
    <select name="difficulty" required>
        <option value="">Difficulty Level</option>
        <option value="easy">Easy</option>
        <option value="medium">Medium</option>
        <option value="hard">Hard</option>
    </select><br><br>
    <input type="checkbox" name="multiple_choice" value="1"> Multiple Choice<br><br>
    <input type="radio" name="category" value="math" required> Math
    <input type="radio" name="category" value="science"> Science
    <input type="radio" name="category" value="history"> History<br><br>
    <input type="submit" value="Create Question">
</form>