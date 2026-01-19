<?php
require_once 'contection.php';

// Process vote
if ($_POST && $_POST['vote']) {
    $stmt = $pdo->prepare("UPDATE votes SET vote_count = vote_count + 1 WHERE id = ?");
    $stmt->execute([$_POST['vote']]);
    echo "<div style='color: green;'>Vote recorded!</div>";
}

// Get all vote options
$stmt = $pdo->query("SELECT * FROM votes ORDER BY vote_count DESC");
$votes = $stmt->fetchAll();

// Calculate total votes
$total_votes = array_sum(array_column($votes, 'vote_count'));
?>

<h2>Voting System</h2>

<h3>Cast Your Vote</h3>
<form method="POST">
    <?php foreach ($votes as $vote): ?>
        <div>
            <input type="radio" name="vote" value="<?= $vote['id'] ?>" required>
            <?= htmlspecialchars($vote['option_name']) ?>
        </div>
    <?php endforeach; ?>
    <br>
    <input type="submit" value="Vote">
</form>

<h3>Results</h3>
<table border="1">
    <tr>
        <th>Option</th>
        <th>Votes</th>
        <th>Percentage</th>
    </tr>
    <?php foreach ($votes as $vote): ?>
        <?php $percentage = $total_votes > 0 ? round(($vote['vote_count'] / $total_votes) * 100, 1) : 0; ?>
        <tr>
            <td><?= htmlspecialchars($vote['option_name']) ?></td>
            <td><?= $vote['vote_count'] ?></td>
            <td><?= $percentage ?>%</td>
        </tr>
    <?php endforeach; ?>
</table>

<p><strong>Total Votes: <?= $total_votes ?></strong></p>
