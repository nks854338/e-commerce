<?php
session_start();                                  //this script is for showing full profile of user or product and dedirecting to regPickerProfile.php
if (isset($_POST['showproduct'])) {
  include_once '../User/db_conn.php';
  $product_id = $_POST['product_id'];

  $q = "SELECT * FROM product where pno=$product_id";
  $result = mysqli_query($conn, $q);

  $cnt = mysqli_affected_rows($conn);
  if ($cnt == 0) {
    $noProduct = true;
  } else {
    $noProduct = false;
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="../profile.css" />
  <title>Document</title>
</head>

<body>
  <?php
    include_once('../Components/_navbar.php');
  ?>
  <main>
    <div class="SingleproductDetailsContainer">
      <?php

      if (!$noProduct) {
        while ($x = mysqli_fetch_array($result)) {
          echo "
    
    <div class='SingleProductBox'>
      <div class='SingleProfileImageBox'>
        <div class='SingleProfileImage'>
          <img src='../$x[3]' height=' alt=' />
        </div>
      </div>
      <div class='SingleproductDetailsBox'>
        <div class='SingleproductDetailsInfoBox1 SingleproductDetailsInfoBox'>
          <div class='SingleproductDetailsName'>$x[1]</div>
          <div class='SingleproductDetailsDescpration'>
            $x[2]
          </div>
          <div class='SingleproductDetailsRatingBox'>
            <span><img src='image/rate.jpg' alt='' height='40px' /></span>
            <span><i class='fa-regular fa-star'></i></span>
            <span><i class='fa-regular fa-star'></i></span>
            <span><i class='fa-regular fa-star'></i></span>
            <span><i class='fa-regular fa-star'></i></span>
            <span><i class='fa-regular fa-star'></i></span>
          </div>
        </div>
        <hr />
        <div class='SingleproductDetailsInfoBox2 SingleproductDetailsInfoBox'>
          <div class='SingleproductDetailsPriceBox'>
            <div class='SingleproductDetailsPrice'>
              <span class='SinglecurrProductPrice currProductPrice'>₹$x[4]</span>
              <span class='SinglepreviousProductPrice previousProductPrice'>₹.1000</span>
              <span class='SingleProductOffer ProductOffer'>(50%OFF)</span>
            </div>

            <div class='SingleproductDetailsTax'>inclusive of all taxes</div>

            <div class='SingleproductDetailsSizeInfo'>
              <div class='SingleproductDetailsSizeHeading'>SELECT SIZE</div>
              <div class='SingleproductDetailsSizeButton'>
                <button class='SingleproductDetailsSizeBtn'>Onesize</button>
              </div>
            </div>
            <div class='SingleproductDetailsButtons'>
             <div class='SingleproductDetailsBuyNow'>
                <form method='post' action=''>
                   <input type='hidden' name='product_id' value='{$x[0]}'>
                   <button type='submit' name='showproduct' style='all: unset; cursor: pointer; min-width: 100%;'>
                     <div class='SingleproductDetailsBuyNowBtn' style=' display: flex; align-items: center; justify-content: center;'>Buy It Now</div>
                    </button>
                </form>
              </div>
              <div class='SingleproductDetailsBuyNow'>
               <form method='post' action='../CartWishlist/addToCart.php'>
                 <input type='hidden' name='product_id' value='{$x[0]}'>
                   <button type='submit' name='showproduct' style='all: unset; cursor: pointer; min-width: 100%;'>
                      <div class='SingleproductDetailsCartBtn' style=' display: flex; align-items: center; justify-content: center;'>Add to cart</div>
                   </button>
                </form>
              </div>
              <div class='SingleproductDetailsBuyNow'>
                <form method='post' action='../CartWishlist/addToWishlist.php'>
                   <input type='hidden' name='product_id' value='{$x[0]}'>
                   <button type='submit' name='showproduct' style='all: unset; cursor: pointer; min-width: 100%;'>
                     <div class='SingleproductDetailswishlistBtn' style=' display: flex; align-items: center; justify-content: center;'>
                      <i class='fa-solid fa-heart' style='color: #c1121f;'></i> Add to Wishlist
                     </div>
                   </button>
                </form>
              </div>
            </div>
          </div>
          <div class='SingleproductDetailsDescpration'></div>
          <div class='SingleproductDetailsRatingBox'></div>
        </div>
        <hr />
        <div class='SingleproductDetailsInfoBox3 SingleproductDetailsInfoBox'>
          <div class='SingleproductDetailsName'></div>
          <div class='SingleproductDetailsDescpration'></div>
          <div class='SingleproductDetailsRatingBox'></div>
        </div>
        <hr />
      </div>
    </div>
    
    ";
        }
      }

      ?>

    </div>
  </main>
  <?php
  include_once('../Components/_footer.php');
  ?>
</body>

</html>