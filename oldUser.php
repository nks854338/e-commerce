<?php
$login = "0";
$error = "0";
if (isset($_POST['s1'])) {

    // db_connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "e_commerce";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM `user` WHERE `email`='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $error = "1";
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header("location: index.php");
            exit(); // Ensure no further code is executed after the redirect
        } else {
            $login = "1";
            echo "<h1>Incorrect password</h1>";
        }
    } else {
        $login = "1";
        echo "<h1>User not found</h1>";
    }

    $conn->close();
}
?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Register form</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        a{
            text-decoration: none;
            color: #eb5e28;
            font-weight: 600;
        }

        h2{
            font-size: 5.5vmin;
            text-align: center;
        }

        p{
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vmin;
        }

        form {
            height: 65vh;
            width: 30vw;
            padding: 4vmin;
            box-shadow: gray 0 2px 5px;
            display: grid;
            gap: 3vmin;
            border-radius: 10px;
        }

        .formInput {
            width: 100%;
            display: grid;
            gap: 2.5vmin;
        }

        input , .registerBtn button{
            border-radius: 10px;
            border: none;
            height: 5vmin;
            width: 100%;
            box-shadow: gray 0 2px 5px;
            background-color: #ffffff;
        }

        .registerBtn button{
            background-color: #111;
            color: #fff;
            height: 5.5vmin;
            font-size: 3.2vmin;
        }

        .registerBtn button:hover{
            background-color: #fc6a03;
            color: #fff;
            transform: scale(1.05);
        }

        .forgotBox {
            display: grid;
            align-items: center;
            justify-content: center;
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    include_once ('_navbar.php');
    ?>

    <div class="container">

        <form action="oldUser.php" method="post" enctype="multipart/form-data">
            <div class="formHeading">
                <h2>Login</h2>
                <p>Welcome back! we miss you!</p>
            </div>
            <div class="formInput">
                <div class="inputBox">
                    <div>
                        <i class="fa-solid fa-user" style="color:rgb(0, 0, 0);"></i> Email :
                    </div>
                    <div>
                        <input type="email" class="name" required name="email">
                    </div>
                </div>
                <div class="inputBox">
                    <div>
                        <i class="fa-solid fa-lock" style="color: rgb(2, 2, 2);"></i> Password :
                    </div>
                    <div>
                        <input type="password" class="password" required name="password">
                    </div>
                </div>
            </div>
            <div class="registerBtn"><button name="submit" class="register">Login</button></div>
            <div class="forgotBox">
                <div><a href="#">Forgot password?</a></div>
                <div> Not a member?
                    <a href="newUser.php">Register Now</a>
                </div>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>