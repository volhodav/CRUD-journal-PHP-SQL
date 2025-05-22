<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $author = $_POST['author'];
    $datetime = $_POST['datetime'];
    $title = $_POST['title'];
    $body = $_POST['body'];
    $mood = $_POST['mood'];

    $stmt = $pdo->prepare("UPDATE entries SET author=?, entry_datetime=?, title=?, body=?, mood=? WHERE id=?");
    $stmt->execute([$author, $datetime, $title, $body, $mood, $id]);

    header('location: index.php');
    exit;        
}

