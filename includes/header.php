<?php 

   session_start();
   include("includes/db.php"); 
   include("functions/functions.php");

?>

<?php 

   if(isset($_GET['pro_id'])){

        $product_id = $_GET['pro_id'];
        $get_product = "select * from products where product_id='$product_id'";

        $run_product = mysqli_query($con,$get_product);
        $row_product =  mysqli_fetch_array($run_product);
        $p_cat_id = $row_product['p_cat_id'];
        $pro_title = $row_product['product_title'];
        $pro_price = $row_product['product_price'];
        $pro_desc = $row_product['product_desc'];
        $pro_img1 = $row_product['product_img1'];
        $pro_img2 = $row_product['product_img2'];
        $pro_img3 = $row_product['product_img3'];

        $get_p_cat = "select * from product_categories where p_cat_id='$p_cat_id'";

        $run_p_cat = mysqli_query($con,$get_p_cat );
        $row_p_cat = mysqli_fetch_array($run_p_cat);
        $p_cat_title = $row_p_cat['p_cat_title'];
        

   }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MALIKA INVESTEMENTS</title>
    <link rel="stylesheet" href="styles/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <style type="text/tailwindcss">
       @layer utilities {
          .content-auto {
             content-visibility: auto;
            }
         }
         </style>

   <script src="https://cdn.tailwindcss.com"></script>
   <script>
      tailwind.config = {
         theme: {
         extend: {
            colors: {
               primary: '#4fbfa8',
            }
         }
         }
      }
   </script>

</head>
<body>
     <div id="navbar" class="navbar navbar-default"><!--navbar navbar-default  begin -->
         <div class="container mt-5"><!--container begin -->
            <div class="navbar-header"><!--navbar-header begin -->
               <a href="index.php" class="navbar-brand home"><!--navbar-brand home begin -->
                  <img src="images/logo.jpeg" alt="Malika Properties Logo" class="hidden-xs" style="height: 50px; width:170px; object-fit: contain;">
                  <img src="images/logo.jpeg" alt="Malika Properties Logo Mobile" class="visible-xs" style="height: 50px; width:170px; object-fit: contain;">
               </a><!--navbar-brand home finish -->
               <button class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                  <span class="sr-only">Toggle Navigation</span>
                  <i class="fa fa-align-justify"></i>  
               </button>
            </div><!--navbar-header  finish -->
            <div class="" id="navigation"><!--navbar-collapse collapse  begin -->
               <div class="paddig-nav flex justify-between"><!--pig-nav  Begin -->
                  <ul class="nav navbar-nav left text-black"><!--nav navbar-nav left  Begin -->
                     <li class="<?php if($active=='HOME') echo"active"; ?>">
                        <a href="index.php">Home</a>
                     <li>
                     <li class="<?php if($active=='SHOPPING CART') echo"active"; ?>">
                           <a href="bookingHistory.php">Booking History</a>
                     </li>
                     <li class="<?php if($active=='CONTACT US') echo"active"; ?>">
                        <a href="contact.php">CONTACT US</a> 
                     </li>
                  </ul><!--nav navbar-nav left  finish -->
                  <ul class="nav navbar-nav left text-black">
                     <li><a href="customer/my_account.php"><?php echo $_SESSION['customer_email']; ?></a></li>
                        <?php
                           if(isset($_SESSION['customer_email'])){
                        ?>
                     <li>
                        <a href="logout.php" class="no-underline"><button class="btn border border-primary text-primary hover:border-none hover:text-white hover:bg-primary">Logout</button> </a>
                     </li>
                        <?php 
                           };
                           if(!isset($_SESSION['customer_email'])){
                        ?>
                     <li style="display: flex; align-items: center;">
                        <a href="login.php" class="no-underline"><button class="btn border text-white bg-primary border-none hover:border-ring px-8 py-3">Login</button> </a> or 
                        <a href="customer_register.php" class="no-underline"><button class="btn border border-primary text-primary hover:border-none hover:text-white hover:bg-primary">Register</button> </a>
                     </li>
                        <?php
                           };
                        ?>
                  </ul>
               </div><!--paddig-nav  finish -->
            </div><!--collapse clearfix  finish --> 
                
         </div><!--navbar-collapse collapse  finish -->
                    
      </div><!--container Finish -->

   </div><!--navbar navbar-default  Finish -->


    
