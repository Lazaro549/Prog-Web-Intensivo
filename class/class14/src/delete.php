<?php
session_start();
if (!isset($_SESSION['items'])) $_SESSION['items'] = ['Item 1', 'Item 2', 'Item 3'];

if ($_POST && isset($_POST['delete'])) {
    $index = $_POST['delete'];
    unset($_SESSION['items'][$index]);
    $_SESSION['items'] = array_values($_SESSION['items']);
}
?>

<h3>Delete Items</h3>
<form method="POST">
    <?php foreach ($_SESSION['items'] as $index => $item): ?>
        <div>
            <?= htmlspecialchars($item) ?>
            <button type="submit" name="delete" value="<?= $index ?>">Delete</button>
        </div>
    <?php endforeach; ?>
</form>
