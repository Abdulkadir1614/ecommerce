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
   INITIALIZE VARIABLES
   ======================= */
$name = $price = $stock = $desc = $category = "";
$error = "";

/* =======================
   HANDLE FORM SUBMISSION
   ======================= */
if (isset($_POST['add'])) {

    $name     = trim($_POST['name'] ?? '');
    $price    = trim($_POST['price'] ?? '');
    $stock    = trim($_POST['stock'] ?? '');
    $desc     = trim($_POST['description'] ?? '');
    $category = trim($_POST['category'] ?? '');

    /* VALIDATION */
    if ($name === "" || $price === "" || $stock === "" || $desc === "" || $category === "") {
        $error = "All fields are required.";
    } elseif (!isset($_FILES['image']) || $_FILES['image']['error'] !== 0) {
        $error = "Please upload a product image.";
    } else {

        $imgTmp  = $_FILES['image']['tmp_name'];
        $imgSize = $_FILES['image']['size'];
        $imgName = $_FILES['image']['name'];

        /* IMAGE VALIDATION */
        $mime = mime_content_type($imgTmp);
        if (strpos($mime, "image/") !== 0) {
            $error = "Only image files are allowed.";
        } elseif ($imgSize > 5 * 1024 * 1024) {
            $error = "Image size must be less than 5MB.";
        } else {

            /* SAFE IMAGE NAME */
            $ext = pathinfo($imgName, PATHINFO_EXTENSION);
            $newName = time() . "_" . uniqid() . "." . $ext;
            move_uploaded_file($imgTmp, "../uploads/" . $newName);

            /* INSERT PRODUCT */
            $stmt = mysqli_prepare(
                $conn,
                "INSERT INTO products (name, price, category, description, stock, image)
                 VALUES (?, ?, ?, ?, ?, ?)"
            );

            mysqli_stmt_bind_param(
                $stmt,
                "sdssis",
                $name,
                $price,
                $category,
                $desc,
                $stock,
                $newName
            );

            mysqli_stmt_execute($stmt);

            header("Location: dashboard.php");
            exit();
        }
    }
}
?>

<!-- =======================
     PAGE CONTENT
     ======================= -->
<div class="container mt-5" style="max-width: 750px;">

    <h2 class="mb-4">Add New Product</h2>

    <?php if ($error) { ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php } ?>

    <form method="POST" enctype="multipart/form-data">

        <!-- PRODUCT NAME -->
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   value="<?= htmlspecialchars($name) ?>"
                   required>
        </div>

        <!-- PRICE -->
        <div class="mb-3">
            <label class="form-label">Price (RM)</label>
            <input type="number"
                   step="0.01"
                   name="price"
                   class="form-control"
                   value="<?= htmlspecialchars($price) ?>"
                   required>
        </div>

        <!-- CATEGORY -->
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-select" required>
                <option value="">-- Select Category --</option>
                <option value="Groceries" <?= $category=="Groceries"?"selected":"" ?>>Groceries</option>
                <option value="Drinks" <?= $category=="Drinks"?"selected":"" ?>>Drinks</option>
                <option value="Snacks" <?= $category=="Snacks"?"selected":"" ?>>Snacks</option>
                <option value="Household" <?= $category=="Household"?"selected":"" ?>>Household</option>
                <option value="Clothes" <?= $category=="Clothes"?"selected":"" ?>>Clothes</option>
                <option value="Shoes" <?= $category=="Shoes"?"selected":"" ?>>Shoes</option>
            </select>
        </div>

        <!-- DESCRIPTION -->
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description"
                      class="form-control"
                      rows="4"
                      required><?= htmlspecialchars($desc) ?></textarea>
        </div>

        <!-- STOCK -->
        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number"
                   name="stock"
                   class="form-control"
                   value="<?= htmlspecialchars($stock) ?>"
                   required>
        </div>

        <!-- IMAGE -->
        <div class="mb-3">
            <label class="form-label">Product Image</label>
            <input type="file"
                   name="image"
                   class="form-control"
                   required>
        </div>

        <!-- ACTIONS -->
        <button type="submit" name="add" class="btn btn-primary">
            Add Product
        </button>

        <a href="dashboard.php" class="btn btn-secondary ms-2">
            Cancel
        </a>

    </form>
</div>

<?php include("../includes/footer.php"); ?>
