<?php
include 'header.php';

// Include the database connection file
require_once 'DataBase.php';

// Get the event ID from the URL parameter
$event_id = isset($_GET['id']) ? $_GET['id'] : null;

// Fetch the event details from the database
if ($event_id) {
    $stmt = $conn->prepare("SELECT * FROM event WHERE event_id = ?");
    $stmt->bindParam(1, $event_id, PDO::PARAM_INT);
    $stmt->execute();
    $event = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;
} else {
    header("Location: manage_events.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>View Event</h1>
    <?php if ($event) : ?>
        <div class="event-details">
            <h2><?php echo $event['event_name']; ?></h2>
            <p><strong>Date:</strong> <?php echo $event['event_date']; ?></p>
            <p><strong>Venue:</strong> <?php echo $event['event_venue']; ?></p>
        </div>
        <a href="manage_events.php" class="btn btn-secondary">Back to Events</a>
    <?php else : ?>
        <p>Event not found.</p>
    <?php endif; ?>
</body>
</html>