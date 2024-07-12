<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .sidebar {
            width: 250px;
            background-color: #00004b;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar a {
            display: block;
            color: #ffffff;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #ddd;
            color: #00004b;
        }
        .content {
            padding: 20px;
        }
        .dashboard {
            color: #ffffff;
        }
        .sidebar i {
            margin-right: 10px;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .product-table th, .product-table td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        .product-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    
    <div class="content">
        <?php if ($editProduct): ?>
            <h2>Edit Product</h2>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="productId" value="<?php echo $editProduct['id']; ?>">
                <div class="mb-3">
                    <label for="productName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="productName" value="<?php echo $editProduct['name']; ?>">
                </div>
                <div class="mb-3">
                    <label for="productPrice" class="form-label">Product Price</label>
                    <input type="number" class="form-control" id="productPrice" name="productPrice" value="<?php echo $editProduct['price']; ?>">
                </div>
                <div class="mb-3">
                    <label for="productDescription" class="form-label">Product Description</label>
                    <textarea class="form-control" id="productDescription" name="productDescription"><?php echo $editProduct['description']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="productMainCategory" class="form-label">Main Category</label>
                    <input type="text" class="form-control" id="productMainCategory" name="productMainCategory" value="<?php echo $editProduct['mainCategory']; ?>">
                </div>
                <div class="mb-3">
                    <label for="productSubCategory" class="form-label">Sub Category</label>
                    <input type="text" class="form-control" id="productSubCategory" name="productSubCategory" value="<?php echo $editProduct['subCategory']; ?>">
                </div>
                <div class="mb-3">
                    <label for="productImage" class="form-label">Product Image</label>
                    <input type="file" class="form-control" id="productImage" name="productImage">
                </div>
                <?php if (!empty($editProduct['image'])): ?>
                    <img src="<?php echo $editProduct['image']; ?>" alt="Product Image" style="max-width: 200px;">
                <?php endif; ?>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="update_product">Update Product</button>
                    <a href="?page=edit-product" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            
        <?php else: ?>
            <h2>Edit Products</h2>
            <?php
            $products = getProducts();
            if ($products):
                echo '<table class="product-table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Name</th>';
                echo '<th>Category</th>';
                echo '<th>Price</th>';
                echo '<th>Action</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($products as $product) {
                    echo '<tr>';
                    echo '<td>' . $product['id'] . '</td>';
                    echo '<td>' . $product['name'] . '</td>';
                    echo '<td>' . $product['mainCategory'] . ' / ' . $product['subCategory'] . '</td>';
                    echo '<td>' . $product['price'] . '</td>';
                    echo '<td><a href="?page=edit-product&edit_id=' . $product['id'] . '" class="btn btn-primary">Edit</a></td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            else:
                echo '<p>No products available.</p>';
            endif;
            ?>
        <?php endif; ?>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
