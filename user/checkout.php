<?php
session_start();
include("../includes/header.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../auth/login.php");
    exit();
}

/* =========================
   MUST COME FROM CONFIRM ORDER
   ========================= */
if (!isset($_SESSION['order_success'])) {
    header("Location: products.php");
    exit();
}

/* Remove flag after display */
unset($_SESSION['order_success']);
?>

<div class="container mt-5" style="max-width:600px;">
    <div class="card shadow-lg p-4 text-center">

        <h2 class="text-success mb-3">✅ Order Successful</h2>

        <p>Thank you for shopping with <strong>SmartMart</strong>.</p>

        <p>Your order has been placed successfully.</p>

        <div class="d-grid gap-2 mt-4">
            <a href="products.php" class="btn btn-primary">
                Continue Shopping
            </a>
            <a href="../auth/logout.php" class="btn btn-outline-secondary">
                Logout
            </a>
        </div>

    </div>
</div>

<?php include("../includes/footer.php"); ?>
