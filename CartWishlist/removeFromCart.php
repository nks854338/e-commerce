<?php
if (isset($_GET["pno"])) {
    include_once '../User/db_conn.php';

    $result = $_GET["pno"];
    echo "$result<br>";
    $sql = "delete from cart where pno=$result";
    $res = mysqli_query($conn, $sql) or die("error in query" . mysqli_error($conn));
    echo "$res";
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

