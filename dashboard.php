<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
            height: 100vh;
            background-color: #00004b;
            color: #ffffff;
        }
        .sidebar {
            width: 250px;
            background-color:rgba(0,0,0,0.3);
            padding: 20px;
            
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
            background-color: #ff681c;
            color: #ffffff;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .dashboard {
            color: #ffffff;
        }
        .sidebar i {
            margin-right: 10px;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                box-shadow: none;
            }
            .sidebar a {
                margin-bottom: 5px;
            }
            body {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="dashboard">Dashboard</h2>
       <a href="?page=add-product"><i class="bi bi-plus-circle"></i>Add Product</a>
        <a href="?page=edit-product"><i class="bi bi-pencil-square"></i>Edit Product</a>
        <a href="?page=upgrade-plan"><i class="bi bi-arrow-up-circle"></i>Upgrade Plan</a>
        
        <a href="?page=report"><i class="bi bi-bar-chart"></i>Report</a>
        <a href="?page=logout"><i class="bi bi-box-arrow-right"></i>Logout</a>
    </div>
    <div class="content">
        
        <?php
               $page = $_GET['page'] ?? 'default';

            switch ($page) {
                case 'add-product':
                    include 'add_product.php';
                    break;
                case 'edit-product':
                    include 'edit_product.php';
                    break;
                case 'upgrade-plan':
                    include 'upgrade_plan.php';
                    break;
                case 'report':
                    include 'report.php';
                    break;
                case 'logout':
                    // Add logout logic here
                    echo '<h1>Logout</h1>';
                    break;
                default:
                    echo '<h1>Welcome to the Dashboard</h1><p>Select an option from the sidebar to get started.</p>';
                    break;
            }
       
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
