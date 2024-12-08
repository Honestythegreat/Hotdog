<?php
include ("dbconnect.php");


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
    <h3> Manufacturer Details</h3>
    
    <input type="submit" class="btn" name="add_details" value="Add Manufactured">
</form>
    </div>
   </div>

</body>


</html>