<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];

    // Insert the cart item into the database
    $sql = "INSERT INTO cart (product_id, product_name, product_price, quantity, total_price)
            VALUES ('$product_id', '$product_name', '$product_price', '$quantity', '$total_price')";

    if ($conn->query($sql) === TRUE) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
