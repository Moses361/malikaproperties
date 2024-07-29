<?php
require_once "includes/db.php";

// Get parameters from the URL
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : '';

// Construct the SQL query
$sql = "SELECT * FROM products WHERE (`product_title` LIKE '%$search%' OR `location` LIKE '%$search%')";

if($category != "nil"){
    $sql .= " AND p_cat_id = '$category'";
}

if(isset($max_price) && !empty($max_price)){
    $sql .=  " AND `product_price` <= '$max_price'";
}

// Execute the query
$query = mysqli_query($con, $sql);

// Prepare the response
$response = [];
$response['success'] = false;
$response['data'] = [];

if ($query) {
    // Fetch the results
    while ($row = mysqli_fetch_assoc($query)) {
        $response['data'][] = $row;
    }

    // If data exists, set success to true
    if (count($response['data']) > 0) {
        $response['success'] = true;
    }
}

// Set the header to return JSON response
header('Content-Type: application/json');

// Return the JSON response
echo json_encode($response);
?>
