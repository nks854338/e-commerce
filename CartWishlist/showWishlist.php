<?php
session_start();
if(!isset($_SESSION['user'])){                    //cheak user is login or not for accessing this resource
    header(('location: ../User/oldUser.php'));
    die();
}

include_once '..\User\db_conn.php';
$user = $_SESSION['user'];
$q = "SELECT * FROM wishlist WHERE user = '$user'";
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
    <link rel="stylesheet" href="cartWishlist.css">
    <title>Wishlist</title>
</head>

<body>
    <?php
    include_once '../Components/_navbar.php';
    ?>

    <div class="cartsection">
        <div class="cartHeadingBox">
            <div class="cartHeading">My Wishlist</div>
        </div>
        <div id="productLists">
            <?php if ($noProduct) { ?>
                <div class='emptyCartDiv' id='emptyCartDiv' style="display: flex; align-items: center;
                 justify-content: center; flex-direction: column; min-width: 90vw;">
                    <div>
                        <img src='../image/empty-wishlist.png'>
                        <div class='blankProductSection'>Currently no any Item is present</div>
                    </div>
                </div>
            <?php } else { ?>
                <?php
                if ($show = "1") {
                    while ($x = mysqli_fetch_array($result)) {
                        echo "
             <div class='wishlistCards'>
        <div class='wishlistProductImage'>
          <img
            src='../$x[3]'
            alt=''
            class='img'
          />
        </div>
        <div class='wishlistProductInfoBox'>
          <div class='wishlistProductInfo'>
            <div class='wishListProductName'>$x[1]</div>
            <div class='displayedProductPrice'>
                                            <span class='currProductPrice'>₹$x[4]</span>
                                            <span class='previousProductPrice'>₹1000</span>
                                            <span class='ProductOffer' span>(50%OFF)</span>
                                        </div>
            <div class='wishCartBtns'>
              <button class='wishCartBtn wishCartBuyNowBtn'>Move to cart</button>
              <button class='wishCartBtn wishCartRemoveBtn'><a href='removeFromWishlist.php?pno=$x[0]'>Remove</a></button>
            </div>
          </div>
        </div>
      </div>
            ";
                    }
                }
                ?>
            <?php } ?>
        </div>
    </div>
    <?php
    include_once '../Components/_footer.php';
    ?>

</body>

</html>