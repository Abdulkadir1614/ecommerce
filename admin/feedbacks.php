<?php
session_start();
include("../config/db.php");
include("../admin/header.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$query = "
    SELECT f.rating, f.message, f.created_at, u.name
    FROM feedback f
    JOIN users u ON f.user_id = u.user_id
    ORDER BY f.created_at DESC
";
$result = mysqli_query($conn, $query);
?>

<div class="container my-5">
    <h3 class="fw-bold mb-4"><i class="bi bi-chat-dots"></i> Feedbacks</h3>

    <div class="card shadow-sm">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>User</th>
                    <th>Rating</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td>
                        <?php for ($i=1; $i<=5; $i++) {
                            echo $i <= $row['rating'] ? "⭐" : "☆";
                        } ?>
                    </td>
                    <td><?= htmlspecialchars($row['message']) ?></td>
                    <td><?= date("d M Y", strtotime($row['created_at'])) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
