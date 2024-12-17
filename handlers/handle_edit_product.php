<?php

require_once('../functions.php');
require_once('../db.php');

// Fetch the product details before handling the form
$product_id = $_POST['id'] ?? null;
if ($product_id) {
    $query = "SELECT * FROM books WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':id' => $product_id]);
    $product = $stmt->fetch(); // Fetch the product data from the database
}

// Process form data
$id = $_POST['id'] ?? null;
$title = trim($_POST['title'] ?? '');
$price = trim($_POST['price'] ?? '');
$genre = trim($_POST['genre'] ?? '');
$author = trim($_POST['author'] ?? '');
$image = $_FILES['image'] ?? null;

// Validate form data
if (!$id || mb_strlen($title) == 0 || !is_numeric($price) || mb_strlen($genre) == 0 || mb_strlen($author) == 0) {
    $_SESSION['flash']['message']['type'] = 'danger';
    $_SESSION['flash']['message']['text'] = 'All fields are required and price must be numeric.';
    header('Location: ../edit_book.php?id=' . $id);
    exit;
}

// Handle the image upload logic
$new_filename = $product['image'] ?? ''; // Retain the existing image filename by default

if ($image && $image['error'] === 0) {
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $upload_dir = '../uploads/';
    $file_extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    $new_filename = time() . '_' . basename($image['name']); // Generate a new filename for the uploaded image

    if (!in_array($file_extension, $allowed_extensions)) {
        $_SESSION['flash']['message']['type'] = 'danger';
        $_SESSION['flash']['message']['text'] = 'Invalid image type. Allowed types: ' . implode(', ', $allowed_extensions);
        header('Location: ../edit_book.php?id=' . $id);
        exit;
    }

    // Ensure the upload directory exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0775, true);
    }

    // Move the uploaded file to the uploads directory
    if (!move_uploaded_file($image['tmp_name'], $upload_dir . $new_filename)) {
        $_SESSION['flash']['message']['type'] = 'danger';
        $_SESSION['flash']['message']['text'] = 'Error uploading the image.';
        header('Location: ../edit_book.php?id=' . $id);
        exit;
    }

    // Delete the old image if a new one is uploaded
    if ($product['image'] && file_exists($upload_dir . $product['image'])) {
        unlink($upload_dir . $product['image']);
    }
}

// Prepare and execute the update query
$query = "UPDATE books SET title = :title, price = :price, genre = :genre, author = :author, image = :image WHERE id = :id";
$stmt = $pdo->prepare($query);
$params = [
    ':title' => $title,
    ':author' => $author,
    ':price' => $price,
    ':genre' => $genre,
    ':image' => $new_filename, // Use the existing or new image filename
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
