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
$success = $error = "";

if (isset($_POST['reset_password'])) {

    $current_password = $_POST['current_password'];
    $new_password     = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif ($new_password !== $confirm_password) {
        $error = "New passwords do not match.";
    } else {

        // Get current hashed password
        $stmt = mysqli_prepare($conn, "SELECT password FROM users WHERE user_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

        if (!$user || !password_verify($current_password, $user['password'])) {
            $error = "Current password is incorrect.";
        } else {
            $hashed = password_hash($new_password, PASSWORD_DEFAULT);

            $stmt = mysqli_prepare(
                $conn,
                "UPDATE users SET password = ? WHERE user_id = ?"
            );
            mysqli_stmt_bind_param($stmt, "si", $hashed, $user_id);

            if (mysqli_stmt_execute($stmt)) {
                $success = "Password reset successfully.";
            } else {
                $error = "Failed to reset password.";
            }
        }
    }
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h4 class="fw-bold text-center mb-4">
                        <i class="bi bi-key-fill me-1"></i> Reset Your Password
                    </h4>

                    <?php if ($error) { ?>
                        <div class="alert alert-danger text-center"><?= $error ?></div>
                    <?php } ?>

                    <?php if ($success) { ?>
                        <div class="alert alert-success text-center"><?= $success ?></div>
                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password"
                                   name="current_password"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password"
                                   name="new_password"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password"
                                   name="confirm_password"
                                   class="form-control"
                                   required>
                        </div>

                        <button type="submit"
                                name="reset_password"
                                class="btn btn-warning w-100">
                            <i class="bi bi-arrow-repeat me-1"></i>
                            Reset Password
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
