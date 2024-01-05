<?php
$link = mysqli_connect('localhost', 'root', '', 'food');

if (!$link) {
    die("ไม่สามารถเชื่อมต่อฐานข้อมูล: " . mysqli_connect_error());
}

$dish = [];
$resultDish = null;
$resultIngredients = null;

if (isset($_GET['dishID'])) {
    $dishID = mysqli_real_escape_string($link, $_GET['dishID']);

    
    $queryDish = "SELECT Dishes.DishID, Dishes.DishName
                  FROM Dishes
                  WHERE Dishes.DishID = ?";
    $stmtDish = mysqli_prepare($link, $queryDish);
    mysqli_stmt_bind_param($stmtDish, "i", $dishID);
    mysqli_stmt_execute($stmtDish);
    $resultDish = mysqli_stmt_get_result($stmtDish);

    if (!$resultDish) {
        die("เกิดข้อผิดพลาดในการดึงข้อมูลเมนู: " . mysqli_error($link));
    }

    $dish = mysqli_fetch_assoc($resultDish);

    
    $queryIngredients = "SELECT DishIngredients.*, Ingredients.IngredientName
                         FROM DishIngredients
                         INNER JOIN Ingredients ON DishIngredients.IngredientID = Ingredients.IngredientID
                         WHERE DishIngredients.DishID = ?";
    $stmtIngredients = mysqli_prepare($link, $queryIngredients);
    mysqli_stmt_bind_param($stmtIngredients, "i", $dishID);
    mysqli_stmt_execute($stmtIngredients);
    $resultIngredients = mysqli_stmt_get_result($stmtIngredients);

    if (!$resultIngredients) {
        die("เกิดข้อผิดพลาดในการดึงข้อมูลส่วนผสม: " . mysqli_error($link));
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($dish['DishName']) ? $dish['DishName'] : 'ไม่พบข้อมูล'; ?></title>
    <link rel="stylesheet" href="dish.css">
</head>
<body>

    <?php if (isset($dish['DishName'])) : ?>
        <h1><?php echo $dish['DishName']; ?></h1>

        <h2>ส่วนผสม:</h2>

        <table>
            <tr>
                <th>ส่วนผสม</th>
                <th>ปริมาณ</th>
                <th>หน่วย</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($resultIngredients)) {
                echo "<tr>";
                echo "<td>{$row['IngredientName']}</td>";
                echo "<td>{$row['Quantity']}</td>";
                echo "<td>{$row['MeasurementUnit']}</td>";
                echo "</tr>";
            }
            ?>
        </table>

        <h2>เพิ่มส่วนผสม</h2>
        <form action="process.php" method="post">
            <label for="ingredientID">เลือกวัตถุดิบ:</label>
            <select name="ingredientID" required>
                <?php
                
                $resultIngredients = mysqli_query($link, "SELECT * FROM ingredients");

                while ($rowIngredient = mysqli_fetch_assoc($resultIngredients)) {
                    echo "<option value='{$rowIngredient['IngredientID']}'>{$rowIngredient['IngredientName']}</option>";
                }
                ?>
            </select>
            <label for="quantity">ปริมาณ:</label>
            <input type="number" name="quantity" required>
            <label for="measurementUnit">หน่วยนับ:</label>
            <input type="text" name="measurementUnit" required>
            <input type="hidden" name="dishID" value="<?php echo $dishID; ?>">
            <input type="submit" value="เพิ่มส่วนผสม">
            <input type="hidden" name="action" value="addRecipe">
        </form>

    <?php else : ?>
        <h1>ไม่พบข้อมูล</h1>
    <?php endif; ?>

</body>
</html>

<?php
mysqli_close($link);
?>
