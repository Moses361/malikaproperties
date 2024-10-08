<?php

$db = mysqli_connect("localhost", "root", "", "malikaproperties");

/// begining getRealIpUser function///   

function getRealIpUser()
{

    switch (true) {

        case (!empty($_SERVER['HTTP_X_REAL_IP'])):
            return $_SERVER['HTTP_X_REAL_IP'];
        case (!empty($_SERVER['HTTP_CLIENT_IP'])):
            return $_SERVER['HTTP_CLIENT_IP'];
        case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
            return $_SERVER['HTTP_X_FORWARDED_FOR'];

        default:
            return $_SERVER['REMOTE_ADDR'];

    }

}

/// begin add_cart functions ///

function add_cart($total)
{

    global $db;
    if (isset($_GET['add_cart'])) {


        $ip_add = getRealIpUser();

        $p_id = @$_GET['add_cart'];

        $product_qty = @$_POST['product_qty'];

        $product_size = @$_POST['product_size'];

        $check_product = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";

        $run_check = mysqli_query($db, $check_product);

        if (mysqli_num_rows($run_check) > 0) {

            echo "<script>alert('This product has already been added to cart')</script>";
            echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

        } else {

            $query = "insert into cart (p_id,ip_add,qty,size, p_price) values ('$p_id','$ip_add','$product_qty','$product_size', '$total')";

            $run_query = @mysqli_query($db, $query);

            echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

        }

    }
}

/// finish add_cart function///

/// finish getRealIpUser function///


/// begining getPro function///  

function getPro()
{

    global $db;
    $get_products = "select * from products ";

    $run_products = mysqli_query($db, $get_products);
    while ($row_products = mysqli_fetch_array($run_products)) {

        $pro_id = $row_products['product_id'];

        $pro_title = $row_products['product_title'];
        $pro_price = $row_products['product_price'];
        $pro_price = number_format($pro_price, "0", ".", ",");
        $pro_img1 = $row_products['product_img1'];
        $pro_location = $row_products['location'];

        echo "
        <div class='col-md-4 col-sm-6 single'>
            <div class='product p-2 rounded'>
                <a href='details.php?pro_id=$pro_id'>
                    <img class='img-responsive rounded-md' src='admin_area/product_images/$pro_img1'>
                </a>
                <div class='text-left py-5 px-5'>
                    <h4 class='text-red-500 font-bold text-2xl'>Ksh. $pro_price</h4>
                    <h3 class='pt-2 text-3xl'>
                        <a href='details.php?pro_id=$pro_id'>
                            $pro_title
                        </a>
                    </h3>
                    <div class='pt-2 cursor-pointer text-primary'><i class='fa fa-map-marker'> </i> Nairobi Area | $pro_location </div>
                    <p class='button pt-2 flex justify-between'>
                        <a class='btn btn-default' href='details.php?pro_id=$pro_id'>
                            View Listing
                        </a>
                        <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>
                            <i class='fa fa-shopping-cart'></i> Book
                        </a>
                    </p>
                </div>
            </div>
        </div>
        ";

    }
}
/// finish getPro function///

/// begining getLoc function///  

function getLoc()
{

    global $db;
    $get_products = "select * from products ";

    $run_products = mysqli_query($db, $get_products);
    while ($row_products = mysqli_fetch_array($run_products)) {

        $pro_id = $row_products['product_id'];

        $pro_location = $row_products['location'];

        echo "
            $pro_location,
        ";

    }
}
/// finish getLoc function///

/// begining getPCats function///
function getPCats()
{

    global $db;
    $get_p_cats = "select * from product_categories";

    $run_p_cats = mysqli_query($db, $get_p_cats);

    while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {

        $p_cat_id = $row_p_cats['p_cat_id'];
        $p_cat_title = $row_p_cats['p_cat_title'];

        echo "
         
             <li>
             
                 <a href='shop.php?p_cat=$p_cat_id'>$p_cat_title</a>
             
             </li>
         
         ";

    }


}


/// finish getPCats function///

/// begining getpcatpro function///

