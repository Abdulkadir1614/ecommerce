<?php
session_start();
include("../config/db.php");
include("../includes/header.php");

$error = "";
$success = "";

/* =======================
   HANDLE REGISTRATION
   ======================= */
if (isset($_POST['register'])) {

    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if ($name === "" || $email === "" || $password === "") {
        $error = "All fields are required.";
    } else {

        // Check if email already exists
        $stmt = mysqli_prepare($conn, "SELECT user_id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $error = "Email already registered.";
        } else {

            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user (default role = user)
            $stmt = mysqli_prepare(
                $conn,
                "INSERT INTO users (name, email, password, role)
                 VALUES (?, ?, ?, 'user')"
            );
            mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashed_password);
            mysqli_stmt_execute($stmt);

            $success = "Registration successful. You can now login.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">                        
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
                        <i class="bi bi-person-plus-fill fs-1 text-primary"></i>
                        <h3 class="fw-bold mt-2">Create Account</h3>
                        <p class="text-muted small">Join SmartMart today</p>
                    </div>

                    <!-- ERROR -->
                    <?php if ($error) { ?>
                        <div class="alert alert-danger text-center py-2">
                            <?= $error ?>
                        </div>
                    <?php } ?>

                    <!-- SUCCESS -->
                    <?php if ($success) { ?>
                        <div class="alert alert-success text-center py-2">
                            <?= $success ?>
                        </div>
                    <?php } ?>

                    <!-- FORM -->
                    <form method="POST">

                        <!-- FULL NAME -->
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="Your full name"
                                    value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                                    required
                                >
                            </div>
                        </div>

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
                                    placeholder="Create a password"
                                    id="regPassword"
                                    required
                                >
                                <span class="input-group-text" style="cursor:pointer" onclick="toggleRegPassword()">
                                    <i class="bi bi-eye" id="regEyeIcon"></i>
                                </span>
                            </div>
                        </div>

                        <!-- REGISTER BUTTON -->
                        <button type="submit" name="register" class="btn btn-primary w-100 py-2 mt-2">
                            <i class="bi bi-person-check me-1"></i> Register
                        </button>

                        <!-- LOGIN LINK -->
                        <p class="text-center mt-3 mb-0 small">
                            Already have an account?
                            <a href="login.php" class="fw-semibold">Login</a>
                        </p>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
function toggleRegPassword() {
    const password = document.getElementById("regPassword");
    const icon = document.getElementById("regEyeIcon");

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
