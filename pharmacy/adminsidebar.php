<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar with Profile</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="icon" type="logo-image" href="logo.png">
</head>
<body>
    <div class="sidebar">
        <!-- Profile Section -->
        <div class="profile">
            <img src="pfp.webp" alt="Profile Image" class="profile-img">
            <h2 class="profile-name">Admin</h2>
        </div>

        <div class="dropdown">
          <button class="dropdown-button" id="dropdownbtn1">Suppliers</button>
          <div class="dropdown-content" id="dropdowncontent1">
          <a href="#">Supplier</a>
              <a href="#">Add Supplier</a>
              
          </div>
      </div>

      <div class="dropdown">
        <button class="dropdown-button" id="dropdownbtn2">Summary Inventory</button>
        <div class="dropdown-select" id="dropdownselect2">
            <a href="adminproductm.php">Inventory</a>
            
            
        </div>
    </div>

      <nav class="nav-links">
        <a href="#">Dashboard</a>
        <a href="logout.php">Logout</a>
    </nav>
    </div>
    
</body>
<script src="js/dashboard.js"></script>
</html>