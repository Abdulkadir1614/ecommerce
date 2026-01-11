<?php
session_start();
include("../config/db.php");

/* SECURITY */
if (
    !isset($_SESSION['user_id']) ||
    $_SESSION['role'] !== 'user' ||
    empty($_SESSION['cart']) ||
    !isset($_POST['payment'])
) {
    header("Location: cart.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$payment_method = $_POST['payment'];

/* CALCULATE TOTAL */
$total = 0;

foreach ($_SESSION['cart'] as $productId => $qty) {
    $stmt = mysqli_prepare($conn, "SELECT price FROM products WHERE product_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $productId);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    if ($row) {
        $total += $row['price'] * $qty;
    }
}

/* SAVE ORDER */
$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO orders (user_id, total_price, payment_method)
     VALUES (?, ?, ?)"
);
mysqli_stmt_bind_param($stmt, "ids", $user_id, $total, $payment_method);
mysqli_stmt_execute($stmt);

$order_id = mysqli_insert_id($conn);

/* SAVE ORDER ITEMS + UPDATE STOCK */
foreach ($_SESSION['cart'] as $productId => $qty) {

    $stmt = mysqli_prepare(
        $conn,
        "SELECT price, stock FROM products WHERE product_id = ?"
    );
    mysqli_stmt_bind_param($stmt, "i", $productId);
    mysqli_stmt_execute($stmt);
    $product = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    if (!$product) continue;

    $price = $product['price'];

    /* INSERT ORDER ITEM */
    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO order_items (order_id, product_id, quantity, price)
         VALUES (?, ?, ?, ?)"
    );
    mysqli_stmt_bind_param($stmt, "iiid", $order_id, $productId, $qty, $price);
    mysqli_stmt_execute($stmt);

    /* UPDATE STOCK */
    $stmt = mysqli_prepare(
        $conn,
        "UPDATE products SET stock = stock - ? WHERE product_id = ?"
    );
    mysqli_stmt_bind_param($stmt, "ii", $qty, $productId);
    mysqli_stmt_execute($stmt);
}

/* CLEAN SESSION */
unset($_SESSION['cart'], $_SESSION['delivery']);

/* SUCCESS */
$_SESSION['order_success'] = true;
header("Location: checkout.php");
exit();
