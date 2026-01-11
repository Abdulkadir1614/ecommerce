<?php
session_start();
include("../config/db.php");
include("../admin/header.php");

/* ADMIN SECURITY */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$admin_id = $_SESSION['user_id'];
$success = $error = "";

/* HANDLE PASSWORD RESET */
if (isset($_POST['reset_password'])) {

    $current = $_POST['current_password'];
    $new     = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if ($new !== $confirm) {
        $error = "New passwords do not match.";
    } elseif (strlen($new) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {

        $stmt = mysqli_prepare($conn, "SELECT password FROM users WHERE user_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $admin_id);
        mysqli_stmt_execute($stmt);
        $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

        if (!password_verify($current, $row['password'])) {
            $error = "Current password is incorrect.";
        } else {

            $hashed = password_hash($new, PASSWORD_DEFAULT);

            $stmt = mysqli_prepare(
                $conn,
                "UPDATE users SET password = ? WHERE user_id = ?"
            );
            mysqli_stmt_bind_param($stmt, "si", $hashed, $admin_id);
            mysqli_stmt_execute($stmt);

            $success = "Password updated successfully.";
        }
    }
}
?>

<div class="container my-5" style="max-width:600px;">
    <div class="card shadow-sm">
        <div class="card-body p-4">

            <h4 class="fw-bold text-center mb-4">
                <i class="bi bi-gear-fill me-1"></i> Settings
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
                    <input type="password" name="current_password"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" name="new_password"
                           class="form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="confirm_password"
                           class="form-control" required>
                </div>

                <button class="btn btn-warning w-100" name="reset_password">
                    <i class="bi bi-arrow-repeat me-1"></i> Reset Password
                </button>
            </form>

        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
