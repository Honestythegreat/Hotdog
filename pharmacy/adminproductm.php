<?php
include "dbconnect.php";
include "adminsidebar.php";
?>
<html>
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inventory</title>
    <link rel="stylesheet" type="text/css" href="css/inventory.css">
</head>
<body>
<form action="adminproductm.php" method="GET">
            <input type="text" name= "search" value = "<?php if(isset($_GET['search'])) echo $_GET['search']; ?>" placeholder="Search for products..." class="search-input">
            <button class="search-button">Search</button>
            <a href="insertforms.php">Add Products</a>
<div class="product-display">
    <table class="product-display-table" border='1' cellpadding='10' cellspacing='0'>
    <thead>
    <tr>
        <th>Product Image</th>
        <th>Product Name</th>
        <th>Product Milligram</th>
        <th>Product Price</th>
        <th>Actions</th>  
    </tr>
    </thead>
    <tbody>
    <?php
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $filter = $_GET['search'];     
        $select = mysqli_query($conn, "SELECT * FROM product WHERE Product_Name LIKE '%$filter%'");
    } else {
        // If no search query, select all products
        $select = mysqli_query($conn, "SELECT * FROM product");
    }
    if (mysqli_num_rows($select) > 0) {
        while ($row = mysqli_fetch_assoc($select)) {
    ?>
    <tr>
        <td><img src="image/<?php echo $row['Image']; ?>" height="100" alt=""></td>
        <td><?php echo $row['Product_Name']; ?></td>
        <td><?php echo $row['Milligram']; ?></td>
        <td><?php echo $row['Product_Price']; ?></td>
        
        <td>
            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
            <a href="delete.php?id=<?php echo $row['id']; ?>">Hide</a>
        </td>  
    </tr>
    <?php 
        } 
    } else {
        echo "<tr><td colspan='6'>No Product Found</td></tr>";
    }
    ?>
    </tbody>
    </table>
</div>
</body>
</html>