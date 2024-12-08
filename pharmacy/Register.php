
<?php include 'dbconnect.php';?>
<html>
    <head></head>
    
    <body>
    <link rel='stylesheet' type='text/css' href='css/register.css'>
    <div class="register">
        <form action="reg.php" method="POST">
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class = "error-msg">' .$error. '</span>';
                }
            }


?>
            
            <input type='text' placeholder='Username' required name = 'uname'class = 'usertb'><br>
            
            <input type='password' placeholder='Password' required name = 'pass' class = 'passtb'><br>
            
            <input type='password' placeholder='Confirm Password' required name = 'Cpass' class = 'Cpasstb'><br>
            
            <input type='text' placeholder='email' required name = 'email' class = 'emailtb'><br>
            
            <input type='text' placeholder='Contact Number' required name = 'number' class = 'numbertb'><br>
            <button type='submit' name = 'submit' value = 'Register' class = 'regbtn' > Register </button>

</form>
    </div>

</body>

</html>
