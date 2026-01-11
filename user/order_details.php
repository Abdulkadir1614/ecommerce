<?php
session_start();
include("../config/db.php");
include("../includes/header.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$order_id = $_GET['id'];
$user_id  = $_SESSION['user_id'];

$stmt = mysqli_prepare(
    $conn,
    "SELECT oi.quantity, oi.price, p.name
     FROM order_items oi
     JOIN products p ON oi.product_id = p.product_id
     JOIN orders o ON oi.order_id = o.order_id
     WHERE oi.order_id = ? AND o.user_id = ?"
);
mysqli_stmt_bind_param($stmt, "ii", $order_id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<div class="container my-5">
    <h4 class="fw-bold mb-3">Order #<?= $order_id ?></h4>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price (RM)</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= $row['quantity'] ?></td>
                <td><?= number_format($row['price'],2) ?></td>
                <td><?= number_format($row['price'] * $row['quantity'],2) ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php include("../includes/footer.php"); ?>
