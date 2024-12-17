<?php
//страница home
?>
<div id="carousel" class="carousel slide mt-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="uploads/photo.jpg" class="d-block w-100" alt="A Court of Thorns and Roses">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Welcome to Velaris - the Bookstore of Starlight</h5>
                    <p>Discover a world of enchantment, romance, and danger. Your adventure awaits!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="uploads/acomaf2.png" class="d-block w-100" alt="A Court of Mist and Fury" style="object-fit: contain;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>A Court of Mist and Fury</h5>
                    <p>Lose yourself in a mesmerizing tale of love and danger, set in a magical realm of fae courts and dark secrets. Price: $14.99</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="uploads/acotar.png" class="d-block w-100" alt="A court of thorns and roses">
                <div class="carousel-caption d-none d-md-block">
                    <h5>A court of thorns and roses</h5>
                    <p>A deadly assassin's journey to reclaim her destiny, packed with action and intrigue. Price: $12.99</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="uploads/acofs.png" class="d-block w-100" alt="A court of frost and starlight">
                <div class="carousel-caption d-none d-md-block">
                    <h5>A court of frost and starlight</h5>
                    <p>An urban fantasy epic filled with heart-pounding adventure and unbreakable friendships. Price: $18.99</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section id="most-bought" class="container mt-5">
        <h2 class="text-center mb-4">Most Bought Books of 2024</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card book-card">
                    <img src="uploads/acowar.jpg" class="card-img-top p-5" alt="Book 1" style="height: 500px;">
                    <div class="card-body">
                        <h5 class="card-title">A court of wings and ruin</h5>
                        <p class="card-text">$15.99</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card book-card">
                    <img src="uploads/9781526635297.jpg" class="card-img-top p-5" alt="Book 2" style="height: 500px;">
                    <div class="card-body">
                        <h5 class="card-title">Throne of glass</h5>
                        <p class="card-text">$13.99</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card book-card">
                    <img src="uploads/love_on_the_brain_1666883522_0.jpg" class="card-img-top p-5" alt="Book 3" style="height: 500px;">
                    <div class="card-body">
                        <h5 class="card-title">Love on the brain</h5>
                        <p class="card-text">$17.99</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .carousel-item img {
            object-fit: cover;
            height: 400px;
        }
        .carousel-caption {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 1rem;
        }
        .book-card {
            transition: transform 0.3s;
        }
        .book-card:hover {
            transform: scale(1.05);
        }
        .most-bought {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
        }
        .navbar-brand {
            font-family: 'Georgia', serif;
            font-size: 1.8rem;
            font-weight: bold;
        }
    </style>