<?php
$files = ['notes.txt', 'simpson.txt'];
$selected_file = $_POST['file'] ?? 'notes.txt';

if ($_POST) {
    if (file_exists($selected_file)) {
        $content = file_get_contents($selected_file);
        if (!empty($content)) {
            echo "<h3>Content of $selected_file:</h3>";
            echo "<pre>" . htmlspecialchars($content) . "</pre>";
        } else {
            echo "<h3>File is empty!</h3>";
        }
    } else {
        echo "<h3>File does not exist!</h3>";
    }
}
?>

<form method="POST">
    <select name="file">
        <?php foreach ($files as $file): ?>
            <option value="<?= $file ?>" <?= ($file == $selected_file) ? 'selected' : '' ?>>
                <?= $file ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>
    <input type="submit" value="Read File">
</form>