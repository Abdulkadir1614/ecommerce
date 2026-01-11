<?php
session_start();

if (!isset($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

if (isset($_GET['id'])) {
    $productId = (int) $_GET['id'];

    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }

    // Update cart count
    $_SESSION['cart_count'] = !empty($_SESSION['cart'])
        ? array_sum($_SESSION['cart'])
        : 0;
}

header("Location: cart.php");
exit();
