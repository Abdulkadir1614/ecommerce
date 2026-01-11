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

/* FETCH CURRENT USER */
$stmt = mysqli_prepare(
    $conn,
    "SELECT name, email, phone FROM users WHERE user_id = ?"
);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    session_destroy();
    header("Location: ../auth/login.php");
    exit();
}


/* UPDATE PROFILE */
if (isset($_POST['update_profile'])) {
    $name  = trim($_POST['name']);
    $phone = trim($_POST['phone']);

    if (empty($name)) {
        $error = "Full name is required.";
    } else {
        $stmt = mysqli_prepare(
            $conn,
            "UPDATE users SET name = ?, phone = ? WHERE user_id = ?"
        );
        mysqli_stmt_bind_param($stmt, "ssi", $name, $phone, $user_id);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['name'] = $name;
            $success = "Profile updated successfully.";
        } else {
            $error = "Failed to update profile.";
        }
    }
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4 text-center">
                        <i class="bi bi-person-check-fill me-1"></i>
                        Update Your Profile
                    </h4>

                    <?php if ($error) { ?>
                        <div class="alert alert-danger text-center"><?= $error ?></div>
                    <?php } ?>

                    <?php if ($success) { ?>
                        <div class="alert alert-success text-center"><?= $success ?></div>
                    <?php } ?>

                    <form method="POST">

                        <!-- FULL NAME -->
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-person"></i> Full Name</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="<?= htmlspecialchars($user['name'] ?? '') ?>"
                                   required>
                        </div>

                        <!-- EMAIL (DISABLED) -->
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-envelope"></i> Email (Cannot be changed)</label>
                            <input type="email"
                                   class="form-control bg-light"
                                   value="<?= htmlspecialchars($user['email'] ?? '') ?>"
                                   disabled>
                        </div>

                        <!-- PHONE -->
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-phone"></i> Phone Number</label>
                            <input type="text"
                                   name="phone"
                                   class="form-control"
                                   value="<?= htmlspecialchars($user['phone'] ?? '') ?>"
                                   placeholder="Enter phone number">
                        </div>

                        <!-- SAVE -->
                        <button type="submit"
                                name="update_profile"
                                class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-save me-1"></i> Save Changes
                        </button>

                    </form>

                    <hr>

                    <!-- RESET PASSWORD -->
                    <div class="text-center">
                        <a href="../user/reset_password.php"
                           class="btn btn-outline-warning">
                            <i class="bi bi-key-fill me-1"></i> Reset Password
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
