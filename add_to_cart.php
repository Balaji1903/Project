<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id']; // Assuming you have user sessions implemented

    // Check if the product is already in the cart
    $check_cart = $conn->query("SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'");
    if ($check_cart->num_rows == 0) {
        // Add the product to the cart
        $conn->query("INSERT INTO cart (user_id, product_id) VALUES ('$user_id', '$product_id')");
        echo 'Product added to cart.';
    } else {
        echo 'Product is already in your cart.';
    }
}
?>
