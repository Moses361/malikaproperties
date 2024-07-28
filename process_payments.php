<?php
session_start();

include_once 'includes/db.php';
include_once 'payment.php';
include_once 'Functions.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['checkout'])) {
    $amount = $_POST["amount"];
    $phone = $_POST["phone"];

    $id = create_order($_SESSION['customer_email'], $o_id, $total, $origin, $destination,$order_date);
    $mpesa = new MpesaApi(rand(1, 1000));
    $token = $mpesa->get_access_tocken();
    // get the last 9 digits of the phone number
    $phone = "254" . substr($phone, -9);
    $message = $mpesa->stk_push($token, $amount, $phone);
    $res = json_decode($message);

    if(!isset($res-> CheckoutRequestID)){
        $_SESSION['error'] = "Unable to reach the M-Pesa number you provided: ".$phone;
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }else{
        $_SESSION['success'] = "Kindly check the M-Pesa popup sent to your phone to complete booking. Thank you.";
        header("Location: checkout_success.php");
    }
    // save transaction details
    $sql = "INSERT INTO transactions(order_id, customer_id, checkout_request_id) VALUES('{$_SESSION['booking']['order_id']}', '{$_SESSION['booking']['customer_id']}', '{$res-> CheckoutRequestID}')";
    $query = mysqli_query($con, $sql);
    if(!$query){
        echo json_encode([
            "success"=>false,
            "message"=>"Unable to save transaction info: ".mysqli_error($con)
        ]);
        return;
    }
}
?>
