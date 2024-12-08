<html>
<head> 
    <?php
    include 'header.php';
    include 'dbconnect.php';
    ?>
    <link rel="stylesheet" type="text/css" href="css/product.css">
</head>
<body>
<div class="container"> <!-- Main container for products -->
    <?php
    // Select query with search filter if provided
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $filter = $_GET['search'];     
        $select = mysqli_query($conn, "SELECT product.id, product.Product_Name, product.Milligram, product.Product_Price, product.Image, product.Prescribed, product_detail.Quantity
          FROM product
          LEFT JOIN product_detail ON product.id = product_detail.product_id WHERE Product_Name LIKE '%$filter%'");
    } else {
        $select = mysqli_query($conn, "SELECT product.id, product.Product_Name, product.Milligram, product.Product_Price, product.Image, product.Prescribed, product_detail.Quantity
          FROM product
          LEFT JOIN product_detail ON product.id = product_detail.product_id");
    }

    // Display products
    if (mysqli_num_rows($select) > 0) {
        while ($row = mysqli_fetch_assoc($select)) {
            echo '<div class="product">';
            echo '<img src="image/' . $row['Image'] . '" height="80" alt="">';
            echo '<ul>';
            echo '<li>Name: ' . $row['Product_Name'] . '</li>';
            echo '<li>Milligram: ' . $row['Milligram'] . ' MG</li>';
            echo '<li>Price: ' . $row['Product_Price'] . ' Pesos</li>';
            echo '<li>Stock: ' . ($row['Quantity'] !== null ? $row['Quantity'] : 'Out of Stock')     . '</li>';
            echo '</ul>';
            
            if ($row['Prescribed'] == 1) {
                echo '<li class="prescription-required">This product needs a prescription</li>';
            } else {
                echo '<li class="no-prescription">Product does not need any prescription</li>';
            }

            echo '<button onclick="addtocart(' . $row['id'] . ', \'' . $row['Product_Name'] . '\', \'' . $row['Milligram'] . '\', ' . $row['Product_Price'] . ', ' . $row['Prescribed'] . ')" class="add-to-cart">Add to Cart</button>';
            echo '</div>';
        }
    } else {
        echo "<p>No products found.</p>";
    }
    ?>
</div> <!-- End of the main container for products -->
<script src="js/cart.js"></script>
</body>
</html>