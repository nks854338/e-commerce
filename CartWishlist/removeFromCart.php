<?php
if (isset($_GET["pno"])) {
    include_once '../User/db_conn.php';

    $result = (int) $_GET["pno"];
    echo "$result<br>";
    echo gettype($result);
    $sql = "delete from cart where cartNo=$result";
    $res = mysqli_query($conn, $sql) or die("error in query" . mysqli_error($conn));
    echo "$res<br>";
    $cnt = mysqli_affected_rows($conn);
    echo "$cnt<br>";
    mysqli_close($conn);
    if ($cnt >= 1) {
        header("location:showCart.php");
    } else {
        echo "try again";
    }
}
?> 
