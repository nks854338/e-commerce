<?php
session_start();
if (isset($_POST["showproduct"])) {
    include_once '..\User\db_conn.php';
    $product_id = $_POST["product_id"];

    $selectResult = "SELECT * FROM product WHERE pno=$product_id";

    $result = mysqli_query($conn, $selectResult);

    $cnt = mysqli_affected_rows($conn);
    if ($cnt == 0) {
      echo "No product found with the given ID";
    } else {
        echo "Product found<br>";
    }

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the row data
        $row = mysqli_fetch_array($result);
        echo "success<br>";

        $proNo = $row['pno'];
        $productName = $row['productName'];
        $productDescription = $row['productDescription'];
        $ProductPrice = $row['ProductPrice'];
        $image = mysqli_real_escape_string($conn, $row['image']);
        $user = $_SESSION['user'];
        $sql_insert = "INSERT INTO `wishlist` (`productName`, `productDescription`, `ProductPrice`, `image`, `pno`, `user`) VALUES ('$productName', '$productDescription', $ProductPrice, '$image', $proNo, '$user')";
        
        if ($conn->query($sql_insert) === TRUE) {
            echo "Row inserted successfully into wishlist";
            header("location: showWishlist.php");
        } else {
            echo "Error inserting row: " . $conn->error;
        }
    } else {
        echo "No rows found in product table with ID: $product_id";
    }

    $conn->close();
}
?>





















<?php
// if (isset($_POST["pno"])) {

//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $database = "e_commerce";

//     $selectResult = $_POST["pno"];
//     echo"$result.<br>";
//     $conn = new mysqli($servername, $username, $password, $database);
//     $sql = "delete from product where pno='$result'";
//     $res = mysqli_query($conn, $sql) or die("error in query" . mysqli_error($conn));
//     $cnt = mysqli_affected_rows($conn);
//     echo "$cnt.<br>";
//     mysqli_close($conn);
//     if ($cnt >= 1) {
//         header("location:vendor.php");
//     } else {
//         echo "try again";
//     }
// }
?>