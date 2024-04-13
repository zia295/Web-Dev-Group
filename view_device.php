<?php
include 'header.php';
// Include the database connection file
include 'DataBase.php';

// Get the device ID from the query parameter
$deviceId = isset($_GET['id']) ? $_GET['id'] : null;

// Fetch the device details from the database
if ($deviceId) {
    $stmt = $conn->prepare("SELECT * FROM crypto_device WHERE crypto_device_id = ? AND fk_user_id = ?");
    $stmt->bindParam(1, $deviceId, PDO::PARAM_INT);
    $stmt->bindParam(2, $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $device = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;
}

if (!$device) {
    // Redirect to the manage devices page if the device ID is invalid or doesn't belong to the user
    header("Location: manage_devices.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<body>
  <div class="view-device-container">
    <div class="view-device-details">
      <h2><?php echo $device['crypto_device_name']; ?></h2>
      <img src="./image/<?php echo $device['crypto_device_image_name']; ?>" alt="Device Image">
      <p>Registered on: <?php echo $device['crypto_device_registered_timestamp']; ?></p>
      <a href="manage_devices.php">Back to Manage Devices</a>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>