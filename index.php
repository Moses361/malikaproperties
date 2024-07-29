<?php 
    $active='HOME';
    include("includes/header.php");
    include_once("includes/db.php");
    
    //fetch categories
    $sql = "SELECT p_cat_id as cat_id,p_cat_title as cat_title FROM product_categories";
    $query = mysqli_query($con, $sql);
?>
<div class="container mx-auto">
    <form id="searchForm">
        <div class="grid grid-cols-5 gap-x-5 bg-success flex p-10 rounded-2xl">
            <select name="category" class="rounded">
                <option value="nil">--Select Category--</option>
                <?php
                    while($cat = mysqli_fetch_assoc($query)){
                ?>
                <option value="<?=$cat['cat_id'];?>"><?=$cat['cat_title'];?></option>
                <?php
                }
                ?>
            </select>   
            <input type="search" name="search"  class="col-span-2 rounded-lg outline-none px-3 py-5" placeholder="Enter a Location or Town">
            <input type="number" name="max_price" class="rounded-lg outline-none px-3 py-5" placeholder="Max Price (Ksh)">
            <button class="rounded-2xl bg-primary text-white p-2 active:outline-none focus:outline-none focus:ring-2 focus:ring-primary-300 focus:ring-opacity-50">Search</button>
        </div>
    </form>
</div>

<div class="bg-white p-5 mx-2 my-3 rounded-xl"><!--box begin -->
    <h2 class="capitalize pl-20 text-primary text-6xl">Featured Listings</h2>
</div><!--box  Finish -->

 <div id="content" class="container"><!--container begin -->

<div class="grid grid-cols-4 gap-x-5 productsList"><!--row  begin -->
    <?php 
       getPro();
    ?>
</div><!--row  Finish -->

</div><!--row  container -->

    <?php
    
    include("includes/footer.php")
    
    ?>

    <script src="js/jquery-331.min.js"></script>
     <script src="js/bootstrap-337.min.js"></script>
     <script>
        const searchForm = document.getElementById('searchForm');
        searchForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(searchForm);
            const search = formData.get('search');
            const category = formData.get('category');
            const max_price = formData.get('max_price');
            const url = `search.php?search=${search}&category=${category}&max_price=${max_price}`;
            const res = await fetch(url);
            const data = await res.json();
            console.log("Data: ", data);
            const products = generateTemplates(data.data);
            if(!products ){
                document.querySelector('.productsList').innerHTML = "<h2 class='text-center font-bold font-3xl my-10'>No products matching that search criteria</h2>";
                return;
            }

            document.querySelector('.productsList').innerHTML = products;
        });

        function generateTemplates(products){
            let html = ``;
            for(let product of products){
                html += `
                <div class='col-md-4 col-sm-6 single'>
                    <div class='product p-2 rounded'>
                    <a href='details.php?pro_id=${product.product_id}'>
                        <img class='img-responsive rounded-md' src='admin_area/product_images/${product.product_img1}'>
                    </a>
                        <div class='text-left py-5 px-5'>
                            <h4 class='text-red-500 font-bold text-2xl'>Ksh. ${product.product_price}</h4>
                            <h3 class='pt-2 text-3xl'>
                                <a href='details.php?pro_id=${product.product_id}'>
                                    ${product.product_title}
                                </a>
                            </h3>
                            <div class='pt-2 cursor-pointer text-primary'><i class='fa fa-map-marker'> </i> Nairobi Area </div>
                            <p class='button pt-2 flex justify-between'>
                                <a class='btn btn-default' href='details.php?pro_id=${product.product_id}'>
                                    View Listing
                                </a>
                                <a class='btn btn-primary' href='details.php?pro_id=${product.product_id}'>
                                    <i class='fa fa-shopping-cart'></i> Book
                                </a>
                            </p>
                            </div>
                    </div>
                </div>
                `;
            }
            return html;
        }
     </script>
</body>
</html>