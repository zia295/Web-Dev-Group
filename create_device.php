<?php
include 'header.php';


// Check if the user is logged in
if (!$isLoggedIn) {
    // Redirect the user to the login page if not logged in
    header("Location: Login.html");
    exit;
}

$page_header = <<< HEADER
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add Device</title>
</head>
HEADER;

echo $page_header;
?>

<body>


    <section class="add-device">
        <h2>Add Device</h2>
        <form class ="form-controll"  action = "createDeviceController.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="device_name">Device Name:</label>
                <input type="text" id="device_name" name="device_name" required>
            </div>
            <div class="form-group">
                <label for="device_description">Description:</label>
                <textarea id="device_description" name="device_description" required></textarea>
            </div>
            <div class="form-group">
                <label for="device_image">Image:</label>
                <input type="file" id="device_image" name="device_image" required accept="image/*">
            </div>
            <button type="submit">Submit</button>
        </form>
    </section>

    <?php
    $page_footer = <<< FOOTER
    <section class="footer">
        <footer>
            Zia Hassankhail, Kader Zamoulli, Muaaz Patel, Hassan Mojahed, Hassan Choudhry
        </footer>
    </section>

    <script src="./script.js"></script>
</body>
</html>
FOOTER;

echo $page_footer;
?>
