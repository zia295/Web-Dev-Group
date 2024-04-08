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
    <header class="header">
        <a href="./index.php" class="logo">
            <img src="./image/logo.jpg" alt="logo">
        </a>
        <nav class="navbar">
            <a href="./index.php">home</a>
            <a href="./about.html">about</a>
            <a href="./events.html">Events</a>
            <a href="./contact.html">contact</a>
        </nav>

        <div class="auth">
            <span>Hello <?php echo $_SESSION['user_nickname']; ?></span>
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </header>

    <section class="add-device">
        <h2>Add Device</h2>
        <form action="process-device.php" method="post" enctype="multipart/form-data">
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
