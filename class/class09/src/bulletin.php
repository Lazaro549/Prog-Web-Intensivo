<?php
if ($_POST) {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $category = $_POST['category'] ?? '';
    $priority = $_POST['priority'] ?? '';
    
    echo "<h3>Bulletin Posted:</h3>";
    echo "Title: " . htmlspecialchars($title) . "<br>";
    echo "Content: " . htmlspecialchars($content) . "<br>";
    echo "Category: " . htmlspecialchars($category) . "<br>";
    echo "Priority: " . htmlspecialchars($priority) . "<br>";
}
?>

<form method="POST">
    <input type="text" name="title" placeholder="Title" required><br><br>
    <textarea name="content" placeholder="Content" required></textarea><br><br>
    <select name="category" required>
        <option value="">Select Category</option>
        <option value="news">News</option>
        <option value="event">Event</option>
        <option value="announcement">Announcement</option>
    </select><br><br>
    <input type="radio" name="priority" value="low" required> Low
    <input type="radio" name="priority" value="high"> High<br><br>
    <input type="submit" value="Post Bulletin">
</form>
