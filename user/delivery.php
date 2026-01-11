<?php
session_start();

/* Protect page — MUST COME FIRST */
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: products.php");
    exit();
}

/* Handle form submit — MUST COME BEFORE HTML */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (
        empty($_POST['name']) ||
        empty($_POST['phone']) ||
        empty($_POST['address'])
    ) {
        $error = "All fields are required.";
    } else {
        $_SESSION['delivery'] = [
            'name'    => $_POST['name'],
            'phone'   => $_POST['phone'],
            'address' => $_POST['address']
        ];

        header("Location: payment.php");
        exit();
    }
}

/* NOW include header (safe) */
include("../includes/header.php");
?>


<div class="container mt-4" style="max-width:600px;">

    <h2 class="mb-4 text-center"><i class="bi bi-info-circle-fill"></i> Delivery Information</h2>

    <?php if (!empty($error)) { ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <!-- IMPORTANT: action + method -->
    <form method="POST" action="">

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-person"></i> Full Name</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-telephone"></i> Phone Number</label>
            <input type="text"
                   name="phone"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-house-door"></i> Delivery Address</label>
            <textarea name="address"
                      class="form-control"
                      rows="4"
                      required></textarea>
        </div>

        <!-- MUST be submit -->
        <button type="submit" class="btn btn-primary w-100">
            Continue to Payment
        </button>

    </form>
</div>

<?php include("../includes/footer.php"); ?>
