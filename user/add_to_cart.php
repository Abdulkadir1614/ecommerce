<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../auth/login.php");
    exit();
}

/* Initialize cart as associative array */
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* Add product with quantity */
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    if ($id > 0) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]++;   // increase quantity
        } else {
            $_SESSION['cart'][$id] = 1; // first time
        }
    }
}

/* Redirect to cart */
header("Location: cart.php");
exit();
