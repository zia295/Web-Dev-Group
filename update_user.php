<?php
include 'header.php';
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $userId = $_POST['id'];
        $nickname = $_POST['nickname'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        $stmt = $conn->prepare("UPDATE registered_user SET user_nickname = ?, user_name = ?, user_email = ? WHERE user_id = ?");
        $stmt->execute([$nickname, $name, $email, $userId]);
        $stmt = null;

        // Redirect to the user management page
        header("Location: manage_members.php");
        exit;
    }
}