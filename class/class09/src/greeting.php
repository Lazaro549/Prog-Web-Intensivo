<?php
if ($_POST) {
    $name = $_POST['name'] ?? '';
    $greeting = $_POST['greeting'] ?? '';
    $language = $_POST['language'] ?? '';
    
    echo "<h3>Greeting Generated:</h3>";
    echo htmlspecialchars($greeting) . ", " . htmlspecialchars($name) . "!<br>";
    echo "Language: " . htmlspecialchars($language) . "<br>";
}
?>

<form method="POST">
    <input type="text" name="name" placeholder="Your Name" required><br><br>
    <select name="greeting" required>
        <option value="">Select Greeting</option>
        <option value="Hello">Hello</option>
        <option value="Hi">Hi</option>
        <option value="Welcome">Welcome</option>
    </select><br><br>
    <input type="radio" name="language" value="english" required> English
    <input type="radio" name="language" value="spanish"> Spanish<br><br>
    <input type="submit" value="Generate Greeting">
</form>
