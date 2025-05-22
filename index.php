<?php
require 'connect.php';

$editing = false;
$edit_entry = null;

if (isset($_GET['edit_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM entries WHERE id = ?");
    $stmt->execute([$_GET['edit_id']]);
    $edit_entry = $stmt->fetch();
    $editing = true;
}
    
include 'read.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Journal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1><a href="./index.php">My Journal</a></h1>

<form action="<?= $editing ? 'update.php' : 'create.php' ?>" method="post">
    <?php if ($editing): ?>
    <input type="hidden" name="id" value="<?= $edit_entry['id'] ?>">
    <?php endif; ?>
    <input type="text" name="author" placeholder="Author" class="formtop" required value="<?= $editing ? htmlspecialchars($edit_entry['author']) : '' ?>"><br>
    <input type="datetime-local" name="datetime" class="formtop" required value="<?= $editing ? date('Y-m-d\Th:i', strtotime($edit_entry['entry_datetime'])) : '' ?>"><br>
    <input type="text" name="title" placeholder="Title" class="formtop" required value="<?= $editing ? htmlspecialchars($edit_entry['title']) : ''  ?>"><br>
    <textarea name="body" placeholder="Write your entry..." required><?= $editing ? htmlspecialchars($edit_entry['body']) : '' ?></textarea><br>
    Mood:
    <?php
    $moods = ['Happy', 'Neutral', 'Sad'];
    foreach ($moods as $mood) {
        $checked = $editing && $edit_entry['mood'] === $mood ? 'checked' : '';
        echo "<label><input type='radio' name='mood' value='$mood' $checked> $mood</label>";
    }
    ?><br>

    <button type="submit" id="formbutton"><?= $editing ? 'Update Entry' : 'Save Entry' ?></button>
</form>

<hr>

<h2>Previous Entries</h2>
<ol>
<?php foreach ($entries as $entry): ?>
    <li>
        <a id="editpencil" href="index.php?edit_id=<?= $entry['id'] ?>" title="Edit">✏️</a>
        <a href="delete.php?id=<?= $entry['id'] ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this entry?')">🗑️</a>
        <a href="javascript:void(0);" onclick="const e = document.getElementById('entry<?= $entry['id'] ?>'); e.style.display = (e.style.display === 'none' ? 'block' : 'none');">
        (<?= htmlspecialchars($entry['entry_datetime']) ?>) <?= htmlspecialchars($entry['title']) ?>
        
        <div class="previousentry" id="entry<?= $entry['id'] ?>">
            <strong>Author:</strong> <?= htmlspecialchars($entry['author']) ?><br>
            <strong>Mood:</strong> <?= htmlspecialchars($entry['mood']) ?><br>
            <p><?= nl2br(htmlspecialchars($entry['body'])) ?></p>
        </div>
        
    </li>
<?php endforeach; ?>
</ol>

</body>
</html>
