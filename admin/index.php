<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$username=$_POST['username'];
$password=$_POST['password'];
$stmt=$mysqli->prepare("SELECT username,email,password,id FROM admin WHERE (userName=?|| email=?) and password=? ");
				$stmt->bind_param('sss',$username,$username,$password);
				$stmt->execute();
				$stmt -> bind_result($username,$username,$password,$id);
				$rs=$stmt->fetch();
				$_SESSION['id']=$id;
				$uip=$_SERVER['REMOTE_ADDR'];
				$ldate=date('d/m/Y h:i:s', time());
				if($rs)
				{
                //  $insert="INSERT into admin(adminid,ip)VALUES(?,?)";
   // $stmtins = $mysqli->prepare($insert);
   // $stmtins->bind_param('sH',$id,$uip);
    //$res=$stmtins->execute();
					header("location:dashboard.php");
				}

				else
				{
					echo "<script>alert('Invalid Username/Email or password');</script>";
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

	<title>Admin login</title>

	<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            color: black;
            margin-top: 40px;
        }

        div.container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        }

        form {
            text-align: center;
            font-weight: bolder;
            color: #333;
            font-size: 24px;
        }

        label {
            display: block;
            font-size: 18px;
            margin-top: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 18px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #f9c30b;
            color: #333;
            font-size: 24px;
            font-weight: bolder;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ffc40b;
        }
    </style>
		</head>
<body style="background-image: url(img/second.jpg);" >

	
<h1>Hostel Management System</h1>
    <div class="container">
        <form action="" class="mt" method="post">
            <label for="username">Username or Email
            <input type="text" placeholder="Username" name="username"></label> <br>

            <label for="password">Password
            <input type="password" placeholder="Password" name="password"></label><br>

            <input type="submit" name="login" value="Login">
        </form>
    </div><br>
    <div style="text-align: center; font-size: 20px; color: #ff5733;  padding: 21px; border-radius: 5px;">
    <a href=" /hostel/login.php" style="text-decoration: none; color: #fff; background-color: #4CAF50; padding: 8px 18px; border-radius: 5px; font-weight: bold;">  Go to User Panel</a>
</div>			
				
	
	<script src="js/jquery.min.js"></script>
	<!-- <script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script> -->
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>


</html>
