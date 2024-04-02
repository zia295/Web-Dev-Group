<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: Login.html");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form inputs
    $deviceName = $_POST['device_name'];
    $deviceDescription = $_POST['device_description'];

    // Handle file upload (if an image is provided)
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
            // if everything is ok, try to upload file
            if (move_uploaded_file($_FILES["device_image"]["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($_FILES["device_image"]["name"])) . " has been uploaded.";
            } else {
                $errorMessage = "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Insert device information into the database (assuming you have a database connection)
    // Modify the database connection parameters as needed
    include 'DataBase.php';

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO crypto_device (fk_user_id, crypto_device_name, crypto_device_image_name, crypto_device_record_visible) VALUES (?, ?, ?, 1)");
    $stmt->bindParam(1, $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->bindParam(2, $deviceName, PDO::PARAM_STR);
    $stmt->bindParam(3, $_FILES["device_image"]["name"], PDO::PARAM_STR);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        $errorMessage = "Error: " . $stmt->error;
    }

    $stmt = null;
    $conn = null;

    // Redirect the user to a relevant page after processing
    if (isset($errorMessage)) {
        $_SESSION['error_message'] = $errorMessage;
    }
    header("Location: manage_devices.php");
    exit;
} else {
    // If the form is not submitted via POST method, redirect the user to the homepage
    header("Location: index.php");
    exit;
}
?>