<?php

require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = $_POST['author'];
    $datetime = $_POST['datetime'];
    $title = $_POST['title'];
    $body = $_POST['body'];
    $mood = $_POST['mood'];

    $stmt = $pdo->prepare("INSERT INTO entries (author, entry_datetime, title, body, mood) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$author, $datetime, $title, $body, $mood]);

    header('location: index.php');
    exit;
}
?>
