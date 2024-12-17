<?php
// boilerplate index
require_once('./functions.php');
require_once('./db.php');

$page = $_GET['page'] ?? 'home';

$flash = [];
if (isset($_SESSION['flash'])) {
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velaris - the City of Starlight</title>
    <!-- Bootstrap 5.3 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
    <script>
        $(function() {
            // добавяне в любими
            $(document).on('click', '.add-favorite', function() {
                let btn = $(this);
                let productId = btn.data('product');

                $.ajax({
                    url: './ajax/add_favorite.php',
                    method: 'POST',
                    data: {
                        product_id: productId
                    },
                    success: function(response) {
                        let res = JSON.parse(response);
                        console.log(res);

                        if (res.success) {
                            alert('Продуктът беше добавен в любими');
                            let removeBtn = $(`<button class="btn btn-danger btn-sm remove-favorite" data-product="${productId}">Премахни от любими</button>`);
                            btn.replaceWith(removeBtn);
                        } else {
                            alert('Възникна грешка: ' + res.error);
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });

            // премахване от любими
            $(document).on('click', '.remove-favorite', function() {
                let btn = $(this);
                let productId = btn.data('product');

                $.ajax({
                    url: './ajax/remove_favorite.php',
                    method: 'POST',
                    data: {
                        product_id: productId
                    },
                    success: function(response) {
                        let res = JSON.parse(response);

                        if (res.success) {
                            alert('Продуктът беше премахнат от любими');
                            let addBtn = $(`<button class="btn btn-primary btn-sm add-favorite" data-product="${productId}">Добави в любими</button>`);
                            btn.replaceWith(addBtn);
                        } else {
                            alert('Възникна грешка: ' + res.error);
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
  <header>
        <nav class="navbar navbar-expand-lg navbar-dark py-3" style="background: linear-gradient(to right, #2c3e50,rgb(47, 100, 108)); box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold text-uppercase" href="?page=home" style="color: #f8f9fa; font-family: 'Cinzel', serif;">
                <i class="bi bi-stars" style="color:rgb(238, 246, 154);"></i> Velaris <i class="bi bi-stars" style="color:rgb(238, 246, 154);"></i>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link <?php echo ($page == 'home' ? 'active' : ''); ?>" href="?page=home">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link <?php echo ($page == 'products' ? 'active' : ''); ?>" href="?page=products">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'contacts' ? 'active' : ''); ?>" href="?page=contacts">Contacts</a>
                    </li>
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item <?php echo ($page == 'add_product' ? 'active' : ''); ?>" href="?page=add_product">Add book</a></li>
                        <li><a class="dropdown-item <?php echo ($page == 'products' ? 'active' : ''); ?>" href="?page=products">List books</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else</a></li>
                    </ul>
                    </li>
                    <?php endif; ?>
                </ul>
                <div class="d-flex flex-row gap-3">
                    <?php
                    if (isset($_SESSION['user_name'])) {
                        echo '<span class="text-white mt-2">Welcome, ' . htmlspecialchars($_SESSION['user_name']) . '</span>';
                        echo '
                        <form method="POST" action="./handlers/handle_logout.php" class="m-0">
                            <button type="submit" class="btn btn-outline-light">Logout</button>
                        </form>
                        ';
                    } else {
                        echo '<a href="?page=login" class="btn btn-outline-light">Login</a>';
                        echo '<a href="?page=register" class="btn btn-outline-light">Register</a>';
                    }
                    ?>
                </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="container py-4" style="min-height:80vh;">
        <?php
            if (isset($flash['message'])) {
                echo '
                    <div class="alert alert-' . $flash['message']['type'] . '" role="alert">
                        ' . $flash['message']['text'] . '
                    </div>
                ';
            }

            if (file_exists('pages/' . $page . '.php')) {
                require_once('pages/' . $page . '.php');
            } else {
                require_once('pages/not_found.php');
            }
        ?>
    </main>

    <footer class="py-4" style="background: linear-gradient(to right, #2c3e50, rgb(47, 100, 108)); box-shadow: 0 -4px 6px rgba(0,0,0,0.1);">
        <div class="container">
            <div class="row">
            <div class="col-md-4 text-center text-md-start">
                <h5 class="fw-bold text-light text-uppercase" style="font-family: 'Cinzel', serif;"><i class="bi bi-stars" style="color:rgb(238, 246, 154);"></i>Velaris<i class="bi bi-stars" style="color:rgb(238, 246, 154);"></i></h5>
                <p class="small text-light">The City of Starlight, where dreams are born and wishes come true.</p>
            </div>
            <div class="col-md-4 text-center my-3 my-md-0">
                <ul class="list-unstyled">
                <li><a href="?page=home" class="text-light text-decoration-none">Home</a></li>
                <li><a href="?page=products" class="text-light text-decoration-none">Products</a></li>
                <li><a href="?page=contacts" class="text-light text-decoration-none">Contacts</a></li>
                </ul>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <p class="small text-light mb-0">&copy; 2024 Velaris. All Rights Reserved.</p>
                <p class="small text-light">Follow us:
                <a href="#" class="text-light text-decoration-none me-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-light text-decoration-none me-2"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-light text-decoration-none"><i class="bi bi-instagram"></i></a>
                </p>
            </div>
            </div>
        </div>
    </footer>
</body>
</html>

<style>
body {
    background-color: #ffffff;
    color: #1b263b;
    font-family: 'Lato', sans-serif;
}

.navbar-brand {
    font-size: 1.5rem;
}

.nav-link {
    color: #dfe4ea !important;
    transition: color 0.3s ease;
}

.nav-link:hover, .nav-link.active {
    color: #4ca1af !important;
}

.btn-outline-light {
    border-color: #4ca1af;
    color: #f8f9fa;
}

.btn-outline-light:hover {
    background-color: #4ca1af;
    color: #fff;
}

.dropdown-menu {
    background-color: #2c3e50;
    border: none;
}

.dropdown-item {
    color: #dfe4ea;
}

.dropdown-item:hover {
    background-color: #4ca1af;
    color: #fff;
}

footer a {
    color: #dfe4ea;
    transition: color 0.3s ease;
}

footer a:hover {
    color: #4ca1af !important;
}

footer h5 {
    font-size: 1.5rem;
}
</style>