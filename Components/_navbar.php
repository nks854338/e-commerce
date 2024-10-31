<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../MyStyle.css">
    <title>Navbar</title>
</head>

<body>
<header style="padding:0 20px;">
    <form action="/projects/e-commerce/products/searchProduct.php" method="POST">
        <div class="navbar">
            <a href="/projects/e-commerce/index.php" class="logo" style="color: #fc6a03;">
                <img src="/projects/e-commerce/image/logo.png" alt="" height="37px"> Sneh Sangrah
            </a>
            <div class="searchBar" style="border-right: 0;">
                <input type="search" class="search" placeholder="search gifts for some special one..." name="inputData">
                <button class="searchBtn" style="color: #000; cursor: pointer;" name="input" type='submit'>
                    <i class="fa-solid fa-magnifying-glass searchIcon NavSearchIcon" style="background-color: #fc6a03;"></i>
                </button>
            </div>
            <div class="navComponentBox">
                <?php
                if (isset($_SESSION['user'])) {
                    echo '<div class="signIn">';

                    echo '<div class="user"><a href="/projects/e-commerce/products/profile.php"><div class="userProfileBox"><div class="userAuthI userProfileIcon"><i class="fa-regular fa-user"></i></div><div class="userAuthIcon userProfileTitle">Profile</div></div></a></div>';
                   
                    if(isset($_SESSION['shop'])){
                        echo '<div class="user"><a href="/projects/e-commerce/shop/vendor/index.php"><div class="userProfileBox"><div class="userAuthI ShopIcon"><i class="fa-solid fa-shop"></i></div><div class="userAuthIcon ShopTitle">Shop</div></div></a></div>';
                    }else{
                        echo '<div class="user"><a href="/projects/e-commerce/shop/setUpShop.php"><div class="userProfileBox"><div class="userAuthI ShopIcon"><i class="fa-solid fa-shop"></i></div><div class="userAuthIcon ShopTitle">shop</div></div></a></div>';
                    }
                    
                    echo '<div class="user"><a href="/projects/e-commerce/CartWishlist/showWishlist.php"><div class="navWishlistBox"><div class="userAuthI navWishlistIcon"><i class="fa-regular fa-heart"></i></div><div class="userAuthIcon navWishlistTitle">Wishlist</div></div></a></div>';

                    echo '<div class="user"><a href="/projects/e-commerce/CartWishlist/showCart.php"><div class="navCartBox"><div class="userAuthI navCartIcon"><i class="fa-solid fa-cart-shopping"></i></div><div class="userAuthIcon navCartTitle">Cart</div></div></a></div>';

                    echo '</div>';
                } else {
                    echo '<div class="signIn" id="signIn">';
                    echo '<a href="/projects/e-commerce/User/oldUser.php"><div class="signInBtn" name="signIn">Sign In</div></a>';
                    echo '<a href="/projects/e-commerce/User/newUser.php"><i class="fa-solid fa-heart" style="color: orange;"></i></a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </form>
</header>

</body>

</html>
