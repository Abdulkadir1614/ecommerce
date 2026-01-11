<?php
session_start();
include("../config/db.php");
include("../admin/header.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$totalOrders = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT COUNT(*) total FROM orders"))['total'];

$totalRevenue = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT SUM(total_price) revenue FROM orders"))['revenue'];

$totalUsers = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT COUNT(*) total FROM users WHERE role='user'"))['total'];

$avgOrder = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
?>

<div class="container my-5">
    <h3 class="fw-bold mb-4"><i class="bi bi-bar-chart"></i> Reports</h3>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm p-3">
                <h6>Total Orders</h6>
                <h3><?= $totalOrders ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm p-3">
                <h6>Total Revenue</h6>
                <h3>RM <?= number_format($totalRevenue,2) ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm p-3">
                <h6>Total Customers</h6>
                <h3><?= $totalUsers ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm p-3">
                <h6>Avg Order Value</h6>
                <h3>RM <?= number_format($avgOrder,2) ?></h3>
            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
