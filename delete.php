<?php
if (isset($_GET["pid"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "e_commerce";
    $result = $_GET["pno"];
    echo "$result.<br>";
    $conn = new mysqli($servername, $username, $password, $database);
    $sql = "delete from product where pno='$result'";
    $result = $_GET["pid"];
    echo "$result.<br>";
    mysqli_close($conn);
    if ($cnt >= 1) {
        header("location:vendor.php");
    } else {
        echo "try again";
    }
}
?>