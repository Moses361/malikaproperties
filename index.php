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

<div class="grid grid-cols-4 gap-x-5"><!--row  begin -->
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
            const data = res.json();
            console.log(data);
        });
     </script>
</body>
</html>