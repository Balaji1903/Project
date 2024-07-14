<?php
include 'config.php';

// Fetch up to 6 products from the database
$product = $conn->query("SELECT * FROM product ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .card-img-top {
            max-height: 200px;
            object-fit: cover;
        }
        .sidebar {
            height: 100vh;
            padding-top: 20px;
            border-right: 1px solid #ddd;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">E-Commerce</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Add to Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Wishlist</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 d-none d-md-block sidebar bg-light">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <h4 class="nav-link">Categories</h4>
                        </li>
                        <li class="nav-item mt-4">
                            <h4 class="nav-link">Filters</h4>
                            <a class="nav-link" href="#">Filter by Price</a>
                            <a class="nav-link" href="#">Filter by Rating</a>
                            <a class="nav-link" href="#">Sort by</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Products -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <h1 class="h2">Our Products</h1>
                <div class="row">
                    <?php while($row = $product->fetch_assoc()): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="uploads/<?= $row['image'] ?>" class="card-img-top" alt="<?= $row['name'] ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['name'] ?></h5>
                                    <p class="card-text"><?= $row['description'] ?></p>
                                    <p class="card-text"><strong>Price:</strong> $<?= $row['price'] ?></p>
                                    <a href="add_to_cart.php" class="btn btn-primary">Add to Cart</a>
                                    <a href="order.php?id=<?= $row['id'] ?>" class="btn btn-primary">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; 2024 Your Company. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
