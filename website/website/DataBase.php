<?php
$servername = "localhost";
$username = "cryptoshowuser";
$password = "cryptoshowpass";
$dbname = "cryptoshow_DB";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
