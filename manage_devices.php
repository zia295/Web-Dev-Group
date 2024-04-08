<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: Login.html");
    exit;
}

// Include the database connection file
include 'DataBase.php';

// Fetch the user's devices from the database
$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM crypto_device WHERE fk_user_id = ?");
$stmt->bindParam(1, $userId, PDO::PARAM_INT);
$stmt->execute();
$devices = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Devices</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Manage Devices</h1>

    <a href="create_device.php">Add New Device</a>

    <table>
        <thead>
            <tr>
                <th>Device Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($devices as $device) : ?>
                <tr>
                    <td><?php echo $device['crypto_device_name']; ?></td>
                    <td><img src="./image/<?php echo $device['crypto_device_image_name']; ?>" alt="Device Image" width="100"></td>
                    <td>
                        <a href="view_device.php?id=<?php echo $device['crypto_device_id']; ?>" target="_blank">View</a>
                        <a href="edit_device.php?id=<?php echo $device['crypto_device_id']; ?>" target="_blank">Edit</a>
                        <a href="delete_device.php?id=<?php echo $device['crypto_device_id']; ?>" onclick="return confirm('Are you sure you want to delete this device?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="script.js"></script>
</body>
</html>