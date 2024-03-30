<?php
include 'DataBase.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nickname = $_POST["nickname"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $filtered_nickname = filter_var($nickname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $filtered_name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $filtered_email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $validated_email = filter_var($filtered_email, FILTER_VALIDATE_EMAIL);

    if ($password != $confirm_password) {
        echo "Error: Passwords do not match.";
    } elseif (!$validated_email) {
        echo "Error: Invalid email format.";
    } else {
        try {
            // Check if the email is already registered
            $checkEmailSql = "SELECT * FROM registered_user WHERE user_email = :email";
            $checkEmailStmt = $conn->prepare($checkEmailSql);
            $checkEmailStmt->bindParam(':email', $validated_email);
            $checkEmailStmt->execute();

            if ($checkEmailStmt->rowCount() > 0) {
                echo "Error: Email already registered.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $defaultRoleId = 1; 

                $sql = "INSERT INTO registered_user (user_nickname, user_name, user_email, user_hashed_password, fk_role_id) VALUES (:nickname, :name, :email, :hashed_password, :role_id)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nickname', $filtered_nickname);
                $stmt->bindParam(':name', $filtered_name);
                $stmt->bindParam(':email', $validated_email);
                $stmt->bindParam(':hashed_password', $hashed_password);
                $stmt->bindParam(':role_id', $defaultRoleId);

                if ($stmt->execute()) {
                    // Redirect to a success page
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Error: Registration failed.";
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
