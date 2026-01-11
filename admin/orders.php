<?php
session_start();
include("../config/db.php");
include("../admin/header.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$query = "
    SELECT o.order_id, o.total_price, o.payment_method, o.order_date,
           u.name AS customer
    FROM orders o
    JOIN users u ON o.user_id = u.user_id
    ORDER BY o.order_date DESC
";
$result = mysqli_query($conn, $query);
?>

<div class="container my-5">
    <h3 class="fw-bold mb-4"><i class="bi bi-bag-check"></i> Orders</h3>

    <div class="card shadow-sm">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Total (RM)</th>
                    <th>Payment</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td>#<?= $row['order_id'] ?></td>
                    <td><?= htmlspecialchars($row['customer']) ?></td>
                    <td><?= number_format($row['total_price'], 2) ?></td>
                    <td>
                        <span class="badge bg-info">
                            <?= htmlspecialchars($row['payment_method']) ?>
                        </span>
                    </td>
                    <td><?= date("d M Y, h:i A", strtotime($row['order_date'])) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
