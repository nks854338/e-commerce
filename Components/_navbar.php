<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css"> <!-- Adjusted to point to the correct location -->
    <title>Navbar</title>
</head>

<body>
<header style="padding:0 20px;">
    <form action="../index.php" method="POST"> <!-- Adjusted to point to the correct location -->
        <div class="navbar">
            <a href="./index.php" class="logo" style="color: #fc6a03;"> <!-- Adjusted to point to the correct location -->
                <img src="../image/logo.png" alt="" height="37px"> Sneh Sangrah <!-- Adjusted to point to the correct location -->
            </a>
            <div class="searchBar" style="border-right: 0;">
                <input type="search" class="search" placeholder="search gifts for some special one..." name="inputData">
                <button style="color: #000; cursor: pointer;" name="input" type='submit'>
                    <i class="fa-solid fa-magnifying-glass searchIcon NavSearchIcon" style="background-color: #fc6a03;"></i>
                </button>
            </div>
            <div class="navComponentBox">
                <?php
                if (isset($_SESSION['user'])) {
                    echo '<div class="signIn">';

                    echo '<div class="user"><a href="../logout.php"><div class="userProfileBox"><div class="userProfileIcon"><i class="fa-regular fa-user"></i></div><div class="userProfileTitle">Profile</div></div></a></div>';

                    echo '<div class="user"><a href=".\shop\setUpShop.php"><div class="userProfileBox"><div class="ShopIcon"><i class="fa-solid fa-shop"></i></div><div class="ShopTitle">Shop</div></div></a></div>';

                    echo '<div class="user"><a href=".\CartWishlist\showWishlist.php"><div class="navWishlistBox"><div class="navWishlistIcon"><i class="fa-regular fa-heart"></i></div><div class="navWishlistTitle">Wishlist</div></div></a></div>';

                    echo '<div class="user"><a href=".\CartWishlist\showCart.php"><div class="navCartBox"><div class="navCartIcon"><i class="fa-solid fa-cart-shopping"></i></div><div class="navCartTitle">Cart</div></div></a></div>';

                    echo '</div>';
                } else {
                    echo '<div class="signIn">';
                    echo '<a href="../oldUser.php"><div class="signInBtn" name="signIn">Sign In</div></a>';
                    echo '<a href="../newUser.php"><i class="fa-solid fa-heart" style="color: orange;"></i></a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </form>
</header>
</body>

</html>






<!-- 


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Navbar</title>
</head>

<body>
<header style="padding:0 20px;">
        <form action="index.php" method="POST">
            <div class="navbar">
                <a href="index.php" class="logo" style="color: #fc6a03;">
                    <img src="image/logo.png" alt="" height="37px"> Sneh Sangrah
                </a>
                <div class="searchBar" style="border-right: 0;">
                    <input type="search" class="search" placeholder="search gifts for some special one..."
                        name="inputData">
                    <button style="color: #000; cursor: pointer; " name="input" type='submit'>
                        <i class="fa-solid fa-magnifying-glass searchIcon NavSearchIcon" style="background-color: #fc6a03;"></i>
                    </button>
                </div>
                <div class="navComponentBox">
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo '<div class="signIn">';
                        echo '<button class="user" name="signIn"><a href="logout.php">';
                        echo '<div class="userProfileBox">
                    <div class="userProfileIcon"><i class="fa-regular fa-user"></i></div>
                    <div class="userProfileTitle">Profile</div>
                    </div></a></button>';

                        echo '<button class="shop" name="shop"><a href="setUpShop.php">';
                        echo '<div class="userProfileBox">
                    <div class="ShopIcon"><i class="fa-solid fa-shop"></i></div>
                    <div class="ShopTitle">Shop</div>
                    </div></a></button>';

                        echo '<button class="navWishlist" id="navWishlist" name="navWishlist"><div class="navWishlistBox">
                    <div class="navWishlistIcon"><i class="fa-regular fa-heart"></i></div><a href="showWishlist.php">
                    <div class="navWishlistTitle">Wishlist</div>
                    </div></a></button>';

                        echo '<button class="cart" id="cart" name="cart"><a href="showCart.php"><div class="navCartBox">
                    <div class="navCartIcon"><i class="fa-solid fa-cart-shopping"></i></a></div>
                    <a href="showCart.php">
                    <div class="navCartTitle">Cart</div>
                    </div></a></button></div>';
                    }
                     else {
                        echo '<div class="signIn">';
                        echo '<button class="signInBtn"name="signIn"><a href="oldUser.php">Sign In</a></button>';
                        echo '<button class="navWishlist" name="navWishlist"><a href="newUser.php"><i class="fa-solid fa-heart" style="color: orange;"></i></a></button>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </form>
    </header>
</body>

</html> -->
