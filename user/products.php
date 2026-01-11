<?php
session_start();
include("../config/db.php");
include("../includes/header.php");

/* SECURITY */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../auth/login.php");
    exit();
}

/* =======================
   SEARCH & CATEGORY LOGIC
   ======================= */
$search   = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$query = "SELECT * FROM products WHERE 1";
$params = [];
$types  = "";

/* SEARCH */
if (!empty($search)) {
    $query .= " AND name LIKE ?";
    $params[] = "%$search%";
    $types .= "s";
}

/* CATEGORY */
if (!empty($category)) {
    $query .= " AND category = ?";
    $params[] = $category;
    $types .= "s";
}

$stmt = mysqli_prepare($conn, $query);
if (!empty($params)) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<div class="container mt-4">

    <h3 class="fw-bold mb-4">Our Products</h3>

    <!-- SEARCH BAR -->
    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-10">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search products..."
                   value="<?= htmlspecialchars($search) ?>">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">
                <i class="bi bi-search"></i> Search
            </button>
        </div>

        <!-- KEEP CATEGORY WHEN SEARCHING -->
        <?php if (!empty($category)) { ?>
            <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
        <?php } ?>
    </form>

    <!-- CATEGORY PILLS -->
    <ul class="nav nav-pills mb-4">
        <?php
        $categories = ["All", "Groceries", "Drinks", "Snacks", "Household", "Clothes", "Shoes"];
        foreach ($categories as $cat) {
            $isActive = ($cat === "All" && empty($category)) || ($category === $cat);
            $link = $cat === "All"
                ? "?search=" . urlencode($search)
                : "?category=" . urlencode($cat) . "&search=" . urlencode($search);
        ?>
            <li class="nav-item me-2">
                <a class="nav-link <?= $isActive ? 'active' : '' ?>" href="<?= $link ?>">
                    <?= $cat ?>
                </a>
            </li>
        <?php } ?>
    </ul>

    <!-- PRODUCTS GRID -->
    <div class="row g-4">

        <?php if (mysqli_num_rows($result) == 0) { ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No products found.
                </div>
            </div>
        <?php } ?>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm border-0">
                    <img src="../uploads/<?= htmlspecialchars($row['image']) ?>"
                         class="card-img-top p-3"
                         style="height:180px; object-fit:contain;">

                    <div class="card-body">
                        <span class="badge bg-secondary mb-2">
                            <?= htmlspecialchars($row['category']) ?>
                        </span>

                        <h6 class="fw-bold"><?= htmlspecialchars($row['name']) ?></h6>
                        <p class="fw-bold mb-2">RM <?= number_format($row['price'], 2) ?></p>

                        <a href="add_to_cart.php?id=<?= $row['product_id'] ?>"
                           class="btn btn-primary w-100">
                            Add to Cart
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>

<?php include("../includes/footer.php"); ?>
