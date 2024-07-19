<!-- <?php                                      //this script is for showing full profile of user or product and dedirecting to regPickerProfile.php
if (isset($_POST['showproduct'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "e_commerce";
    $conn = new mysqli($servername, $username, $password, $database);
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

?> -->


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="profile.css" />
    <title>Document</title>
  </head>
  <body>
    <?php
    include_once ('_navbar.php');
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
          <img src='$x[4]' height=' alt=' />
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
              <span class='SinglecurrProductPrice currProductPrice'>₹$x[3]</span>
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
                <button class='SingleproductDetailsBuyNowBtn'>Buy It Now</button>
              </div>
              <div class='SingleproductDetailsCart'>
                <button class='SingleproductDetailsCartBtn'>Add to cart</button>
              </div>
              <div class='SingleproductDetailsCart'>
                <button class='SingleproductDetailswishlistBtn'>
                  <i class='fa-solid fa-heart' style='color: #c1121f;'></i> Add to Wishlist
                </button>
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
  }}

?>

      </div>
    </main>
    <?php
    include_once ('_footer.php');
    ?>
  </body>
</html>
