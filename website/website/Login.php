<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        require_once "DataBase.php";
        $email = $_POST["email"];
        $password = $_POST["password"];

    
        $sql = "SELECT u.*, r.role_name
                FROM registered_user u
                JOIN roles r ON u.fk_role_id = r.role_id
                WHERE u.user_email = :email";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['user_hashed_password'])) {
            $userRole = $user['role_name'];
            $userId = $user['user_id'];
            $userNickname = $user['user_nickname'];

            // Set session variables
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_nickname'] = $userNickname;
            $_SESSION['user_role'] = $userRole;

            // Redirect to the appropriate page
            header("Location: index.php");
            exit;
        } else {
            header("Location: Login.html?error=1");
            exit;
        }
    }
}
