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

/* FETCH ADMIN DATA */
$stmt = mysqli_prepare($conn, "SELECT name, email FROM users WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $admin_id);
mysqli_stmt_execute($stmt);
$admin = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

/* UPDATE PROFILE */
if (isset($_POST['update_profile'])) {
    $name = trim($_POST['name']);

    if ($name === "") {
        $error = "Name cannot be empty.";
    } else {
        $stmt = mysqli_prepare(
            $conn,
            "UPDATE users SET name = ? WHERE user_id = ?"
        );
        mysqli_stmt_bind_param($stmt, "si", $name, $admin_id);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['name'] = $name;
            $success = "Profile updated successfully.";
        } else {
            $error = "Failed to update profile.";
        }
    }
}
?>

<div class="container my-5" style="max-width:600px;">
    <div class="card shadow-sm">
        <div class="card-body p-4">

            <h4 class="fw-bold text-center mb-4">
                <i class="bi bi-person-circle me-1"></i> Admin Profile
            </h4>

            <?php if ($error) { ?>
                <div class="alert alert-danger text-center"><?= $error ?></div>
            <?php } ?>

            <?php if ($success) { ?>
                <div class="alert alert-success text-center"><?= $success ?></div>
            <?php } ?>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="<?= htmlspecialchars($admin['name']) ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email (Cannot be changed)</label>
                    <input type="email"
                           class="form-control bg-light"
                           value="<?= htmlspecialchars($admin['email']) ?>"
                           disabled>
                </div>

                <button class="btn btn-primary w-100" name="update_profile">
                    <i class="bi bi-save me-1"></i> Save Changes
                </button>
            </form>

        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
