<?php
require_once 'conection.php';

// Add brand
if ($_POST && $_POST['name']) {
    $stmt = $pdo->prepare("INSERT INTO brands (name, country, founded_year) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['name'], $_POST['country'], $_POST['founded_year']]);
    echo "Brand added successfully!<br>";
}

// Get all brands
$stmt = $pdo->query("SELECT * FROM brands ORDER BY name");
$brands = $stmt->fetchAll();
?>

<h2>Brand Management</h2>

<h3>Add Brand</h3>
<form method="POST">
    <input type="text" name="name" placeholder="Brand Name" required><br><br>
    <input type="text" name="country" placeholder="Country"><br><br>
    <input type="number" name="founded_year" placeholder="Founded Year"><br><br>
    <input type="submit" value="Add Brand">
</form>

<h3>Brands List</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Country</th>
        <th>Founded Year</th>
        <th>Created At</th>
    </tr>
    <?php foreach ($brands as $brand): ?>
        <tr>
            <td><?= $brand['id'] ?></td>
            <td><?= htmlspecialchars($brand['name']) ?></td>
            <td><?= htmlspecialchars($brand['country']) ?></td>
            <td><?= $brand['founded_year'] ?></td>
            <td><?= $brand['created_at'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
