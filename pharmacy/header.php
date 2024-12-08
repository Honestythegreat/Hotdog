<?php
include "dbconnect.php";
session_start(); //put this in every page so that it can catch the session

// Ensure user_id is set
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

// Get the count of items in the cart
$count_query = mysqli_query($conn, "SELECT COUNT(*) as count FROM cart WHERE user_id = $user_id");
$result = mysqli_fetch_assoc($count_query);
$count = $result['count'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="icon" type="image/png" href="logo.png"> <!-- Corrected type to image/png -->
    <title>Pharmacy</title> <!-- Added title for better SEO -->
</head>
<body>
    <header>
        <div class="logo">
            <a href="#"><img src="css/logo.png" alt="Site Logo" class="logo-image"></a>
        </div>
        <nav class="nav-links">
            <a href="home.php">Home</a>&nbsp;&nbsp; 
            <a href="product.php">Products</a>
            <a href="#">About Us</a>&nbsp;&nbsp;
        </nav>
        <div class="search-bar">
            <form action="product.php" method="GET">
                <input type="text" name="search" value="<?php if(isset($_GET['search'])) echo htmlspecialchars($_GET['search']); ?>" placeholder="Search for products..." class="search-input">
                <button class="search-button">Search</button>
            </form>
        </div>
        <a href="viewcart.php" class="cart"><span>Cart (<?php echo $count; ?>)</span></a>

        <div class="user-account">
            <button class="user-button" id="userBtn">
                <img src="css/pfp.jpg" alt="User Icon" class="user-icon">
                <?php 
                if(isset($_SESSION['email'])){
                    echo htmlspecialchars($_SESSION['email']); // Ensure output is safe
                } else {
                    echo "<a href='index.php'>Log in</a>";
                }
                ?>
            </button>
            <div class="dropdown-content" id="userDropdown">
                <a href="#">Account Settings</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </header>
    <script src="js/header.js"></script>
</body>
</html>
