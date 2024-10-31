<?php 
session_start();
include_once('../php/searchByClick.php');     // This is for rendering all cards by searching product by click
include_once('../php/searchByInput.php');    // This is for rendering all cards by searching product by input
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
</head>

<body>
    <?php
    include_once '../Components/_navbar.php';
    ?>

    <section class="searchProductSection secondSection"> <!-- This section renders search data -->
        <?php
        if (isset($_POST['search'])) {
            echo "<div class='cartHeadingBox' style='height: 50px; padding-top: 40px; padding-left: 25px; display: flex; align-items: center;'><div class='cartHeading' style='font-size: 28px; font-weight: 700;'>
                Result for " . htmlspecialchars($name) . "
            </div> </div>";
        }

        if (isset($_POST['input'])) {
            if (!empty($inputData)) {
                echo "<div class='cartHeadingBox'  style='height: 50px; padding-top: 40px; padding-left: 25px; display: flex; align-items: center;'><div class='cartHeading' style='font-size: 28px; font-weight: 700;'>
                Result for " . htmlspecialchars($inputData) . "
            </div></div>";
            }
        }
        ?>
        
        <div class="secSecCards" style='display: flex; justify-content: space-around; flex-wrap: wrap; margin: auto;'>
            <?php
            if (isset($_POST['search'])) {
                if (!$noSearch) {
                    $count = 0;
                    while ($x = mysqli_fetch_assoc($output)) {
                        echo "
                            <form method='post' action='singleProduct.php'>
                                <input type='hidden' name='product_id' value='{$x['pno']}'>
                                <button type='submit' name='showproduct' style='all: unset; cursor: pointer;'>
                                    <div class='displayedCard'>
                                        <div class='displayedProductImage'>
                                            <img src='../{$x['image']}' alt='' class='img' />
                                        </div>
                                        <div class='displayedProductInfoBox'>
                                            <div class='displayedProductInfo'>
                                                <div class='displayedProductName'>{$x['productName']}</div>
                                                <div class='displayedProductdesc'>{$x['productDescription']}</div>
                                                <div class='displayedProductPrice'>
                                                    <span class='currProductPrice'>RS.{$x['ProductPrice']}</span>
                                                    <span class='previousProductPrice'>Rs.1000</span>
                                                    <span class='ProductOffer'>(50% OFF)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </form>
                        ";
                        $count++;
                    }
                } else {
                    echo "<div class='emptyCartDiv' id='emptyCartDiv'>
                        <div style='height: 400px;'>
                            <img src='../image/noItemFound.jpg' style='height: 400px;'>
                            <div class='noResultFoundText' style='text-align: center; font-size: 40px; font-weight: 500;'>No result found</div>
                        </div>
                    </div>";
                }
            }

            if (isset($_POST['input'])) {
                if (!$noInput) {
                    $count = 0;
                    while ($x = mysqli_fetch_assoc($output)) {
                        echo "
                            <form method='post' action='singleProduct.php'>
                                <input type='hidden' name='product_id' value='{$x['pno']}'>
                                <button type='submit' name='showproduct' style='all: unset; cursor: pointer;'>
                                    <div class='displayedCard'>
                                        <div class='displayedProductImage'>
                                            <img src='../{$x['image']}' alt='' class='img' />
                                        </div>
                                        <div class='displayedProductInfoBox'>
                                            <div class='displayedProductInfo'>
                                                <div class='displayedProductName'>{$x['productName']}</div>
                                                <div class='displayedProductdesc'>{$x['productDescription']}</div>
                                                <div class='displayedProductPrice'>
                                                    <span class='currProductPrice'>RS.{$x['ProductPrice']}</span>
                                                    <span class='previousProductPrice'>Rs.1000</span>
                                                    <span class='ProductOffer'>(50% OFF)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </form>
                        ";
                        $count++;
                    }
                } else {
                    echo "<div class='emptyCartDiv' id='emptyCartDiv'>
                        <div style='height: 400px;'>
                            <img src='../image/noItemFound.jpg' style='height: 400px;'>
                            <div class='noResultFoundText' style='text-align: center; font-size: 40px; font-weight: 500;'>No result found</div>
                        </div>
                    </div>";
                }
            }
            ?>
        </div>
    </section>

    <?php
    include_once '../Components/_footer.php';
    ?>
</body>

</html>
