<?php
session_start();

$noProduct = true;
if (isset($_POST['submit'])) {

    //db_connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "e_commerce";

    $conn = new mysqli($servername, $username, $password, $database);

    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"]; // Corrected typo
    $folder = "upload/" . $filename;
    move_uploaded_file($tempname, $folder);

    $productName = $_POST["productName"];
    $productDescription = $_POST["productDescription"];
    $ProductPrice = $_POST["ProductPrice"];


    $sql = "INSERT INTO `product` (`productName`, `productDescription`,`ProductPrice`, `image`) VALUES ('$productName', '$productDescription', '$ProductPrice', '$folder')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // alert('product added successfully');
    } else {
        // alert('some error is occured try again');
    }
    $conn->close();

}


?>






<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "e_commerce";
$conn = new mysqli($servername, $username, $password, $database);
$q = "select * from product";

$show = "0";

$result = mysqli_query($conn, $q);

$cnt = mysqli_affected_rows($conn);
if ($cnt == 0) {
    $noProduct = true;
} else {
    $noProduct = false;
    $show = "1";
    // echo "No Member Found";
}

mysqli_close($conn);
?>









<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Add items</title>
    <title>Todo List with Product Information</title>
    <style>
        /* Basic styling */
        * {
            margin: 0;
            padding: 0;
            text-decoration: none;
        }

        .productContainer {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.925);
        }

        .productContainer h2 {
            font-size: 30px;
            margin: 5px;
        }

        .addProductForm input[type="text"],
        .fileBox {
            width: calc(100% - 80px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .fileBox {
            display: flex;
            justify-content: space-between;
            color: rgb(120, 120, 120);
        }

        .button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #0056b3;
        }

        /* product add section style start */

        .blankProductSection {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #eeecec;
            border-radius: 20px;
            box-shadow: 0px 0px 15px gray;
            width: fit-content;
            padding: 15px;
            margin: auto;
            font-size: 30px;
        }

        #productList {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin: auto;
        }

        .todoList {
            height: 65vmin;
            width: 48vmin;
            border-radius: 10px;
            background-color: #ffffff;
            border: 3px solid black;
            margin: 1vmin;
            margin-bottom: 2vmin;
            padding: 5px 10px 10px 10px;
            background-size: cover;
            display: inline-block;
            justify-content: space-between;
        }

        .todoList:hover {
            transform: scale(1.02);
            box-shadow: 8px 10px 0px rgba(108, 107, 107, 0.604);
        }

        .todoList .productInfo {
            height: 20%;
            text-align: center;
        }


        .todoList .productInfo h3 {
            margin: 5px;
            font-size: 28px;
        }

        .todoList .productInfo p {
            font-size: 15px;
        }


        .todoList .productImage {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 45vmin;
            height: 65%;
        }

        .todoList .productImage img {
            max-width: 100%;
            height: 100%;
        }

        .todoList .productPriceInfo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 15%;
        }

        .productPriceInfo .price {
            font-size: 20px;
            font-weight: bold;
        }

        .productPriceInfo .deleteBtn {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 35px;
            width: 120px;
            border: 2px solid black;
            color: black;
            background-color: transparent;
            border-radius: 15px;
        }

        .productPriceInfo .deleteBtn a {
            color: black;
            font-weight: 600;
            font-size: 14px;
        }

        .productPriceInfo .deleteBtn:hover {
            background-color: #d9534f;
            color: #ffffff;
            box-shadow: 0px 3px 1px gray;
            transform: scale(0.9);
        }

        /* product add section style end */
    </style>
</head>

<body>
    <?php
    include_once ('_navbar.php');
    ?>
    <div class="productContainer">
        <h2>Add products</h2>
        <form action="vendor.php" method="POST" enctype="multipart/form-data" class="addProductForm">
            <input type="text" id="productName" placeholder="Product Name" name="productName" required>
            <input type="text" id="productDescription" placeholder="Product Description" name="productDescription">
            <input type="text" id="ProductPrice" placeholder="Product Price" name="ProductPrice" required>
            <div class="fileBox">upload Image<input type="file" name="image" id="image" required></div>
            <button name="submit" class="button">Add Product</button>
        </form>
    </div>
    <?php
    if ($noProduct == true) {
        echo '<div class="blankProductSection">Currently no any Item is present</div>';
    }
    ?>
    <div id="productList">
        <?php
        if ($show = "1") {
            while ($x = mysqli_fetch_array($result)) {
                echo "
            <div class='todoList'>
                <div class='productInfo'>
                    <h3>$x[1]</h3>
                    <p>$x[2]</p>
                 </div>
                <div class='productImage'>
                    <img src='$x[4]' class='productimg'>
                </div>
               <div class='productPriceInfo'>
                    <div class='price'>$$x[3]</div>
                    <button class='deleteBtn'><a href='delete.php?pno=$x[0]'>Delete Item</a></button>
                </div>
            </div>";
            }
        }

        ?>
    </div>
    <?php
    include_once ('_footer.php');
    ?>
</body>

</html>