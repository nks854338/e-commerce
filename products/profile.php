<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="profiles.css" />
    <title>Profile Page</title>
  </head>

  <body>
    <?php
        include_once '../Components/_navbar.php';
   ?>
    <section id="section">
      <!--<div id="msgdiv">Dusshera Sales Ends In 01 Day 07 H:35 M:52 S</div>-->
      <div id="containerdiv">
        <div id="firstchilddiv">
          <p id="textaccount">Account</p>
        </div>
        <div id="secondchilddiv">
          <div id="sidebar">
            <div class="box5" style="height: 150px">
              <p id="firstsentencebox4" class="textbox3">ACCOUNT</p>
              <a href="#" id="profilelink" class="textbox3">Profile</a>
              <p class="textbox3">Cash</p>
              <p class="textbox3">Cupons</p>
              <p class="textbox3">Credit</p>
            </div>
            <hr />
            <div class="box5">
              <p id="firstsentencebox4">ORDERS</p>
              <span class="textbox3">Orders & Returns</span>
            </div>
            <hr />
            <div class="box5">
              <p id="firstsentencebox4">Legal</p>
              <p class="textbox3">Terms of Use</p>
              <p class="textbox3">Privacy Policy</p>
            </div>
            <hr />
            <div class="box5">
               <a href="/projects/e-commerce/User/logout.php">
              <p id="firstsentencebox4">Logout</p>
            </a>
            </div>
          </div>
          <div id="tablecontainer">
            <div id="profiledetails">Profile Details</div>
            <table>
              <tbody>
                <tr>
                  <td>Full Name</td>
                  <td><?php echo $_SESSION['name']?></td>
                </tr>
                <tr>
                  <td>Email ID</td>
                  <td><?php echo $_SESSION['user']?></td>
                </tr>
                <tr>
                  <td>Moblie Number</td>
                  <td>not added</td>
                </tr>
                <tr>
                  <td>Gender</td>
                  <td>not added</td>
                </tr>
                <tr>
                  <td>Date of Birth</td>
                  <td>not added</td>
                </tr>
                <tr>
                  <td>Address</td>
                  <td>not added</td>
                </tr>
              </tbody>
            </table>
            <button id="editbutton">EDIT</button>
          </div>
        </div>
      </div>
    </section>
  </body>
  <?php
        include_once '../Components/_footer.php';
   ?>
</html>
