<?php
session_start();
include("./includes/header_guest.php");
?>

<!-- HERO SECTION -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="fw-bold display-5">Welcome to SmartMart</h1>
        <p class="lead text-muted mt-3">
            Your one-stop shop for groceries, drinks, snacks & more
        </p>

        <div class="mt-4">
            <a href="<?= isset($_SESSION['user_id']) 
                ? 'user/products.php' 
                : 'auth/login.php' ?>" 
                class="btn btn-primary btn-lg me-2">
                Shop Now
            </a>


            <?php if (!isset($_SESSION['user_id'])) { ?>
                <a href="auth/register.php" class="btn btn-outline-secondary btn-lg">
                    Create Account
                </a>
            <?php } ?>
        </div>
    </div>
</section>

<!-- CATEGORIES -->
<section class="container my-5">
    <h3 class="fw-bold text-center mb-4">Shop by Category</h3>

    <div class="row g-4 text-center">
        <?php
        $categories = [
            "Groceries" => "bi-basket",
            "Drinks" => "bi-cup-straw",
            "Snacks" => "bi-emoji-smile",
            "Household" => "bi-house"
        ];

        foreach ($categories as $name => $icon) {
        ?>
        <div class="col-md-3">
            <a href="user/products.php?category=<?= $name ?>"
               class="category-card text-decoration-none">
                <i class="bi <?= $icon ?> fs-1"></i>
                <h6 class="mt-2"><?= $name ?></h6>
            </a>
        </div>
        <?php } ?>
    </div>
</section>

<!-- FEATURED PRODUCTS -->
<section class="bg-light py-5">
    <div class="container">
        <h3 class="fw-bold text-center mb-4">Popular Products</h3>

        <div class="row g-4">
        <?php
        include("config/db.php");
        $result = mysqli_query(
            $conn,
            "SELECT * FROM products ORDER BY product_id DESC LIMIT 4"
        );

        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <img src="uploads/<?= $row['image'] ?>"
                         class="card-img-top"
                         style="height:180px;object-fit:contain;">
                    <div class="card-body text-center">
                        <h6><?= htmlspecialchars($row['name']) ?></h6>
                        <p class="fw-bold mb-2">RM <?= number_format($row['price'],2) ?></p>
                        <a href="user/products.php"
                           class="btn btn-sm btn-primary w-100">
                           View Product
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</section>

<!-- WHY SMARTMART -->
<section class="container my-5">
    <div class="row text-center">
        <div class="col-md-4">
            <i class="bi bi-truck fs-1 text-primary"></i>
            <h5 class="mt-2">Fast Delivery</h5>
            <p class="text-muted">Quick and reliable delivery to your doorstep.</p>
        </div>
        <div class="col-md-4">
            <i class="bi bi-shield-check fs-1 text-primary"></i>
            <h5 class="mt-2">Secure Payments</h5>
            <p class="text-muted">Your payment information is always safe.</p>
        </div>
        <div class="col-md-4">
            <i class="bi bi-emoji-smile fs-1 text-primary"></i>
            <h5 class="mt-2">Trusted Quality</h5>
            <p class="text-muted">Only quality products from trusted brands.</p>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section text-center">
    <div class="container">
        <h4 class="fw-bold">Start Shopping with Confidence</h4>
        <a href="user/products.php" class="btn btn-light btn-lg mt-3">
            Browse Products
        </a>
    </div>
</section>

<?php include("includes/footer_guest.php"); ?>
