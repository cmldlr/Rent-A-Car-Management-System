<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$start_date = new DateTime($fromdate);
$end_date = new DateTime($todate);
$current_time = new DateTime();
if ($end_date < $start_date || $start_date<$current_time || $end_date<$current_time) {
  echo "<script>alert('Please select a valid date range');</script>";
} else {
  $interval = $start_date->diff($end_date);
  if ($interval->days > 7) {
      echo "<script>alert('You can rent a maximum of seven days, please change the date range.');</script>";
  }
  else{
    $interval1 = $start_date->diff($current_time);
    if($interval1->days >3){
      echo "<script>alert('You can reservation for maximum of 3 days later.');</script>";
    }
    else{
      $useremail=$_SESSION['login'];
      $status=0;
      $carid=$_GET['carid'];
      $sql1 = "SELECT SUM(car_dprice)  AS dprice FROM cars WHERE cars.car_id=:carid ";
      $query1 = $dbh -> prepare($sql1);
      $query1->bindParam(':carid', $carid, PDO::PARAM_INT);
      $query1->execute();
      $result=$query1->fetchAll(PDO::FETCH_OBJ);
      $dailyprice=$result[0]->dprice;
  
      $totalamount=$dailyprice*$interval->days;
      $sql="INSERT INTO reservations (userEmail,CarId,FromDate,ToDate,TotalAmount,Status) VALUES(:useremail,:carid,:fromdate,:todate,:totalamount,:status)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
      $query->bindParam(':carid',$carid,PDO::PARAM_STR);
      $query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
      $query->bindParam(':todate',$todate,PDO::PARAM_STR);
      $query->bindParam(':totalamount',$totalamount,PDO::PARAM_STR);
      $query->bindParam(':status',$status,PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $dbh->lastInsertId();
      if($lastInsertId)
      {
      echo "<script>alert('Reservation successfull.');</script>";
      }
      else 
      {
      echo "<script>alert('Something went wrong. Please try again');</script>";
      }
    }
    
    
    }    
  }
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
<title>DEU RAC | Car Details</title>
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

<!--Listing-Image-Slider-->

<?php 
$carid=intval($_GET['carid']);
$sql = "SELECT cars.*,brands.BrandName,brands.id as bid  from cars join brands on brands.id=cars.car_brand_id where cars.car_id=:carid";
$query = $dbh -> prepare($sql);
$query->bindParam(':carid',$carid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
$_SESSION['brndid']=$result->bid;  
?>  

<section id="listing_img_slider">
  <div><img src="admin/img/carimages/<?php echo htmlentities($result->car_img1);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="admin/img/carimages/<?php echo htmlentities($result->car_img2);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="admin/img/carimages/<?php echo htmlentities($result->car_img3);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="admin/img/carimages/<?php echo htmlentities($result->car_img4);?>" class="img-responsive"  alt="image" width="900" height="560"></div>
  <?php if($result->car_img5=="")
{

} else {
  ?>
  <div><img src="admin/img/carimages/<?php echo htmlentities($result->car_img5);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <?php } ?>
</section>
<!--/Listing-Image-Slider-->


<!--Listing-detail-->
<section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?php echo htmlentities($result->BrandName);?>  <?php echo htmlentities($result->car_model);?></h2>
      </div>
      <div class="col-md-3">
        <div class="price_info">
          <p>$<?php echo htmlentities($result->car_dprice);?> </p>Per Day
         
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>
          
            <li> <i class="fa fa-calendar" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->car_modelyear);?></h5>
              <p>Reg.Year</p>
            </li>
            <li> <i class="fa fa-cogs" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->car_fueltype);?></h5>
              <p>Fuel Type</p>
            </li>
       
            <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->car_seatingcapacity);?></h5>
              <p>Seats</p>
            </li>
          </ul>
        </div>
        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Vehicle Overview </a></li>
          
  
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content"> 
              <!-- vehicle-overview -->
              <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
                
                <p><?php echo "DEU RAC MANAGEMENT SYSTEM";?></p>
              </div>
              
              

              
            </div>
          </div>
          
        </div>
<?php }} ?>
   
      </div>
      
      <!--Side-Bar-->
      <aside class="col-md-3">
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h5>
            <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
          </div>
          <form method="post">
            <div class="form-group">
              <input type="date" class="form-control" name="fromdate" placeholder="From Date(yyyy-mm-dd)" required>
            </div>
            <div class="form-group">
              <input type="date" class="form-control" name="todate" placeholder="To Date(yyyy-mm-dd)" required>
            </div>
          <?php if($_SESSION['login'])
              {?>
              <div class="form-group">
                <input type="submit" class="btn"  name="submit" value="Book Now">
              </div>
              <?php } else { ?>
<a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login For Booking</a>

              <?php } ?>
          </form>
        </div>
      </aside>
      <!--/Side-Bar--> 
    </div>
    
    <div class="space-20"></div>
    <div class="divider"></div>
    
    <!--Similar-Cars-->
    <div class="similar_cars">
      <h3>Similar Cars</h3>
      <div class="row">
<?php 
$bid=$_SESSION['brndid'];
$carid=$_GET['carid'];
$sql="SELECT cars.car_model,brands.BrandName,cars.car_dprice,cars.car_fueltype,cars.car_modelyear,cars.car_id,cars.car_seatingcapacity,cars.car_img1 from cars join brands on brands.id=cars.car_brand_id where cars.car_brand_id=:bid and cars.car_status='available' and cars.car_id !=:carid ";
$query = $dbh -> prepare($sql);
$query->bindParam(':bid',$bid, PDO::PARAM_STR);
$query->bindParam(':carid',$carid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>      
        <div class="col-md-3 grid_listing">
          <div class="product-listing-m gray-bg">
            <div class="product-listing-img"> <a href="car-details.php?carid=<?php echo htmlentities($result->car_id);?>"><img src="admin/img/carimages/<?php echo htmlentities($result->car_img1);?>" class="img-responsive" alt="image" /> </a>
            </div>
            <div class="product-listing-content">
              <h5><a href="car-details.php?carid=<?php echo htmlentities($result->car_id);?>"><?php echo htmlentities($result->BrandName);?> <?php echo htmlentities($result->car_model);?></a></h5>
              <p class="list-price">$<?php echo htmlentities($result->car_dprice);?></p>
          
              <ul class="features_list">
                
             <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->car_seatingcapacity);?> seats</li>
                <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->car_modelyear);?> model</li>
                <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->car_fueltype);?></li>
              </ul>
            </div>
          </div>
        </div>
 <?php }} ?>       

      </div>
    </div>
    <!--/Similar-Cars--> 
    
  </div>
</section>
<!--/Listing-detail--> 

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

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>