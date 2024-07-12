<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id']; // Assuming you have user sessions implemented

    // Check if the product is already in the wishlist
    $check_wishlist = $conn->query("SELECT * FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'");
    if ($check_wishlist->num_rows == 0) {
        // Add the product to the wishlist
        $conn->query("INSERT INTO wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')");
        echo 'Product added to wishlist.';
    } else {
        echo 'Product is already in your wishlist.';
    }
}
?>
