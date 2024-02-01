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

$car_model=$_POST['car_model'];
$brand=$_POST['brandname'];
$car_dprice=$_POST['car_dprice'];
$car_fueltype=$_POST['car_fueltype'];
$car_status=$_POST['car_status'];
$car_modelyear=$_POST['car_modelyear'];
$car_seatingcapacity=$_POST['car_seatingcapacity'];
$car_image1=$_FILES["img1"]["name"];
$car_image2=$_FILES["img2"]["name"];
$car_image3=$_FILES["img3"]["name"];
$car_image4=$_FILES["img4"]["name"];
$car_image5=$_FILES["img5"]["name"];

move_uploaded_file($_FILES["img1"]["tmp_name"],"img/carimages/".$_FILES["img1"]["name"]);
move_uploaded_file($_FILES["img2"]["tmp_name"],"img/carimages/".$_FILES["img2"]["name"]);
move_uploaded_file($_FILES["img3"]["tmp_name"],"img/carimages/".$_FILES["img3"]["name"]);
move_uploaded_file($_FILES["img4"]["tmp_name"],"img/carimages/".$_FILES["img4"]["name"]);
move_uploaded_file($_FILES["img5"]["tmp_name"],"img/carimages/".$_FILES["img5"]["name"]);

$sql="INSERT INTO cars(car_brand_id,car_model,car_dprice,car_modelyear,car_seatingcapacity,car_fueltype,car_status,car_img1,car_img2,car_img3,car_img4,car_img5) 
VALUES(:brand,:car_model,:car_dprice,:car_modelyear,:car_seatingcapacity,:car_fueltype,:car_status,:car_image1,:car_image2,:car_image3,:car_image4,:car_image5)";
$query = $dbh->prepare($sql);

$query->bindParam(':brand',$brand,PDO::PARAM_STR);
$query->bindParam(':car_model',$car_model,PDO::PARAM_STR);
$query->bindParam(':car_dprice',$car_dprice,PDO::PARAM_STR);
$query->bindParam(':car_modelyear',$car_modelyear,PDO::PARAM_STR);
$query->bindParam(':car_seatingcapacity',$car_seatingcapacity,PDO::PARAM_STR);
$query->bindParam(':car_fueltype',$car_fueltype,PDO::PARAM_STR);
$query->bindParam(':car_status',$car_status,PDO::PARAM_STR);

$query->bindParam(':car_image1',$car_image1,PDO::PARAM_STR);
$query->bindParam(':car_image2',$car_image2,PDO::PARAM_STR);
$query->bindParam(':car_image3',$car_image3,PDO::PARAM_STR);
$query->bindParam(':car_image4',$car_image4,PDO::PARAM_STR);
$query->bindParam(':car_image5',$car_image5,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Car added successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

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
	
	<title>DEU RAC | Admin Add Car</title>

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
					
						<h2 class="page-title">Add A Car</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
<label class="col-sm-2 control-label">Select Brand<span style="color:red">*</span></label>
<div class="col-sm-2">
<select class="selectpicker" name="brandname" required>
<option value=""> Select </option>
<?php $ret="select id,BrandName from brands";
$query= $dbh -> prepare($ret);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
?>
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?></option>
<?php }} ?>

</select>
</div>

<label class="col-sm-3 control-label">Car Model<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="car_model" class="form-control" required>
</div>

</div>										
<form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
<label class="col-sm-2 control-label">Status<span style="color:red">*</span></label>
<div class="col-sm-2">
<select class="selectpicker" name="car_status" required>
<option value=""> Select </option>
<option value="available">Available</option>
<option value="not available">Not Available</option>
</select>
</div>


</div>
<div class="form-group">
<label class="col-sm-2 control-label">Price Per Day(in USD)<span style="color:red">*</span></label>
<div class="col-sm-2">
<input type="number" min="100" name="car_dprice" class="form-control" required>
</div>

<label class="col-sm-3 control-label">Select Fuel Type<span style="color:red">*</span></label>
<div class="col-sm-3">
<select class="selectpicker" name="car_fueltype" required>
<option value=""> Select </option>
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
<input type="number" min="2000" max="2022" name="car_modelyear" class="form-control" required>
</div>
<label class="col-sm-3 control-label">Seating Capacity<span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="number" min="2" max="7" name="car_seatingcapacity" class="form-control" required>
</div>
</div>
<div class="hr-dashed"></div>


<div class="form-group">
<div class="col-sm-12">
<h4><b>Upload Images</b></h4>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 1 <span style="color:red">*</span><input type="file" name="img1" required>
</div>
<div class="col-sm-4">
Image 2<span style="color:red">*</span><input type="file" name="img2" required>
</div>
<div class="col-sm-4">
Image 3<span style="color:red">*</span><input type="file" name="img3" required>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 4<span style="color:red">*</span><input type="file" name="img4" required>
</div>
<div class="col-sm-4">
Image 5<input type="file" name="img5">
</div>

</div>
<div class="hr-dashed"></div>									
</div>
</div>
</div>
</div>
							
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-default" type="reset">Cancel</button>
													<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
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