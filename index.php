<?php
include_once('php/renderAllCommonScript.php');   //this is for rendering all productsType cards
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cartWishlist.css">
    <title>e-commerce site</title>
</head>

<body>
    <?php
    include_once('Components/_navbar.php');
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
                    include_once('php/roundProductSection.php');
                    ?>
                </div>
            </div>
        </section>

        <section class="secondSection" style="margin-top: 0vmin;">
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
                            echo "<form method='post' action='products/searchProduct.php'>
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
                            echo "<form method='post' action='products/searchProduct.php'>
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
                            echo "<form method='post' action='products/searchProduct.php'>
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
                            echo "<form method='post' action='products/searchProduct.php'>
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
    include_once('Components/_footer.php');
    ?>
</body>

</html>
