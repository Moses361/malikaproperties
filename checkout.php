<?php 
    session_start();
    $active='MY ACCOUNT';
    include("includes/header.php");

    // redirect to home page if already logged in 
    if(!isset($_SESSION['customer_email'])){
        header('location: index.php');
        exit();
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
        <div class="flex items-center justify-center mx-auto mb-10">
            <div class="box w-2/3 rounded-lg"><!-- box begin-->
                <img src="images/lipanampesa.png" class="image-responsive h-36 w-full overflow-hidden" style="object-fit: cover"  alt="Lipa Na M-Pesa Logo">
                <p class="lead">
                <form action="process_payments.php" class="form-login" method="post"><!-- form-login begin -->
                    <label class="text-2xl"> Amount</label>                            
                    <input type="text" class="form-control mt-1" placeholder="amount" name="amount" required value="<?php echo $_SESSION['booking']['total']; ?>">   <br>                         
                    <input type="text" class="form-control mt-3" placeholder="Enter M-Pesa number to be billed" name="phone" required="" value="<?php echo $_SESSION['booking']['phone']; ?>"><br>
                    <div class="flex justify-between">
                        <button class="px-10 text-primary outline-none focus:outline-none focus:text-black hover:text-black" id="backBtn"><i class="fa fa-chevron-left"></i></button>
                        <button type="submit" class="btn btn-lg btn-primary" name="checkout">Pay</button>
                    </div>
                </form><!-- form-login finish -->
                </p>  
            </div><!-- box Finish-->
        </div>
    </div><!--col-md-9   Finish -->

  </div><!--container   Finish -->
</div><!--content  Finish -->

 <?php
    include("includes/footer.php")
 ?>

    <script src="js/jquery-331.min.js"></script>
     <script src="js/bootstrap-337.min.js"></script>
<script>
    document.getElementById('backBtn').addEventListener('click', function(e){
        e.preventDefault();
        window.history.back();
    }); 
</script>
</body>
</html>