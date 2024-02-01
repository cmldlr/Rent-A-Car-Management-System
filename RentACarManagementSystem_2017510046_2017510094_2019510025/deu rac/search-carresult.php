<?php 
session_start();
include('includes/config.php');
error_reporting(0);
function sqlquery($bool){
  $where="";
  $brand1="";
  $fueltype1="";
  $minPrice1="";
  $maxPrice1="";
  $asc_desc1="";
  $brand=$_POST['brand'];
  $fueltype=$_POST['fueltype'];
  $minPrice=$_POST['minPrice'];
  $maxPrice=$_POST['maxPrice'];
  $sql="";
  $asc_desc=$_POST['asc_desc'];
  if($brand !="Select Brand"){
    $brand1="and car_brand_id=:brand ";
  }
  if($fueltype!="Select Fuel Type"){
    $fueltype1="and car_fueltype=:fueltype ";
  }
  if($minPrice!=null){
    $minPrice1="and car_dprice >= :minPrice ";
  }
  if($maxPrice!=null){
    $maxPrice1="and car_dprice  <= :maxPrice ";
  }
  if($asc_desc!="Select ASC/DESC"){
    if($asc_desc=="asc"){
      $asc_desc1="order by car_dprice asc ";
    }
    else if($asc_desc=="desc"){
      $asc_desc1="order by car_dprice desc ";
    }
  }
  if($bool=="1"){
    $sql = "SELECT * from cars where car_status='available'  $brand1 $fueltype1 $minPrice1 $maxPrice1 $asc_desc1";
  }
  else if($bool=="2"){
    if($brand !="Select Brand"){
      $brand1="and cars.car_brand_id=:brand ";
    }
    if($fueltype!="Select Fuel Type"){
      $fueltype1="and cars.car_fueltype=:fueltype ";
    }
    if($minPrice!=null){
      $minPrice1="and cars.car_dprice >= :minPrice ";
    }
    if($maxPrice!=null){
      $maxPrice1="and cars.car_dprice  <= :maxPrice ";
    }
    if($asc_desc!="Select ASC/DESC"){
      if($asc_desc=="asc"){
        $asc_desc1="order by cars.car_dprice asc ";
      }
      else if($asc_desc=="desc"){
        $asc_desc1="order by cars.car_dprice desc ";
      }
    }
    $sql = "SELECT cars.*,brands.BrandName,brands.id as bid  from cars join brands on brands.id=cars.car_brand_id where cars.car_status='available' $brand1 $fueltype1 $minPrice1 $maxPrice1 $asc_desc1";
  }

  define('DB_HOST','localhost');
  define('DB_USER','root');
  define('DB_PASS','');
  define('DB_NAME','carrental');
  $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
  $query = $dbh -> prepare($sql);
  if($brand !="Select Brand"){
    $query -> bindParam(':brand',$brand, PDO::PARAM_STR);   
  }
  if($fueltype!="Select Fuel Type"){
    $query -> bindParam(':fueltype',$fueltype, PDO::PARAM_STR);
  }
  if($minPrice!=null){  
    $query -> bindParam(':minPrice',$minPrice, PDO::PARAM_INT);
  }
  if($maxPrice!=null){
    $query -> bindParam(':maxPrice',$maxPrice, PDO::PARAM_INT);
  }
  /*if($asc_desc!="Select ASC/DESC"){
    $query -> bindParam(':asc_desc',$asc_desc, PDO::PARAM_INT);
  }*/
  $query->execute();
  return $query;
}


?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Car Rental Portal | Car Listing</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<!--OWL Carousel slider-->
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="assets/css/slick.css" rel="stylesheet">
<!--bootstrap-slider -->
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>
<body>


<!--Header--> 
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Page Header-->
<section class="page-header listing_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Car Listing</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>Car Listing</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<!--Listing-->
<section class="listing-page">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
        <div class="result-sorting-wrapper">
          <div class="sorting-count">
<?php 
//Query for Listing count
$query=sqlquery(1);
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=$query->rowCount();

?>
<p><span><?php echo htmlentities($cnt);?> Listings</span></p>
</div>
</div>

<?php 
$query=sqlquery(2);
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>
        <div class="product-listing-m gray-bg">
          <div class="product-listing-img"><img src="admin/img/carimages/<?php echo htmlentities($result->car_img1);?>" class="img-responsive" alt="Image" /> </a> 
          </div>
          <div class="product-listing-content">
            <h5><a href="car-details.php?carid=<?php echo htmlentities($result->car_id);?>"><?php echo htmlentities($result->BrandName);?>  <?php echo htmlentities($result->car_model);?></a></h5>
            <p class="list-price">$<?php echo htmlentities($result->car_dprice);?> Per Day</p>
            <ul>
              <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->car_seatingcapacity);?> seats</li>
              <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->car_modelyear);?> model</li>
              <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->car_fueltype);?></li>
            </ul>
            <a href="car-details.php?carid=<?php echo htmlentities($result->car_id);?>" class="btn">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
          </div>
        </div>
      <?php }} ?>
         </div>
      
      <!--Side-Bar-->
      <aside class="col-md-3 col-md-pull-9">
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-filter" aria-hidden="true"></i> Find Your  Car </h5>
          </div>
          <div class="sidebar_filter">
          <form action="search-carresult.php" method="post">
              <div class="form-group select">
              <select class="form-control" name="brand">
              <option>Select Brand</option>

                  <?php $sql = "SELECT * from  brands ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{       ?>  
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?></option>
<?php }} ?>
                 
                </select>
              </div>
              <div class="form-group select">
              <select class="form-control" name="fueltype">
              <option>Select Fuel Type</option>
<option value="Petrol">Petrol</option>
<option value="Diesel">Diesel</option>
<option value="CNG">CNG</option>
<option value="Electric">Electric</option>
                </select>
              </div>
              <div class="form-group">
                  <label for="minPrice">Minimum Price:</label>
                  <input type="text" class="form-control" id="minPrice" name="minPrice">
              </div>
              <div class="form-group">
                  <label for="maxPrice">Maximum Price:</label>
                  <input type="text" class="form-control" id="maxPrice" name="maxPrice">  
              </div>
              <div class="form-group select">
                <select class="form-control" name="asc_desc">
                  <option>Select ASC/DESC</option>
                  <option value="asc">Ascendant</option>
                  <option value="desc">Descendant</option>
                </select> 
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car</button>
              </div>
            </form>
          </div>
        </div>

        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-car" aria-hidden="true"></i> Recently Listed Cars</h5>
          </div>
          <div class="recent_addedcars">
            <ul>
<?php $sql = "SELECT cars.*,brands.BrandName,brands.id as bid  from cars join brands on brands.id=cars.car_brand_id where cars.car_status='available' order by cars.car_id desc limit 4";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>

              <li class="gray-bg">
                <div class="recent_post_img"> <a href="car-details.php?carid=<?php echo htmlentities($result->car_id);?>"><img src="admin/img/carimages/<?php echo htmlentities($result->car_img1);?>" alt="image"></a> </div>
                <div class="recent_post_title"> <a href="car-details.php?carid=<?php echo htmlentities($result->car_id);?>"><?php echo htmlentities($result->BrandName);?> <?php echo htmlentities($result->car_model);?></a>
                  <p class="widget_price">$<?php echo htmlentities($result->car_dprice);?> Per Day</p>
                </div>
              </li>
              <?php }} ?>
              
            </ul>
          </div>
        </div>
      </aside>
      <!--/Side-Bar--> 
    </div>
  </div>
</section>
<!-- /Listing--> 

<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>
