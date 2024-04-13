<?php
include 'header.php';
require_once 'Database.php';

// Query to fetch events from the database
$sql = "SELECT * FROM event";
$stmt = $conn->query($sql);

if ($stmt->rowCount() > 0) {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $result = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 
</head>
<body>
    <!-- -------------------------------------------PRODUCTS SECTION -->
    <section class="products" id="products">
        <h1 class="heading">our <span>Events</span></h1>
        <div class="box-container">
            <?php
            if (!empty($result)) {
                // Output data of each row
                foreach ($result as $row) {
                    echo '<div class="box">';
                    echo '<div class="box-head">';
                    echo '<span class="title">' . $row["event_name"] . '</span>';
                    echo '<br></br>';
                    echo '<a href="#" class="name">' . $row["event_venue"] . '</a>';
                    echo '</div>';
                    echo '<div class="image">';
                    echo '<img src="./image/event3.jfif" alt="' . $row["event_name"] . '">';
                    echo '</div>';
                    echo '<div class="box-bottom">';
                    echo '<div class="info">';
                    echo '<b class="date">' . $row["event_date"] . '</b>';
                    echo '</div>';
                    echo '<div class="product-btn">';
                    echo '<a href="./images/event1.jpg"></a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No events found.";
            }
            ?>
        </div>
    </section>
    <!-- -------------------------------------------PRODUCTS SECTION -->

    <!-- -------------------------------------------FOOTER SECTION -->
    <section class="footer">
        <footer>Zia Hassankhail, Kader Zamoulli, Muaaz Patel, Hassan Mojahed, Hassan Choudhry</footer>
    </section>
    <!-- -------------------------------------------FOOTER SECTION -->

    <script src="./script.js"></script>
</body>
</html>