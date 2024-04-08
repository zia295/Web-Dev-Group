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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deviceName = $_POST['device_name'];

    // Handle file upload (if a new image is provided)
    if (isset($_FILES["device_image"])) {
        $targetDir = "./image";
        $targetFile = $targetDir . basename($_FILES["device_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["device_image"]["tmp_name"]);
        if ($check === false) {
            $uploadOk = 0;
            $errorMessage = "File is not an image.";
        }

        // Check file size
        if ($_FILES["device_image"]["size"] > 500000) {
            $uploadOk = 0;
            $errorMessage = "Sorry, your file is too large.";
        }

        // Allow certain file formats
        if (!in_array($imageFileType, array("jpg", "jpeg", "png", "gif"))) {
            $uploadOk = 0;
            $errorMessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $errorMessage = "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload the new file
            if (move_uploaded_file($_FILES["device_image"]["tmp_name"], $targetFile)) {
                $deviceImageName = $_FILES["device_image"]["name"];
            } else {
                $errorMessage = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // If no new image is provided, use the existing image name
        $deviceImageName = $device['crypto_device_image_name'];
    }

    // Update the device information in the database
    $stmt = $conn->prepare("UPDATE crypto_device SET crypto_device_name = ?, crypto_device_image_name = ? WHERE crypto_device_id = ? AND fk_user_id = ?");
    $stmt->bindParam(1, $deviceName, PDO::PARAM_STR);
    $stmt->bindParam(2, $deviceImageName, PDO::PARAM_STR);
    $stmt->bindParam(3, $deviceId, PDO::PARAM_INT);
    $stmt->bindParam(4, $_SESSION['user_id'], PDO::PARAM_INT);

    if ($stmt->execute() === TRUE) {
        $successMessage = "Device updated successfully";
    } else {
        $errorMessage = "Error updating device: " . $stmt->error;
    }

    $stmt = null;

    // Redirect to the manage devices page after updating
    if (isset($successMessage)) {
        $_SESSION['success_message'] = $successMessage;
    } elseif (isset($errorMessage)) {
        $_SESSION['error_message'] = $errorMessage;
    }
    header("Location: manage_devices.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Device</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Device</h1>

    <form method="post" enctype="multipart/form-data">
        <label for="device_name">Device Name:</label>
        <input type="text" name="device_name" id="device_name" value="<?php echo $device['crypto_device_name']; ?>" required>

        <label for="device_image">Device Image:</label>
        <input type="file" name="device_image" id="device_image">
        <img src="./image/<?php echo $device['crypto_device_image_name']; ?>" alt="Current Device Image" width="100">

        <button type="submit">Update Device</button>
    </form>

    <a href="manage_devices.php">Back to Manage Devices</a>

    <script src="script.js"></script>
</body>
</html>