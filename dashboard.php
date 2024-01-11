<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
checklogin();

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

	<title>DashBoard</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<link rel="stylesheet" href="css/fileinput.min.css">
	
	<link rel="stylesheet" href="css/style.css">


</head>

<body  style="background-image:url(images/hostel.jpg width: 10px;)"> 
<?php include("includes/header.php");?>

	<div class="ts-main-content">
		<?php include("includes/sidebar.php");?>
		<div class="content-wrapper">
			<div class="container-fluid">
			
				<div class="row">
					<div class="col-md-12">
				
					
						<h2 style="color: Green; font-weight: bolder; font-size:65px; text-align:center">Dashboard</h2> <br> <br>
						
						<div class="row" style="text-align:center; font-size: larger; font-weight:bolder">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="panel panel-default">
											<div >
												<div>



													<div  style="font-size: 55px; font-weight:bolder; color:black" >My Profile</div>

												</div>
											</div>
											<a href="my-profile.php" class="block-anchor panel-footer" style="font-size: 45px;">Full Detail <i class="fa fa-arrow-right"></i></a> <br><br>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div >
												<div class="stat-panel text-center">

												<div style="font-size: 55px; font-weight:bolder; color:black" >My Room</div>

												</div>
											</div>
											<a href="room-details.php" class="block-anchor panel-footer text-center" style="font-size: 45px;">See All &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
										
									</div>

								</div>
							</div>
						</div>





					</div>
				</div>

			</div>
		</div>
	</div>
	</div>

	<!
	<script src="js/jquery.min.js"></script>

	<script src="js/jquery.dataTables.min.js"></script>
	
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

	

</body>

</html>
