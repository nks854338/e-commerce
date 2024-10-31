<?php
session_start();
if (isset($_POST["showproduct"])) {
    include_once '..\User\db_conn.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $product_id = $_POST["product_id"];

    // Prepare a statement to prevent SQL injection
    $selectResult = "SELECT * FROM product WHERE pno = $product_id";

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

        // Fetching the product details
        $proNo = $row['pno'];
        $productName = mysqli_real_escape_string($conn, $row['productName']);
        $productDescription = mysqli_real_escape_string($conn, $row['productDescription']);
        $ProductPrice = $row['ProductPrice'];
        $image = mysqli_real_escape_string($conn, $row['image']);
        $user = $_SESSION['user'];

        // Insert the product into the cart table
        $sql_insert = "INSERT INTO `cart` (`productName`, `productDescription`, `ProductPrice`, `image`, `pno`, `user`) 
                       VALUES ('$productName', '$productDescription', $ProductPrice, '$image', $proNo, '$user')";
        
        if ($conn->query($sql_insert) === TRUE) {
            header("location: showCart.php");
        } else {
            echo "Error inserting row: " . $conn->error;
        }
    } else {
        echo "No rows found in product table with ID: $product_id";
    }

    // Close connection
    $conn->close();
}
?>
