<div class="flex items-center justify-center mx-auto mb-10">
    <div class="box w-2/3"><!-- Box begin-->

        <div class="box-header"><!-- box-header begin-->
            <p class="lead">Welcome Back!</p>
        </div><!-- box-header finish-->
        <form method="post" action="login.php"><!-- form begin-->
        <div class="form-group"><!-- form-group begin-->
            <label>Email</label>
            <input name="c_email" type="text" class="form-control" required>
        </div><!-- form-group Finish-->
        <div class="form-group"><!-- form-group begin-->
            <label>Password</label>
            <input name="c_pass" type="password" class="form-control" required>
        
        </div><!-- form-group Finish-->
        <div class="text-center"><!-- text-center begin-->
                <button name="login" value="Login" class="btn btn-primary">
                    <i class="fa fa-sign-in"></i> Login
                </button>
        </div><!-- text-center Finish-->
        </form><!-- form Finish-->
    </div><!-- Box Finish-->
</div>

<?php 
if(isset($_POST['login'])){
    
    $customer_email = $_POST['c_email'];
    
    $customer_pass = $_POST['c_pass'];
    
    $select_customer = "select * from customers where customer_email='$customer_email' AND customer_pass='$customer_pass'";
    
    $run_customer = mysqli_query($con,$select_customer);
    
    $get_ip = getRealIpUser();
    
    $check_customer = mysqli_num_rows($run_customer);
    
    $select_cart = "select * from cart where ip_add='$get_ip'";
    
    $run_cart = mysqli_query($con,$select_cart);
    
    $check_cart = mysqli_num_rows($run_cart);
    
    if($check_customer==0){
        echo "<script>alert('Invalid email or password')</script>";
        exit();
    }
    
    if($check_customer==1 AND $check_cart==0){
        
        $_SESSION['customer_email']=$customer_email;
        $_SESSION['success'] = "Login success";
        header('location: index.php');
    }else{
        
        $_SESSION['customer_email']=$customer_email;
        
        $_SESSION['success'] = "Login success";
        header('location: index.php');
    }
    
}

?>
