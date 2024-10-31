<?php
session_start();
if (!isset($_SESSION['user'])) {                    //cheak user is login or not for accessing this resource
    header(('location: ../User/oldUser.php'));
    die();
}

$show = "0";
$error = "0";
//db_connection
include_once '..\User\db_conn.php';

if (isset($_POST['submit'])) {
    $user = $_SESSION['user'];
    $shopName = $_POST["shopName"];
    $ownerName = $_POST["ownerName"];
    $dateofBirth = $_POST["dateofBirth"];
    $country = $_POST["country"];
    $address = $_POST["address"];
    $accountNo = $_POST["accountNo"];
    $IFSCcode = $_POST["IFSCcode"];
    $acountHolderName = $_POST["acountHolderName"];
    $bankName = $_POST["bankName"];
    $sql = "INSERT INTO `shop` (`user`, `shopName`, `ownerName`,`dateofBirth`,`country`,`address`,`accountNo`,`IFSCcode`,`acountHolderName`,`bankName`) VALUES ('$user', '$shopName', '$ownerName','$dateofBirth','$country','$address','$accountNo','$IFSCcode','$acountHolderName','$bankName')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $show = "1";
        $_SESSION['shop'] = "done";
        echo '<script type="text/javascript">';
        echo 'alert("Shop created succefully");';
        echo 'window.location.href = "/projects/e-commerce/shop/vendor/index.php";';
        echo '</script>';
    } else {
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
    <link rel="stylesheet" href="..\style.css">
    <title>Create shop</title>
</head>

<body>
    <header class="setUpShopHeader">
        <div class="navbar">
            <div class="name setUpShopLogo"><a href="..\index.php">Sneh Sangrah</a></div>
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
                                        <input type="text" class="ownerName" name="ownerName">
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        <label for="dateofBirth">Date of Birth:</label>
                                    </th>
                                    <td>
                                        <input type="date" id="dateofBirth" name="dateofBirth" required>
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        <label for="country">country:</label>
                                    </th>
                                    <td>
                                        <select id="country" name="country" required>
                                            <option value="" disabled selected>Select country</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Canada">Canada</option>
                                            <option value="China">China</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Czechia">Czechia</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russia">Russia</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Korea">South Korea</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Taiwan">Taiwan</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Vietnam">Vietnam</option>

                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        <label for="country">address:</label>
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
                                        <label for="country">IFSCcode code:</label>
                                    </th>
                                    <td>
                                        <input type="text" class="IFSCcode" name="IFSCcode">
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        <label for="country">Account holder Name:</label>
                                    </th>
                                    <td>
                                        <input type="text" class="acountHolderName" name="acountHolderName">
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        <label for="country">bankName name:</label>
                                    </th>
                                    <td>
                                        <input type="text" class="bankNameName" name="bankName">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="submitbtn" style="display: flex; align-items: center; justify-content: center;">
                            <button class="submitData" type="submit" name="submit">
                                Create your shop
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <?php
    include_once('..\Components\_footer.php');
    ?>
</body>

</html>