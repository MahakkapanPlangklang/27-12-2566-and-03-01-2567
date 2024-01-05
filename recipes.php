<html>
<body>
    <h2>เพิ่มสูตรอาหาร</h2>
    <form action="process.php" method="post">
        <label for="dishID">เลือกรายการอาหาร:</label>
        <select name="dishID" required>
            
            <?php
            $link = mysqli_connect('localhost', 'root', '', 'food');

            if (!$link) {
                die("ไม่สามารถเชื่อมต่อฐานข้อมูล: " . mysqli_connect_error());
            }

            $result = mysqli_query($link, "SELECT * FROM Dishes");

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['DishID']}'>{$row['DishName']}</option>";
            }

            mysqli_close($link);
            ?>
        </select>
        <br>
        <label for="ingredientID">เลือกส่วนผสม:</label>
        <select name="ingredientID" required>
            
            <?php
            $link = mysqli_connect('localhost', 'root', '', 'food');

            if (!$link) {
                die("ไม่สามารถเชื่อมต่อฐานข้อมูล: " . mysqli_connect_error());
            }

            $result = mysqli_query($link, "SELECT * FROM Ingredients");

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['IngredientID']}'>{$row['IngredientName']}</option>";
            }

            mysqli_close($link);
            ?>
        </select>
        <br>
        <label for="quantity">ปริมาณ:</label>
        <input type="number" name="quantity" required>
        <br>
        <label for="measurementUnit">หน่วยนับ:</label>
        <input type="text" name="measurementUnit" required>
        <br>
        <input type="submit" value="เพิ่มสูตรอาหาร">
        <input type="hidden" name="action" value="addRecipe">
    </form>
</body>
</html>
