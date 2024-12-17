<?php
    // добавяне/редакция на продукт
    $product_id = intval($_GET['id'] ?? 0);

    if ($product_id > 0) {
        $query = "SELECT * FROM books WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':id' => $product_id]);
        $product = $stmt->fetch();
    }
?>

<form class="border border-info rounded p-4 w-50 mx-auto" method="POST" action="./handlers/handle_edit_product.php" enctype="multipart/form-data">
    <h3 class="text-center">Edit book</h3>
    <div class="mb-3">
        <label for="bookTitle" class="form-label">Book Title</label>
        <input type="text" class="form-control" id="bookTitle" placeholder="Enter book title" required name="title" value="<?php echo $product['title'] ?? '' ?>" autocomplete="off">
    </div>
    <div class="mb-3">
        <label for="bookAuthor" class="form-label">Author</label>
        <input type="text" class="form-control" id="bookAuthor" placeholder="Enter author name" required name="author" autocomplete="off" value="<?php echo $product['author'] ?? '' ?>">
    </div>
    <div class="mb-3">
        <label for="bookGenre" class="form-label">Genre</label>
        <select class="form-select" id="bookGenre" name="genre" required>
            <option value="" disabled>Select a genre</option>
            <option value="Fiction" <?php echo $product['genre'] === 'Fiction' ? 'selected' : ''; ?>>Fiction</option>
            <option value="Non-Fiction" <?php echo $product['genre'] === 'Non-Fiction' ? 'selected' : ''; ?>>Non-Fiction</option>
            <option value="Contemporary romance" <?php echo $product['genre'] === 'Contemporary romance' ? 'selected' : ''; ?>>Contemporary romance</option>
            <option value="Fantasy" <?php echo $product['genre'] === 'Fantasy' ? 'selected' : ''; ?>>Fantasy</option>
            <option value="Mystery" <?php echo $product['genre'] === 'Mystery' ? 'selected' : ''; ?>>Mystery</option>
            <option value="Romantasy" <?php echo $product['genre'] === 'Romantasy' ? 'selected' : ''; ?>>Romantasy</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" autocomplete="off" value="<?php echo $product['price'] ?? '' ?>">
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Book Cover:</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
    </div>
    <div class="mb-3">
        <img class="img-fluid" src="uploads/<?php echo $product['image'] ?>" alt="<?php echo $product['title'] ?>">
    </div>
    <input type="hidden" name="id" value="<?php echo $product['id'] ?>"> <!-- Ensure the product ID is passed -->
    <button type="submit" class="btn btn-outline-light mx-auto">Edit</button>
</form>

<style>
    .btn-outline-light {
        background-color: #4ca1af;
        color: #fff;
    }
</style>