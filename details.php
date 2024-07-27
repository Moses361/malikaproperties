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
                    <a href="index.php">Details</a>
                </li>
                    <a href="shop.php?p_cat=<?php echo $p_cat_id; ?>"><?php ///echo $p_cat_title; ?></a>
                </li>
                <li>
                    <?php /// echo $pro_title; ?>
                </li>
            </ul><!-- breadcrumb Finish -->

        </div><!-- col-md-12 Finish -->
        <h4 class="text-5xl font-bold ml-5"> <?=$pro_title;?></h4>
        <span class="ml-5 mt-3 text-primary"><i class="fa fa-map-marker"></i> Nairobi Area</span>

        <div class="col-md-12 mt-3"><!-- col-md-9 Begin -->
            <div id="productMain" class="row"><!-- row Begin -->
                <div class="col-sm-8"><!-- col-sm-6 Begin -->
                    <div id="mainImage"><!-- #mainImage Begin -->
                        <div id="myCarousel" class="carousel slide" data-ride="carousel"><!-- carousel slide Begin -->
                            <ol class="carousel-indicators"><!-- carousel-indicators Begin -->
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol><!-- carousel-indicators Finish -->

                            <div class="carousel-inner">
                                <div class="item active flex justify-center">
                                    <img class="img-responsive"
                                            src="admin_area/product_images/<?php echo $pro_img1; ?>" alt="Product 3-a">

                                </div>
                                <div class="item flex justify-center">
                                    <img class="img-responsive"
                                            src="admin_area/product_images/<?php echo $pro_img2; ?>" alt="Product 3-b">
                                </div>
                                <div class="item flex justify-center">
                                    <img class="img-responsive"
                                            src="admin_area/product_images/<?php echo $pro_img3; ?>" alt="Product 3-c">
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

                    <!-- Image Thumbnaills -->
                    <div class="grid grid-cols-3 gap-x-2 mt-2 justify-items-center" id="thumbs"><!-- row Begin -->
                        <div><!-- col-xs-4 Begin -->
                            <a data-target="#myCarousel"  class ="rounded-xl" data-slide-to="0" href="#" class="thumb"><!-- thumb Begin -->
                                <img src="admin_area/product_images/<?php echo $pro_img1; ?>" alt="product 1"
                                    class="img-responsive rounded-xl h-32 w-full">
                            </a><!-- thumb Finish -->
                        </div><!-- col-xs-4 Finish -->

                        <div class=""><!-- col-xs-4 Begin -->
                            <a data-target="#myCarousel" class ="rounded-xl"  data-slide-to="1" href="#" class="thumb"><!-- thumb Begin -->
                                <img src="admin_area/product_images/<?php echo $pro_img2; ?>" alt="product 2"
                                    class="img-responsive rounded-xl h-32 w-full">
                            </a><!-- thumb Finish -->
                        </div><!-- col-xs-4 Finish -->

                        <div class=""><!-- col-xs-4 Begin -->
                            <a data-target="#myCarousel" class ="rounded-xl"  data-slide-to="2" href="#" class="thumb"><!-- thumb Begin -->
                                <img src="admin_area/product_images/<?php echo $pro_img3; ?>" alt="product 4"
                                    class="img-responsive rounded-xl h-32 w-full">
                            </a><!-- thumb Finish -->
                        </div><!-- col-xs-4 Finish -->

                    </div><!-- row Finish -->
                    <hr class="h-1 bg-primary mt-5" />
                    <div class="mt-3 mb-3">
                        <small class="text-2xl">30 Units</small>
                        <h4 class="text-2xl font-bold">Ksh. <?=number_format($pro_price,"0", ".", ",");?></h4>
                    </div>
                    <!-- About the Listing -->
                    <div class="flex justify-around gap-x-2 mt-5">
                        <button class="w-full py-2 px-4 text-gray-600 border-b-2 border-transparent hover:border-primary focus:outline-none tab-button" data-tab="tab1">Overview</button>
                        <button class="w-full py-2 px-4 text-gray-600 border-b-2 border-transparent hover:border-primary focus:outline-none tab-button" data-tab="tab2">Amenities</button>
                    </div>
                        <!-- Tab Content -->
                        <div id="tab1" class="tab-content mt-4">
                            <h3 class="text2xl font-bold">Description</h3>
                            <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia, nemo!</p>
                        </div>
                        <div id="tab2" class="tab-content mt-4">
                            <h3 class="text-2xl font-bold">Amenities</h3>
                            <ul class="list-none">
                                <li>WiFi</li>
                                <li>Hot Shower</li>
                                <li>Free Parkin</li>
                                <li>Swimming Pool</li>
                            </ul>
                        </div>
                </div><!-- col-sm-6 Finish -->

                <div class="col-sm-4"><!-- col-sm-6 Begin -->
                    <div class="box rounded-xl"><!-- box Begin -->
                        <?php
                        if(!isset($_SESSION['customer_email'])){
                            die("You should be logged in to Add items to cart");
                        }
                        $total = total_price2();
                        add_cart($total);
                        // $_SESSION['new_total'] = get_total();
                        
                        // }
                        

                        ?>

                        <form action="addToCart.php" class="form-horizontal flex justify-start items-start ml-10 flex-col" method="POST">
                            <!-- form-horizontal Begin -->
                             <h4 class="text-4xl font-bold">Complete your booking</h4>
                            <input type="hidden" value="<?=$product_id;?>" name="product_id"> <!--product id -->
                            <div class="text-2xl mt-5"><span class="font-bold">Base Price:</span> <span class="text-primary">Ksh. <span id="basePrice"><?=number_format($pro_price,"0", ".", ",");?> </span></span></div>
                            <div class="flex flex-col justify-between mt-3">
                                <label for="num_units">Number of Units</label>
                                <input type="number" id="num_units" name="num_units" placeholder="Number of Units to book" class="focus:outline-none border border-primary rounded-2xl px-3 py-5" value="1">
                            </div>
                            <div class="mt-3 text-2xl">Total: <span id="calculated_totals" class="text-primary">12,000 </span></div>
                            <input type="hidden" value="total" id="total">
                            <p class="text-end w-full flex items-end justify-end pe-5">
                                <button class="btn btn-primary px-10 py-5 fa fa-shopping-cart" name="addToCart" type="submit"> Checkout</button>
                            </p>

                        </form><!-- form-horizontal Finish -->

                    </div><!-- box Finish -->

                </div><!-- col-sm-6 Finish -->


            </div><!-- row Finish -->


            <div class="container py-5">
                <h3 class="text-3xl font-bold">You may like</h3>
            </div>

            <div id="row same-heigh-row" class="grid grid-cols-4 gap-x-5"><!-- #row same-heigh-row Begin -->
                <?php
                $get_products = "select * from products order by rand() LIMIT 0,4";

                $run_products = mysqli_query($con, $get_products);

                while ($row_products = mysqli_fetch_array($run_products)) {

                    $pro_id = $row_products['product_id'];

                    $pro_title = $row_products['product_title'];

                    $pro_img1 = $row_products['product_img1'];

                    $pro_price = $row_products['product_price'];
                    $pro_price = number_format($pro_price, "0", ".", ",");

                    echo "
                        <div class='sinle'>
                            <div class='product p-2 rounded'>
                                <a href='details.php?pro_id=$pro_id'>
                                    <img class='img-responsive rounded-md' style='max-height: 100px;' src='admin_area/product_images/$pro_img1'>
                                </a>
                                <div class='text-left py-5 px-5'>
                                    <h4 class='text-red-500 font-bold text-2xl'>Ksh. $pro_price</h4>
                                    <h3 class='pt-2 text-3xl'>
                                        <a href='details.php?pro_id=$pro_id'>
                                            $pro_title
                                        </a>
                                    </h3>
                                    <div class='pt-2 cursor-pointer text-primary'><i class='fa fa-map-marker'> </i> Nairobi Area </div>
                                    <p class='button pt-2 flex justify-between'>
                                        <a class='btn btn-default' href='details.php?pro_id=$pro_id'>
                                            View Listing
                                        </a>
                                    </p>
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

         // JavaScript to handle tab switching
        document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');
            // set active tab
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('border-primary');
                button.classList.remove("text-primary");
            });

            button.classList.add('border-primary');
            button.classList.add("text-primary");
        
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.style.display = 'none';
            });
            
            // Show the clicked tab's content
            document.getElementById(tabId).style.display = 'block';
        });
        });

        // Optionally, activate the first tab by default
        document.querySelector('.tab-button').click();
    });


    // auto calculate total
    const calculateTotals = () => {
        const basePrice = document.getElementById('basePrice').innerText.replace(/,/g, '');
        const calculatedTotals = document.getElementById('calculated_totals');
        const totalInput = document.getElementById('total');
        const numUnits = document.getElementById('num_units').value;
        const totalAmount = basePrice * numUnits;
        calculatedTotals.innerText = totalAmount.toLocaleString();
        totalInput.value = totalAmount;
    }

    const numUnits = document.getElementById('num_units');
    numUnits.addEventListener("keyup", calculateTotals);
    numUnits.addEventListener("change", calculateTotals);
    calculateTotals();
</script>