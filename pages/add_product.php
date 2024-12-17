<?php
?>

<form class="border border-info rounded p-4 w-50 mx-auto" method="POST" action="./handlers/handle_add_product.php" enctype="multipart/form-data">
    <h3 class="text-center">Add a new book</h3>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="bookTitle" class="form-label" >Book Title</label>
            <input type="text" class="form-control" id="bookTitle" placeholder="Enter book title" required name="title" autocomplete="off">
        </div>

        <div class="col-md-6 mb-3">
            <label for="bookAuthor" class="form-label" >Author</label>
            <input type="text" class="form-control" id="bookAuthor" placeholder="Enter author name" required name="author" autocomplete="off">
        </div>
    </div>

    <div class="mb-3">
        <label for="bookGenre" class="form-label" >Genre</label>
        <select class="form-select" id="bookGenre" required name="genre">
            <option value="" selected disabled>Select a genre</option>
            <option value="Fiction">Fiction</option>
            <option value="Non-Fiction">Non-Fiction</option>
            <option value="Contemporary romance">Contemporary romance</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Mystery">Mystery</option>
            <option value="Romantasy">Romantasy</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label" >Price</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" autocomplete="off">
    </div>

    <div class="mb-3">
        <label for="bookImage" class="form-label">Book Cover Image</label>
        <input type="file" class="form-control" id="bookImage" accept="image/*" name="image" required>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-outline-light">
            Add Book
        </button>
    </div>
</form>

<style>
    .btn-outline-light {
        background-color: #4ca1af;
        color: #fff;
    }
</style>