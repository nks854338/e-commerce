<?php
session_start();

if(!isset($_SESSION['user'])){                   
    header(('location: ../User/oldUser.php'));
    die();
}

$user = $_SESSION['user'];

if (isset($_POST['submit'])) {
    include_once '../User/db_conn.php'; 

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
            echo 'alert("Shop created succefully");';
            echo 'window.location.href = "vendor.php";';
            echo '</script>';
        } else {
            die("Error adding product: " . mysqli_error($conn));
        }
    } else {
        die("Failed to move uploaded file.");
    }
}

include_once '..\User\db_conn.php';
$q = "SELECT * FROM product WHERE soldedBy = '$user'";
$result = mysqli_query($conn, $q);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$cnt = mysqli_num_rows($result);
if ($cnt == 0) {
    $noProduct = true;
} else {
    $noProduct = false;
}

// mysqli_close($conn);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="mainCartbox">
<div class='cartLeft'>
                    <div class='cartItems'>
                        <?php
                        // Fetch all the products for display
                        $q = "SELECT * FROM product WHERE user = '$user'";
                        $result = mysqli_query($conn, $q);
                        while ($x = mysqli_fetch_array($result)) {
                            ?>
                            <div class='cartItem'>
                                <div class='cartContent'>
                                    <div class='cartItemleft'><img src='../<?php echo $x[4]; ?>' alt='' /></div>
                                    <div class='cartItemRight'>
                                        <div class='cartItemRight1'><?php echo $x[1]; ?></div>
                                        <div class='displayedProductPrice'>
                                            <span class='currProductPrice'>₹<?php echo $x[3]; ?></span>
                                            <span class='previousProductPrice'>₹1000</span>
                                            <span class='ProductOffer' span>(50%OFF)</span>
                                        </div>
                                        <div class='cartItemRight3'>
                                            Sold by: Seneh Sangrah Private Limited
                                        </div>
                                        <div class='cartItemRight4'>
                                            <label for='quantitySelect'>Quantity:</label>
                                            <select id='quantitySelect' name='quantity'
                                                onchange="updateCart(<?php echo $x[0]; ?>, this.value, <?php echo $x[3]; ?>)">
                                                <?php
                                                for ($i = 1; $i <= 10; $i++) {
                                                    $selected = ($i == 1) ? "selected" : ""; // Default quantity is set to 1
                                                    echo "<option value='$i' $selected>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class='cartItemRight5 productPrice' id="price_<?php echo $x[0]; ?>">
                                            ₹<?php echo $x[3]; ?></div> <!-- Default price for 1 item -->
                                    </div>
                                </div>
                                <div class='cartRemove'>
                                    <button>
                                        <a href='removeFromCart.php?pno=<?php echo $x[0]; ?>'>
                                            <img src='../image/x_mark.png' height='18px' alt='' />
                                        </a>
                                    </button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="cartRight">
                <div class="productContainer">
        <h2>Add products</h2>
        <form action="vendor.php" method="POST" enctype="multipart/form-data" class="addProductForm">
            <input type="text" id="productName" placeholder="Product Name" name="productName" required>
            <input type="text" id="productDescription" placeholder="Product Description" name="productDescription">
            <input type="text" id="ProductPrice" placeholder="Product Price" name="ProductPrice" required>
            <input type="text" id="searchkey" placeholder="provide some search key" name="searchkey">
            <div class="fileBox">upload Image<input type="file" name="image" id="image" required></div>
            <button name="submit" class="button">Add Product</button>
        </form>
    </div>
                </div>
</div>
</body>
</html>