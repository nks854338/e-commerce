<?php
$show = "0";
$error = "0";
//db_connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "e_commerce";

$conn = new mysqli($servername, $username, $password, $database);

if (isset($_POST['submit'])) {

    $shopName = $_POST["shopName"];
    $VendorName = $_POST["VendorName"];
    $dob = $_POST["dob"];
    $country = $_POST["country"];
    $address = $_POST["address"];
    $accountNo = $_POST["accountNo"];
    $IFSC = $_POST["IFSC"];
    $accHolderName = $_POST["accHolderName"];
    $bank = $_POST["bank"];
    $sql = "INSERT INTO `shop` (`shopName`, `VendorName`,`dob`,`country`,`address`,`accountNo`,`IFSC`,`accHolderName`,`bank`) VALUES ('$shopName', '$VendorName','$dob','$country','$address','$accountNo','$IFSC','$accHolderName','$bank')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $show = "1";
        echo '<script type="text/javascript">';
        echo 'alert("Shop created succefully");';
        echo 'window.location.href = "vendor.php";';
        echo '</script>';
    }
    else {
        echo "failure";
        $error = "1";
    }
}

$conn->close();


?>









<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="setUpShop.css">
    <title>Create shop</title>
</head>

<body>
    <header class="setUpShopHeader">
        <div class="navbar">
            <div class="name">Sneh Sangrah</div>
        </div>
    </header>
    <main>
        <section class="setUpSection" style="background-color: antiquewhite;">
            <div class="firsec">
                <div class="heading1">Setup your Shop on Sneh Sangrah</div>
                <div class="para1">Let's get started! Tell us about you and your shop.</div>
            </div>
            <div class="formSection">
                <form action="setUpShop.php" method="POST" id="shopCreationForm">
                    <div class="firstBox">
                        <div class="tableBox">
                            <table>
                                <tr>
                                    <th>
                                        <label for="country">Name your shop:</label>
                                    </th>
                                    <td>
                                        <input type="text" class="shopName" name="shopName">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="secondBox">




                        <div class="heading2">Tell us a little bit about yourself</div>
                        <div class="tableBox">
                            <table>
                                <tr>
                                    <th>
                                        <label for="country">Your name :</label>
                                    </th>
                                    <td>
                                        <input type="text" class="VendorName" name="VendorName">
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        <label for="dob">Date of Birth:</label>
                                    </th>
                                    <td>
                                        <input type="date" id="dob" name="dob" required>
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        <label for="country">Country:</label>
                                    </th>
                                    <td>
                                        <select id="country" name="country" required>
                                            <option value="" disabled selected>Select Country</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Albania">Albania</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        <label for="country">Address:</label>
                                    </th>
                                    <td>
                                        <textarea name="address" id="address"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="thirdBox">
                        <div class="thisec">
                            <div class="heading2">How you'll get paid</div>
                            <div class="para1">Give us your account details where you'll get paid</div>
                        </div>
                        <div class="tableBox">
                            <table>
                                <tr>
                                    <th>
                                        <label for="country">Account No:</label>
                                    </th>
                                    <td>
                                        <input type="number" class="accNo" name="accountNo">
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        <label for="country">IFSC code:</label>
                                    </th>
                                    <td>
                                        <input type="text" class="IFSC" name="IFSC">
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        <label for="country">Account holder Name:</label>
                                    </th>
                                    <td>
                                        <input type="text" class="accHolderName" name="accHolderName">
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        <label for="country">Bank name:</label>
                                    </th>
                                    <td>
                                        <input type="text" class="bankName" name="bank">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="submitbtn" style="display: flex; align-items: center; justify-content: center;">
                            <button class="submitData" name="submit">
                                Create your shop
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <?php
    include_once ('_footer.php');
    ?>
</body>

</html>