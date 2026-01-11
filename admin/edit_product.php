<?php
session_start();

/* =======================
   ADMIN ACCESS PROTECTION
   ======================= */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

include("../config/db.php");
include("../admin/header.php");

/* =======================
   FETCH PRODUCT
   ======================= */
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM products WHERE product_id = ?"
);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$product = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$product) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

/* =======================
   HANDLE UPDATE
   ======================= */
if (isset($_POST['update'])) {

    $name     = trim($_POST['name'] ?? '');
    $price    = trim($_POST['price'] ?? '');
    $stock    = trim($_POST['stock'] ?? '');
    $desc     = trim($_POST['description'] ?? '');
    $category = trim($_POST['category'] ?? '');

    if ($name === "" || $price === "" || $stock === "" || $desc === "" || $category === "") {
        $error = "All fields are required.";
    } else {

        $stmt = mysqli_prepare(
            $conn,
            "UPDATE products
             SET name = ?, price = ?, category = ?, description = ?, stock = ?
             WHERE product_id = ?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "sdssii",
            $name,
            $price,
            $category,
            $desc,
            $stock,
            $id
        );

        mysqli_stmt_execute($stmt);

        header("Location: dashboard.php");
        exit();
    }
}
?>

<!-- =======================
     PAGE CONTENT
     ======================= -->
<div class="container mt-5" style="max-width:750px;">

    <h2 class="mb-4">Edit Product</h2>

    <?php if ($error) { ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php } ?>

    <form method="POST">

        <!-- PRODUCT NAME -->
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   value="<?= htmlspecialchars($product['name']) ?>"
                   required>
        </div>

        <!-- PRICE -->
        <div class="mb-3">
            <label class="form-label">Price (RM)</label>
            <input type="number"
                   step="0.01"
                   name="price"
                   class="form-control"
                   value="<?= htmlspecialchars($product['price']) ?>"
                   required>
        </div>

        <!-- CATEGORY -->
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-select" required>
                <?php
                $categories = ['Groceries', 'Drinks', 'Snacks', 'Household', 'Clothes', 'Shoes'];
                foreach ($categories as $cat) {
                    $selected = ($product['category'] === $cat) ? 'selected' : '';
                    echo "<option value=\"$cat\" $selected>$cat</option>";
                }
                ?>
            </select>
        </div>

        <!-- DESCRIPTION -->
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description"
                      class="form-control"
                      rows="4"
                      required><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <!-- STOCK -->
        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number"
                   name="stock"
                   class="form-control"
                   value="<?= htmlspecialchars($product['stock']) ?>"
                   required>
        </div>

        <!-- ACTIONS -->
        <button type="submit" name="update" class="btn btn-primary">
            Update Product
        </button>

        <a href="dashboard.php" class="btn btn-secondary ms-2">
            Cancel
        </a>

    </form>
</div>

<?php include("../includes/footer.php"); ?>
