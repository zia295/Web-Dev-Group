<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password are provided
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        // Include your database connection file
        require_once "DataBase.php";

        // Get user input
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Prepare and execute SQL statement to check login credentials
        $sql = "SELECT * FROM registered_user WHERE user_email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify if user exists and password matches
        if ($user && password_verify($password, $user['user_hashed_password'])) {
            // Redirect to dashboard upon successful login
            header("Location: index.html");
            exit;
        } else {
            // Redirect back to login page with error message
            header("Location: Login.html?error=1");
            exit;
        }
    }
}
?>
