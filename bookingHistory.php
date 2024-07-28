<?php
$active = 'SHOPPING CART';
//  date_default_timezone_set('UTC');
include("includes/header.php");

if(!isset($_SESSION['customer_email'])){
  die("You need to be logged in to access your booking history");
}

$intiator = trim($_SESSION['customer_email']);

$discount = 0;
$select_cart = "SELECT  * from referals where initiator  ='$intiator' AND redeemed=false;";
$run_cart2 = mysqli_query($con, $select_cart);
if(mysqli_num_rows($run_cart2) > 0){
  while($data = mysqli_fetch_array($run_cart2)){
    $discount += $data['discount'];
  }
}
// die();


?>

<div id="content"><!--content  begin -->
  <div class="container"><!--container begin -->
    <div class="container col-md-12"><!--container col-md-12 begin -->

      <ul class="breadcrumb"><!--breadcrumb   begin -->
        <li>
          <a href="index.php">Home</a>
        </li>
        <li class="cursor-pointer">
          Booking History
        </li>
      </ul><!--breadcrumb   Finish -->

    </div><!--container col-md-12  Finish -->

    <div id="cart" class="col-md-12"><!--cart col-md-12  begin-->

      <div class="box"><!--box   begin-->

        <form action="bookingHistory.php" method="post" enctype="multipart/form-data" id="orderForm"><!--form   begin -->

          <h1>Bookings</h1>

          <?php

          $ip_add = getRealIpUser();
          $select_cart = "select * from cart where ip_add='$ip_add'";
          $run_cart = mysqli_query($con, $select_cart);
          $count = mysqli_num_rows($run_cart);
          ?>
          <div class="table-responsive"><!--table-responsive   begin -->
            <table class="table" id="myTable"><!--table   begin -->
              <thead>
                <tr><!--tr   begin -->
                  <th colspan="2">Item</th>
                  <th>Unit Price</th>
                  <th>Location</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>SubTotal</th>
                </tr><!--tr   finish -->
              </thead>
              <tbody><!--tbody  begin -->
                <?php
                $total = 0;
                $tranport_cost = 0;
                while ($row_cart = mysqli_fetch_array($run_cart)) {

                  $pro_id = $row_cart['p_id'];
                  $pro_size = $row_cart['size'];
                  $pro_qty = $row_cart['qty'];
                  $tranport_cost += $row_cart['transport_cost'];
                  $get_products = "select *from products where product_id='$pro_id'";
                  $run_products = mysqli_query($con, $get_products);
                  while ($row_products = mysqli_fetch_array($run_products)) {
                    $product_title = $row_products['product_title'];
                    $product_img1 = $row_products['product_img1'];
                    $only_price = $row_products['product_price'];
                    $sub_total = $row_products['product_price'] * $pro_qty;
                    $total += $sub_total;
                    ?>

                    <tr><!--tr   begin-->
                      <td>
                        <img class="img-responsive" src="admin_area/product_images/<?php echo $product_img1; ?>"
                          alt="product-d2">
                      </td>
                      <td>
                        <?php print($product_title); ?>
                      </td>
                      <td>
                        <?php echo $pro_qty; ?>
                      </td>
                      <td>
                        <?php echo $only_price; ?>
                      </td>
                      <td>
                        <?php echo $pro_size; ?>
                      </td>
                      <td>
                        <?php echo $location; ?>
                      </td>
                      <td>
                        <input type="date" name="orderDate" class="orderDate" style="width: 110px" data-id="<?=$pro_id;?>">
                      </td>
                    </tr><!--tr   Finish -->
                    <?php
                  }
                }

                ?>

              </tbody><!--tbody   Finish -->
            </table><!--table   Finish -->

          </div><!--table-responsive   Finish -->
          <div class="flex w-full justify-end items-end">
            <button id="downloadBtn" title="Download Report" class="btn btn-lg bg-primary"> <i class="fa fa-download"></i></button>
          </div>
        </form><!--form   Finish -->
      </div><!--box   Finish -->

      <?php

      function update_cart()
      {

        global $con;
        if (isset($_POST['update'])) {

          foreach ($_POST['remove'] as $remove_id) {

            $delete_product = "delete from cart where p_id='$remove_id'";
            $run_delete = mysqli_query($con, $delete_product);
            if ($run_delete) {

              echo "
                  <script>window.open('bookingHistory.php','_self')</script>
                  ";
            }

          }
        }

      }



      @$up_cart = update_cart();
      ;
      ?>
    </div><!--cart col-md-12   Finish -->
  </div><!--container   Finish -->
</div><!--content  Finish -->


<?php

include("includes/footer.php")

  ?>

<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>
</body>

</html>



