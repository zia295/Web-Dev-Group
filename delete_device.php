<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit;
}

// Include the database connection file
require_once 'DataBase.php';

// Get the device ID from the URL parameter
$device_id = isset($_GET['id']) ? $_GET['id'] : null;

// Delete the device from the database
if ($device_id) {
    $stmt = $conn->prepare("DELETE FROM crypto_device WHERE crypto_device_id = ?");
    $stmt->bindParam(1, $device_id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        header("Location: manage_devices.php");
        exit;
    } else {
        echo "Something went wrong. Please try again.";
    }
    $stmt = null;
} else {
    header("Location: manage_devices.php");
    exit;
}

$conn = null;
?>