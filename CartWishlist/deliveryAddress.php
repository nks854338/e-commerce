<?php
session_start();
if (!isset($_SESSION['user'])) {
    header(('location: ../User/oldUser.php'));
    die();
}

$user = $_SESSION['user'];

include_once '..\User\db_conn.php';

$totalPrice = $_SESSION['totalPrice'];

$q = "SELECT * FROM useraddress WHERE user = '$user'";
$result = mysqli_query($conn, $q);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}

$noAddress = (mysqli_num_rows($result) == 0);
if ($noAddress) {
    header(('Location: addDeliverAddress.php'));
    die();
}
$cartItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="address.css" />
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../MyStyle.css">
    <link rel="stylesheet" href="cartWishlist.css">
    <title>Delivery Address</title>
</head>

<body>
    <?php
    include_once '../Components/_navbar.php';
    ?>
    <div class="AddressPageBox">
        <div class="AddressPage">
            <?php if (!$noAddress) { ?>
                <div class='AddressItems'>
                    <?php foreach ($cartItems as $x) { ?>
                        <div class='cartItem'>
                            <div class='cartContent'>
                                <div class='cartItemleft'>
                                    <input type="radio" name="selectedAddress" value="<?php echo $x['sno']; ?>">
                                </div>
                                <div class='cartItemRight'>
                                    <div class='cartItemRight1'><?php echo $x['name']; ?></div>
                                    <div class='displayedProductPrice'>
                                        <span class='cartItemRight3'><?php echo $x['address']; ?></span>
                                    </div>
                                    <div class='cartItemRight3'>
                                       <?php echo $x['pincode']; ?>, <?php echo $x['city']; ?>
                                    </div>
                                    <div class='cartItemRight3'>
                                    <?php echo $x['mobileNo']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class='cartRemove'>
                                <button>
                                <a href='removeFromAddress.php?sno=<?php echo $x['sno']; ?>'>
                                            <img src='../image/x_mark.png' height='18px' alt='' />
                                        </a>
                                </button>
                            </div>
                        </div>
                    <?php } ?>
                    <br>
                    <div class="addAddressBtn">
                        <button type="submit" name="addAddress" style="width: 100%; height: 40px; text-align: left;">
                            <a href="addDeliverAddress.php" style="font-size: 25px; color: #000; float: left;">+ Add new Address</a>
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="cartRight">
            <div>
                <div class="TotalCartInfoMain">
                    <div class="TotalCartInfoBox">
                        <div class="couponsBox">
                            <div class="couponsHeading">Coupons</div>
                            <div class="couponsInfo">
                                <div class="couponsleft">
                                    <div class="couponsleft1">
                                        <img src="../image/Select.png" height="50px" alt="" />
                                    </div>
                                    <div class="couponsleft2">Apply Coupons</div>
                                </div>
                                <div class="couponsright"><button>Apply</button></div>
                            </div>
                            <div class="cartPriceDetails">
                                <div class="cartPriceDetail cartPriceDetail1">
                                    <div class="cartPriceDetailleft">Total MRP</div>
                                    <div class="cartPriceDetailRight">₹<?php echo $totalPrice; ?></div>
                                </div>
                                <div class="cartPriceDetail cartPriceDetail2">
                                    <div class="cartPriceDetailleft">Discount MRP</div>
                                    <div class="cartPriceDetailRight">₹1200</div>
                                </div>
                                <div class="cartPriceDetail cartPriceDetail3">
                                    <div class="cartPriceDetailleft">Platform Fee</div>
                                    <div class="cartPriceDetailRight">Free</div>
                                </div>
                                <div class="cartPriceDetail cartPriceDetail4">
                                    <div class="cartPriceDetailleft">Shipping Fee</div>
                                    <div class="cartPriceDetailRight">Free</div>
                                </div>
                                <hr />
                                <div class="cartPriceDetail cartPriceDetail5">
                                    <div class="cartPriceDetailleft">Total Price</div>
                                    <div class="cartPriceDetailRight cartTotalPrice">₹<?php echo $_SESSION['totalPrice'];?>
                                    </div>
                                </div>
                                <div class="cartPriceDetail cartPriceDetail6">
                                    <div class="cartPriceDetail cartPriceDetail6" style="width: 100%;">
                                        <form method="POST" style="width: 100%;" action="phonePayPaymentGateway/pay.php"
                                            id="placeOrderForm">
                                            <input type="hidden" name="totalPrice" id="totalPriceInput"
                                                value="<?php echo $totalPrice; ?>">

                                            <input type="hidden" name="email" id="totalPriceInput"
                                                value="<?php echo $email = 'nk@gmail'; ?>">

                                            <input type="hidden" name="mobile" id="totalPriceInput"
                                                value="<?php echo $mobileNo = '1111111111'; ?>">

                                            <input type="hidden" name="name" id="totalPriceInput"
                                                value="<?php echo $name = 'nk'; ?>">

                                            <input type="hidden" name="totalQuantity" id="totalQuantityInput" value="0">

                                            <button type="submit" style="width: 100%;">Place Order</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>