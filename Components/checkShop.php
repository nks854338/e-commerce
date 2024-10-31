<?php
// Start session
// session_start();

// Include database connection
include_once __DIR__ . '/../User/db_conn.php';

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    // Query the database to check if the user has a shop
    $sql = "SELECT * FROM `shop` WHERE `user` = '$user'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    }

    // Store result in session
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['shopExists'] = true;  // Shop exists
    } else {
        $_SESSION['shopExists'] = false; // No shop exists
    }
}
