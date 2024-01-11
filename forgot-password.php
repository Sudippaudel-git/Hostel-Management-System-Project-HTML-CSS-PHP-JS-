<?php
session_start();
include('includes/config.php');
$pwd = ''; // Initialize the $pwd variable with an empty value

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $stmt = $mysqli->prepare("SELECT email,contactNo,password FROM userregistration WHERE (email=? && contactNo=?) ");
    $stmt->bind_param('ss', $email, $contact);
    $stmt->execute();
    $stmt->bind_result($username, $email, $password);
    $rs = $stmt->fetch();
    if ($rs) {
        $pwd = $password;
    } else {
        echo "<script>alert('Invalid Email/Contact no or password');</script>";
    }
}
?>

<!doctype html>
<!-- Rest of the code remains the same -->


<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>User Forgot Password</title>
	<style>
			/* Global Styles */
			body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
			background-color: #f4f4f4;
		}

		/* Page Styles */
		.login-page {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			background-size: cover;
			background-position: center;
		}

		.bk-img {
			background-image: url(img/login-bg.jpg);
		}

		.text-center {
			text-align: center;
		}

		.text-bold {
			font-weight: bold;
		}

		.text-light {
			color: #fff;
		}

		.mt-4x {
			margin-top: 4rem;
		}

		.pt-2x {
			padding-top: 2rem;
		}

		.pb-3x {
			padding-bottom: 3rem;
		}

		.bk-light {
			background-color: #f9f9f9;
		}

		.col-md-8 {
			width: 66.66667%;
		}

		.col-md-offset-2 {
			margin-left: 16.66667%;
		}

		/* Form Styles */
		.form-control {
			display: block;
			width: 100%;
			padding: 0.5rem 1rem;
			font-size: 1rem;
			line-height: 1.5;
			color: #495057;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid #ced4da;
			border-radius: 0.25rem;
			transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
		}

		.form-control:focus {
			border-color: #80bdff;
			box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
		}

		.mb {
			margin-bottom: 1rem;
		}

		/* Button Styles */
		.btn {
			display: inline-block;
			font-weight: 400;
			text-align: center;
			white-space: nowrap;
			vertical-align: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			border: 1px solid transparent;
			padding: 0.5rem 1rem;
			font-size: 1rem;
			line-height: 1.5;
			border-radius: 0.25rem;
			transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
				border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
		}

		.btn-primary {
			color: #fff;
			background-color: #007bff;
			border-color: #007bff;
		}

		.btn-primary:hover {
			color: #fff;
			background-color: #0056b3;
			border-color: #0056b3;
		}

		.btn-block {
			display: block;
			width: 100%;
		}

		/* Link Styles */
		.text-light {
			color: #fff;
		}

		.text-light:hover {
			color: #f8f9fa;
			text-decoration: none;
		}

		/* Responsive Styles */
		@media (max-width: 768px) {
			.col-md-8,
			.col-md-offset-2 {
				width: 100%;
				margin-left: 0;
			}
		}
	</style>

			</head>
<body style="background-color:antiquewhite">
	

<!-- <h6 class="text-center text-bold text-light mt-4x" >Forgot Password</h6><br><br><br><br> -->
		
			<div class="col-md-8 col-md-offset-2">
				<?php if (isset($_POST['login'])) { ?>
					<p>Your Password is <?php echo $pwd; ?> <br> <br> Change the Password After login</p>
				<?php } ?><br><br><br>
				<form action="" class="mt" method="post">
					<label for="" class="text-uppercase text-sm">Your Email</label>
					<input type="email" placeholder="Email" name="email" class="form-control mb">
					<label for="" class="text-uppercase text-sm">Your Contact no</label>
					<input type="text" placeholder="Contact no" name="contact" class="form-control mb">

					<input type="submit" name="login" class="btn btn-primary btn-block" value="login">
				</form>
		
			
			</div>
		
		
		<!-- <div class="text-center text-light">
			<a href="index.php" class="text-light">Sign in?</a>
		</div> -->

	<div style="text-align: center; margin-top: 100px;">
		<a href="login.php" style="display: inline-block; padding: 10px 20px; font-size: 18px; font-weight: bold; text-decoration: none; color: #fff; background-color: green; border: 1px solid #007bff; border-radius: 3px; transition: background-color 0.3s ease-in-out;">
			User Login
		</a>
	</div>

	<script src="js/jquery.min.js"></script>

	<script src="js/jquery.dataTables.min.js"></script>

	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</body>
</html>
