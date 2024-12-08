<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
header('Content-Type: application/json'); 

include 'dbconnect.php';


$raw_input = file_get_contents("php://input");
$data = json_decode($raw_input, true);
error_log("Raw input: " . $raw_input);
error_log("Decoded data: " . print_r($data, true));
error_log("Data keys: " . implode(", ", array_keys($data))); 


if (!isset($data['id']) || !isset($data['name']) || !isset($data['milligram']) || !isset($data['price']) || !isset($data['Prescribed'])) {
    echo json_encode(["success" => false, "message" => "Missing required fields."]);
    exit();
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Please log in to add items to the cart."]);
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $data['id'];
$product_name = $data['name'];
$milligram = $data['milligram'];
$price = $data['price'];
$prescribed = $data['Prescribed'];


$check_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = $user_id AND prod_id = $product_id");

if (mysqli_num_rows($check_cart) > 0) {
    
    $query = "UPDATE cart  SET prod_quantity = prod_quantity + 1, Status = 'cart' WHERE user_id = $user_id AND prod_id = $product_id";
    $action = "updated";
} else {
    
    $query = "INSERT INTO cart (user_id, prod_id, prod_name, prod_mg, prod_price, prod_quantity, Prescribed, Status) VALUES ($user_id, $product_id, '$product_name', '$milligram', $price, 1, $prescribed, 'cart')";
    $action = "added";
}


if (mysqli_query($conn, $query)) {
    echo json_encode(["success" => true, "message" => "$product_name has been $action to your cart."]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to add to cart: " . mysqli_error($conn)]);
}
?>
