<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styled.css">
    <title>Navbar</title>
</head>

<body>
    <header>
    <form action="index.php" method="POST">
        <div class="navbar">
            <a href="index.php" class="logo">
                <img src="image/logo.png" alt="" height="37px"> Sneh Sangrah
            </a>
                <div class="searchBar">
                    <input type="search" class="search" placeholder="search gifts for some special one..."
                        name="inputData">
                        <button style="color: #132186; cursor: pointer;"  name="input" type='submit'>
                        <i class="fa-solid fa-magnifying-glass searchIcon"></i>
                        </button>
                </div>
            <div class="navComponentBox">
                <?php
                if (isset($_SESSION['user'])) {
                    echo "<div class='signIn'>";
                    echo '<button class="user" name="signIn"><a href="userProfile.php">';
                    echo '<div class="userProfileBox"><i class="fa-regular fa-user"></i></div></a></button>';

                    echo '<button class="shop" name="shop"><a href="setUpShop.php"><i class="fa-solid fa-shop"></i></a></button>';

                    echo '<button class="wishlist" id="wishlist" name="wishlist"><a href="showWishlist.php"><i class="fa-regular fa-heart"></i></a></button>';

                    echo '<button class="cart" id="cart" name="cart"><a href="showCart.php"><i class="fa-solid fa-cart-shopping"></i></a></button>';
                    echo "</div>";
                } else {
                    echo '<button class="signInBtn" name="signIn"><a href="oldUser.php">Sign In</a></button>';
                    echo '<button class="wishlist" name="wishlist"><a href="newUser.php"><i class="fa-solid fa-heart" style="color: orange;"></i></a></button>';
                }
                ?>
            </div>
        </div>
        </form>
    </header>
</body>

</html>