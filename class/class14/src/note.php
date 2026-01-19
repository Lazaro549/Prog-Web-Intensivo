<?php
session_start();
if (!isset($_SESSION['notes'])) $_SESSION['notes'] = [];

if ($_POST && $_POST['note']) {
    $_SESSION['notes'][] = $_POST['note'];
}

if ($_POST && isset($_POST['clear'])) {
    $_SESSION['notes'] = [];
}
?>

<h3>Notes App</h3>
<form method="POST">
    <textarea name="note" placeholder="Write a note..." required></textarea><br><br>
    <input type="submit" value="Add Note">
    <input type="submit" name="clear" value="Clear All">
</form>

<h4>Your Notes:</h4>
<?php foreach ($_SESSION['notes'] as $note): ?>
    <div style="border:1px solid #ccc; padding:10px; margin:5px;">
        <?= htmlspecialchars($note) ?>
    </div>
<?php endforeach; ?>
