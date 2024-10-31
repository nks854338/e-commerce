<?php
session_start();
if (isset($_POST['addAddress'])) {
    include_once '..\User\db_conn.php';
    $user = $_SESSION['user'];
    $name = $_POST["name"];
    $mobileNo = $_POST["mobileNo"];
    $pincode = $_POST["pincode"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $sql = "INSERT INTO `useraddress` (`name`, `mobileNo`, `pincode`, `address`, `city`, `user`) 
            VALUES ('$name', '$mobileNo', '$pincode', '$address', '$city', '$user');";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['success_message'] = "Address added successfully";
        header('Location: deliveryAddress.php');
        exit(); 
    } else {
        echo "Failed to add address: " . mysqli_error($conn);
    }
}

include_once '..\User\db_conn.php';  
$user = $_SESSION['user'];
$q = "SELECT * FROM useraddress WHERE user = '$user'";
$result = mysqli_query($conn, $q);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}

$noAddress = (mysqli_num_rows($result) == 0);
$cartItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="address.css" />
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../MyStyle.css">
    <link rel="stylesheet" href="cartWishlist.css">
    <title>Document</title>
</head>

<body>
    <?php
    include_once '../Components/_navbar.php';
    ?>
    <div class="AddressPageBox">
        <form method="POST" action="">
            <div class="addressForm">
                <div class="addressFormTop">
                    <div class="addressPageHeading">
                        <h3>Contact Details</h3>
                    </div>
                    <div class="name">
                        <input type="text" name="name" placeholder="Name*..." required />
                    </div>
                    <div class="mobileNo">
                        <input type="text" name="mobileNo" placeholder="Mobile no*..." required />
                    </div>
                </div>
                <div class="addressFormTop">
                    <div class="addressPageHeading">
                        <h3>Address</h3>
                    </div>
                    <div class="pincode">
                        <input type="text" name="pincode" placeholder="Pincode*..." required />
                    </div>
                    <div class="address">
                        <input type="text" name="address" placeholder="Address (House no, building, street, area)*..."
                            required />
                    </div>
                    <div class="city">
                        <input type="text" name="city" placeholder="Locality/Town*..." required />
                    </div>
                    <button type="submit" name="addAddress" style="width: 100%; background-color: tomato; height: 40px">
                        Add Address
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>