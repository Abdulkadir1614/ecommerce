<?php
session_start();

/* ADMIN PROTECTION */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

include("../config/db.php");
include("../admin/header.php");

/* DASHBOARD COUNTS */

// Products
$productResult = mysqli_query($conn, "SELECT * FROM products");
$productCount  = mysqli_num_rows($productResult);

// Orders
$orderCountResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders");
$orderCountRow = mysqli_fetch_assoc($orderCountResult);
$orderCount = $orderCountRow['total'];

// Users
$userCountResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
$userCountRow = mysqli_fetch_assoc($userCountResult);
$userCount = $userCountRow['total'];

// Total Revenue
$revenueResult = mysqli_query($conn, "SELECT SUM(total_price) AS revenue FROM orders");
$revenueRow = mysqli_fetch_assoc($revenueResult);
$totalRevenue = $revenueRow['revenue'] ?? 0;
?>

<div class="container mt-4">

    <h2 class="mb-2">Admin Dashboard</h2>
    <p class="text-muted mb-4">System Overview</p>

    <!-- SUMMARY CARDS -->
    <div class="row mb-4">

        <div class="col-md-3 mb-3">
            <div class="card text-center p-4">
                <h6 class="text-muted">Total Products</h6>
                <h2><?php echo $productCount; ?></h2>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-center p-4">
                <h6 class="text-muted">Total Orders</h6>
                <h2><?php echo $orderCount; ?></h2>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-center p-4">
                <h6 class="text-muted">Total Users</h6>
                <h2><?php echo $userCount; ?></h2>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-center p-4">
                <h6 class="text-muted">Total Revenue</h6>
                <h2>RM <?php echo number_format($totalRevenue, 2); ?></h2>
            </div>
        </div>

    </div>

    <!-- ADD PRODUCT BUTTON -->
    <div class="d-flex justify-content-end mb-3">
        <a href="add_product.php" class="btn btn-primary">
            + Add New Product
        </a>
    </div>

    <!-- PRODUCTS TABLE -->
    <div class="card p-3">
        <h5 class="mb-3">Products List</h5>

        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price (RM)</th>
                    <th>Stock</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
            <?php while ($row = mysqli_fetch_assoc($productResult)) { ?>
                <tr>
                    <td>
                        <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>"
                             width="55" class="rounded">
                    </td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['price']); ?></td>
                    <td><?php echo htmlspecialchars($row['stock']); ?></td>
                    <td class="text-center">
                        <a href="edit_product.php?id=<?php echo $row['product_id']; ?>"
                           class="btn btn-sm btn-warning me-1">
                           Edit
                        </a>
                        <a href="delete_product.php?id=<?php echo $row['product_id']; ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete this product?')">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

<?php include("../includes/footer.php"); ?>
