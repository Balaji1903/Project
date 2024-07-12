<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $main_category_id = $_POST['main_category_id'];

    $sql = "INSERT INTO sub_categories (name, main_category_id) VALUES ('$name', '$main_category_id')";
    if ($conn->query($sql) === TRUE) {
        echo "New sub-category added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$main_categories = $conn->query("SELECT * FROM main_categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Sub Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="container">
    <h2>Add Sub Category</h2>
    <form action="add_sub_category.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Sub Category Name:</label>
            <input type="text" id="name" name="name" class="form-control">
        </div>
        <div class="mb-3">
            <label for="main_category_id" class="form-label">Main Category:</label>
            <select id="main_category_id" name="main_category_id" class="form-select">
                <?php while($row = $main_categories->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Sub Category</button>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
