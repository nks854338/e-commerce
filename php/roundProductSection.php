<?php          //this script is for rendering round cards in top section

if (!$noProduct) {
    $skip = 8;
    $count = 0;
    while ($x = mysqli_fetch_array($result)) {
        if ($count < $skip) {
            echo "<div class='firSecBox1 firSecBox'>
                <form method='post' action='./products/searchProduct.php'>
                    <input type='hidden' name='product_id' value='{$x[0]}'>
                    <button type='submit' id='' name='search' style='all: unset; cursor: pointer;'>
                        
    <div class='image'>
        <a href='./index.php'><img src='{$x[2]}' alt='' class='proImg' height='100%' style='border-radius: 50%;'></a>
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