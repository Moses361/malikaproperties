<?php
session_start();

include("functions/functions.php");
include("includes/db.php");

if (!isset($_POST['addToCart'])) {
    die("You are not allowed to access this route");
}
if(!isset($_SESSION['customer_email'])){
    header('location: index.php');
    exit();
}

$p_id = $_POST['product_id'];
$base_price = $_POST['base_price'];
$num_units = @$_POST['num_units'];

// get user id 
$sql = "SELECT customer_id, customer_contact FROM customers WHERE customer_email = '{$_SESSION['customer_email']}' LIMIT 1";
$result = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($result);
$customer_id = $data['customer_id'];

// insert into bookings table
$sql = "INSERT INTO orders (customer_id, product_id, num_units) VALUES ('$customer_id', '$p_id', '$num_units')";
$query = mysqli_query($con, $sql);
// get last insert id of the query above
$order_id = mysqli_insert_id($con);

if(!$query){
    die("An error while placing your booking. Please try again: " . mysqli_error($con));
}

// set session for the total amount the customer is to pay
$_SESSION['booking']['total'] = $base_price * $num_units;
$_SESSION['booking']['phone'] = $data['customer_contact'];
$_SESSION['booking']['customer_id'] = $customer_id;
$_SESSION['booking']['order_id'] = $order_id;
header("Location: checkout.php");