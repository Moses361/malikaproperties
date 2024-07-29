<?php
$active = 'SHOPPING CART';
//  date_default_timezone_set('UTC');
include("includes/header.php");

if(!isset($_SESSION['customer_email'])){
  die("You need to be logged in to access your booking history");
}

// delete order
if(isset($_GET['delete_order'])){
  $order_id = $_GET['delete_order'];
  $delete_order = "DELETE FROM orders WHERE id = '$order_id'";
  $run_delete = mysqli_query($con,$delete_order);
  if($run_delete){
    echo "<script>alert('Order has been deleted')</script>";
    echo "<script>window.open('bookingHistory.php','_self')</script>";
  }
}

// check if order has been paid
function checkOrderPaymentStatus($con, $customer_id){
  $sql = "SELECT * FROM transactions WHERE checked=false AND checkout_request_id != '' AND customer_id='$customer_id'";
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

<div id="content"><!--content  begin -->
  <div class="container"><!--container begin -->
    <div class="container col-md-12"><!--container col-md-12 begin -->

      <ul class="breadcrumb"><!--breadcrumb   begin -->
        <li>
          <a href="index.php">Home</a>
        </li>
        <li class="cursor-pointer">
          Booking History
        </li>
      </ul><!--breadcrumb   Finish -->

    </div><!--container col-md-12  Finish -->

    <div id="cart" class="col-md-12"><!--cart col-md-12  begin-->

      <div class="box"><!--box   begin-->

        <form action="bookingHistory.php" method="post" enctype="multipart/form-data" id="orderForm"><!--form   begin -->

          <h1>Bookings</h1>

          <?php

          ?>
          <div class="table-responsive"><!--table-responsive   begin -->
          <table class="table table-striped table-bordered table-hover" id="myTable"><!-- table table-striped table-bordered table-hover begin -->
                        
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
                                checkOrderPaymentStatus($con, $_SESSION['customer_id']);

                                $sql = "SELECT orders.*, 
                                        customers.customer_name, customers.second_name, customers.customer_email, customers.customer_contact, 
                                        products.product_id, products.product_title, products.product_img1, products.product_price, products.location,
                                        transactions.paid as is_paid, transactions.checked as is_checked
                                        FROM orders INNER JOIN products ON orders.product_id = products.product_id
                                        INNER JOIN customers ON orders.customer_id = customers.customer_id
                                        INNER JOIN transactions ON orders.id = transactions.order_id 
                                        WHERE customers.customer_id = '{$_SESSION['customer_id']}'";

                                $query = mysqli_query($con,$sql);

                                while($row_order=mysqli_fetch_array($query)){
                                    $order_id = $row_order['id'];
                                    $product_id = $row_order['product_id'];
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
                                    $payment_status = ($row_order['is_paid'] == 0) ? 'Pending' : (($row_order['is_paid'] == 1) ? 'Paid' : 'Cancelled');
                                    $date = date('d/m/y h:i A', strtotime($date));
                                    $unit_price = number_format($unit_price,"0", ".",",");
                                    $total_amount = number_format($total_amount,"0", ".",",");
                            ?>
                            <tr data-product-id="<?=$product_id;?>" class="bhTr cursor-pointer"><!-- tr begin -->
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
                                  <a href="bookingHistory.php?delete_order=<?php echo $order_id; ?>">
                                      <i class="fa fa-trash-o"></i> Delete
                                  </a> 
                              </td>
                            </tr><!-- tr finish -->
                            <?php } ?>
                        </tbody><!-- tbody finish -->
                        
                    </table><!-- table table-striped table-bordered table-hover finish -->
          </div><!--table-responsive   Finish -->
          <div class="flex w-full justify-end items-end" id="orderOptions">
            <button id="downloadBtn" title="Download Report" class="btn btn-lg bg-primary"> <i class="fa fa-download"></i></button>
          </div>
        </form><!--form   Finish -->
      </div><!--box   Finish -->
    </div><!--cart col-md-12   Finish -->
  </div><!--container   Finish -->
</div><!--content  Finish -->


<?php

include("includes/footer.php")

  ?>

<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>
</body>

</html>



<script>
  // Get the table element
  var table = document.getElementById('myTable');

  // Function to print the table
  function printTable() {
    printPageArea("orderForm");
  }

  // print only a section of a page
  function printPageArea(areaID) {
    var printContent = document.getElementById(areaID).innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = printContent;
    var orderOptions = document.getElementById("orderOptions");
    orderOptions.style.display = "none"; // hide order options while printing report
    window.print();
    // orderOptions.style.display = "block"; // show order options back
    document.body.innerHTML = originalContent;
  }

  // Function to download the table as CSV
  function downloadTable() {
    printPageArea("orderForm");
  }

  // Download receipts
  var downloadBtn = document.getElementById('downloadBtn');
  downloadBtn.addEventListener('click', downloadTable);

  // open product details on tr click
  document.querySelectorAll(".bhTr").forEach(tr => {
    tr.addEventListener("click", function(){
      const productId = this.getAttribute("data-product-id");
      window.location.href = `details.php?pro_id=${productId}`;
    });
  })

</script>
