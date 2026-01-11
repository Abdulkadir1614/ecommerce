<?php
session_start();
include("../config/db.php");
include("../admin/header.php");

/* SECURITY */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

/* DELETE USER */
if (isset($_GET['delete'])) {
    $delete_id = (int) $_GET['delete'];

    // Prevent admin deleting self
    if ($delete_id === $_SESSION['user_id']) {
        $_SESSION['error'] = "You cannot delete your own account.";
        header("Location: users.php");
        exit();
    }

    $stmt = mysqli_prepare(
        $conn,
        "DELETE FROM users WHERE user_id = ? AND role = 'user'"
    );
    mysqli_stmt_bind_param($stmt, "i", $delete_id);
    mysqli_stmt_execute($stmt);

    $_SESSION['success'] = "User removed successfully.";
    header("Location: users.php");
    exit();
}

/* FETCH USERS */
$result = mysqli_query($conn, "SELECT user_id, name, email, role FROM users");
?>

<div class="container my-5">
    <h3 class="fw-bold mb-4">
        <i class="bi bi-people"></i> Users
    </h3>

    <?php if (!empty($_SESSION['error'])) { ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php } ?>

    <?php if (!empty($_SESSION['success'])) { ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php } ?>

    <div class="card shadow-sm">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['user_id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td>
                        <span class="badge <?= $row['role']=='admin'?'bg-danger':'bg-secondary' ?>">
                            <?= ucfirst($row['role']) ?>
                        </span>
                    </td>
                    <td class="text-center">

                        <?php if ($row['role'] === 'user') { ?>
                            <a href="users.php?delete=<?= $row['user_id'] ?>"
                               class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('Are you sure you want to delete this user?');">
                                <i class="bi bi-trash"></i>
                            </a>
                        <?php } else { ?>
                            <span class="text-muted">—</span>
                        <?php } ?>

                    </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
