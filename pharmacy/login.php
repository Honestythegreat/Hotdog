<?php 
session_start();
include 'dbconnect.php';

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Query to select user from the database
    $select = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $select);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        
        // Set session variables based on user type
        $_SESSION['user_id'] = $row['id'];             // Main user session ID
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        
        if ($row['user_type'] == 'admin') {
            $_SESSION['user_type'] = 'admin';
            header("Location: admin.php");
            exit();
        } elseif ($row['user_type'] == 'normal') {
            $_SESSION['user_type'] = 'normal';
            header("Location: home.php");
            exit();
        }
    } else {
        // Store error message and redirect back to login page
        $_SESSION['login_error'] = 'Incorrect email or password';
        header("Location: index.php");
        exit();
    }
}
?>
