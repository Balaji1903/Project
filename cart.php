<?php
include 'config.php';

// Function to update cart item quantity
if (isset($_POST['update_quantity'])) {
    $cart_id = $_POST['cart_id'];
    $new_quantity = $_POST['new_quantity'];
    
    // Update quantity in database
    $update_query = "UPDATE cart SET quantity = $new_quantity WHERE id = $cart_id";
    $conn->query($update_query);
    exit('success');
}

// Function to remove item from cart
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $cart_id = $_GET['id'];
    
    // Delete item from database
    $delete_query = "DELETE FROM cart WHERE id = $cart_id";
    $conn->query($delete_query);
    
    header('Location: cart.php');
    exit();
}

// Fetch cart items from the database
$cart_items = $conn->query("SELECT * FROM cart");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .quantity-control {
            display: flex;
            align-items: center;
        }
        .quantity-control button {
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Shopping Cart</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $cart_items->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['product_name'] ?></td>
                        <td>$<?= $row['product_price'] ?></td>
                        <td class="quantity-control">
                            <button class="btn btn-sm btn-outline-secondary decrease-quantity" data-cart-id="<?= $row['id'] ?>">-</button>
                            <input type="number" class="form-control item-quantity" value="<?= $row['quantity'] ?>" data-cart-id="<?= $row['id'] ?>" style="width: 50px;" readonly>
                            <button class="btn btn-sm btn-outline-secondary increase-quantity" data-cart-id="<?= $row['id'] ?>">+</button>
                        </td>
                        <td>$<span class="item-total"><?= $row['total_price'] ?></span></td>
                        <td>
                            <a href="cart.php?action=remove&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Remove</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-primary">Continue Shopping</a>
        <a href="shipping_details.php" class="btn btn-success">Checkout</a>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to handle quantity change
            function updateQuantity(cartId, newQuantity) {
                fetch('cart.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        update_quantity: true,
                        cart_id: cartId,
                        new_quantity: newQuantity
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        location.reload();
                    } else {
                        console.log('Failed to update quantity');
                    }
                })
                .catch(error => console.error('Error:', error));
            }

            // Add event listeners for increase and decrease quantity buttons
            document.querySelectorAll('.increase-quantity, .decrease-quantity').forEach(button => {
                button.addEventListener('click', function() {
                    const cartId = this.dataset.cartId;
                    const input = document.querySelector(`.item-quantity[data-cart-id="${cartId}"]`);
                    let newQuantity = parseInt(input.value);

                    if (this.classList.contains('increase-quantity')) {
                        newQuantity++;
                    } else if (this.classList.contains('decrease-quantity')) {
                        if (newQuantity > 1) {
                            newQuantity--;
                        } else {
                            return; // Minimum quantity reached
                        }
                    }

                    input.value = newQuantity;
                    updateQuantity(cartId, newQuantity);
                });
            });
        });
    </script>
</body>
</html>
