<?php
session_start();
include_once 'payment.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $amount = $_POST["amount"];
    $phone = $_POST["phone"];
    // // start testing 
    // /*
    $mpesa = new MpesaApi();
    $token = $mpesa->get_access_tocken();
    // */
    // // end testign 
    $formated = str_split($phone);
    array_shift($formated);
    // print_r($formated);
    $accepted_format = implode("", $formated);
    // print($accepted_format);
    // die();
    $new_phone = "254".$accepted_format;
    print($amount.":".$new_phone);
    $message = $mpesa->stk_push($token, $amount, $new_phone);
    print($message);
    die();

    $session_email = $_SESSION['customer_email'];
    
    $select_customer = "select * from customers where customer_email='$session_email'";
    
    $run_customer = mysqli_query($con,$select_customer);
    
    $row_customer = mysqli_fetch_array($run_customer);
    
    $customer_id = $row_customer['customer_id'];

}
?>
<div class="flex items-center justify-center mx-auto mb-10">
    <div class="box w-2/3 rounded-lg"><!-- box begin-->
        <img src="images/lipanampesa.png" class="image-responsive h-36 w-full overflow-hidden" style="object-fit: cover"  alt="Lipa Na M-Pesa Logo">
        <p class="lead">
        <form action="orders.php" class="form-login" method="post"><!-- form-login begin -->
            <label class="text-2xl"> Amount</label>                            
            <input type="text" class="form-control mt-1" placeholder="amount" name="amount" required value="<?php echo $_SESSION['booking']['total']; ?>">   <br>                         
            <input type="text" class="form-control mt-3" placeholder="Enter M-Pesa number to be billed" name="phone" required="" value="<?php echo $_SESSION['booking']['phone']; ?>"><br>
            <div class="flex justify-between">
                <button type="cancel" class="px-10 text-primary outline-none focus:outline-none focus:text-black hover:text-black" name="goBack" onclick="history.back()"><i class="fa fa-chevron-left"></i></button>
                <button type="submit" class="btn btn-lg btn-primary" name="checkout">Pay</button>
            </div>
        </form><!-- form-login finish -->
        </p>  
    </div><!-- box Finish-->

</div>
