<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: Login.html");
    exit;
}

// Include the database connection file
include 'DataBase.php';

// Get the device ID from the query parameter
$deviceId = isset($_GET['id']) ? $_GET['id'] : null;

// Delete the device from the database
if ($deviceId) {
    $stmt = $conn->prepare("DELETE FROM crypto_device WHERE crypto_device_id = ? AND fk_user_id = ?");
    $stmt->bindParam(1, $deviceId, PDO::PARAM_INT);
    $stmt->bindParam(2, $_SESSION['user_id'], PDO::PARAM_INT);

    if ($stmt->execute() === TRUE) {
        $successMessage = "Device deleted successfully";
    } else {
        $errorMessage = "Error deleting device: " . $stmt->error;
    }

    $stmt = null;
}

// Redirect to the manage devices page after deletion
if (isset($successMessage)) {
    $_SESSION['success_message'] = $successMessage;
} elseif (isset($errorMessage)) {
    $_SESSION['error_message'] = $errorMessage;
}
header("Location: manage_devices.php");
exit;