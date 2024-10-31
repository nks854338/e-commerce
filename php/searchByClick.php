<?php                                            //this script is for search

if (isset($_POST['search'])) {
    include_once '../User/db_conn.php';
    $product_id = $_POST['product_id'];

    $sql = "SELECT * FROM `producttype` WHERE `sno`='$product_id'";
    $r = mysqli_query($conn, $sql);

    if ($r) {
        $array = mysqli_fetch_array($r);
        $name = $array['productName'];
    }

    $q = "SELECT * FROM `product` WHERE `productName` like '%$name%' || `searchkey` like '%$name%'";
    $output = mysqli_query($conn, $q);
    $numOfRow = mysqli_affected_rows($conn);

    if (!$output) {
        die("Query failed: " . mysqli_error($conn));
    }

    if ($numOfRow == 0) {
        $noSearch = true;                 //this varibale is used to render the cards on Home page
    } else {
        $noSearch = false;
    }
}

?>