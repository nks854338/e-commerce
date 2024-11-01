<?php

session_start();
if (!isset($_SESSION['user'])) {
    header(('location: /e-commerce/User/oldUser.php'));
    die();
}

$user = $_SESSION['user'];

include_once 'C:/xampp/htdocs/e-commerce/User/db_conn.php';
$q = "SELECT * FROM product WHERE soldedBy = '$user'";
$result = mysqli_query($conn, $q);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$cnt = mysqli_num_rows($result);
if ($cnt == 0) {
    $noProduct = true;
} else {
    $noProduct = false;
}

?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NFT MarketPlace</title>
    <link rel="stylesheet" href="vendorStyle.css" />
    <link rel="stylesheet" href="scroll.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>

<body>
    <!-- Sidebar -->
    <nav class="sidebar" style="box-shadow: rgba(0, 0, 0, 0.15) 2.4px 2.4px 3.2px;">
        <div class="logo">
            <a href="/e-commerce/index.php">
            <img src="Assets/images/bag.png" alt="Logo" />
            </a>
        </div>
        <ul class="nav-links">
            <li>
                <a href="/e-commerce/shop/vendor/index.php"><i class="fa-solid fa-table-cells-large"
                        style="color: #fc6a03;"></i></a>
            </li>
            <li>
                <a href="/e-commerce/shop/vendor/profile.php"><i class="fa-solid fa-user"></i></a>
            </li>
            <li>
                <a href="/e-commerce/shop/vendor/setting.php"><i class="fa-solid fa-gear"></i></a>
            </li>
            <li>
                <a href="/e-commerce/User/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
            </li>
        </ul>
    </nav>

    <!-- Bottom Navbar for Mobile Devices -->
    <nav class="bottom-navbar">
        <ul class="bottom-nav-links">
            <li>
                <a href="/index.html"><i class="fa-solid fa-table-cells-large" style="color: #fc6a03;"></i></a>
            </li>
            <li>
                <a href="/profile.html"><i class="fa-solid fa-user"></i></a>
            </li>
            <li>
                <a href="/setting.html"><i class="fa-solid fa-gear"></i></a>
            </li>
            <li class="bottomLogout">
                <a href="#"><i class="fa-solid fa-right-from-bracket"></i></a>
            </li>
        </ul>
    </nav>

    <!-- Main Content Area -->
    <div class="main-content" style="margin-left: 90px;">
        <!-- Header -->
        <header class="header" style="width: 100%; box-shadow: rgba(0, 0, 0, 0.15) 3px 3px 5px;">
            <div class="search-container">
            </div>

            <div class="header-right">
                <!-- Theme Toggle -->
                <div class="theme-toggle">
                    <button class="theme-btn">
                        <img src="Assets/images/sun.png" alt="" />
                    </button>
                </div>

                <!-- Notifications -->
                <div class="notifications">
                    <button class="notif-btn">
                        <img src="Assets/images/bell.png" alt="Notifications" />
                    </button>
                </div>

                <!-- User Profile -->
                <div class="user-profile">
                    <img src="Assets/images/avatar.png" alt="User Profile" class="profile-img" />
                </div>
            </div>
        </header>

        <main class="HomeMain">
            <!-- hero section -->
            <div class="hero-section">
                <div class="hero-left" style="background-image: url('Assets/images/gift.jpg');">
                    <h2>Discover, Choose, Present, <br>and Craft Your Special Gifts</h2>
                    <p>Digital Shop for Artistic Gifts & Custom Collectibles</p>
                    <div class="btn-row">
                        <button type="submit" class="btn1">Explore</button>
                        <button type="submit" class="btn2" style="background-color: #31c48d; color: #fff;"><a
                                href="/e-commerce/shop/vendor/addProduct.php"
                                style="color: #fff; text-decoration: none;">Create</a></button>
                    </div>
                </div>
                <div class="hero-right">
                    <div class="hero-right-left">
                        <img src="Assets/images/6.jpg" alt="NFT Image" class="nft-image">
                    </div>
                    <div class="hero-right-right">
                        <div class="user">
                            <img src="Assets/images/avatar.png" alt="User Avatar" class="user-avatar">
                            <h3> <?php echo $_SESSION['name'];?></h3>
                            <span class="status-dot"></span>
                        </div>
                        <div class="data">
                            <h2>
                                Cuddle & Co
                            </h2>
                            <p class="auction-info">
                                <span>Auction time</span>
                                <span class="current-bid">Current stack: <span>0.05 ETH</span></span>
                            </p>
                            <p class="bid-time">
                                <span>3h 1m 50s</span>
                                <span class="bid-amount">0.15 ETH</span>
                            </p>
                            <div class="buttons">
                                <button type="submit" class="place-bid">Update</button>
                                <button type="submit" class="details"
                                    style="background-color: #31c48d; color: #fff;">Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- dashboard content -->

            <div class="SellerDashboardContainer" style="max-width: 98%; margin-left: 20px;">

            <div class="settingHeadingMainBox settingmarginBox ProductBox">
                <!-- <div class="settingHeadingMainBox1">Saved Items</div> -->
                <div class="settingHeadingMainBox2">
                    <div class="settingHeadingMainBox1"><?php
                    if (!$noProduct) { ?>Active Products<?php } ?></div>
                    <div>
                        <button type="submit" class="BidBtn"><a href="addProduct.php" style="color: #fff;">Add
                                Products</a></button>
                    </div>
                </div>
            </div>
            <?php
            if (!$noProduct) { ?>
                <div class="activeBidDataTableContainer" style="margin-bottom: 30px;">
                    <table>
                        <thead>
                            <tr>
                                <th><i class="fa-solid fa-square" style="color: #fff;"></i></th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Search Key</th>
                                <th>Edit</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="blankRow">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                            while ($x = mysqli_fetch_array($result)) {
                                echo "
                     <form method='post' action='singleProduct.php'>
                        <input type='hidden' name='product_id' value='{$x['pno']}'>
                        <button type='submit' name='showproduct' style='all: unset; cursor: pointer;'>
                    <tr class='spectialRow'>
                    <td class='firstTdCell'><i class='fa-solid fa-square' style='color: #fff;'></i></td>
                    <td>
                      <div class='settingUserForm1Profile'>
                        <div class='profileIconLeftImage'>
                          <img src='../{$x["image"]}' alt='' />
                        </div>
                      </div>
                    </td>
                    <td class='thSize'>{$x['productName']}</td>
                    <td class='thSize maxThSize'><div>{$x['productDescription']}</div></td>
                    <td>
                       ₹{$x['ProductPrice']}
                    </td>
                    <td>
                        {$x['searchkey']}
                     </td>
                    <td class='lastTdCell'><a href='editFromShop.php?pno=$x[pno]'><i class='fa-solid fa-pen-to-square' style='font-size: 25px; color: #000;'></i></a></td>
                    <td class='lastTdCell'><a href='removeFromShop.php?pno=$x[pno]'><i class='fa-solid fa-x' style='font-size: 25px; color: #000;'></i></a></td>
                  </tr>
                  </button>
                    </form>
                    ";
                            }

            }
            ?>
                    </tbody>
                </table>
            </div>

            <div class="dashboard2">
                <div class="recent-activity">
                    <div class="info">
                        <h3>Recent Activity</h3>
                        <p><a href="#">See More</a></p>
                    </div>
                    <div class="main-activity">
                        <div class="activity-card1">
                            <div class="activity-cardImg1">
                                <img src="Assets/images/174.jpg" alt="User Avatar" class="user-avatar2">
                            </div>
                            <div class="card-detail">
                                <p class="card-name">Cuddle & Co</p>
                                <p class="card-data">Purchase by you for 0.05 ETH</p>
                            </div>
                            <div class="card-time">
                                <p>12 mins ago</p>
                            </div>
                        </div>
                        <hr>
                        <div class="activity-card">
                            <div class="activity-cardImg1">
                                <img src="Assets/images/fri.jpg" alt="User Avatar" class="user-avatar2">
                            </div>
                            <div class="card-detail">
                                <p class="card-name">Floral Wishes</p>
                                <p class="card-data">Started Following you</p>
                            </div>
                            <div class="card-time">
                                <p>12 mins ago</p>
                            </div>
                        </div>
                        <hr>
                        <div class="activity-card">
                            <div class="activity-cardImg1">
                                <img src="Assets/images/40.jpg" alt="User Avatar" class="user-avatar2">
                            </div>
                            <div class="card-detail">
                                <p class="card-name">Gilded Gifts</p>
                                <p class="card-data">Has been sold by 12.75ETH</p>
                            </div>
                            <div class="card-time">
                                <p>12 mins ago</p>
                            </div>
                        </div>
                        <hr>
                        <div class="activity-card5">
                            <div class="activity-cardImg1">
                                <img src="Assets/images/29.jpg" alt="User Avatar" class="user-avatar2">
                            </div>
                            <div class="card-detail">
                                <p class="card-name">Bijoux Bliss</p>
                                <p class="card-data">Purchase by you for 0.05 ETH </p>
                            </div>
                            <div class="card-time">
                                <p>12 mins ago</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="top-creators">
                    <h3>Top Shops</h3>
                    <div class="creator">
                        <div class="creator-card">
                            <div class="crearor-cardImg">
                                <img src="Assets/images/spaceStu.jpg" alt="User Avatar" class="user-avatar2">
                            </div>
                            <div class="card-detail">
                                <p class="card-name">Crafted Curios</p>
                                <p class="card-data">60 Items</p>
                            </div>
                            <div class="card-button">
                                <button class="btn">Follow</button>
                            </div>
                        </div>

                        <div class="creator-card">
                            <div class="crearor-cardImg">
                                <img src="Assets/images/158.jpg" alt="User Avatar" class="user-avatar2">
                            </div>
                            <div class="card-detail">
                                <p class="card-name">Heartfelt Gifts</p>
                                <p class="card-data">60 Items</p>
                            </div>
                            <div class="card-button">
                                <button class="btn">Follow</button>
                            </div>
                        </div>

                        <div class="creator-card">
                            <div class="crearor-cardImg">
                                <img src="Assets/images/29.jpg" alt="User Avatar" class="user-avatar2">
                            </div>
                            <div class="card-detail">
                                <p class="card-name">Bijoux Bliss</p>
                                <p class="card-data">60 Items</p>
                            </div>
                            <div class="card-button">
                                <button class="btn">Follow</button>
                            </div>
                        </div>

                        <div class="creator-card">
                            <div class="crearor-cardImg">
                                <img src="Assets/images/200.jpg" alt="User Avatar" class="user-avatar2">
                            </div>
                            <div class="card-detail">
                                <p class="card-name">Handmade Haven Gifts</p>
                                <p class="card-data">60 Items</p>
                            </div>
                            <div class="card-button">
                                <button class="btn">Follow</button>
                            </div>
                        </div>

                        <div class="creator-card">
                            <div class="crearor-cardImg">
                                <img src="Assets/images/40.jpg" alt="User Avatar" class="user-avatar2">
                            </div>
                            <div class="card-detail">
                                <p class="card-name">Gilded Gifts</p>
                                <p class="card-data">60 Items</p>
                            </div>
                            <div class="card-button">
                                <button class="btn">Follow</button>
                            </div>
                        </div>

                        <div class="creator-card">
                            <div class="crearor-cardImg">
                                <img src="Assets/images/flower.jpg" alt="User Avatar" class="user-avatar2">
                            </div>
                            <div class="card-detail">
                                <p class="card-name">Blooming Gifts</p>
                                <p class="card-data">60 Items</p>
                            </div>
                            <div class="card-button">
                                <button class="btn">Follow</button>
                            </div>
                        </div>

                        <div class="creator-card">
                            <div class="crearor-cardImg">
                                <img src="Assets/images/174.jpg" alt="User Avatar" class="user-avatar2">
                            </div>
                            <div class="card-detail">
                                <p class="card-name">Cuddle & Co</p>
                                <p class="card-data">60 Items</p>
                            </div>
                            <div class="card-button">
                                <button class="btn">Follow</button>
                            </div>
                        </div>

                        <div class="creator-card">
                            <div class="crearor-cardImg">
                                <img src="Assets/images/fri.jpg" alt="User Avatar" class="user-avatar2">
                            </div>
                            <div class="card-detail">
                                <p class="card-name">Floral Wishes</p>
                                <p class="card-data">60 Items</p>
                            </div>
                            <div class="card-button">
                                <button class="btn">Follow</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </main>
    </div>

    <script src="script.js"></script>
</body>

</html>