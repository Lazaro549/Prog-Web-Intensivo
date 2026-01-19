<?php
if ($_POST) {
    $subject = $_POST['subject'] ?? '';
    $note = $_POST['note'] ?? '';
    $category = $_POST['category'] ?? '';
    $important = $_POST['important'] ?? '';
    
    echo "<h3>Note Saved:</h3>";
    echo "Subject: " . htmlspecialchars($subject) . "<br>";
    echo "Note: " . htmlspecialchars($note) . "<br>";
    echo "Category: " . htmlspecialchars($category) . "<br>";
    echo "Important: " . ($important ? 'Yes' : 'No') . "<br>";
}
?>

<form method="POST">
    <input type="text" name="subject" placeholder="Subject" required><br><br>
    <textarea name="note" placeholder="Write your note..." rows="5" required></textarea><br><br>
    <select name="category" required>
        <option value="">Select Category</option>
        <option value="personal">Personal</option>
        <option value="work">Work</option>
        <option value="study">Study</option>
    </select><br><br>
    <input type="checkbox" name="important" value="1"> Mark as Important<br><br>
    <input type="submit" value="Save Note">
</form>