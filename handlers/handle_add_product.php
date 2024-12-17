<?php

require_once('../functions.php');
require_once('../db.php');

$title = trim($_POST['title'] ?? '');
$author = trim($_POST['author'] ?? '');
$genre = trim($_POST['genre'] ?? '');
$price = trim($_POST['price'] ?? '');

if (mb_strlen($title) == 0 || mb_strlen($author) == 0 || mb_strlen($genre) == 0 || mb_strlen($price) == 0) {
    $_SESSION['flash']['message']['type'] = 'danger';
    $_SESSION['flash']['message']['text'] = 'Please fill in all required fields!';

    header('Location: ../index.php?page=add_product');
    exit;
}

if (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {
    var_dump($_FILES); exit;
    $_SESSION['flash']['message']['type'] = 'danger';
    $_SESSION['flash']['message']['text'] = 'Please select a valid image!';

    header('Location: ../index.php?page=add_product');
    exit;
}

$new_filename = time() . '_' . $_FILES['image']['name'];
$upload_dir = '../uploads/';

if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0775, true);
}

if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $new_filename)) {
    $_SESSION['flash']['message']['type'] = 'danger';
    $_SESSION['flash']['message']['text'] = 'Error uploading the file!';

    header('Location: ../index.php?page=add_product');
    exit;
}

$query = "INSERT INTO books (title, author, genre, price, image) VALUES (:title, :author, :genre, :price, :image)";
$stmt = $pdo->prepare($query);
$params = [
    ':title' => $title,
    ':author' => $author,
    ':genre' => $genre,
    ':price' => $price,
    ':image' => $new_filename
];

if ($stmt->execute($params)) {
    $_SESSION['flash']['message']['type'] = 'success';
    $_SESSION['flash']['message']['text'] = 'The book has been successfully added!';

    header('Location: ../index.php?page=add_product');
    exit;
} else {
    $_SESSION['flash']['message']['type'] = 'danger';
    $_SESSION['flash']['message']['text'] = 'Error adding the book!';

    header('Location: ../index.php?page=add_product');
    exit;
}