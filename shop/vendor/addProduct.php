<?php
session_start();

if (!isset($_SESSION['user'])) {
    header(('location: ../User/oldUser.php'));
    die();
}

$user = $_SESSION['user'];
$noProduct = true;

if (isset($_POST['submit'])) {
    include_once 'C:/xampp/htdocs/projects/e-commerce/User/db_conn.php';

    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "image/" . $filename;
    $uploadFolder = "../image/" . $filename;

    if (!is_dir("../image")) {
        mkdir("../image", 0777, true);
    }

    if (move_uploaded_file($tempname, $uploadFolder)) {
        $productName = $_POST["productName"];
        $productDescription = $_POST["productDescription"];
        $ProductPrice = $_POST["ProductPrice"];
        $searchkey = $_POST["searchkey"];

        $sql = "INSERT INTO `product` (`productName`, `productDescription`, `ProductPrice`, `searchkey`, `image`, `soldedBy`) 
                VALUES ('$productName', '$productDescription', '$ProductPrice', '$searchkey', '$folder', '$user')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<script type="text/javascript">';
            echo 'alert("product added succefully");';
            echo 'window.location.href = "/projects/e-commerce/shop/vendor/index.php";';
            echo '</script>';
        } else {
            die("Error adding product: " . mysqli_error($conn));
        }
    } else {
        die("Failed to move uploaded file.");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../MyStyle.css">
    <link rel="stylesheet" href="../CartWishlist/cartWishlist.css">
    <title>Add items</title>
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
            height: 32px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        ::placeholder {
            padding-left: 10px;
        }

        .fileBox {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 10px;
            width: 98%;
            color: rgb(120, 120, 120);
        }

        .button {
            padding: 10px 20px;
            background-color: #d9534f;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .button:hover {
            transform: scale(1.02);
        }

        /* product add section style start */

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

        .blabkCenter {
            width: 95%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 30px;
        }

        .blabkCenter div div img {
            height: 40vmin;
        }

        .blabkCenter div div {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }

        /* product add section style end */
    </style>
</head>

<body>
    <?php
    // include_once '.../Components/_navbar.php';
    ?>
    <div class="MainproductContainer" style="display: flex; align-items: center; justify-content: center; height: 95vh;">
    <div class="productContainer" style="max-width: 30vw;">
        <h2>Add products</h2>
        <form action="" method="POST" enctype="multipart/form-data" class="addProductForm">
            <input type="text" id="productName" placeholder="Product Name" name="productName" required>
            <input type="text" id="productDescription" placeholder="Product Description" name="productDescription">
            <input type="text" id="ProductPrice" placeholder="Product Price" name="ProductPrice" required>
            <input type="text" id="searchkey" placeholder="provide some search key" name="searchkey">
            <div class="fileBox">upload Image<input type="file" name="image" id="image" required></div>
            <button name="submit" class="button">Add Product</button>
        </form>
    </div>
    </div>
    <?php 
        // include_once '.../Components/_footer.php'; 
    ?>
</body>

</html>