<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin';

// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="php" href="test.php">
    <title>Home</title>
</head>
<body>
    <header class="header">
        <a href="./index.php" class="logo">
            <img src="./image/logo.jpg" alt="logo">
        </a>
        <nav class="navbar">
            <a href="./index.php" <?php if ($current_page == 'index.php') echo 'class="active"'; ?>>home</a>
            <a href="./about.php" <?php if ($current_page == 'about.php') echo 'class="active"'; ?>>about</a>
            <a href="./events.php" <?php if ($current_page == 'events.php') echo 'class="active"'; ?>>Events</a>
            <a href="./contact.php" <?php if ($current_page == 'contact.php') echo 'class="active"'; ?>>contact</a>
            <?php if ($isLoggedIn) : ?>
                <a href="./manage_devices.php" <?php if ($current_page == 'manage_devices.php') echo 'class="active"'; ?>>Devices</a>
                
            <?php endif; ?>
            <?php if ($isAdmin) : ?>
                <a href="./manage_events.php" <?php if ($current_page == 'manage_events.php') echo 'class="active"'; ?>>Manage Events</a>
            <?php endif; ?>
        </nav>

        <div class="auth">
            <?php if ($isLoggedIn) : ?>
                <span>Hello <?php echo $_SESSION['user_nickname']; ?></span>
                <a href="logout.php" class="logout">Logout</a>
            <?php else : ?>
                <a href="./register.html">register</a>
                <a href="./Login.html">login</a>
            <?php endif; ?>
        </div>
    </header>
