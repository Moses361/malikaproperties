<?php 
    session_start();
    $active='MY ACCOUNT';
    include("includes/header.php");

    // redirect to home page if already logged in 
    if(!isset($_SESSION['customer_email'])){
        header('location: index.php');
        exit();
    }
    $sql = "SELECT customer_contact as phone FROM customers WHERE customer_email = '{$_SESSION['customer_email']}'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $phone = $row['phone'];
    $_SESSION['booking']['phone'] = $phone;
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
              include_once("payment_options.php");
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