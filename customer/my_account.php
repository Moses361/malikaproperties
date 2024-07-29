<?php 

   session_start();
   if(!isset($_SESSION['customer_email'])){

     echo"<script>window.open('../login.php','_self')</script>";

   }else{

     
   include("includes/db.php"); 
   include("includes/header.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account|Malika Properties</title>
    <link rel="stylesheet" href="styles/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
    
</head>
<body>
<div id="content"><!--content  begin -->
  <div class="container"><!--container begin -->

    <div class="container col-md-12"><!--container col-md-12 begin -->
    
          <ul class="breadcrumb"><!--breadcrumb   begin -->
              <li>
                  <a href="index.php">Home</a>
              </li>
              <li>
                  My Account
              </li>
          </ul><!--breadcrumb   Finish -->
    
    </div><!--container col-md-12  Finish -->
    <div class="col-md-3"><!--col-md-3   begin -->
          <?php
               include("includes/sidebar.php")
           ?>
    </div><!--col-md-3   Finish -->

       <div class="col-md-9"><!--col-md-9  begin -->
       
           <div class="box"><!--box  begin -->
                 <?php 
                
                  if (isset($_GET['edit_account'])){
                       include("edit_account.php");

                  }
                
                ?>
                 <?php 
                
                  if (isset($_GET['change_pass'])){
                       include("change_pass.php");

                  }
                
                ?>
                 <?php 
                
                  if (isset($_GET['delete_account'])){
                       include("delete_account.php");

                  }
                
                ?>
           
           </div><!--box  Finish -->
       
       </div><!--col-md-9  Finish -->
       
  </div><!--container   Finish -->
</div><!--content  Finish -->


 <?php
    
    include("includes/footer.php")
    
 ?>

    <script src="js/jquery-331.min.js"></script>
     <script src="js/bootstrap-337.min.js"></script>
</body>
</html>
<?php } ?>
