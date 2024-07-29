<?php 
     $active='MY ACCOUNT';
    include("includes/header.php");

    // redirect to home page if already logged in 
    if(isset($_SESSION['customer_email'])){
        header('location: index.php');
        exit();
    }

    if(isset($_POST['login'])){
        
        $customer_email = $_POST['c_email'];
        
        $customer_pass = $_POST['c_pass'];
        
        $select_customer = "select * from customers where customer_email='$customer_email' AND customer_pass='$customer_pass'";
        
        $run_customer = mysqli_query($con,$select_customer);
        
        $get_ip = getRealIpUser();
        
        $check_customer = mysqli_num_rows($run_customer);
        
        if($check_customer == 0){
            echo "<script>alert('Invalid email or password')</script>";
            exit();
        }
        
        $row = mysqli_fetch_array($run_customer);

        $_SESSION['customer_email']=$row['customer_email'];
        $_SESSION['customer_id']=$row['customer_id'];
        
        $_SESSION['success'] = "Login success";
        header('location: index.php');
    }

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