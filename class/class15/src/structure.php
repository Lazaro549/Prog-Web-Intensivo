<?php
$users = [
    ['id' => 1, 'name' => 'John', 'age' => 25, 'city' => 'New York'],
    ['id' => 2, 'name' => 'Jane', 'age' => 30, 'city' => 'Los Angeles'],
    ['id' => 3, 'name' => 'Bob', 'age' => 35, 'city' => 'Chicago'],
    ['id' => 4, 'name' => 'Alice', 'age' => 28, 'city' => 'Miami'],
    ['id' => 5, 'name' => 'Mike', 'age' => 32, 'city' => 'Seattle']
];

echo "<h3>User Structure:</h3>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>City</th></tr>";
foreach ($users as $user) {
    echo "<tr>";
    echo "<td>{$user['id']}</td>";
    echo "<td>{$user['name']}</td>";
    echo "<td>{$user['age']}</td>";
    echo "<td>{$user['city']}</td>";
    echo "</tr>";
}
echo "</table>";
?>
