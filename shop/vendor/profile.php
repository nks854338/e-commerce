<?php 
session_start();

if (!isset($_SESSION['user'])) {                   
  header(('location: ../User/oldUser.php'));
  die();
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NFT MarketPlace</title>
    <link rel="stylesheet" href="vendorStyle.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
  </head>
  <body>
    <!-- Sidebar -->
    <nav class="sidebar">
      <div class="logo">
            <a href="/e-commerce/index.php">
            <img src="Assets/images/bag.png" alt="Logo" />
            </a>
        </div>
        <ul class="nav-links">
            <li>
                <a href="/e-commerce/shop/vendor/index.php"><i class="fa-solid fa-table-cells-large"></i></a>
            </li>
        <li>
          <a href="/e-commerce/shop/vendor/profile.php"
            ><i class="fa-solid fa-user" style="color: #fc6a03;"></i></a>
        </li>
        <li>
          <a href="/e-commerce/shop/vendor/setting.php"
            ><i class="fa-solid fa-gear"></i></a>
        </li>
        <li>
          <a href="/e-commerce/User/logout.php"
            ><i class="fa-solid fa-right-from-bracket"></i></a>
        </li>
      </ul>
    </nav>

    <!-- Bottom Navbar for Mobile Devices -->
    <nav class="bottom-navbar">
      <ul class="bottom-nav-links">
        <li>
          <a href="/index.html"><i class="fa-solid fa-table-cells-large"></i></a>
        </li>
        <li>
          <a href="/HomeScrollDown.html"
            ><i class="fa-solid fa-clipboard-list"></i
          ></a>
        </li>
        <li>
          <a href="/Saved.html"><i class="fa-solid fa-heart"></i></a>
        </li>
        <li>
          <a href="/collection.html"><i class="fa-solid fa-star"></i></a>
        </li>
        <li>
          <a href="/profile.html"
            ><i class="fa-solid fa-user" style="color: #fc6a03"></i
          ></a>
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
      <header class="header" style=" box-shadow: rgba(0, 0, 0, 0.15) 3px 3px 5px; min-width: 100%;">
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
            <img
              src="Assets/images/avatar.png"
              alt="User Profile"
              class="profile-img"
            />
          </div>
        </div>
      </header>

      <main class="profileMain" style="padding: 30px;">
        <div class="">
          <div class="settingHeadingMainBox1" style="color: #fc6a03;">Profile</div>
          <div class="settingHeadingMainBox2">
            <div class="settingHeadingMainBox21">Welcome Profile Page</div>
            <div class="settingHeadingMainBox22">
              <span class="SettingHome" style="color: #fc6a03;">Home</span>
              <span class="SettingHomeGreaterIcon"
                ><i class="fa-solid fa-greater-than"></i
              ></span>
              <span class="SettingHome" style="color: #fc6a03;">Profile</span>
            </div>
          </div>
        </div>
        <div class="main-data">
          <div class="profile-data" style=" box-shadow: 0 0 5px gray;">
            <img
              src="Assets/images/avatar.png"
              class="user-avatar"
              alt=""
            />
            <h3>Welcome, <?php echo $_SESSION['name'];?></h3>
            <p>
              Looks like you are not verified yet. Verify yourself to use the
              full potential of Xtrader.
            </p>
            <div class="security">
              <div class="security-option1">
                <i class="fa-solid fa-check"></i><span>Verify account</span>
              </div>
              <hr />
              <div class="security-option2">
                <i class="fa-solid fa-lock"></i
                ><span>Two-factor Authentication (2FA)</span>
              </div>
            </div>
          </div>
          <div class="following">
            <h3>Following</h3>
            <div class="follow">
              <div class="follow-card" style=" box-shadow: 0 0 5px gray;">
                <div class="follow-cardImg">
                  <img
                    src="Assets/images/174.jpg"
                    alt="User Avatar"
                    class="user-avatar2"
                  />
                </div>
                <div class="card-detail">
                  <p class="card-name">Cuddle & Co</p>
                  <p class="card-data">60 Items</p>
                </div>
                <div class="card-button">
                  <button class="btn">Unfollow</button>
                </div>
              </div>

              <div class="follow-card" style=" box-shadow: 0 0 5px gray;">
                <div class="follow-cardImg">
                  <img
                    src="Assets/images/fri.jpg"
                    alt="User Avatar"
                    class="user-avatar2"
                  />
                </div>
                <div class="card-detail">
                  <p class="card-name">Floral Wishes</p>
                  <p class="card-data">60 Items</p>
                </div>
                <div class="card-button">
                  <button class="btn">Unfollow</button>
                </div>
              </div>

              <div class="follow-card" style=" box-shadow: 0 0 5px gray;"> 
                <div class="follow-cardImg">
                  <img
                    src="Assets/images/40.jpg"
                    alt="User Avatar"
                    class="user-avatar2"
                  />
                </div>
                <div class="card-detail">
                  <p class="card-name">Gilded Gifts</p>
                  <p class="card-data">60 Items</p>
                </div>
                <div class="card-button">
                  <button class="btn">Unfollow</button>
                </div>
              </div>

              <div class="follow-card" style=" box-shadow: 0 0 5px gray;">
                <div class="follow-cardImg">
                  <img
                    src="Assets/images/29.jpg"
                    alt="User Avatar"
                    class="user-avatar2"
                  />
                </div>
                <div class="card-detail">
                  <p class="card-name">Bijoux Bliss</p>
                  <p class="card-data">60 Items</p>
                </div>
                <div class="card-button">
                  <button class="btn">Unfollow</button>
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
