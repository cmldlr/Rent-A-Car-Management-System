<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 

if(isset($_POST['submit']))
{
$model1="";
$brand1="";
$status1="";
$priceperday1="";
$fueltype1=" ";
$modelyear1="";

$id=$_GET['id'];
$model=$_POST['model'];
$brand=$_POST['brandname'];
$status=$_POST['status'];
$priceperday=$_POST['priceperday'];
$fueltype=$_POST['fueltype'];
$modelyear=$_POST['modelyear'];
if($model!=null){
	$model1="car_model=:model,";
}
if($brand!=null){
	$brand1="car_brand_id=:brand,";
}
if($status!=null){
	$status1="car_status=:status,";
}
if($priceperday!=null){
	$priceperday1="car_dprice=:priceperday,";
}
if($fueltype!=null){
	$fueltype1="car_fueltype=:fueltype,";
}
if($modelyear!=null){
	$modelyear1="car_modelyear=:modelyear";
}

$sql="update cars set car_id=:id,$model1 $brand1 $status1 $priceperday1 $fueltype1 $modelyear1 where car_id=:id ";
$query = $dbh->prepare($sql);
if($id!=null){
	$query->bindParam(':id',$id,PDO::PARAM_STR);
}	
if($model!=null){
	$query->bindParam(':model',$model,PDO::PARAM_STR);
}
if($brand!=null){
	$query->bindParam(':brand',$brand,PDO::PARAM_STR);
}
if($status!=null){
	$query->bindParam(':status',$status,PDO::PARAM_STR);
}
if($priceperday!=null){
	$query->bindParam(':priceperday',$priceperday,PDO::PARAM_STR);
}
if($fueltype!=null){
	$query->bindParam(':fueltype',$fueltype,PDO::PARAM_STR);
}
if($modelyear!=null){
	$query->bindParam(':modelyear',$modelyear,PDO::PARAM_STR);
}	
$query->execute();
$msg="Successfully updated.";
}

	?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>DEU RAC | Admin Edit Car Info</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
	<style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>
</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Edit Car</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
									<div class="panel-body">
<?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
<?php 
$id=intval($_GET['id']);
$sql ="SELECT cars.*,brands.BrandName,brands.id as bid from cars join brands on brands.id=cars.car_brand_id where cars.car_id=:id";
$query = $dbh -> prepare($sql);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

<form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
<label class="col-sm-2 control-label">Select Brand<span style="color:red">*</span></label>
<div class="col-sm-2">
<select class="selectpicker" name="brandname" required>
<option value="<?php echo htmlentities($result->bid);?>"><?php echo htmlentities($bdname=$result->BrandName); ?> </option>
<?php $ret="select id,BrandName from brands";
$query= $dbh -> prepare($ret);
$query-> execute();
$resultss = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
foreach($resultss as $results)
{
if($results->BrandName==$bdname)
{
continue;
} else{
?>
<option value="<?php echo htmlentities($results->id);?>"><?php echo htmlentities($results->BrandName);?></option>
<?php }}} ?>
</select>	
</div>

<label class="col-sm-3 control-label">Car Model<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="model" class="form-control" value="<?php echo htmlentities($result->car_model)?>" required>

</div>
</div>
											
<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Status<span style="color:red">*</span></label>
<div class="col-sm-2">
<select class="selectpicker" name="status" >
<option value="<?php echo htmlentities($results->car_status);?>"> <?php echo htmlentities($result->car_status);?> </option>
<option value="available">Available</option>
<option value="not available">Not Available</option>
</select>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Price Per Day(in USD)<span style="color:red">*</span></label>
<div class="col-sm-2">
<input type="number" min="100" name="priceperday" class="form-control" value="<?php echo htmlentities($result->car_dprice);?>" required>
</div>
<label class="col-sm-3 control-label">Select Fuel Type<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="fueltype">
<option value="<?php echo htmlentities($results->car_fueltype);?>"> <?php echo htmlentities($result->car_fueltype);?> </option>

<option value="Petrol">Petrol</option>
<option value="Diesel">Diesel</option>
<option value="CNG">CNG</option>
<option value="Electric">Electric</option>
</select>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Model Year<span style="color:red">*</span></label>
<div class="col-sm-2">
<input type="number" min="2000" max="2023" name="modelyear" class="form-control" value="<?php echo htmlentities($result->car_modelyear);?>" required>
</div>
<label class="col-sm-3 control-label">Seating Capacity<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="number" min="2" max="7" name="seatingcapacity" class="form-control" value="<?php echo htmlentities($result->car_seatingcapacity);?>" required>
</div>
</div>
<div class="hr-dashed"></div>								
<div class="form-group">
<div class="col-sm-12">
<h4><b>Car Images</b></h4>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 1 <img src="img/carimages/<?php echo htmlentities($result->car_img1);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage1.php?imgid=<?php echo htmlentities($result->car_id)?>">Change Image 1</a>
</div>
<div class="col-sm-4">
Image 2<img src="img/carimages/<?php echo htmlentities($result->car_img2);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage2.php?imgid=<?php echo htmlentities($result->car_id)?>">Change Image 2</a>
</div>
<div class="col-sm-4">
Image 3<img src="img/carimages/<?php echo htmlentities($result->car_img3);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage3.php?imgid=<?php echo htmlentities($result->car_id)?>">Change Image 3</a>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 4<img src="img/carimages/<?php echo htmlentities($result->car_img4);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage4.php?imgid=<?php echo htmlentities($result->car_id)?>">Change Image 4</a>
</div>
<div class="col-sm-4">
Image 5
<?php if($result->car_img5=="")
{
echo htmlentities("File not available");
} else {?>
<img src="img/carimages/<?php echo htmlentities($result->car_img5);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage5.php?imgid=<?php echo htmlentities($result->car_id)?>">Change Image 5</a>
<?php } ?>
</div>

</div>
							
</div>
</div>
</div>
</div>



<?php }} ?>


											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2" >
													
													<button class="btn btn-primary" name="submit" type="submit" style="margin-top:4%">Save changes</button>
												</div>
											</div>

										</form>
									</div>
								</div>
							</div>
						</div>
						
					

					</div>
				</div>
				
			

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php } ?>