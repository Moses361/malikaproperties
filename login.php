<?php 
     $active='MY ACCOUNT';
    include("includes/header.php");


?>

<div id="content"><!--content  begin -->
  <div class="container"><!--container begin -->
    <div class="container col-md-12"><!--container col-md-12 begin -->
    
          <ul class="breadcrumb"><!--breadcrumb   begin -->
              <li>
                  <a href="index.php">Home</a>
              </li>
              <li>
                  <a href="details.php?pro_id=">Product Details</a>
              </li>
              <li>
                  <a href="login.php">Checkout</a>
              </li>
          </ul><!--breadcrumb   Finish -->
    
    </div><!--container col-md-12  Finish -->
    <div class="col-md-12"><!--col-md-9   Finish -->

          <?php 
          
              if(!isset($_SESSION['customer_email'])){

                   include("customer/customer_login.php");

              }else{

                    include("payment_options.php");

              }

          ?>
    </div><!--col-md-9   Finish -->

  </div><!--container   Finish -->
</div><!--content  Finish -->


 <?php
    
    include("includes/footer.php")
    
 ?>

    <script src="js/jquery-331.min.js"></script>
     <script src="js/bootstrap-337.min.js"></script>
</body>
</html>