<?php include 'dbconnect.php'; ?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Alto Pharmacy Login</title>
</head>
<body>

<div class="container">
    <h1 class="title">Alto Pharmacy</h1>

    <div class="Login">
        <form action="login.php" method="POST">
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
            }
            ?>
            <input type="text" placeholder="Email" required class="usernametb" name="email"><br>
            <input type="password" placeholder="Password" required class="passtb" name="password">
            <button class="loginbt" type="submit" name="submit">Log in</button>
        </form>

        <p class="or"> ------------- or -------------</p>

        <div class="links">
            <p>Don't have an account yet?</p>
            <a id="signupbtn" class="signupbtn" href="Register.php">Sign Up</a>
        </div>
    </div>
</div>

</body>
</html>
