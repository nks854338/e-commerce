<?php
// Connect to the database
include_once 'C:/xampp/htdocs/projects/e-commerce/User/db_conn.php';

if (isset($_GET["pno"])) {
    $productNumber = (int) $_GET["pno"];
    // Fetch product details to display in the form
    $q = "SELECT * FROM product WHERE pno = '$productNumber'";
    $result = mysqli_query($conn, $q);
    $cnt = mysqli_num_rows($result);
    if ($cnt == 0) {
        $noProduct = true;
    } else {
        $noProduct = false;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get updated data from the form
    $productName = mysqli_real_escape_string($conn, $_POST["productName"]);
    $productDescription = mysqli_real_escape_string($conn, $_POST["productDescription"]);
    $productPrice = mysqli_real_escape_string($conn, $_POST["ProductPrice"]);
    $searchKey = mysqli_real_escape_string($conn, $_POST["searchkey"]);

    // Update the product details in the database (excluding image)
    $updateQuery = "UPDATE product SET 
                        `productName` = '$productName', 
                        `productDescription` = '$productDescription', 
                        `ProductPrice` = '$productPrice', 
                        `searchkey` = '$searchKey'
                    WHERE pno = '$productNumber'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "Product updated successfully!";
        // Optionally redirect the user to another page
        header("Location: /projects/e-commerce/shop/vendor/index.php");
        exit();
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .addProductForm input[type="text"] {
            height: 32px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        ::placeholder {
            padding-left: 10px;
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
    </style>
    <title>Edit Product</title>
</head>
<body>
<div class="MainProductContainer" style="display: flex; align-items: center; justify-content: center; height: 95vh;">
<div class="productContainer"  style="max-width: 25vw;">
    <h2>Edit Product</h2>
    <?php 
    if (isset($noProduct) && !$noProduct) {
        while ($product = mysqli_fetch_array($result)) {
            ?>
            <form action="" method="POST" class="addProductForm">
                <input type="text" id="productName" name="productName" value="<?= htmlspecialchars($product['productName']) ?>" required>
                <input type="text" id="productDescription" name="productDescription" value="<?= htmlspecialchars($product['productDescription']) ?>">
                <input type="text" id="ProductPrice" name="ProductPrice" value="<?= htmlspecialchars($product['ProductPrice']) ?>" required>
                <input type="text" id="searchkey" name="searchkey" value="<?= htmlspecialchars($product['searchkey']) ?>">
                <button name="submit" class="button">Edit</button>
            </form>
            <?php
        }
    } else {
        echo "<p>No product found.</p>";
    }
    ?>
</div>
</body>
</html>
