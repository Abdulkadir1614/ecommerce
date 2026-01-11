<?php
session_start();
include("../includes/header.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../auth/login.php");
    exit();
}

/* Protect access */
if (!isset($_SESSION['delivery'])) {
    header("Location: delivery.php");
    exit();
}
?>

<div class="container mt-4" style="max-width:600px;">

    <h2 class="mb-4 text-center">Payment Method</h2>

    <form method="POST" action="confirm_order.php">

        <!-- PAYMENT OPTIONS -->
        <div class="mb-3">
            <label class="form-label">Choose Payment Method</label>

            <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       name="payment"
                       value="Cash on Delivery"
                       required
                       onclick="toggleCard(false)">
                <label class="form-check-label">
                   <i class="bi bi-cash-coin"></i> Cash on Delivery
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       name="payment"
                       value="Online Banking"
                       onclick="toggleCard(false)">
                <label class="form-check-label">
                    <i class="bi bi-bank"></i> Online Banking
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       name="payment"
                       value="Credit / Debit Card"
                       onclick="toggleCard(true)">
                <label class="form-check-label">
                    <i class="bi bi-credit-card"></i> Credit / Debit Card
                </label>
            </div>
        </div>

        <!-- CARD DETAILS (HIDDEN BY DEFAULT) -->
        <div id="cardSection" style="display:none;">

            <div class="mb-3">
                <label class="form-label"><i class="bi bi-file-person-fill"></i> Cardholder Name</label>
                <input type="text" name="card_name" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="bi bi-credit-card"></i> Card Number</label>
                <input type="text"
                       name="card_number"
                       class="form-control"
                       maxlength="16"
                       placeholder="1234 5678 9012 3456">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="bi bi-calendar"></i> Expiry Date</label>
                    <input type="month" name="expiry" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="bi bi-shield-lock"></i> CVV</label>
                    <input type="password"
                           name="cvv"
                           class="form-control"
                           maxlength="3"
                           placeholder="***">
                </div>
            </div>

        </div>

        <button class="btn btn-success w-100 mt-3">
            Confirm Order
        </button>

    </form>
</div>

<!-- SIMPLE JS -->
<script>
function toggleCard(show) {
    document.getElementById("cardSection").style.display = show ? "block" : "none";
}
</script>

<?php include("../includes/footer.php"); ?>
