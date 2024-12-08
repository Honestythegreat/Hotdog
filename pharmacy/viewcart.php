<?php
session_start();
include 'dbconnect.php';
// if not logged in, have to transition to make home.php as an index instead of the log in page
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to view your cart.";
    exit();
}

$user_id = $_SESSION['user_id'];
$cart_query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = $user_id AND Status = 'cart'");   


echo "<h2>Your Cart</h2>";
if (mysqli_num_rows($cart_query) > 0) {
    echo "<form action='chechkout.php' method='POST'>"; 
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr>";
    echo "<th>Select</th>";
    echo "<th>Product Name</th>";
    echo "<th>Milligram (MG)</th>";
    echo "<th>Price (Pesos)</th>";
    echo "<th>Quantity</th>";
    echo "<th>Subtotal</th>";
    echo "</tr>";
    
    while ($item = mysqli_fetch_assoc($cart_query)) {
        $subtotal = $item['prod_price'] * $item['prod_quantity'];
        

        echo "<tr>";
        echo "<td><input type='checkbox' name='selected_items[]' value='{$item['prod_id']}' class='item-checkbox' data-price='{$subtotal}'></td>";
        echo "<td>{$item['prod_name']}</td>";
        echo "<td>{$item['prod_mg']} MG</td>";
        echo "<td>{$item['prod_price']} Pesos</td>";
        echo "<td>{$item['prod_quantity']}</td>";
        echo "<td>{$subtotal} Pesos</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<p>Total Price: <span id='total-price'>0</span> Pesos</p>";
    echo "<button type='submit' name='checkout'>Checkout Selected</button>"; // Submit button for checkout
    echo "</form>";
} else {
    echo "<p>Your cart is empty.</p>";
}
//remember the INSERT INTO SELECT sql command when putting the check out page also use this on the delete page on admin so instead of deleting it will be marked as arhhived(webdev flashbacks)

?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateTotalPrice() {
        let totalPrice = 0;
        // Loop through each checkbox to see if it's checked
        document.querySelectorAll('.item-checkbox').forEach(checkbox => {
            if (checkbox.checked) {
                totalPrice += parseFloat(checkbox.getAttribute('data-price'));
            }
        });
        // Update the displayed total price
        document.getElementById('total-price').textContent = totalPrice.toFixed(2);
    }

    // Add event listeners to each checkbox to update total on change
    document.querySelectorAll('.item-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateTotalPrice);
    });
})
</script>

