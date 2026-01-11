<?php
include("../config/db.php");
mysqli_query($conn, "DELETE FROM products WHERE product_id=".$_GET['id']);
header("Location: dashboard.php");
