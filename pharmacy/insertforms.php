<?php
include "dbconnect.php";
if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_mg = $_POST['product_mg'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'image/'.$product_image;
    $prescription = $_POST['prescription'];
    

    // Check for empty fields
    if(empty($product_name) || empty($product_price)){
        $message[] = 'Please fill out all product information';
    } else {
        // Insert query with new fields
        $insert = "INSERT INTO product(Product_Name, Milligram, Product_Price, Image, Prescribed) 
                   VALUES ('$product_name', '$product_mg', '$product_price', '$product_image', '$prescription')";
        
        $upload = mysqli_query($conn, $insert);
        if($upload) {
            if (move_uploaded_file($product_image_tmp_name, $product_image_folder)) {
                echo 'File uploaded successfully.';
            } else {
                echo 'Failed to move uploaded file.';
            }
            $message[] = 'New Product Added Successfully';
            header("Location: adminproductm.php");
            exit();
        } else {
            $message[] = 'Could not add the product';
        }
    }
}
?>
<html>
    <head> 
        <meta charset = "UTF-8">
        <meta http-equiv= "X-UA-Compatible" content="IE=edge">
        <title> Inventory </title>
        <link rel= "stylesheet" type="text/css" href= "css/insert.css">
    </head>
    <body>
        <?php
        if(isset($message)){
            foreach($message as $message){
                echo '<span class="message"> '.$message.' </span>';
            }
        }
        ?>
     
   <div class="container">
    <div class="form">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method="POST">
    <h3> Add a new product </h3>
    <input type="text" placeholder="Enter Product/Medicine Name" name="product_name" class="box">
    <input type="number" placeholder="Enter Product/Medicine Milligram" name="product_mg" class="box">
    <input type="text" placeholder="Enter Product/Medicine Price" name="product_price" class="box">
    <input type="number" class="prescription" name="prescription" min="0" max="1" placeholder="put 1 if product needs prescription">
    <input type="file" name="product_image" class="box">
    <input type="submit" class="btn" name="add_product" value="Add a product">
</form>
    </div>
   </div>

</body>


</html>