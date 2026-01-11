<?php
session_start();
include("../config/db.php");
include("../includes/header.php");

$error = "";

/* =======================
   HANDLE LOGIN
   ======================= */
if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM users WHERE LOWER(email) = LOWER(?)"
);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {

    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['role']    = $user['role'];
    $_SESSION['name']    = $user['name'];

    if ($user['role'] === 'admin') {
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../user/products.php");
    }
    exit();
} else {
    $error = "Invalid email or password!";
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <!-- TITLE -->
                    <div class="text-center mb-4">
                        <i class="bi bi-person-circle fs-1 text-primary"></i>
                        <h3 class="fw-bold mt-2">Welcome Back</h3>
                        <p class="text-muted small">Login to your SmartMart account</p>
                    </div>

                    <!-- ERROR -->
                    <?php if ($error) { ?>
                        <div class="alert alert-danger text-center py-2">
                            <?= $error ?>
                        </div>
                    <?php } ?>

                    <!-- FORM -->
                    <form method="POST">

                        <!-- EMAIL -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="you@example.com"
                                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                                    required
                                >
                            </div>
                        </div>

                        <!-- PASSWORD -->
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Enter your password"
                                    id="password"
                                    required
                                >
                                <span class="input-group-text" style="cursor:pointer" onclick="togglePassword()">
                                    <i class="bi bi-eye" id="eyeIcon"></i>
                                </span>
                            </div>
                        </div>

                        <!-- LOGIN BUTTON -->
                        <button type="submit" name="login" class="btn btn-primary w-100 py-2 mt-2">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </button>

                        <!-- LINKS -->
                        <div class="text-center mt-3 small">
                            <a href="forgot_password.php" class="text-decoration-none">
                                Forgot password?
                            </a>
                        </div>

                        <p class="text-center mt-3 mb-0 small">
                            Don’t have an account?
                            <a href="register.php" class="fw-semibold">Register</a>
                        </p>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
function togglePassword() {
    const password = document.getElementById("password");
    const icon = document.getElementById("eyeIcon");

    if (password.type === "password") {
        password.type = "text";
        icon.classList.replace("bi-eye", "bi-eye-slash");
    } else {
        password.type = "password";
        icon.classList.replace("bi-eye-slash", "bi-eye");
    }
}
</script>
</body>
</html>

<?php include("../includes/footer.php"); ?>
