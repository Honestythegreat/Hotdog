<?php include 'dbconnect.php';



if(isset ($_POST['submit']) ){
    $username =  mysqli_real_escape_string($conn, $_POST['uname']);
    $password = $_POST['pass'];
    $contact = $_POST['number'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $cpass = $_POST['Cpass'];
    
    $select = " SELECT * FROM user where email = '$email' && password = '$password'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $error[] = 'user already exist';
    }else{
        if($password != $cpass){
            $error[] = 'password not matched';
        }else{
            $insert = "INSERT INTO user(username, password, email, contact, user_type) VALUES ('$username', '$password', '$email', '$contact', 'normal')";
            mysqli_query($conn, $insert);
            header('location: index.php');
            exit();
        }
    }
}
?>