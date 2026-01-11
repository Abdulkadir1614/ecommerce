<?php
session_start();
include("../config/db.php");
include("../includes/header.php");

/* SECURITY */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../auth/login.php");
    exit();
}

$success = "";
$error = "";

if (isset($_POST['submit_feedback'])) {

    $rating  = (int) $_POST['rating'];
    $message = trim($_POST['message']);
    $user_id = $_SESSION['user_id'];

    if ($rating < 1 || $rating > 5 || empty($message)) {
        $error = "Please provide a rating and feedback message.";
    } else {
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO feedback (user_id, rating, message) VALUES (?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "iis", $user_id, $rating, $message);

        if (mysqli_stmt_execute($stmt)) {
            $success = "Thank you for your feedback!";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>

    

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <i class="bi bi-chat-dots-fill fs-1 text-primary"></i>
                        <h3 class="fw-bold mt-2">Feedback</h3>
                        <p class="text-muted small">
                            Help us improve SmartMart
                        </p>
                    </div>

                    <?php if ($error) { ?>
                        <div class="alert alert-danger text-center"><?= $error ?></div>
                    <?php } ?>

                    <?php if ($success) { ?>
                        <div class="alert alert-success text-center"><?= $success ?></div>
                    <?php } ?>

                    <form method="POST">

                        <!-- STAR RATING -->
                        
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" required>
                            <label for="star5" title="5 stars">★</label>

                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4" title="4 stars">★</label>

                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3" title="3 stars">★</label>

                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2" title="2 stars">★</label>

                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1" title="1 star">★</label>
                        </div>

                        <!-- MESSAGE -->
                        <div class="mb-3">
                            <label class="form-label">Your Feedback</label>
                            <textarea
                                name="message"
                                class="form-control"
                                rows="3"
                                placeholder="Write your feedback here..."
                                required></textarea>
                        </div>

                        <!-- SUBMIT -->
                        <button type="submit" name="submit_feedback" class="btn btn-primary w-100">
                            <i class="bi bi-send me-1"></i> Submit Feedback
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