function getpcatpro()
{

    global $db;

    if (isset($_GET['p_cat'])) {

        $p_cat_id = $_GET['p_cat'];
        $get_p_cat = "select * from product_categories where p_cat_id='$p_cat_id'";
        $run_p_cat = mysqli_query($db, $get_p_cat);
        $row_p_cat = mysqli_fetch_array($run_p_cat);
        $p_cat_title = $row_p_cat['p_cat_title'];
        $p_cat_desc = $row_p_cat['p_cat_desc'];

        $get_products = "select * from products where p_cat_id='$p_cat_id'";
        $run_products = mysqli_query($db, $get_products);
        $count = mysqli_num_rows($run_products);

        if ($count == 0) {

            echo "
            
                <div class='box'>
                
                   <h1> Sorry No Service In This Category</h1>                     
                
                </div>
            
            
            ";

        } else {

            echo "
            
                <div class='box'>
                
                   <h1>$p_cat_title</h1> 
                   <p>$p_cat_desc</p>                    
                
                </div>
            
            
            ";

        }

        while ($row_products = mysqli_fetch_array($run_products)) {

            $pro_id = $row_products['product_id'];

            $pro_title = $row_products['product_title'];
            $pro_price = $row_products['product_price'];
            $pro_img1 = $row_products['product_img1'];

            echo "
             
                <div class='col-md-4 col-sm-6 center-responsive '>
              
                  <div class='product'>
                  
                     <a href='details.php?pro_id=$pro_id'>
                         <img class='img-responsive' src='admin_area/product_images/$pro_img1'>
                     </a>
                     <div class='text'>
                     
                        <h3>
                        
                            <a href='details.php?pro_id=$pro_id'>
                               $pro_title
                            </a>
                        
                            <p class='price'>
                            
                                Ksh.$pro_price
                            
                            </p>
                         </h3>
                            <p class='button'>
                            
                                 <a class='btn btn-default' href='details.php?pro_id=$pro_id'>
                                     View Details
                                 </a>
                                 <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>
                                     <i class='fa fa-shopping-cart'></i> Add To Cart 
                                 </a>
                            
                            </p>
                        
                        
                     
                     </div>
                  </div>
              
              </div>
             
             ";

        }

    }

}


/// finish getpcatpro function///

/// begining items() function/// 

function items()
{

    global $db;
    $ip_add = getRealIpUser();
    $get_items = "select * from cart where ip_add='$ip_add'";
    $run_items = mysqli_query($db, $get_items);
    $count_items = mysqli_num_rows($run_items);
    echo $count_items;

}


/// finish items() function/// 

/// begining total_price function/// 

function total_price()
{

    global $db;
    $ip_add = getRealIpUser();
    $total = 0;
    $select_cart = "select * from cart where ip_add='$ip_add'";
    $run_cart = mysqli_query($db, $select_cart);
    while ($record = mysqli_fetch_array($run_cart)) {

        $pro_id = $record['p_id'];
        $pro_qty = $record['qty'];
        $get_price = "select * from products where product_id='$pro_id'";
        $run_price = mysqli_query($db, $get_price);
        while ($row_price = mysqli_fetch_array($run_price)) {

            $sub_total = $row_price['product_price'] * $pro_qty;
            $total += $sub_total;

        }

    }

    echo $total;
    return $total;



}
function total_price2()
{
    global $db;
    // get discount 
    $discount = 0;
    $intiator = trim($_SESSION['customer_email']);
    $select_cart = "SELECT  * from referals where initiator  ='$intiator' AND redeemed=false;";
    $run_cart2 = mysqli_query($db, $select_cart);
    if(mysqli_num_rows($run_cart2) > 0){
        while($data = mysqli_fetch_array($run_cart2)){
            $discount += $data['discount'];
        }
    }
    
    // get other price
    $ip_add = getRealIpUser();
    $total = 0;
    $select_cart = "select * from cart where ip_add='$ip_add'";
    $run_cart = mysqli_query($db, $select_cart);
    $transport_cost = 0; //

    while ($record = mysqli_fetch_array($run_cart)) {

        $pro_id = $record['p_id'];
        $pro_qty = $record['qty'];
        $transport_cost += $record['transport_cost'];
        $get_price = "select * from products where product_id='$pro_id'";
        $run_price = mysqli_query($db, $get_price);
        while ($row_price = mysqli_fetch_array($run_price)) {

            $sub_total = $row_price['product_price'] * $pro_qty;
            $total += $sub_total;

        }

    }
    //   echo $total;
    return $total + $transport_cost - $discount;



}

/// finish total_price function/// 


function get_unit_price($id)
{

    global $db;
    $ip_add = $id;
    $total = 0;
    $select_cart = "select product_price  from products  where product_id ='$ip_add'";
    $run_cart = mysqli_query($db, $select_cart);
    while ($record = mysqli_fetch_array($run_cart)) {

        $pro_id = $record['product_price'];
        //  $pro_qty = $record['qty'];

    }
    //   echo $total;
    // print($pro_id);
    return $pro_id;



}