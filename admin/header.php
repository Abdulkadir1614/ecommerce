<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SmartMart</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/style.css">
</head>


<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
    <div class="container-fluid px-4">

        <!-- BRAND -->
        <a class="navbar-brand fw-bold d-flex align-items-center" href="dashboard.php">
            <i class="bi bi-speedometer2 fs-4 me-2"></i> SmartMart Admin
        </a>

        <!-- TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- NAVBAR -->
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">

                <!-- DASHBOARD -->
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">
                        <i class="bi bi-house-door"></i> Dashboard
                    </a>
                </li>

                <!-- ORDERS -->
                <li class="nav-item">
                    <a class="nav-link" href="orders.php">
                        <i class="bi bi-receipt"></i> Orders
                    </a>
                </li>

                <!-- USERS -->
                <li class="nav-item">
                    <a class="nav-link" href="users.php">
                        <i class="bi bi-people"></i> Users
                    </a>
                </li>

                <!-- FEEDBACKS -->
                <li class="nav-item">
                    <a class="nav-link" href="feedbacks.php">
                        <i class="bi bi-chat-dots"></i> Feedbacks
                    </a>
                </li>

                <!-- REPORTS -->
                <li class="nav-item">
                    <a class="nav-link" href="reports.php">
                        <i class="bi bi-bar-chart"></i> Reports
                    </a>
                </li>

                <!-- ADMIN PROFILE DROPDOWN -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center"
                       href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle fs-5 me-1"></i>
                        <?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow">

                        <li>
                            <a class="dropdown-item" href="profile.php">
                                <i class="bi bi-person-gear me-2"></i> Admin Profile
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="settings.php">
                                <i class="bi bi-gear me-2"></i> Settings
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item text-danger" href="../auth/logout.php">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- END OF NAVBAR -->
 <!-- Bootstrap JS Bundle (REQUIRED) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

 </body>
</html>