<script>
  // Get the table element
  var table = document.getElementById('myTable');

  // Function to print the table
  function printTable() {
    printPageArea("orderForm");
  }

  // print only a section of a page
  function printPageArea(areaID) {
    var printContent = document.getElementById(areaID).innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = printContent;
    var orderOptions = document.getElementById("orderOptions");
    orderOptions.style.display = "none"; // hide order options while printing report
    window.print();
    // orderOptions.style.display = "block"; // show order options back
    document.body.innerHTML = originalContent;
  }

  // Function to download the table as CSV
  function downloadTable() {
    printPageArea("orderForm");
  }

  // Download receipts
  var downloadBtn = document.getElementById('downloadBtn');
  downloadBtn.addEventListener('click', downloadTable);

  // disable selection of dates before current date
  const today = new Date().toISOString().split('T')[0];
  const dateElements = document.querySelectorAll(".orderDate");
  const sources = document.querySelectorAll(".source");
  const destinations = document.querySelectorAll(".destination");
  const itemsTotal = document.getElementById("itemsTotal");
  const deliveryTotal = document.getElementById("deliveryTotal");
  const discount = document.getElementById("discount");
  const total = document.getElementById("total");


  dateElements.forEach(dateElement => {
    dateElement.setAttribute("min", today);
    // listen when =user selects a different date
    dateElement.addEventListener("change", function () {
      const selectedDate = new Date(this.value);
      const now = new Date();
      if (selectedDate < now) {
        this.value = today;
      }

      // update order date
      const productId = this.getAttribute("data-id");
      updateOrderDate(productId, this.value);
    });
  })

  // laod cities and fill in the options
  let cities = {}; // gloabal variable to store all cities data
  let pricePerKm = 3;
  (async function init() {
    const data = await fetch("cities.json").then(res => res.json()).then(data => data);
    cities = data;

    generateOptions() // generate dropdown options
    calculatePrice();
    sources.forEach(source => source.addEventListener("change", () => calculatePrice()))
    destinations.forEach(destination => destination.addEventListener("change", () => calculatePrice()));

  })();


  // get distance between two towns (In km)
  function getDistance(src, dst) {
    const radius = 6371; // Earth's radius in kilometers
    const townA = getCoords(src);
    const townB = getCoords(dst);

    const lat1 = townA.lat * Math.PI / 180;
    const lat2 = townB.lat * Math.PI / 180;
    const lon1 = townA.lng * Math.PI / 180;
    const lon2 = townB.lng * Math.PI / 180;
    const dLat = lat2 - lat1; // difference in latitudes
    const dLon = lon2 - lon1; // difference in longitutes

    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
      Math.cos(lat1) * Math.cos(lat2) *
      Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

    const distance = radius * c;
    return parseInt(distance);
  }

  // return latitude and longitude for a city
  function getCoords(cityName) {
    for (let i in cities) {
      let city = cities[i];
      if (city.city == cityName) {
        return {
          lat: city.lat,
          lng: city.lng
        }
      }
    }
  }

  // fill in cities as dropdown options
  function generateOptions() {
    let options = ``;
    for (let i in cities) {
      let city = cities[i];
      options += `<option value="${city.city}">${city.city}</option>`
    }
    // origins
    for (let i = 0; i < sources.length; i++) {
      sources[i].innerHTML = options;
    }
    // destinations 
    for (let i = 0; i < destinations.length; i++) {
      destinations[i].innerHTML = options;
    }
  }

  // re-calcuate price on route change. 
  //@returns the new calculated price
  function calculatePrice() {
    let price = 0;
    for (let i = 0; i < sources.length; i++) {
      const src = sources[i].value;
      const dst = destinations[i].value;
      const distance = getDistance(src, dst);
      price += pricePerKm * distance;
      const productId = sources[i].getAttribute('data-id');
      updateTransportCost(productId, (pricePerKm * distance), src, dst)
    }

    let itemsPrice = parseFloat(itemsTotal.getAttribute("data-value"));
    let delivery = parseFloat(deliveryTotal.getAttribute("data-value"));
    let discountPrice = parseFloat(discount.getAttribute("data-value"));

    deliveryTotal.innerHTML = "Ksh. " + price;
    total.innerHTML = "Ksh. " + (itemsPrice + delivery - discountPrice)
  }

  // function to update the transport cost of a certain product
  function updateTransportCost(productId, transportCost, origin, destination) {
    fetch("cartUtils.php?action=update_transport_cost", {
      method: "POST",
      body: JSON.stringify({ productId, transportCost, origin, destination })
    }).then(res => res.json()).then(res => {
      // console.log("response: ", res)
    })

  }

  function updateOrderDate(productId, orderDate){
    fetch("cartUtils.php?action=update_order_date", {
      method: "POST",
      body: JSON.stringify({ productId, orderDate })
    }).then(res => res.json()).then(res => {
      // console.log("response: ", res)
    })
  }

</script>
