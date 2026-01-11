<?php
session_start();
include("../config/db.php");
include("../includes/header.php");

/* SECURITY */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = mysqli_prepare(
    $conn,
    "SELECT order_id, total_price, payment_method, order_date
     FROM orders
     WHERE user_id = ?
     ORDER BY order_date DESC"
);


if (!$stmt) {
    die("Prepare failed: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>

<div class="container my-5">

    <h3 class="fw-bold mb-4">
        <i class="bi bi-clock-history me-1"></i> My Orders
    </h3>

    <?php if (mysqli_num_rows($result) == 0) { ?>

        <div class="alert alert-info">
            You have not placed any orders yet.
        </div>

    <?php } else { ?>

        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Total (RM)</th>
                            <th>Payment Method</th>
                            <th>Order Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) == 0) { ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No orders found.
                            </td>
                        </tr>
                        <?php } else { ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td>#<?= $row['order_id']; ?></td>
                            <td><?= number_format($row['total_price'], 2); ?></td>
                            <td>
                                <span class="badge bg-info">
                                    <?= htmlspecialchars($row['payment_method']); ?>
                                </span>
                            </td>
                            <td><?= date("d M Y, h:i A", strtotime($row['order_date'])); ?></td>
                            <td>
                                <a href="order_details.php?id=<?= $row['order_id']; ?>"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> View
                                </a>
                            </td>
                        </tr>

                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>

    <?php } ?>

</div>

<?php include("../includes/footer.php"); ?>
