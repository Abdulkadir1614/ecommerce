<?php
session_start();
include("../config/db.php");
include("../includes/header.php");


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../auth/login.php");
    exit();
}
/* =========================
   FETCH CART ITEMS
   ========================= */ 
$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<div class="container mt-4">

    <h2 class="mb-4">Your Cart</h2>

    <?php if (empty($cart)) { ?>

        <div class="alert alert-info">
            Your cart is empty.
        </div>

        <a href="products.php" class="btn btn-primary">
            Continue Shopping
        </a>

    <?php } else { ?>

        <div class="card shadow-sm p-3">

            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Price (RM)</th>
                        <th>Qty</th>
                        <th>Subtotal (RM)</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                foreach ($cart as $productId => $qty) {

                    $stmt = mysqli_prepare(
                        $conn,
                        "SELECT * FROM products WHERE product_id = ?"
                    );
                    mysqli_stmt_bind_param($stmt, "i", $productId);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_assoc($result);

                    if (!$row) continue;

                    $subtotal = $row['price'] * $qty;
                    $total += $subtotal;
                ?>
                    <tr>
                        <td>
                            <img src="../uploads/<?php echo $row['image']; ?>"
                            width="60"
                            class="img-fluid rounded">
                        </td>

                        <td><?= htmlspecialchars($row['name']); ?></td>

                        <td><?= number_format($row['price'], 2); ?></td>

                        <td><?= $qty; ?></td>

                        <td><?= number_format($subtotal, 2); ?></td>

                        <td>
                            <a href="remove_from_cart.php?id=<?= $productId; ?>"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Remove this item from cart?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <a href="clear_cart.php"
                class="btn btn-outline-secondary"
                onclick="return confirm('Clear entire cart?')">
                <i class="bi bi-x-circle"></i> Clear Cart
            </a>

        </div>

        <!-- RIGHT-ALIGNED TOTAL & CHECKOUT -->
        <div class="d-flex justify-content-end mt-4">

            <div class="text-end">

                <h4 class="mb-3">
                    Total: RM <?php echo number_format($total, 2); ?>
                </h4>

                <a href="delivery.php" class="btn btn-success btn-lg">
                    Proceed to Checkout
                </a>

            </div>

        </div>

    <?php } ?>

</div>

<?php include("../includes/footer.php"); ?>
