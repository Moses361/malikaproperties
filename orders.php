<?php
include("includes/header.php");
// include("functions/functions.php");
include_once 'payment.php';
include_once 'Functions.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    if (isset($_POST['checkout'])) {
        $amount = $_POST["amount"];
        $phone = $_POST["phone"];
        $total = total_price();
        $ip_add = getRealIpUser();
        $o_id = rand(100000, 999999);

        // get all items in the shopping cart for this user
        $sql = "SELECT * FROM cart WHERE ip_add='$ip_add';";
        $query = mysqli_query($con, $sql);
        if (!$query) die("Error getting items in cart: ".mysqli_error($con));

        $intiator = trim($_SESSION['customer_email']);
        $discount = 0; 
        $select_cart = "SELECT  * from referals where initiator  ='$intiator' AND redeemed=false;";
        $run_cart2 = mysqli_query($db, $select_cart);
        if(mysqli_num_rows($run_cart2) > 0){
            while($data = mysqli_fetch_array($run_cart2)){
                $discount += $data['discount'];
            }
            
            $total -= $discount; // deduct discount here before creating an order
        }

        // include transport cost in calculating the total price of the product
        while($row = mysqli_fetch_array($query)){
            $total += $row['transport_cost'];
        }

        $query = mysqli_query($con, $sql);
        $id = ""; //initially transaction id is empty. Updated once an order is successful
        while ($data = mysqli_fetch_array($query)){
            $origin = $data['origin'];
            $destination = $data['destination'];
            $order_date = $data['order_date'];
            $id = create_order($_SESSION['customer_email'], $o_id, $total, $origin, $destination,$order_date);
        }
        


        // print($id);
        // die();
        $mpesa = new MpesaApi($id);
        // $mpesa->setCallBackUrl($callback_url);
        
        $token = $mpesa->get_access_tocken();


        // */
        // // end testign 
        $formated = str_split($phone);
        array_shift($formated);
        // print_r($formated);
        $accepted_format = implode("", $formated);
        // print($accepted_format);
        // die();
        $new_phone = "254" . $accepted_format;
        // print($amount.":".$new_phone);
        $message = $mpesa->stk_push($token, $amount, $new_phone);
        // print($message);
        $res = json_decode($message);
        $checkout_request_id = "";
        if(!isset($res-> CheckoutRequestID)){
            die("Unable to reach the M-Pesa number you provided: ".$phone); // order processing must require a valid M-Pesa phone number
        }else{
            echo "Kindly check the M-Pesa popup sent to your phone to complete the order. Thank you.";
        }


        // save transaction details
        $sql = "INSERT INTO transactions(order_id, checkout_request_id) VALUES('$o_id', '$checkout_request_id');";
        $query = mysqli_query($con, $sql);

        if(!$query){
            echo json_encode([
                "success"=>false,
                "message"=>"Unable to save transaction info: ".mysqli_error($con)
            ]);
            return;
        }

        // order has been processed. Update referrals
        $session_email = trim($_SESSION['customer_email']);
        $sql = "UPDATE referals SET redeemed=true WHERE initiator='$session_email';";
        $query = mysqli_query($con, $sql);
        if (!$query){
            die("Unable to update referrals: ".mysqli_error($con));
        }

        // Order has been successful. Delete shopping cart
        $sql = "DELETE FROM cart WHERE ip_add='$ip_add';";
        $query = mysqli_query($con, $sql);
        if (!$query){
            die("Error clearing shopping cart: ".mysqli_error($con));
        }
        
    }

}
?>





<div class="box"><!-- box begin-->
    <?php

    $session_email = $_SESSION['customer_email'];

    $select_customer = "select * from customers where customer_email='$session_email'";

    $run_customer = mysqli_query($con, $select_customer);

    $row_customer = mysqli_fetch_array($run_customer);

    $customer_id = $row_customer['customer_id'];

    ?>


    <h1 class="text-center">Orders</h1>

    <p class="lead text-center"><!-- lead text-center Begin -->


    </p>

    <center id="orderSection">

        <p class="lead">
            <!-- Paypal Payment -->
