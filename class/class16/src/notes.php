<?php
$notes_file = 'notes.txt';

if ($_POST) {
    $action = $_POST['action'] ?? '';
    $note = $_POST['note'] ?? '';
    
    if ($action == 'add' && !empty($note)) {
        file_put_contents($notes_file, date('Y-m-d H:i:s') . " - " . $note . "\n", FILE_APPEND);
        $message = "Note added!";
    } elseif ($action == 'clear') {
        file_put_contents($notes_file, '');
        $message = "All notes cleared!";
    } else {
        $message = "Invalid action or empty note!";
    }
    
    echo "<h3>$message</h3>";
}

if (file_exists($notes_file)) {
    $content = file_get_contents($notes_file);
    if (!empty($content)) {
        echo "<h3>Current Notes:</h3>";
        echo "<pre>" . htmlspecialchars($content) . "</pre>";
    }
}
?>

<form method="POST">
    <textarea name="note" placeholder="Enter your note"></textarea><br><br>
    <input type="radio" name="action" value="add" checked> Add Note
    <input type="radio" name="action" value="clear"> Clear All<br><br>
    <input type="submit" value="Execute">
</form>
