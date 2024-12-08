<?php
session_start();
include 'dbconnect.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to proceed.";
    exit();
}

$user_id = $_SESSION['user_id'];
$selected_items = $_POST['selected_items'] ?? [];

// Initialize variables
$prescription = false;
$total_price = 0;
$summary = [];

// Process the selected items
foreach ($selected_items as $prod_id) {
    // Get item details from the cart
    $item_query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' AND prod_id = '$prod_id'");
    $item = mysqli_fetch_assoc($item_query);

    // Check if prescription is required
    if ($item['Prescribed'] == 1) {
        $prescription = true;
        // Update the status to 'pending' for prescribed items
        mysqli_query($conn, "UPDATE cart SET Status = 'pending' WHERE user_id = '$user_id' AND prod_id = '$prod_id'");
    }

    // Calculate subtotal for the item
    $subtotal = $item['prod_price'] * $item['prod_quantity'];
    $total_price += $subtotal;

    // Add item to the order summary
    $summary[] = [
        'name' => $item['prod_name'],
        'mg' => $item['prod_mg'],
        'price' => $item['prod_price'],
        'quantity' => $item['prod_quantity'],
        'subtotal' => $subtotal
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
</head>
<body>
    <h2>Order Summary</h2>

    <!-- Display each product in a form-style layout -->
    <?php 
    foreach ($summary as $item) {
        echo "<p><strong>Product Name:</strong> " . htmlspecialchars($item['name']) . " (" . htmlspecialchars($item['mg']) . " MG)</p>";
        echo "<p><strong>Price:</strong> " . htmlspecialchars($item['price']) . " Pesos</p>";
        echo "<p><strong>Quantity:</strong> " . htmlspecialchars($item['quantity']) . "</p>";
        echo "<p><strong>Subtotal:</strong> " . htmlspecialchars($item['subtotal']) . " Pesos</p>";
        echo "<hr>";
    }
    ?>
    <p><strong>Total Price:</strong> <?php echo htmlspecialchars($total_price); ?> Pesos</p>

    <!-- Form for uploading prescription or ID -->
    <form action="process_checkout.php" method="POST" enctype="multipart/form-data">
        <?php
        if ($prescription) {
            // Show prescription and ID inputs if prescription is required
            echo '<p>Some items require a prescription. Please upload your prescription for approval.</p>';
            echo '<label for="prescription">Upload Prescription:</label>';
            echo '<input type="file" name="prescription" id="prescription" required><br><br>';
        }
        // Show ID input in both cases (prescription or not)
        echo '<label for="id">Upload ID for Discount:</label>';
        echo '<input type="file" name="id" id="id"><br><br>';
        
        echo '<button type="submit">Proceed to Checkout</button>';
        ?>
    </form>
</body>
</html>