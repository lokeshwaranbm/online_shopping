<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: products.php");
            exit();
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "No user found with this email. Please register first.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #ff69b4;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 105, 180, 0.5);
            width: 350px;
            text-align: center;
            transition: transform 0.3s;
        }
        .login-container:hover {
            transform: scale(1.05);
        }
        h2 {
            margin-bottom: 20px;
            color: #fff;
        }
        label {
            font-weight: bold;
            display: block;
            text-align: left;
            margin-top: 10px;
            color: #fff;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #fff;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            transition: border-color 0.3s;
        }
        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #ff69b4;
            outline: none;
        }
        button[type="submit"] {
            background-color: #ff1493;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #c71585;
        }
        p {
            margin-top: 15px;
            font-size: 14px;
            color: #fff;
        }
        a {
            color: #ff69b4;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
            color: #c71585;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Here</h2>
        <form method="POST" action="login.php">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>

            <button type="submit">Login</button>
        </form>

        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
