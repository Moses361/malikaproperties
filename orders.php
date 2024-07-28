<?php
include("includes/header.php");
include_once 'payment.php';
include_once 'Functions.php';

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
