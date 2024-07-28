<?php 
     $active='MY ACCOUNT';
    include("includes/header.php");
    if(isset($_POST['register'])){
        $c_name = $_POST['c_name'];
        $s_name = $_POST['s_name'];
        $c_email = $_POST['c_email'];
        $c_pass = $_POST['c_pass'];
        $c_pass = $_POST['c__confirm_pass'];
        $c_county = $_POST['c_county'];
        $c_contact = $_POST['c_contact'];
        $c_image = $_FILES['c_image']['name'];
        $c_image_tmp = $_FILES['c_image']['tmp_name'];
        $c_ip = getRealIpUser();
    
        move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");
        $insert_customer = "insert into customers (customer_name,second_name,customer_email,customer_pass,customer_county,customer_contact,customer_image,customer_ip) values ('$c_name','$s_name','$c_email','$c_pass','$c_county','$c_contact','$c_image','$c_ip')";
        $register_customer = mysqli_query($con,$insert_customer);
        if(!$register_customer){
            $_SESSION['error']="There was an error in registering you. Please try again";
            header("Location: customer_register.php");
            return;
        }

        $last_insert_id = mysqli_insert_id($con);
        $_SESSION['customer_email']=$c_email;
        $_SESSION['customer_id']=$last_insert_id;

        echo "<script>alert('You have been Registered Sucessfully')</script>";
        echo "<script>window.open('index.php','_self')</script>";
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
                  Register
              </li>
          </ul><!--breadcrumb   Finish -->
    
    </div><!--container col-md-12  Finish -->
    <div class="col-md-3"><!--col-md-3   begin -->
    
          
       </div><!--col-md-3   Finish -->
       <div class="col-md-6"><!--col-md-9  begin -->
    
          <div class="box"><!--box  begin -->
            
            <div class="box-header"><!--box-header  begin -->
              
              <div class="text-left">
                    <h2 class="text-4xl">Create Your Account with Malika Properties</h2>
                </div>

             <form action="" method="post" enctype="multipart/form-data" class="mt-5"><!--form  begin -->
             
                <div class="formm-group"><!--form-group  begin-->
                
                    <label>First Name</label>
                    <input type="text" class="form-control" name="c_name" required>
                
                </div><!--form-group  Finish -->
                 <div class="formm-group"><!--form-group  begin-->
                
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="s_name" required>
                
                </div><!--form-group  Finish -->

                <div class="formm-group"><!--form-group  begin-->
                
                    <label>Email</label>
                    <input type="text" class="form-control" name="c_email" required>
                
                </div><!--form-group  Finish -->

                <div class="formm-group"><!--form-group  begin-->
                
                <label>Phone</label>
                <input type="text" class="form-control" name="c_contact" required>
            
                </div><!--form-group  Finish -->

                <div class="formm-group"><!--form-group  begin-->
                
                    <label>County</label>
                    <input type="text" class="form-control" name="c_county" required>
                
                </div><!--form-group  Finish -->
                
                 <div class="formm-group"><!--form-group  begin-->
                
                    <label>Profile Picture</label>
                    <input type="file" class="form-control form-height-custom " name="c_image" required>
                
                </div><!--form-group  Finish -->

                <div class="formm-group mt-2"><!--form-group  begin-->
                
                    <label>Password</label>
                    <input type="password" class="form-control" name="c_pass" required>
                
                </div><!--form-group  Finish -->

                <div class="formm-group mt-2"><!--form-group  begin-->
                
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="c_confirm_pass" required>
                
                </div><!--form-group  Finish -->
                
                <div class="text-center mt-10">
                   <button type="submit" name="register"class="btn btn-primary rounded-full px-10 py-4">
                   <i class="fa fa-user-md"></i> Register
                   </button>
                
                </div>
             
             </form><!--form  Finish -->
            
            </div><!--box-header  Finish -->
          
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

<?php 


 
   
    

?>