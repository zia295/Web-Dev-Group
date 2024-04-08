<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit;
}

// Include the database connection file
require_once 'DataBase.php';

// Get the event ID from the URL parameter
$event_id = isset($_GET['id']) ? $_GET['id'] : null;

// Delete the event from the database
if ($event_id) {
    $stmt = $conn->prepare("DELETE FROM event WHERE event_id = ?");
    $stmt->bindParam(1, $event_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: manage_events.php");
        exit;
    } else {
        echo "Something went wrong. Please try again.";
    }

    $stmt = null;
} else {
    header("Location: manage_events.php");
    exit;
}

$conn = null;
?>