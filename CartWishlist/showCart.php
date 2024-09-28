<?php
session_start();

include_once '..\User\db_conn.php';

$q = "select * from cart";

$show = "0";

$result = mysqli_query($conn, $q);

$cnt = mysqli_affected_rows($conn);
if ($cnt == 0) {
    $noProduct = true;
} else {
    $noProduct = false;
    $show = "1";
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
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../MyStyle.css">
    <title>Cart</title>
</head>

<body>
    <?php
    include_once '../Components/_navbar.php'; // path for navbar
    ?>

    <div id="wishlistHeading" class="wishlistHeading">
        My cart
    </div>
    <div id="productLists">
        <?php
        if ($noProduct == true) {
            echo "<div class='emptyCartDiv'><img src='../image/empty-cart.png'></div>";
        }
        ?>
        <?php
        if ($show == "1") {
            while ($x = mysqli_fetch_array($result)) {
                echo "
             <div class='wishlistCards'>
        <div class='wishlistProductImage'>
          <img
            src='../$x[4]'
            alt=''
            class='img'
          />
        </div>
        <div class='wishlistProductInfoBox'>
          <div class='wishlistProductInfo'>
            <div class='wishListProductName'>$x[1]</div>
            <div class='wishlistProductPrice'>₹$x[3]</div>
            <div class='wishCartBtns'>
            <button class='wishCartBtn wishCartBuyNowBtn'>Buy Now</button>
            <button class='wishCartBtn wishCartRemoveBtn'><a href='removeFromCart.php?pno=$x[0]'>Remove</a></button>
            </div>
          </div>
        </div>
      </div>
            ";
            }
        }
        ?>
    </div>

    <div class="wishlistSuggessionHeading wishlistHeading">
        <!-- Suggested searches -->
    </div>

    <div class="firSecComp2 wishlistSuggession">
        <?php
        // include_once '../Components/_suggestedProduct.php'; 
        ?>
    </div>
    <?php
    include_once '../Components/_footer.php'; // path to _footer.php
    ?>
</body>

</html>