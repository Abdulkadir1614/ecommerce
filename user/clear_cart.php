<?php
session_start();
unset($_SESSION['cart']);
$_SESSION['cart_count'] = 0;
header("Location: cart.php");
exit();
