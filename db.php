<!-- db.php -->
<?php
$servername = "localhost";
$username = "root";  // Default for XAMPP
$password = "";  // Default for XAMPP
$dbname = "shopping_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
