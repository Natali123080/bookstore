<?php

require_once('../functions.php');
require_once('../db.php');

$id = $_POST['id'] ?? null;
$title = trim($_POST['title'] ?? '');
$price = trim($_POST['price'] ?? '');
$genre = trim($_POST['genre'] ?? '');
$author = trim($_POST['author'] ?? '');
$image = $_FILES['image'] ?? null;

if (!$id || mb_strlen($title) == 0 || !is_numeric($price) || mb_strlen($genre) == 0 || mb_strlen($author) == 0) {
    $_SESSION['flash']['message']['type'] = 'danger';
    $_SESSION['flash']['message']['text'] = 'All fields are required and price must be numeric.';
    header('Location: ../edit_book.php?id=' . $id);
    exit;
}

$new_filename = '';
if ($image && $image['error'] === 0) {
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $upload_dir = '../uploads/';
    $file_extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    $new_filename = time() . '_' . basename($image['name']);

    if (!in_array($file_extension, $allowed_extensions)) {
        $_SESSION['flash']['message']['type'] = 'danger';
        $_SESSION['flash']['message']['text'] = 'Invalid image type. Allowed types: ' . implode(', ', $allowed_extensions);
        header('Location: ../edit_book.php?id=' . $id);
        exit;
    }

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0775, true);
    }

    if (!move_uploaded_file($image['tmp_name'], $upload_dir . $new_filename)) {
        $_SESSION['flash']['message']['type'] = 'danger';
        $_SESSION['flash']['message']['text'] = 'Error uploading the image.';
        header('Location: ../edit_book.php?id=' . $id);
        exit;
    }

    if ($product['image'] && file_exists($upload_dir . $product['image'])) {
        unlink($upload_dir . $product['image']);
    }
}

$query = "UPDATE books SET title = :title, price = :price, genre = :genre, author = :author, image = :image WHERE id = :id";
$stmt = $pdo->prepare($query);
$params = [
    ':title' => $title,
    ':author' => $author,
    ':price' => $price,
    ':genre' => $genre,
    ':image' => $new_filename,
    ':id' => $id
];

if ($stmt->execute($params)) {
    $_SESSION['flash']['message']['type'] = 'success';
    $_SESSION['flash']['message']['text'] = 'Book updated successfully.';
    header('Location: ../index.php?page=edit_product&id=' . $id);
    exit;
} else {
    $_SESSION['flash']['message']['type'] = 'danger';
    $_SESSION['flash']['message']['text'] = 'Error updating the book.';
    header('Location: ../index.php?page=edit_product&id=' . $id);
    exit;
}
