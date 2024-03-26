<?php
// Database connection details
$servername = "localhost";
$username = "cryptoshowuser";
$password = "cryptoshowpass";
$dbname = "cryptoshow_DB";
try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nickname = $_POST["nickname"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // Validate input
        if ($password != $confirm_password) {
            echo "Error: Passwords do not match.";
        } else {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare the SQL statement
            $sql = "INSERT INTO registered_user (user_nickname, user_name, user_email, user_hashed_password) VALUES (:nickname, :name, :email, :hashed_password)";
            $stmt = $conn->prepare($sql);

            // Bind parameters to the prepared statement
            $stmt->bindParam(':nickname', $nickname);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':hashed_password', $hashed_password);

            // Execute the prepared statement
            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $stmt->errorInfo()[2];
            }
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$conn = null;
