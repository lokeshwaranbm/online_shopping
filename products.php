<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1c1c1c 0%, #333333 100%);
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #880e4f;
            color: #fff;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        h2 {
            margin: 0;
            font-size: 26px;
            font-weight: bold;
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .logout-link {
            float: right;
            background-color: #ff4081;
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: -35px;
            margin-right: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        .logout-link:hover {
            background-color: #f50057;
        }
        .product {
            background: #212121;
            padding: 20px;
            margin: 15px;
            border-radius: 15px;
            width: 250px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s, border 0.2s;
            position: relative;
            overflow: hidden;
        }
        .product::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 15px;
            background: linear-gradient(135deg, rgba(255, 20, 147, 0.4), rgba(255, 20, 147, 0));
            opacity: 0;
            transition: opacity 0.2s;
            z-index: 0;
        }
        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        .product:hover::before {
            opacity: 1;
            z-index: 1;
        }
        .product h3 {
            color: #ff4081;
            font-size: 22px;
            margin: 15px 0 10px;
        }
        .product p {
            font-size: 16px;
            color: #e0e0e0;
        }
        .price {
            color: #ff4081;
            font-size: 18px;
            font-weight: bold;
        }
        .stock {
            font-size: 16px;
            color: #bdbdbd;
        }
        footer {
            background-color: #880e4f;
            color: #fff;
            text-align: center;
            padding: 15px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <header>
        <h2>Welcome, <?php echo $_SESSION['username']; ?>! Here are some products:</h2>
        <a href="logout.php" class="logout-link">Logout</a>
    </header>
    <div class="container">
        <?php
        $sql = "SELECT * FROM products";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='product'>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p class='price'>Price: ₹" . $row['price'] . "</p>";
                echo "<p class='stock'>Stock: " . $row['stock'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No products found.</p>";
        }
        ?>
    </div>
    <footer>
        Thanks for visiting!
    </footer>
</body>
</html>
