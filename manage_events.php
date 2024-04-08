<?php
include 'header.php';

// Include the database connection file
require_once 'DataBase.php';

// Fetch all events from the database
$stmt = $conn->prepare("SELECT * FROM event");
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Manage Events</h1>
    <a href="create_event.php">Create New Event</a>

    <?php if (!empty($events)) : ?>
        <table>
        <thead>
    <tr>
        <th>Event Name</th>
        <th>Event Date</th>
        <th>Event Venue</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($events as $event) : ?>
        <tr>
            <td><?php echo $event['event_name']; ?></td>
            <td><?php echo $event['event_date']; ?></td>
            <td><?php echo $event['event_venue']; ?></td>
            <td>
                <a href="view_event.php?id=<?php echo $event['event_id']; ?>">View</a>
                <a href="edit_event.php?id=<?php echo $event['event_id']; ?>">Edit</a>
                <a href="delete_event.php?id=<?php echo $event['event_id']; ?>" onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
        </table>
    <?php else : ?>
        <p>No events found.</p>
    <?php endif; ?>

    <script src="script.js"></script>
</body>
</html>