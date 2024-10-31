<?php
session_start();
include('config.php'); // Ensure this includes your Google client setup as well

if (isset($_SESSION['user'])) { 
    header('location: ../index.php');
    die();
}

if (isset($_GET["code"])) {
    try {
        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
        if (isset($token['error'])) {
            throw new Exception("Error fetching access token: " . $token['error']);
        }
        if ($token === null || !isset($token['access_token'])) {
            throw new Exception("Failed to retrieve access token.");
        }
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();
        
          include_once '..\User\db_conn.php';
        $email = $data['email'];
        $name = $data['given_name'] . ' ' . $data['family_name'];
        $sql = "SELECT * FROM `user` WHERE `email`='$email'";
        $result = mysqli_query($conn, $sql);
        
        if (!$result) {
            die("Query Failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) == 0) {
            // If user doesn't exist, insert into the database
            $insert_sql = "INSERT INTO `user` (email, name) VALUES ('$email', '$name')";
            if (mysqli_query($conn, $insert_sql)) {
                $_SESSION['user'] = $email;
                $_SESSION['name'] = $name;
                header("location: ../index.php");
                exit();
            } else {
                die("Error inserting user: " . mysqli_error($conn));
            }
        } else {
            // User exists, set session variables
            $_SESSION['user'] = $email;
            $_SESSION['name'] = $name;
            header("location: ../index.php");
            exit();
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
        exit;
    }
}

if (isset($_POST['submit'])) { 
    include_once '..\User\db_conn.php';
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]); 

    $sql = "SELECT * FROM `user` WHERE `email`='$email'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Query Failed: " . mysqli_error($conn)); 
    }

    $num = mysqli_num_rows($result); 

    if ($num > 0) { 
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $email;
            $_SESSION['name'] = $row['name'];
            header("location: ../index.php"); 
            exit(); 
        } else {
            echo "<script>alert('Incorrect password');</script>"; 
        }
    } else {
        echo "<script>alert('User not found');</script>";
    }

    $conn->close(); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="auth.css">
    <title>Login Form</title>
</head>

<body>
    
    <?php 
    include_once '../Components/_navbar.php'; ?>

    <div class="loginContainer">
        <form action="oldUser.php" method="post" class="loginform">
            <div class="loginFormHeadings">
                <h2>Login</h2>
                <p>Welcome back! We miss you!</p>
            </div>
            <div class="loginFormInputs">
                <div class="loginInputBoxes">
                    <div>
                        <i class="fa-solid fa-user" style="color: rgb(0, 0, 0)"></i> Email:
                    </div>
                    <div>
                        <input type="email" class="name" required name="email" style="max-width: 96%;"/>
                    </div>
                </div>
                <div class="loginInputBoxes">
                    <div>
                        <i class="fa-solid fa-lock" style="color: rgb(2, 2, 2)"></i> Password:
                    </div>
                    <div>
                        <input type="password" class="password" required name="password" style="max-width: 96%;"/>
                    </div>
                </div>
            </div>
            <div class="registerBtn">
                <button name="submit" class="register">Login</button>
            </div>
            <div class="forgotBox" style="display: flex; flex-direction: column; gap: 8px;">
                <div><a href="#">Forgot password?</a></div>
                <div>
                    Not a member?
                    <a href="newUser.php">Register Now</a>
                </div>
            </div>
            <div class="withGoogle" style="display: flex; align-items: center; justify-content: center; margin-top: 10px;">
                <a href="<?php echo $google_client->createAuthUrl(); ?>" class="withGoogleBtn"  style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <div class="GoogleLogo"><img src="../image/Google.png" alt="" height="25px"></div>
                    <div class="googleText">Login with Google</div>
                </a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
