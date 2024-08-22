<?php                                           //this script is for rendering cards
session_start();

include_once 'User\db_conn.php';

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



<?php                                            //this script is for search

if (isset($_POST['search'])) {
    $product_id = $_POST['product_id'];

    $sql = "SELECT * FROM `producttype` WHERE `sno`='$product_id'";
    $r = mysqli_query($conn, $sql);

    if ($r) {
        $array = mysqli_fetch_array($r);
        $name = $array['name'];
    }

    $q = "SELECT * FROM `product` WHERE `productname`like '%$name%'";
    $output = mysqli_query($conn, $q);
    $numOfRow = mysqli_affected_rows($conn);

    if (!$output) {
        die("Query failed: " . mysqli_error($conn));
    }

    if ($numOfRow == 0) {
        $noSearch = true;                 //this varibale is used to render the cards on Home page
    } else {
        $noSearch = false;
    }
}

?>


<?php

if (isset($_POST['input'])) {
    include_once 'User\db_conn.php';
    $inputData = $_POST['inputData'];
    if($inputData==""){
         $noInput = true;  
    }
    else{
    $q = "SELECT * FROM `product` WHERE `productname` like '%$inputData%' || `productDescription` like '%$inputData%' || `searchkey` like '%$inputData%'";
    $output = mysqli_query($conn, $q);
    $numOfRow = mysqli_affected_rows($conn);

    if (!$output) {
        die("Query failed: " . mysqli_error($conn));
    }

    if ($numOfRow == 0) {
        $noInput = true;            //this varibale is used to render the cards on Home page
    } else {
        $noInput = false;
    }
}
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
    <link rel="stylesheet" href="style.css">
    <title>e-commerce site</title>
</head>

<body>
    <?php
         include_once ('Components/_navbar.php');
    ?>

    <main method="post" action="index.php">
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

        <section class="searchProductSection secondSection">                      <!-- this section renders search datas -->                
            <?php
            if (isset($_POST['search'])) {
                echo "<div class='secSecheading'>
                Result for `$name`
            </div>";
            }

            if (isset($_POST['input'])) {
                if(!$inputData==""){
                echo "<div class='secSecheading'>
                Result for `$inputData`
            </div>";
                }
            }
            ?>
            <div class="secSecCards"
                style='display: flex; justify-content: space-around; flex-wrap: wrap;  margin: auto;'>
                <?php
                if (isset($_POST['search'])) {
                    if (!$noSearch) {
                
                        $startNum = 1;
                        $endNum = 50;
                        $count = 0;
                        while ($x = mysqli_fetch_assoc($output)) {
                            if ($count < $skip) {
                                echo "
                                <form method='post' action='singleProduct.php'>
                                    <input type='hidden' name='product_id' value='{$x['pno']}'>
                                    <button type='submit' name='showproduct' style='all: unset; cursor: pointer;'>
 <div class='displayedCard'>
      <div class='displayedProductImage'>
        <img
          src='{$x['image']}'
          alt='
          class='img'
        />
      </div>
      <div class='displayedProductInfoBox'>
        <div class='displayedProductInfo'>
          <div class='displayedProductName'>{$x['productName']}</div>
          <div class='displayedProductdesc'>{$x['productDescription']}</div>
          <div class='displayedProductPrice'>
            <span class='currProductPrice'>RS.{$x['ProductPrice']}</span>
            <span class='previousProductPrice'>Rs.1000</span>
            <span class='ProductOffer' span>(50%OFF)</span>
          </div>
        </div>
      </div>
    </div>
       </button>
                                </form>
                ";
                            }
                            $count++;
                        }
                    }
                }

                if (isset($_POST['input'])) {
                    if (!$noInput) {
                        $startNum = 1;
                        $endNum = 50;
                        $count = 0;
                        while ($x = mysqli_fetch_assoc($output)) {
                            if ($count < $skip) {
                                echo "
                                
 <div class='displayedCard'>
      <div class='displayedProductImage'>
        <img
          src='{$x['image']}'
          alt='
          class='img'
        />
      </div>
      <div class='displayedProductInfoBox'>
        <div class='displayedProductInfo'>
          <div class='displayedProductName'>{$x['productName']}</div>
          <div class='displayedProductdesc'>{$x['productDescription']}</div>
          <div class='displayedProductPrice'>
            <span class='currProductPrice'>RS.{$x['ProductPrice']}</span>
            <span class='previousProductPrice'>Rs.1000</span>
            <span class='ProductOffer' span>(50%OFF)</span>
          </div>
        </div>
      </div>
    </div>
                ";
                            }
                            $count++;
                        }
                    }
                }


                ?>
            </div>
        </section>

        <section class="secondSection" style="margin-top: -5vmin;">
            <div class="secSecheading secondMainHeading" style="padding-left:21px;">
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
            <div class="secSecheading secondMainHeading" style="padding-left:21px;">
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
                                         <div class='card2 secSeccard'>
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
            <div class="secSecheading secondMainHeading" style="padding-left:21px;">
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
                                         <div class='card2 secSeccard'>
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
            <div class="thiSecheading secondMainHeading" style="padding-left:21px;">
                Explore more products
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
                  <div class='card1 thiSeccard'>
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
    </main>
    <?php
    include_once ('Components/_footer.php');
    ?>
</body>

</html>