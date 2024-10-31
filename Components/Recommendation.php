<?php
// Include database connection
include_once '..\User\db_conn.php';

// Check for a successful connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL query
$q = "SELECT * FROM producttype";

// Execute the query and check for errors
$result = mysqli_query($conn, $q);
if (!$result) {
    die("Query failed: " . mysqli_error($conn)); // Output any query errors
}

// Check if there are results
$cnt = mysqli_num_rows($result);
$noProduct = ($cnt == 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styled.css">
    <title>Recommendation</title>
</head>
<body>
<div class="firSecComp2">
    <?php
    // If there are products, render them
    if (!$noProduct) {
        $skip = 8;  // Maximum number of products to display
        $count = 0;
        while ($x = mysqli_fetch_array($result)) {
            if ($count < $skip) {
                $product_id = $x['id'];         // Assuming 'id' is the product ID column
                $product_name = $x['name'];     // Assuming 'name' is the product name column
                $product_image = $x['image'];   // Assuming 'image' stores the path of the product image

                echo "
                <div class='firSecBox1 firSecBox'>
                    <form method='post' action='index.php'>
                        <input type='hidden' name='product_id' value='{$product_id}'>
                        <button type='submit' name='search' style='all: unset; cursor: pointer;'>
                            <div class='image'>
                                <img src='{$product_image}' alt='{$product_name}' class='proImg' height='100%' style='border-radius: 50%;'>
                            </div>
                            <p class='proNam'>{$product_name}</p>
                        </button>
                    </form>
                </div>";
            }
            $count++;
        }
    } else {
        echo "<p>No products available.</p>"; // Inform if there are no products
    }
    ?>
</div>
</body>
</html>

<?php
// Close the database connection at the end of the script
mysqli_close($conn);
?>
