<?php
$link = mysqli_connect('localhost', 'root', '', 'food');

if (!$link) {
    die("ไม่สามารถเชื่อมต่อฐานข้อมูล: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = mysqli_real_escape_string($link, $_POST['action']);

    if ($action == 'addDish') {
        $newDishName = mysqli_real_escape_string($link, $_POST['newDishName']);

        
        $query = "INSERT INTO Dishes (DishName) VALUES (?)";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "s", $newDishName);
        mysqli_stmt_execute($stmt);

        if (!$stmt) {
            die("เกิดข้อผิดพลาดในการเพิ่มเมนูสูตร: " . mysqli_error($link));
        }

        header("Location: index.php");
    } elseif ($action == 'addRecipe') {
        $dishID = mysqli_real_escape_string($link, $_POST['dishID']);
        $ingredientID = mysqli_real_escape_string($link, $_POST['ingredientID']);
        $quantity = mysqli_real_escape_string($link, $_POST['quantity']);
        $measurementUnit = mysqli_real_escape_string($link, $_POST['measurementUnit']);

        
        $query = "INSERT INTO DishIngredients (DishID, IngredientID, Quantity, MeasurementUnit) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "iiis", $dishID, $ingredientID, $quantity, $measurementUnit);
        mysqli_stmt_execute($stmt);

        if (!$stmt) {
            die("เกิดข้อผิดพลาดในการเพิ่มส่วนผสม: " . mysqli_error($link));
        }

        header("Location: dish.php?dishID=$dishID");
    }
}

mysqli_close($link);
?>
