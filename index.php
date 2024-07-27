<?php 
    $active='HOME';
   include("includes/header.php");
//    require_once "Fucnt ions.php";

?>
<div class="container mx-auto">
    <div class="grid grid-cols-5 gap-x-5 bg-success flex p-10 rounded-2xl">
        <select name="category" class="rounded">
            <option value="1">Category1</option>
            <option value="2">Category2</option>
            <option value="3">Category3</option>
            <option value="4">Category4</option>
        </select>   
        <input type="search" name="search"  class="col-span-2 rounded-lg outline-none px-3 py-5" placeholder="Enter a Location or Town">
        <input type="number" name="max_price" class="rounded-lg outline-none px-3 py-5" placeholder="Max Price (Ksh)">
        <button class="rounded-2xl bg-primary text-white p-2 active:outline-none focus:outline-none focus:ring-2 focus:ring-primary-300 focus:ring-opacity-50">Search</button>
    </div>
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
</body>
</html>