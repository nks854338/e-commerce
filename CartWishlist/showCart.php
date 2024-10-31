<?php
session_start();

if (!isset($_SESSION['user'])) {                   
    header(('location: ../User/oldUser.php'));
    die();
}

$user = $_SESSION['user'];
include_once '..\User\db_conn.php';
$q = "SELECT * FROM cart where user = '$user'";
$result = mysqli_query($conn, $q);
if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
$noProduct = false;
$totalPrice = 0;
if (mysqli_num_rows($result) == 0) {
    $noProduct = true;
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        $totalPrice += $row['ProductPrice'] * $row['quantity'];
        $_SESSION['ProductPrice'] = $totalPrice;
    }
}
$cartItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../MyStyle.css">
    <link rel="stylesheet" href="cartWishlist.css">
    <title>Cart</title>
    <script>
        function updateCart(productId, newQuantity, pricePerItem) {
            const newPrice = newQuantity * pricePerItem;
            document.querySelector(`#price_${productId}`).innerText = "₹" + newPrice;
            updateTotalPrice();
            fetch('updateCart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `pno=${productId}&quantity=${newQuantity}`
            })
                .then(response => response.text())
                .then(data => {
                    console.log("Cart updated successfully", data);
                })
                .catch(error => {
                    console.error("Error updating cart:", error);
                });
        }
        function updateTotalPrice() {
            let totalPrice = 0;
            document.querySelectorAll('.productPrice').forEach(item => {
                const price = parseFloat(item.innerText.replace('₹', ''));
                totalPrice += price;
            });
            document.querySelector('.cartTotalPrice').innerText = "₹" + totalPrice;
        }
    </script>
</head>

<body>
    <?php
    include_once '../Components/_navbar.php';  
    ?>
    <div class="cartsection">
        <div class="cartHeadingBox">
            <div class="cartHeading">My cart</div>
        </div>
        <?php if ($noProduct) { ?>
            <div class='emptyCartDiv' id="emptyCartDiv" style="display: flex; align-items: center;
                 justify-content: center; flex-direction: column; min-width: 90vw;"><img src='../image/empty-cart.png'></div>
        <?php } else { ?>
            <div class='mainCartbox'>
                <div class='cartLeft'>
                    <div class='cartItems'>
                        <?php
                        // Fetch all the products for display
                        $q = "SELECT * FROM cart WHERE user = '$user'";
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
                                            <div class="cartPriceDetailRight">₹<?php echo $_SESSION['ProductPrice'];?></div>
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
                                            <div class="cartPriceDetailRight cartTotalPrice">₹<?php echo $_SESSION['ProductPrice'];?>
                                            </div>
                                        </div>
                                        <div class="cartPriceDetail cartPriceDetail6">
                                            <div class="cartPriceDetail cartPriceDetail6" style="width: 100%;">
                                                <form method="POST" style="width: 100%;"
                                                    action="deliveryAddress.php" id="placeOrderForm">
                                                    <input type="hidden" name="totalPrice" id="totalPriceInput"
                                                        value="<?php echo $totalPrice; ?>">
                                                        
                                                        <input type="hidden" name="email" id="totalPriceInput"
                                                        value="<?php echo $email='nk@gmail'; ?>">

                                                        <input type="hidden" name="mobile" id="totalPriceInput"
                                                        value="<?php echo $mobileNo='1111111111'; ?>">

                                                        <input type="hidden" name="name" id="totalPriceInput"
                                                        value="<?php echo $name='nk'; ?>">

                                                    <input type="hidden" name="totalQuantity" id="totalQuantityInput"
                                                        value="0"> <!-- Default total quantity -->

                                                    <button type="submit" style="width: 100%;"
                                                        onclick="updateOrderDetails()" name="paymentAddress">Place Order</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php include_once '../Components/_footer.php'; ?>
</body>
<script>
    function updateOrderDetails() {
        let totalQuantity = 0;
        let totalPrice = 0;

        document.querySelectorAll('.cartItem').forEach(item => {
            const quantitySelect = item.querySelector('select[name="quantity"]');
            const quantity = parseInt(quantitySelect.value);
            const price = parseFloat(item.querySelector('.currProductPrice').innerText.replace('₹', ''));

            totalQuantity += quantity;
            totalPrice += price * quantity;
        });

        document.getElementById('totalPriceInput').value = totalPrice;
        document.getElementById('totalQuantityInput').value = totalQuantity;
<?php 
 $_SESSION['totalPrice'] = $totalPrice;
?>
        document.querySelector('.cartTotalPrice').innerText = "₹" + totalPrice;
    }
</script>


</html>