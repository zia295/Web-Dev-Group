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
  <div class="view-device-container">
    <div class="view-device-details">
      <h2 class="event-name"><?php echo $event['event_name']; ?></h2>
      <p><strong>Date:</strong> <span class="event-date"><?php echo $event['event_date']; ?></span></p>
      <p><strong>Venue:</strong> <span class="event-venue"><?php echo $event['event_venue']; ?></span></p>
      <a href="manage_events.php" class="btn">Back to Events</a>
    </div>
  </div>
</body>
</html>