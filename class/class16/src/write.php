<?php
if ($_POST) {
    $content = $_POST['content'] ?? '';
    $file = $_POST['file'] ?? 'notes.txt';
    $mode = $_POST['mode'] ?? 'append';
    
    if (!empty($content)) {
        if ($mode == 'overwrite') {
            file_put_contents($file, $content);
            $message = "File overwritten successfully!";
        } else {
            file_put_contents($file, $content . "\n", FILE_APPEND);
            $message = "Content appended successfully!";
        }
    } else {
        $message = "Content cannot be empty!";
    }
    
    echo "<h3>$message</h3>";
}
?>

<form method="POST">
    <textarea name="content" placeholder="Enter content to write" required></textarea><br><br>
    <select name="file">
        <option value="notes.txt">notes.txt</option>
        <option value="simpson.txt">simpson.txt</option>
    </select><br><br>
    <input type="radio" name="mode" value="append" checked> Append
    <input type="radio" name="mode" value="overwrite"> Overwrite<br><br>
    <input type="submit" value="Write File">
</form>
