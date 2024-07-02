<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "e_commerce";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$q = "SELECT * FROM producttype";
$result = mysqli_query($conn, $q);

$cnt = mysqli_affected_rows($conn);
if ($cnt == 0) {
    $noProduct = true;
} else {
    $noProduct = false;
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Mukta:wght@300;500&family=Poppins:wght@300;500;700&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styled.css">
    <title>e-commerce site</title>
</head>

<body>
    <?php
    include_once ('_navbar.php');
    ?>

    <section method="post" action="index.php">
        <section class="firstSection">
            <div class="firSecComponent">

                <?php
                if (isset($_SESSION['user'])) {
                    echo '<div class="firSecComp1">Welcome to Sneh Sangrah, ';
                    echo $_SESSION['name'] . '!</div>';
                } else {
                    echo '<div class="firSecComp1"> Celebrate EVERY moment with gifts from small shops!</div>';
                }
                ?>
                <div class="firSecComp2">
                    <?php
                    if (!$noProduct) {
                        $skip = 8;
                        $count = 0;
                        while ($x = mysqli_fetch_array($result)) {
                            if ($count < $skip) {
                                echo "<div class='firSecBox1 firSecBox'>
                                    <form method='post' action='index.php'>
                                        <input type='hidden' name='product_id' value='{$x[0]}'>
                                        <button type='submit' id='' name='search' style='all: unset; cursor: pointer;'>
                                            
                        <div class='image'>
                            <a href='index.php'><img src='{$x[2]}' alt='' class='proImg' height='100%' style='border-radius: 50%;'></a>
                        </div>
                        <p class='proNam'>{$x[1]}</p>
                          </button>
                                    </form>
                      </div>";
                            }
                            $count++;
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="searchProductSection"></section>

        <section class="secondSection">
            <div class="secSecheading">
                Shop our popular gift categories
            </div>
            <div class="secSecCards">
                <?php
                if (!$noProduct) {
                    // Reset the result pointer to the beginning
                    mysqli_data_seek($result, 0);

                    $startNum = 7;
                    $endNum = 13;
                    $count = 0;
                    while ($x = mysqli_fetch_array($result)) {
                        if ($count > $startNum && $count < $endNum) {
                            echo "<form method='post' action='index.php'>
                                        <input type='hidden' name='product_id' value='{$x[0]}'>
                                        <button type='submit' name='search' style='all: unset; cursor: pointer;'>
                                          <div class='card3 secSeccard'>
                                <img src='$x[2]' alt='' class='cardProImg4 cardimg'>
                                <div class='cardpara'>
                                    $x[1]
                                </div>
                              </div>
                               </button>
                                    </form>";
                        }
                        $count++;
                    }
                }
                ?>
            </div>
        </section>

        <section class="secondSection">
            <div class="secSecheading">
                Gifts that honor Mom and Dad's love
            </div>
            <div class="secSecCards">
                <?php
                if (!$noProduct) {
                    // Reset the result pointer to the beginning
                    mysqli_data_seek($result, 0);

                    $startNum = 13;
                    $endNum = 19;
                    $count = 0;
                    while ($x = mysqli_fetch_array($result)) {
                        if ($count > $startNum && $count < $endNum) {
                            echo "<form method='post' action='index.php'>
                                        <input type='hidden' name='product_id' value='{$x[0]}'>
                                        <button type='submit' name='search' style='all: unset; cursor: pointer;'>
                                         <div class='card2 secSeccard' type='submit' name='search'>
                    <img src='$x[2]' alt=' class='cardProImg2 cardimg'>
                    <div class='cardpara'>
                        $x[1]
                    </div>
                </div>
                 </button>
                                    </form>";
                        }
                        $count++;
                    }
                }
                ?>
            </div>
        </section>

        <section class="secondSection">
            <div class="secSecheading">
                Gifts for friends
            </div>
            <div class="secSecCards">
                <?php
                if (!$noProduct) {
                    // Reset the result pointer to the beginning
                    mysqli_data_seek($result, 0);

                    $startNum = 19;
                    $endNum = 25;
                    $count = 0;
                    while ($x = mysqli_fetch_array($result)) {
                        if ($count > $startNum && $count < $endNum) {
                            echo "<form method='post' action='index.php'>
                                        <input type='hidden' name='product_id' value='{$x[0]}'>
                                        <button type='submit' name='search' style='all: unset; cursor: pointer;'>
                                         <div class='card2 secSeccard' type='submit' name='search'>
                    <img src='$x[2]' alt=' class='cardProImg2 cardimg'>
                    <div class='cardpara'>
                        $x[1]
                    </div>
                </div>
                 </button>
                                    </form>";
                        }
                        $count++;
                    }
                }
                ?>
            </div>
        </section>

        <section class="thirdSection">
            <div class="thiSecheading">
                Discover more shops in India
            </div>
            <div class="thiSecCards">
                <?php
                if (!$noProduct) {
                    // Reset the result pointer to the beginning
                    mysqli_data_seek($result, 0);

                    $skip = 25;
                    $count = 0;
                    while ($x = mysqli_fetch_array($result)) {
                        if ($count >= $skip) {
                            echo "<form method='post' action='index.php'>
                                        <input type='hidden' name='product_id' value='{$x[0]}'>
                                        <button type='submit' name='search' style='all: unset; cursor: pointer;'>
                  <div class='card1 thiSeccard' type='submit' name='search'>
                    <img src='$x[2]' alt=' class='cardProImg1 cardimg'>
                    <div class='cardpara'>
                        <h4>$x[1]</h4>
                        <p>$x[3]</p>
                    </div>
                </div>
                 </button>
                                    </form>
                ";
                        }
                        $count++;
                    }
                }
                ?>
            </div>
        </section>

        <section class="fourthSection"></section>
        <section class="fifthSection"></section>
    </section>
    <?php
    include_once ('_footer.php');
    ?>
</body>

</html>



<?php
if (isset($_POST['search'])) {
    $product_id = $_POST['product_id'];
    echo '<script type="text/javascript">';
    echo '</script>';

    $sql = "SELECT * FROM `producttype` WHERE `sno`='$product_id'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        while ($data = mysqli_fetch_array($result))
            $keywords = $data[4];
    } else {
        echo "error";
    }

}
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "e_commerce";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$q = "SELECT * FROM producttype";
$result = mysqli_query($conn, $q);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// $cnt = mysqli_affected_rows($conn);
// $noProduct = ($cnt == 0);

$filteredProducts = [];
if (isset($_POST['search'])) {
    $product_id = $_POST['product_id'];

    $sql = "SELECT searchkey FROM producttype WHERE sno='$product_id'";
    $searchkey = mysqli_query($conn, $sql);

    if (!$searchkey) {
        die("Query failed: " . mysqli_error($conn));
    }

    $num = mysqli_num_rows($searchkey);
    echo $num;

    if ($searchkey->num_rows > 0) {
        // Fetch data from result set
        while ($row = $result->fetch_assoc()) {
            echo "g$filter=$row.filter($data1 => 
      $data1.name.toLowerCase().includes($searchkey)
  );</script>";
            // Now $row is an associative array
            echo "ID: " . $row["sno"] . " - Name: " . $row["name"] . "<br>";
        }
    } else {
        echo "0 results";
    }
}
?>