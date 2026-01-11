<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    $cartCount = array_sum($_SESSION['cart']);
} else {
    $cartCount = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SmartMart</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container">

        <!-- BRAND -->
        <a class="navbar-brand fw-bold d-flex align-items-center"
           href="<?= isset($_SESSION['user_id']) ? '../user/products.php' : '../index.php' ?>">
            <i class="bi bi-shop fs-4 me-2"></i> SmartMart
        </a>

        <!-- TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- NAV -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-lg-3">

                <?php if (!isset($_SESSION['user_id'])) { ?>
                    <!-- ================= GUEST ================= -->

                    <li class="nav-item">
                        <a class="nav-link" href="../auth/login.php">
                            <i class="bi bi-bag"></i> Shop
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../auth/login.php">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../auth/register.php">
                            <i class="bi bi-person-plus"></i> Register
                        </a>
                    </li>

                <?php } elseif ($_SESSION['role'] === 'user') { ?>
                    <!-- ================= CUSTOMER ================= -->

                    <li class="nav-item">
                        <a class="nav-link" href="../user/products.php">
                            <i class="bi bi-bag"></i> Shop
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../user/feedback.php">
                            <i class="bi bi-chat-dots"></i> Feedback
                        </a>
                    </li>

                    <li class="nav-item position-relative">
                        <a class="nav-link" href="../user/cart.php">
                            <i class="bi bi-cart3 fs-5"></i>
                            <?php if ($cartCount > 0) { ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?= $cartCount ?>
                                </span>
                            <?php } ?>
                        </a>
                    </li>

                    <!-- PROFILE DROPDOWN -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center"
                           href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-5 me-1"></i>
                            <?= htmlspecialchars($_SESSION['name']) ?>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li>
                                <a class="dropdown-item" href="../user/update_profile.php">
                                    <i class="bi bi-person-gear me-2"></i> Update Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../user/order_history.php">
                                    <i class="bi bi-clock-history me-2"></i> Orders
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="../auth/logout.php">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php } elseif ($_SESSION['role'] === 'admin') { ?>
                    <!-- ================= ADMIN ================= -->

                    <li class="nav-item">
                        <a class="nav-link" href="../admin/dashboard.php">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-badge"></i> Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li>
                                <a class="dropdown-item text-danger" href="../auth/logout.php">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php } ?>

            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
