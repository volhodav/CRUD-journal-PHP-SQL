<?php

require 'connect.php';

$stmt = $pdo->query("SELECT * FROM entries ORDER BY entry_datetime DESC");
$entries = $stmt->fetchAll();

