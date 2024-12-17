<?php

require_once('../functions.php');
require_once('../db.php');

$book_id = intval($_POST['id'] ?? 0);

if ($book_id == 0) {
    echo 'error';
    exit;
}

$query = "DELETE FROM books WHERE id = :id";
$stmt = $pdo->prepare($query);
if ($stmt->execute([':id' => $book_id])) {
    echo 'success';
} else {
    echo 'error';
}
?>
