<footer class="bg-dark text-light mt-5">
    <div class="container py-4">
        <div class="row">

            <!-- BRAND -->
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold">
                    <i class="bi bi-shop me-2"></i> SmartMart
                </h5>
                <p class="small text-muted">
                    Your trusted online shopping platform for quality products and fast delivery.
                </p>
            </div>

            <!-- QUICK LINKS -->
            <div class="col-md-4 mb-3">
                <h6 class="fw-semibold">Quick Links</h6>
                <ul class="list-unstyled small">
                    <li><a href="../user/products.php" class="text-decoration-none text-light">Shop</a></li>

                    <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'user') { ?>
                        <li><a href="../user/cart.php" class="text-decoration-none text-light">Cart</a></li>
                        <li><a href="../user/feedback.php" class="text-decoration-none text-light">Feedback</a></li>
                    <?php } ?>

                    <li><a href="../auth/login.php" class="text-decoration-none text-light">Login</a></li>
                </ul>
            </div>

            <!-- CONTACT / SOCIAL -->
            <div class="col-md-4 mb-3">
                <h6 class="fw-semibold">Connect With Us</h6>
                <div class="d-flex gap-3 fs-5">
                    <a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-envelope"></i></a>
                </div>
            </div>

        </div>

        <hr class="border-secondary">

        <!-- COPYRIGHT -->
        <div class="text-center small text-muted">
            &copy; <?= date("Y"); ?> SmartMart E-Commerce System. All Rights Reserved.
        </div>
    </div>
</footer>
