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
    <nav class="sidebar" width="100%">
    <div class="logo">
            <a href="/projects/e-commerce/index.php">
            <img src="Assets/images/bag.png" alt="Logo" />
            </a>
        </div>
        <ul class="nav-links">
            <li>
                <a href="/projects/e-commerce/shop/vendor/index.php"><i class="fa-solid fa-table-cells-large"></i></a>
            </li>
          <li>
            <a href="/projects/e-commerce/shop/vendor/profile.php"
              ><i class="fa-solid fa-user"></i></a>
          </li>
          <li>
            <a href="/projects/e-commerce/shop/vendor/setting.html"
              ><i class="fa-solid fa-gear" style="color: #fc6a03;"></i></a>
          </li>
          <li>
            <a href="/projects/e-commerce/User/logout.php"
              ><i class="fa-solid fa-right-from-bracket"></i></a>
          </li>
      </ul>
    </nav>

    <!-- Bottom Navbar for Mobile Devices -->
    <nav class="bottom-navbar">
      <ul class="bottom-nav-links">
        <li>
          <a href="/index.html"
            ><i class="fa-solid fa-table-cells-large"></i></a>
        </li>
        <li>
          <a href="/HomeScrollDown.html"
            ><i class="fa-solid fa-clipboard-list"></i></a>
        </li>
        <li>
          <a href="/Saved.html"
            ><i class="fa-solid fa-heart"></i></a>
        </li>
        <li>
          <a href="/collection.html"
            ><i class="fa-solid fa-star"></i></a>
        </li>
        <li>
          <a href="/profile.html"
            ><i class="fa-solid fa-user"></i></a>
        </li>
        <li>
          <a href="/setting.html"
            ><i class="fa-solid fa-gear" style="color: #fc6a03;"></i></a>
        </li>
        <li class="bottomLogout">
          <a href="#"
            ><i class="fa-solid fa-right-from-bracket"></i></a>
        </li>
      </ul>
    </nav>

    <!-- Main Content Area -->
    <div class="main-content" style="margin-left: 90px;">
      <!-- Header -->
      <header class="header" style=" box-shadow: rgba(0, 0, 0, 0.15) 3px 3px 5px; min-width: 100%">
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

      <main>
        <!-- Your main content goes here -->
        <div class="outerLayerOfMainSection" style="padding: 30px;">
          <div class="settingHeadingMainBox">
            <div class="settingHeadingMainBox1" style="color: #fc6a03;">Setting</div>
            <div class="settingHeadingMainBox2">
              <div class="settingHeadingMainBox21">Welcome Setting Page</div>
              <div class="settingHeadingMainBox22">
                <span class="SettingHome" style="color: #fc6a03;">Home</span>
                <span class="SettingHomeGreaterIcon"
                  ><i class="fa-solid fa-greater-than"></i
                ></span>
                <span class="SettingHome" style="color: #fc6a03;">Setting</span>
              </div>
            </div>
          </div>
          <div class="settingNavbar">
            <ul>
              <li class="specialList">Profile</li>
              <li>Application</li>
              <li>Security</li>
              <li>Activity</li>
              <li>Payment Method</li>
              <li>API</li>
            </ul>
          </div>

          <div class="settingUserProfileForms">
            <div class="settingUserProfileForm1Container">
              <div class="settingUserProfileForm1Heading">User profile</div>
              <div class="settingUserProfileForm settingForm">
                <form action="">
                  <div class="settingUserForm1FullName">
                    <div>Full Name</div>
                    <div>
                      <input type="text" />
                    </div>
                  </div>
                  <div class="settingUserForm1Profile">
                    <div class="settingUserForm1ProfileLogo">
                      <img src="Assets/images/avatar.png" alt="" />
                    </div>
                    <div class="settingUserForm1ProfileLogoNameBox">
                      <div class="settingUserForm1ProfileLogoNameBox1">
                         <?php echo $_SESSION['name'];?>
                      </div>
                      <div class="settingUserForm1ProfileLogoNameBox2">
                        Welcome Setting Page
                      </div>
                    </div>
                  </div>
                  <div class="SubmitBtn">
                    <button>Save</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="settingUserProfileForm1Container">
              <div class="settingUserProfileForm1Heading">Update Profile</div>
              <div class="settingUserProfileForm settingForm">
                <form action="">
                  <div class="settingUserForm1FullName">
                    <div>Email</div>
                    <div>
                      <input type="text" />
                    </div>
                  </div>
                  <div class="settingUserForm1FullName">
                    <div>Password</div>
                    <div>
                      <input type="text" />
                    </div>
                  </div>
                  <div class="SubmitBtn">
                    <button>Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="settingPersonalInformationFormContainer">
            <div class="settingUserProfileForm1Heading">
              Personal Information
            </div>
            <div class="settingForm">
              <form action="" class="settingPersonalInformationForm">
                <div class="settingPersonalInformationFormFirstRow">
                  <div
                    class="settingPersonalInformationFormColumn1 settingUserForm1FullName"
                  >
                    <div>Name</div>
                    <div>
                      <input type="text" />
                    </div>
                  </div>
                  <div
                    class="settingPersonalInformationFormColumn1 settingUserForm1FullName"
                  >
                    <div>Email</div>
                    <div>
                      <input type="text" />
                    </div>
                  </div>
                </div>
                <div class="settingPersonalInformationFormFirstRow">
                  <div
                    class="settingPersonalInformationFormColumn1 settingUserForm1FullName"
                  >
                    <div>Contact No</div>
                    <div>
                      <input type="text" />
                    </div>
                  </div>
                  <div
                    class="settingPersonalInformationFormColumn1 settingUserForm1FullName"
                  >
                    <div>Date Of Birth</div>
                    <div>
                      <input type="text" />
                    </div>
                  </div>
                </div>
                <div class="settingPersonalInformationFormFirstRow">
                  <div
                    class="settingPersonalInformationFormColumn1 settingUserForm1FullName"
                  >
                    <div>Address</div>
                    <div>
                      <input type="text" />
                    </div>
                  </div>
                  <div
                    class="settingPersonalInformationFormColumn1 settingUserForm1FullName"
                  >
                    <div>Country</div>
                    <div>
                      <input type="text" />
                    </div>
                  </div>
                </div>
                <div class="SubmitBtn">
                  <button>Save</button>
                </div>
              </form>
            </div>
          </div>

          <div class="settingHeadingMainBox"></div>
        </div>
      </main>
    </div>

    <script src="script.js"></script>
  </body>
</html>
