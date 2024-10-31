<?php
if (isset($_GET["pno"])) {
    include_once 'C:/xampp/htdocs/projects/e-commerce/User/db_conn.php';

    $result = (int) $_GET["pno"];
    echo "product id is : $result" ;
    echo "$result<br>";
    echo gettype($result);
    $sql = "delete from product where pno=$result";
    $res = mysqli_query($conn, $sql) or die("error in query" . mysqli_error($conn));
    echo "$res<br>";
    $cnt = mysqli_affected_rows($conn);
    echo "$cnt<br>";
    mysqli_close($conn);
    if ($cnt >= 1) {
        header("location:/projects/e-commerce/shop/vendor/index.php");
    } else {
        echo "try again";
    }
}
?> 

