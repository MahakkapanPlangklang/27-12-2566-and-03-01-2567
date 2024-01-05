<html>
<head>
        <title>Menu</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="theam.css">
    
</head>
<body>
    <h2>ระบบเว็บสูตรอาหาร</h2>
    
    <h3>เมนูอาหาร</h3>
    <table>
        <tr>
            <th>รายการอาหาร</th>
            <th>ดำเนินการ</th>
        </tr>

        <?php
        $link = mysqli_connect('localhost', 'root', '', 'food');

        if (!$link) {
            die("ไม่สามารถเชื่อมต่อฐานข้อมูล: " . mysqli_connect_error());
        }

        $result = mysqli_query($link, "SELECT * FROM Dishes");

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['DishName']}</td>";
            echo "<td><a href='dish.php?dishID={$row['DishID']}'>ดูสูตร</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h3>เพิ่มเมนูสูตร</h3>
    <form action="process.php" method="post">
        <label for="newDishName">ชื่ออาหาร:</label>
        <input type="text" name="newDishName" required>
        <input type="submit" value="เพิ่มเมนู">
        <input type="hidden" name="action" value="addDish">
    </form>

    
    <a href='ingredients.php'><button style="margin-top: 20px;">ดู Ingredients</button></a>
</body>
</html>
