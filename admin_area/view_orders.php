<style>
.pending{
    color: orange;
}
.paid{
    color: green;
}
.cancelled{
    color: maroon;
}
</style>
<?php 
    if(!isset($_SESSION['admin_email'])){
        header("Location: login.php");
        return;
    }
    
    require_once('../payment.php');

    // check order payment status
    function checkOrdersPaymentStatus($con){
        $sql = "SELECT * FROM transactions WHERE checked=false AND checkout_request_id != ''";
        $query = mysqli_query($con, $sql);
        if (!$query) die("Error getting transactions: ".mysqli_error($con));

        while(($data = mysqli_fetch_array($query))){
            $order_id = $data['order_id'];
            $mpesa = new MpesaApi($order_id);
            $response = $mpesa->verifyTransactionDetails($data['checkout_request_id']);
            $data = json_decode($response, true);
            $resultCode = $data['ResultCode'];
            if ($resultCode == 0){
                // order successfully paid. update order status
                $sql = "UPDATE transactions SET paid=1, checked=true WHERE order_id='$order_id';";
            }else{
                // order cancelled or not paid, or cancelled by the user
                $sql = "UPDATE transactions SET paid=2, checked=true WHERE order_id='$order_id';";
            }
            $q2 = mysqli_query($con, $sql); // update orders
            if (!$q2) die("Errror updating payment status: ".mysqli_error($con));
        }
    }
?>

<div class="row"><!-- row 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <ol class="breadcrumb"><!-- breadcrumb begin -->
            <li class="active"><!-- active begin -->
                
                <i class="fa fa-dashboard"></i> Dashboard / View Orders
                
            </li><!-- active finish -->
        </ol><!-- breadcrumb finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 1 finish -->

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
               <h3 class="panel-title"><!-- panel-title begin -->
               
                   <i class="fa fa-tags"></i>  View Orders
                
               </h3><!-- panel-title finish --> 
            </div><!-- panel-heading finish -->
            
            <div class="panel-body"><!-- panel-body begin -->
                <div class="table-responsive"><!-- table-responsive begin -->
                    <table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->
                        
                        <thead><!-- thead begin -->
                            <tr><!-- tr begin -->
                                <th>Name </th>
                                <th>Email </th>
                                <th>Phone</th>
                                <th>Unit</th>
                                <th>Location</th>
                                <th>Units Booked</th>
                                <th>Unit Price</th>
                                <th>Total Amount </th>
                                <th>Date</th>
                                <th>Payment Status</th>
                                <th>Action</th>
                            </tr><!-- tr finish -->
                        </thead><!-- thead finish -->
                        <tbody><!-- tbody begin -->
                            <?php 
                                // update orders payment status
                                checkOrdersPaymentStatus($con);
                                $sql = "SELECT orders.*, 
                                        customers.customer_name, customers.second_name, customers.customer_email, customers.customer_contact, 
                                        products.product_id, products.product_title, products.product_img1, products.product_price, products.location,
                                        transactions.paid as is_paid, transactions.checked as is_checked
                                        FROM orders INNER JOIN products ON orders.product_id = products.product_id
                                        INNER JOIN customers ON orders.customer_id = customers.customer_id
                                        INNER JOIN transactions ON orders.id = transactions.order_id";

                                $query = mysqli_query($con,$sql);

                                while($row_order=mysqli_fetch_array($query)){
                                    $first_name= $row_order['customer_name'];
                                    $last_name = $row_order['second_name'];
                                    $customer_email = $row_order['customer_email'];
                                    $customer_phone = $row_order['customer_contact'];
                                    $unit = $row_order['product_title'];
                                    $units_booked = $row_order['num_units'];
                                    $unit_price = $row_order['product_price'];
                                    $location = $row_order['location'];
                                    $total_amount = $unit_price * $units_booked;
                                    $date = $row_order['created_at'];
                                    // format date in terms of  
                                    $payment_status = $row_order['is_paid'] == 1 ? 'Paid' : ($row_order['is_paid'] == 2 ? 'Cancelled' : 'Pending');
                                    $date = date('d/m/y h:i A', strtotime($date));
                                    $unit_price = number_format($unit_price,"0", ".",",");
                                    $total_amount = number_format($total_amount,"0", ".",",");
                            ?>
                            <tr><!-- tr begin -->
                                <td> <?php echo $first_name." ".$last_name; ?> </td>
                                <td> <?php echo $customer_email; ?> </td>
                                <td> <?php echo $customer_phone; ?> </td>
                                <td> <?php echo $unit; ?> </td>
                                <td> <?php echo $location; ?> </td>
                                <td> <?php echo $units_booked; ?> </td>
                                <td> <?php echo $unit_price; ?> </td>
                                <td> <?php echo $total_amount; ?> </td>
                                <td> <?php echo $date; ?> </td>
                                <td> 
                                    <?php 
                                        $class = strtolower($payment_status);
                                        echo "<span class='$class'> $payment_status </span>";
                                    ?> 
                                </td>
                                <td> 
                                    <a href="index.php?delete_order=<?php echo $order_id; ?>">
                                        <i class="fa fa-trash-o"></i> Delete
                                    </a> 
                                </td>
                            </tr><!-- tr finish -->
                            <?php } ?>
                        </tbody><!-- tbody finish -->
                        
                    </table><!-- table table-striped table-bordered table-hover finish -->
                </div><!-- table-responsive finish -->
            </div><!-- panel-body finish -->
            
        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->