<style>
    @media print{
        .no-print{
            display: none;
        }
    }
</style>
            <!-- <img  class="img-responsive" src="images/paypal_img.png" alt="img_paypal"> -->
        <form action="" class="form-login" method="post"><!-- form-login begin -->
            <h2 class="form-login-heading"> Refresh to update status</h2>
            <table class="table"><!--table   begin -->
                <table class="table" id="myTable">
                    <thead>
                        <tr><!--tr   begin -->

                            <th>Name</th>
                            <th>Order ID</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Location</th>
                            <th>Order Date</th>
                            <th class="no-print">Cancel Order</th>
                        </tr><!--tr   finish -->

                    </thead>
                    <tbody><!--tbody  begin -->
                        <?php

                        $total = 0;
                        //   $pro_id = $row_cart['p_id'];
                        //   $pro_size = $row_cart['size'];
                        //   $pro_qty = $row_cart['qty'];
                        $email = $_SESSION['customer_email'];
                        $get_products = "select * from orders  where customer  = '$email'";
                        $run_products = mysqli_query($con, $get_products);
                        while ($row_products = mysqli_fetch_array($run_products)) {
                            $name = $row_products['customer'];
                            $oId = $row_products['order_id'];
                            $status = $row_products['payment_status'];
                            $amount = $row_products['amount'];
                            $location = $row_products['location'];
                            $order_date = $row_products['order_date'];
                            ?>

                            <tr><!--tr   begin-->
                                <td>
                                    <?php echo $name; ?>
                                </td>
                                <td>
                                    <?php echo $oId; ?>"
                                <td>
                                    <?php echo $status; ?>
                                </td>
                                <td>
                                    <?php echo $amount; ?>
                                </td>
                                <td>
                                    <?php echo $location; ?>
                                </td>
                                <td>
                                    <?php echo $order_date; ?>
                                </td>
				 <th>
                                    <div class="no-print">
                                    <a style="cursor:pointer;" href="cancelOrders.php?order_id=<?php echo $oId; ?>"> <i class="fa fa-trash text-danger"></i> Cancel</a>
                                    </div>
                                </th>

                            </tr><!--tr   Finish -->
                        <?php

                        }

                        ?>

                    </tbody><!--tbody   Finish -->


                    <tfoot><!--tfoot   begin -->


                    </tfoot><!--tfoot   Finish -->

                </table><!--table   Finish -->

                <div id="downloadOptions">
                    <!-- <button id="printAndDownloadBtn" class="btn btn-lg btn-success ">Print and Download</button> -->
                    <button id="printBtn" class="btn btn-lg btn-success">Print</button>
                    <button id="downloadBtn" class="btn btn-lg btn-success">Download</button>
                </div>

        </form><!-- form-login finish -->

        </p>

    </center>

</div><!-- box Finish-->

<!-- JavaScript to add print and download buttons -->

<!-- JavaScript to add print and download functionality to the buttons -->
<script>
    // Get the table element
    var table = document.getElementById('myTable');

    // Function to print the table
    function printTable() {
        printPageArea("orderSection");
    }

    // Function to download the table as pdf
    function downloadTable() {
        printPageArea("orderSection");
    }

    // print only a section of a page
  function printPageArea(areaID) {
    var printContent = document.getElementById(areaID).innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = printContent;
    var downloadOptions = document.getElementById("downloadOptions");
    var heading = document.querySelector(".form-login-heading");
    heading.innerText = "Order Summary";
    downloadOptions.style.display = "none"; // hide order options while printing report
    window.print();
    // orderOptions.style.display = "block"; // show order options back
    document.body.innerHTML = originalContent;
  }

    // Attach click event listeners to the print and download buttons
    var printBtn = document.getElementById('printBtn');
    printBtn.addEventListener('click', printTable);

    var downloadBtn = document.getElementById('downloadBtn');
    downloadBtn.addEventListener('click', downloadTable);
</script>
