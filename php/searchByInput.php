<?php

if (isset($_POST['input'])) {
    include_once '../User/db_conn.php';
    $inputData = $_POST['inputData'];
    if($inputData==""){
         $noInput = true;  
    }
    else{
    $q = "SELECT * FROM `product` WHERE `productName` like '%$inputData%' || `searchkey` like '%$inputData%'";
    $output = mysqli_query($conn, $q);
    $numOfRow = mysqli_affected_rows($conn);

    if (!$output) {
        die("Query failed: " . mysqli_error($conn));
    }

    if ($numOfRow == 0) {
        $noInput = true;            //this varibale is used to render the cards in searchProcuts page
    } else {
        $noInput = false;
    }
}
}

?>
