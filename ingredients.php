<?php
$link = mysqli_connect('localhost', 'root', '', 'food');

if (!$link) {
    die("ไม่สามารถเชื่อมต่อฐานข้อมูล: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == 'addIngredient') {
        $ingredientName = mysqli_real_escape_string($link, $_POST['ingredientName']);

        
        $insertQuery = "INSERT INTO ingredients (IngredientName) VALUES ('$ingredientName')";

        if (mysqli_query($link, $insertQuery)) {
            echo "เพิ่ม Ingredient เรียบร้อยแล้ว";
        } else {
            echo "Error: " . $insertQuery . "<br>" . mysqli_error($link);
        }
    }
}


$resultIngredients = mysqli_query($link, "SELECT * FROM ingredients");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingredients</title>
    <link rel="stylesheet" href="ingredients.css">
</head>
<body>

<h2>Ingredients</h2>


<form method="post" action="">
    <label for="ingredientName">ชื่อ Ingredient: </label>
    <input type="text" name="ingredientName" required>
    <input type="hidden" name="action" value="addIngredient">
    <button type="submit">เพิ่ม Ingredient</button>
</form>


<table>
    <tr>
        <th>รายการวัตถุดิบ</th>
    </tr>

    <?php
    while ($rowIngredient = mysqli_fetch_assoc($resultIngredients)) {
        echo "<tr>";
        echo "<td>{$rowIngredient['IngredientName']}</td>";
        echo "</tr>";
    }

    mysqli_close($link);
    ?>
</table>

</body>
</html>
