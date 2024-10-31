<?php
session_start();
if(isset($_SESSION['user'])){                    //cheak user is login or not for accessing this resource
    header(('location: ../index.php'));
    die();
}

$show = "0";
$error = "0";
//db_connection
include_once '..\User\db_conn.php';

if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    if (($password == $cpassword)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `user` (`name`,`email`, `password`) VALUES ('$name', '$email', '$hashed_password')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $show = "1";
            header("location: oldUser.php");
        }
    } else {
        echo "failure";
        $error = "1";
    }
}
$conn->close();

?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="auth.css">
    <title>Register form</title>
</head>

<body>
    <?php
    include_once '../Components/_navbar.php';
    ?>

    <div class="registerContainer">

        <form action="newUser.php" method="post" enctype="multipart/form-data" class="registerform" style="padding-right: 45px; padding-left: 30px;">
            <div class="loginFormHeadings">
                <h2>Register</h2>
                <p>Join us today and unlock exclusive deals and offers!</p>
            </div>
            <div class="loginFormInputs">
                <div class="loginInputBoxes">
                    <div>
                        <i class="fa-solid fa-user" style="color:rgb(0, 0, 0);"></i> Name :
                    </div>
                    <div>
                        <input type="text" class="name" required name="name">
                    </div>
                </div>
                <div class="loginInputBoxes">
                    <div>
                        <i class="fa-solid fa-user" style="color:rgb(0, 0, 0);"></i> Email :
                    </div>
                    <div>
                        <input type="email" class="email" required name="email">
                    </div>
                </div>
                <div class="loginInputBoxes">
                    <div>
                        <i class="fa-solid fa-lock" style="color: rgb(2, 2, 2);"></i> Password :
                    </div>
                    <div>
                        <input type="password" class="password" required name="password">
                    </div>
                </div>
                <div class="loginInputBoxes">
                    <div>
                        <i class="fa-solid fa-lock" style="color: rgb(2, 2, 2);"></i> Confirm Password :
                    </div>
                    <div>
                        <input type="password" class="cpassword" required name="cpassword">
                    </div>
                </div>
            </div>
            <div class="registerBtn"><button name="submit" class="register">Register</button></div>
            <!-- <div><button><i class="fa-brands fa-google"></i>SignIn with google</button></div> -->
            <div class="forgotBox">
                <div>Already have a account?
                    <a href="oldUser.php">Login Here</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>