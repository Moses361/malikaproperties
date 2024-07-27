<?php

$active = 'Cart';
include("includes/header.php");
if (!empty($_GET['pro_id'])) {
    $price = get_unit_price($_GET['pro_id']);


}

// print(total_price2());
// die();
if (isset($_POST['addToCar'])) {
    add_cart();

}

?>

<div id="content"><!-- #content Begin -->
    <div class="container"><!-- container Begin -->
        <div class="col-md-12"><!-- col-md-12 Begin -->

            <ul class="breadcrumb"><!-- breadcrumb Begin -->
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="index.php">Order</a>
                </li>
                <li>
                    <a href="index.php">Service</a>
                </li>
                <a href="shop.php?p_cat=<?php echo $p_cat_id; ?>"><?php ///echo $p_cat_title; ?></a>
                </li>
                <li>
                    <?php /// echo $pro_title; ?>
                </li>
            </ul><!-- breadcrumb Finish -->

        </div><!-- col-md-12 Finish -->

        <div class="col-md-3"><!-- col-md-3 Begin -->

            <?php

            include("includes/sidebar.php");

            ?>

        </div><!-- col-md-3 Finish -->

        <div class="col-md-9"><!-- col-md-9 Begin -->
            <div id="productMain" class="row"><!-- row Begin -->
                <div class="col-sm-6"><!-- col-sm-6 Begin -->
                    <div id="mainImage"><!-- #mainImage Begin -->
                        <div id="myCarousel" class="carousel slide" data-ride="carousel"><!-- carousel slide Begin -->
                            <ol class="carousel-indicators"><!-- carousel-indicators Begin -->
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol><!-- carousel-indicators Finish -->

                            <div class="carousel-inner">
                                <div class="item active">
                                    <center><img class="img-responsive"
                                            src="admin_area/product_images/<?php echo $pro_img1; ?>" alt="Product 3-a">
                                    </center>
                                </div>
                                <div class="item">
                                    <center><img class="img-responsive"
                                            src="admin_area/product_images/<?php echo $pro_img2; ?>" alt="Product 3-b">
                                    </center>
                                </div>
                                <div class="item">
                                    <center><img class="img-responsive"
                                            src="admin_area/product_images/<?php echo $pro_img3; ?>" alt="Product 3-c">
                                    </center>
                                </div>
                            </div>

                            <a href="#myCarousel" class="left carousel-control"
                                data-slide="prev"><!-- left carousel-control Begin -->
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a><!-- left carousel-control Finish -->

                            <a href="#myCarousel" class="right carousel-control"
                                data-slide="next"><!-- right carousel-control Begin -->
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Previous</span>
                            </a><!-- right carousel-control Finish -->

                        </div><!-- carousel slide Finish -->
                    </div><!-- mainImage Finish -->
                </div><!-- col-sm-6 Finish -->

                <div class="col-sm-6"><!-- col-sm-6 Begin -->
                    <div class="box"><!-- box Begin -->
                        <h1 class="text-center">
                            <?php ///echo $pro_title; ?>
                        </h1>


                        <?php
                        if(!isset($_SESSION['customer_email'])){
                            die("You should be logged in to Add items to cart");
                        }
                        $total = total_price2();
                        add_cart($total);
                        // $_SESSION['new_total'] = get_total();
                        
                        // }
                        

                        ?>

                        <form action="addToCart.php" class="form-horizontal" method="POST">
                            <!-- form-horizontal Begin -->
                            <input type="hidden" value="<?=$product_id;?>" name="product_id"> <!--product id -->
                            <div class="form-group"><!-- form-group Begin -->
                                <label for="" class="col-md-5 control-label">Service(s) Quantity (Per Service)</label>
                                <div class="col-md-7"><!-- col-md-7 Begin -->
                                    <select name="product_qty" id="" class="form-control"><!-- select Begin -->
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select><!-- select Finish -->
                                </div><!-- col-md-7 Finish -->
                            </div><!-- form-group Finish -->

                            <div class="form-group"><!-- form-group Begin -->
                                <label class="col-md-5 control-label">Service Category</label>
                                <div class="col-md-7"><!-- col-md-7 Begin -->
                                    <select name="product_size" class="form-control" required
                                        oninput="setCustomValidity('')"
                                        oninvalid="setCustomValidity('Must pick 1 size for the product')"><!-- form-control Begin -->
                                        <option disabled selected>Select Category</option>
                                        <option>Other</option>
                                        <option>Other</option>
                                        <option>Other</option>
                                    </select><!-- form-control Finish -->
                                </div><!-- col-md-7 Finish -->
                            </div><!-- form-group Finish -->

                            <p class="price" id="total">Ksh.
                                <?php print($price); ?>
                            </p>
                            <input type="hidden" name="total" value="<?=$price?>"> <!-- to send to server to add to cart -->
                            <p class="text-center buttons">
                                <button class="btn btn-primary i fa fa-shopping-cart" name="addToCart" type="submit"> Add to cart</button>
                            </p>

                        </form><!-- form-horizontal Finish -->

                    </div><!-- box Finish -->

                    <div class="row" id="thumbs"><!-- row Begin -->

                        <div class="col-xs-4"><!-- col-xs-4 Begin -->
                            <a data-target="#myCarousel" data-slide-to="0" href="#" class="thumb"><!-- thumb Begin -->
                                <img src="admin_area/product_images/<?php echo $pro_img1; ?>" alt="product 1"
                                    class="img-responsive">
                            </a><!-- thumb Finish -->
                        </div><!-- col-xs-4 Finish -->

                        <div class="col-xs-4"><!-- col-xs-4 Begin -->
                            <a data-target="#myCarousel" data-slide-to="1" href="#" class="thumb"><!-- thumb Begin -->
                                <img src="admin_area/product_images/<?php echo $pro_img2; ?>" alt="product 2"
                                    class="img-responsive">
                            </a><!-- thumb Finish -->
                        </div><!-- col-xs-4 Finish -->

                        <div class="col-xs-4"><!-- col-xs-4 Begin -->
                            <a data-target="#myCarousel" data-slide-to="2" href="#" class="thumb"><!-- thumb Begin -->
                                <img src="admin_area/product_images/<?php echo $pro_img3; ?>" alt="product 4"
                                    class="img-responsive">
                            </a><!-- thumb Finish -->
                        </div><!-- col-xs-4 Finish -->

                    </div><!-- row Finish -->

                </div><!-- col-sm-6 Finish -->


            </div><!-- row Finish -->



            <div id="row same-heigh-row"><!-- #row same-heigh-row Begin -->
                <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 Begin -->
                    <div class="box same-height headline"><!-- box same-height headline Begin -->
                        <h3 class="text-center">Other Services You May Like</h3>
                    </div><!-- box same-height headline Finish -->
                </div><!-- col-md-3 col-sm-6 Finish -->

                <?php

                $get_products = "select * from products order by rand() LIMIT 0,3";

                $run_products = mysqli_query($con, $get_products);

                while ($row_products = mysqli_fetch_array($run_products)) {

                    $pro_id = $row_products['product_id'];

                    $pro_title = $row_products['product_title'];

                    $pro_img1 = $row_products['product_img1'];

                    $pro_price = $row_products['product_price'];

                    echo "
                       
                        <div class='col-md-3 col-sm-6 center-responsive'>
                        
                            <div class='product same-height'>
                            
                                <a href='details.php?pro_id=$pro_id'>
                                
                                    <img class='img-responsive' src='admin_area/product_images/$pro_img1'>
                                
                                </a>
                                
                                <div class='text'>
                                
                                    <h3> <a href='details.php?pro_id=$pro_id'> $pro_title </a> 
                                    
                                           <p class='price'> Ksh.$pro_price </p>
                                
                                    </h3>

                                </div>
                            
                            </div>
                        
                        </div>
                       
                       ";

                }

                ?>

            </div><!-- #row same-heigh-row Finish -->

        </div><!-- col-md-9 Finish -->

    </div><!-- container Finish -->
</div><!-- #content Finish -->

<?php

include("includes/footer.php");

?>

<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>


</body>

</html>

<script>
    // document.getElementById("myDiv").style.display = "none";
    document.addEventListener('DOMContentLoaded', function () {
        // Your code here
        console.log('The DOM has loaded.');
        function hello() {
            // alert(b4);
            $origin = document.getElementById("origin").value
            $destination = document.getElementById("destination").value
            $date = getElementById("date").value

            document.getElementById("hide").style.display = "block";
            // document.getElementById("total"). = "block";

        }
    });




</script>