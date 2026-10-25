<?php
$servername = getenv('DB_HOST') ?: (getenv('MYSQLHOST') ?: 'localhost');
$username = getenv('DB_USER') ?: (getenv('MYSQLUSER') ?: 'root');
$password = getenv('DB_PASSWORD') ?: (getenv('MYSQLPASSWORD') ?: '');
$database = getenv('DB_NAME') ?: (getenv('MYSQLDATABASE') ?: 'swiftbuy');
$port = (int) (getenv('DB_PORT') ?: (getenv('MYSQLPORT') ?: 3306));

$conn = new mysqli($servername, $username, $password, $database, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
