<?php
include 'config.php';

// Fetch product details
$product_id = $_GET['id'];
$product = $conn->query("SELECT * FROM product WHERE id = $product_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .captcha {
            display: flex;
            align-items: center;
        }
        .quantity-control {
            display: flex;
            align-items: center;
        }
        .quantity-control button {
            width: 30px;
            height: 30px;
            font-size: 20px;
            line-height: 0;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>Product Details</h1>
                <div class="card">
                    <img src="uploads/<?= $product['image'] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['name'] ?></h5>
                        <p class="card-text"><?= $product['description'] ?></p>
                        <p class="card-text"><strong>Price:</strong> $<span id="productPrice"><?= $product['price'] ?></span></p>
                        <div class="quantity-control">
                            <button type="button" id="decreaseQuantity" class="btn btn-minus">-</button>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control" style="width: 60px; text-align: center;" readonly>
                            <button type="button" id="increaseQuantity" class="btn btn-plus">+</button>
                        </div>
                        <p class="card-text mt-2"><strong>Total Price:</strong> $<span id="totalPrice"><?= $product['price'] ?></span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h1>Shipping Details</h1>
                <form id="orderForm" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                    <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                    <input type="hidden" id="totalPriceInput" name="total_price" value="<?= $product['price'] ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Shipping Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment" class="form-label">Payment Method</label>
                        <select class="form-control" id="payment" name="payment_method" required>
                            <option value="COD">Cash on Delivery</option>
                        </select>
                    </div>
                    <div class="mb-3 captcha">
                        <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Enter CAPTCHA" required>
                        <span id="captchaText" class="ms-3"></span>
                    </div>
                    <button type="submit" class="btn btn-success">Place Order</button>
                </form>
            </div>
        </div>
    </div>

    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // Simple CAPTCHA
        function generateCaptcha() {
            const captchaText = Math.random().toString(36).substring(2, 8);
            document.getElementById('captchaText').innerText = captchaText;
            return captchaText;
        }

        const captchaText = generateCaptcha();

        document.getElementById('orderForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const enteredCaptcha = document.getElementById('captcha').value;
            if (enteredCaptcha !== captchaText) {
                alert('Invalid CAPTCHA');
                generateCaptcha();  // Regenerate CAPTCHA if incorrect
                return;
            }

            const form = event.target;
            const formData = new FormData(form);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'process_order.php', true);
            xhr.onload = function() {
                if (xhr.status === 200 && xhr.responseText.trim() === 'success') {
                    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();
                    generateCaptcha();  // Regenerate CAPTCHA after successful order
                    form.reset();
                    document.getElementById('totalPrice').innerText = <?= $product['price'] ?>;
                    document.getElementById('quantity').value = 1;
                } else {
                    alert('Error placing order.');
                }
            };
            xhr.send(formData);
        });

        // Quantity and Total Price Calculation
        document.getElementById('increaseQuantity').addEventListener('click', function() {
            const quantityInput = document.getElementById('quantity');
            let quantity = parseInt(quantityInput.value);
            quantity++;
            quantityInput.value = quantity;
            updateTotalPrice();
        });

        document.getElementById('decreaseQuantity').addEventListener('click', function() {
            const quantityInput = document.getElementById('quantity');
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantity--;
                quantityInput.value = quantity;
                updateTotalPrice();
            }
        });

        function updateTotalPrice() {
            const quantity = parseInt(document.getElementById('quantity').value);
            const price = parseFloat(document.getElementById('productPrice').innerText);
            const totalPrice = quantity * price;
            document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
            document.getElementById('totalPriceInput').value = totalPrice.toFixed(2);
        }
    </script>
</body>
</html>
