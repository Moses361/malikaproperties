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
                  <a href="checkout.php">Checkout</a>
              </li>
              <li>
                  <a href="checkout_success.php">Checkout Success</a>
              </li>
          </ul><!--breadcrumb   Finish -->
    
    </div><!--container col-md-12  Finish -->
    <div class="col-md-12"><!--col-md-9   Finish -->
        <div class="flex items-center justify-center mx-auto mb-10">
            <div class="box w-2/3 rounded-lg"><!-- box begin-->
                <img src="images/lipanampesa.png" class="image-responsive h-36 w-full overflow-hidden" style="object-fit: cover"  alt="Lipa Na M-Pesa Logo">
                <div class="flex flex-col mt-8">
                    <span class="text-3xl italic text-green pl-10"> 
                        <?php
                         if(isset($_SESSION['success'])){
                             echo $_SESSION['success'];
                             unset($_SESSION['success']);
                         }
                         ?>
                    </span>
                    <div class="flex justify-between mt-10">
                        <button class="px-10 text-primary outline-none focus:outline-none focus:text-black hover:text-black" id="backBtn"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-lg btn-primary" id="okBtn">Ok</button>
                    </div>
                </div>
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

    document.getElementById('okBtn').addEventListener('click', function(e){
        e.preventDefault();
        window.location.href = 'orders.php';
    });
</script>
</body>
</html>