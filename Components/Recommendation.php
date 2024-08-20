<?php                                           //this script is for rendering cards
session_start();

include_once '..\User\db_conn.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$q = "SELECT * FROM producttype";
$result = mysqli_query($conn, $q);

$cnt = mysqli_affected_rows($conn);
if ($cnt == 0) {
    $noProduct = true;
} else {
    $noProduct = false;
}

?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styled.css">
    <title>Recommendation</title>
</head>
<body>
<div class="firSecComp2">
                    <?php
                    if (!$noProduct) {
                        $skip = 8;
                        $count = 0;
                        while ($x = mysqli_fetch_array($result)) {
                            if ($count < $skip) {
                                echo "<div class='firSecBox1 firSecBox'>
                                    <form method='post' action='index.php'>
                                        <input type='hidden' name='product_id' value='{$x[0]}'>
                                        <button type='submit' id='' name='search' style='all: unset; cursor: pointer;'>      
                        <div class='image'>
                            <a href='index.php'><img src='D:\download\image\e-commerce\2-1-300x300.jpg' alt='' class='proImg' height='100%' style='border-radius: 50%;'></a>
                            <img src='D:\download\image\e-commerce\2-1-300x300.jpg' alt='' class='proImg' height='100%' style='border-radius: 50%;'>
                        </div>
                        <p class='proNam'>{$x[1]}</p>
                        <img src='D:\download\image\e-commerce\2-1-300x300.jpg' alt='' class='proImg' height='100%' style='border-radius: 50%;'>
                          </button>
                        </form>
                      </div>";
                            }
                            $count++;
                        }
                    }
                    ?>
                </div>
</body>
</html>