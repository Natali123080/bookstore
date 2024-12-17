<?php
require_once('./db.php');

$query = "SELECT * FROM books ORDER BY id ASC";
$stmt = $pdo->query($query);
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <?php if (!checkAdmin()): ?>
        <div id="cart-icon-container" class="text-right mb-3">
            <button id="cart-icon" class="btn btn-warning position-relative">
                <i class="bi bi-cart"></i>
                <span id="cart-counter" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    0
                </span>
            </button>
        </div>
    <?php endif; ?>

    <h3 class="text-center mb-4">Book List</h3>
    <table class="table table-bordered table-striped">
        <thead class="table-info">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($books)) : ?>
                <tr>
                    <td colspan="7" class="text-center">No books found.</td>
                </tr>
            <?php else : ?>
                <?php foreach ($books as $book) : ?>
                    <tr id="book-<?php echo htmlspecialchars($book['id']); ?>">
                        <td><?php echo htmlspecialchars($book['id']); ?></td>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><?php echo htmlspecialchars($book['genre']); ?></td>
                        <td>$<?php echo number_format($book['price'], 2); ?></td>
                        <td>
                            <img src="./uploads/<?php echo htmlspecialchars($book['image']); ?>" alt="Book Cover" class="img-fluid" style="max-width: 100px;">
                        </td>
                        <?php if (checkAdmin()): ?>
                            <td>
                                <a href="?page=edit_product&id=<?php echo $book['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                <button class="btn btn-sm btn-danger" onclick="deleteBook(<?php echo $book['id']; ?>)">Delete</button>
                            </td>
                        <?php else: ?>
                            <td>
                                <button class="btn btn-sm btn-success add-to-cart" data-book-id="<?php echo $book['id']; ?>" data-book-title="<?php echo htmlspecialchars($book['title']); ?>">+</button>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<style>
    .table td img {
        display: block;
        margin: 0 auto;
    }

    #cart-icon {
        font-size: 1.5rem;
    }

    #cart-counter {
        font-size: 1rem;
        top: -10px;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        var cartCount = 0;

        function updateCartCounter() {
            $('#cart-counter').text(cartCount);
        }

        $('.add-to-cart').click(function() {
            var bookId = $(this).data('book-id');
            var bookTitle = $(this).data('book-title');

            cartCount++;

            updateCartCounter();
        });
    });
</script>

<script>
    function deleteBook(bookId) {
        if (confirm('Are you sure you want to delete this book?')) {
            $.ajax({
                url: './handlers/handle_delete_product.php',
                type: 'POST',
                data: { id: bookId },
                success: function(response) {
                    if (response == 'success') {
                        $('#book-' + bookId).remove();
                    } else {
                        alert('Error deleting the book. Response: ' + response);
                    }
                }
            });
        }
    }
</script>
