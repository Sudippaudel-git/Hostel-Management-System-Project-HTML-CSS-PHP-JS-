<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=$_POST['password'];
$stmt=$mysqli->prepare("SELECT email,password,id FROM userregistration WHERE email=? and password=? ");
				$stmt->bind_param('ss',$email,$password);
				$stmt->execute();
				$stmt -> bind_result($email,$password,$id);
				$rs=$stmt->fetch();
				$stmt->close();
				$_SESSION['id']=$id;
				$_SESSION['login']=$email;
				$uip=$_SERVER['REMOTE_ADDR'];
				$ldate=date('d/m/Y h:i:s', time());
				if($rs)
				{
             $uid=$_SESSION['id'];
             $uemail=$_SESSION['login'];
$ip=$_SERVER['REMOTE_ADDR'];
$geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip;
$addrDetailsArr = unserialize(file_get_contents($geopluginURL));
$city = $addrDetailsArr['geoplugin_city'];
$country = $addrDetailsArr['geoplugin_countryName'];
$log="insert into userLog(userId,userEmail,userIp,city,country) values('$uid','$uemail','$ip','$city','$country')";
$mysqli->query($log);
if($log)
{
header("location:dashboard.php");
				}
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
	<meta name="theme-color" content="#3e454c">
	<title> Hostel Registration</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript">
function valid()
{
if(document.registration.password.value!= document.registration.cpassword.value)
{
alert("Password and Re-Type Password Field do not match  !!");
document.registration.cpassword.focus();
return false;
}
return true;
}
</script>
</head>
<body>
<header style="background-color: #4CAF50; color: #fff; padding: 20px; text-align: center; font-size: 32px; font-weight: bold;">
    Hostel Management System
</header><br><br>

	
					
<!DOCTYPE html>
<html>
<head>
    <title>Hostel Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        div.container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            text-transform: uppercase;
            font-size: 14px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #3498db;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
        }

        div.text-center {
            text-align: center;
            margin-top: 20px;
        }

        a {
            text-decoration: none;
            color: #fff;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div>
            <div>
                <form action="" class="mt" method="post">
                    <label for="email">Email<br>
                    <input type="text" placeholder="Email" name="email"><br><br><br></label>
                    <label for="password">Password <br>
                    <input type="password" placeholder="Password" name="password"><br></label><br>
                    <input type="submit" name="login" value="Login">
                </form>
            </div>
        </div>
        <div class="text-center">
            <a href="forgot-password.php">Forgot password?</a>
        </div>
    </div>
	<div style="text-align: center; font-size: 18px; color: #555; padding: 20px;">
    Not a member? <a href="registration.php" style="text-decoration: none; color: #3498db; font-weight: bold;">Create an account</a><br>
	<div style="text-align: center; font-size: 22px; color: #ff5733; background-color: #f1f1f1; padding: 21px; border-radius: 10px;">
    <a href="admin/index.php" style="text-decoration: none; color: #fff; background-color: #4CAF50; padding: 10px 20px; border-radius: 5px; font-weight: bold;">  Go to Admin Panel</a>
</div>

<div style="text-align: left; font-size: 12px; color: #ff5733; background-color: #f1f1f1; padding: 12px; border-radius: 8px;">
    <a href="index.php" style="text-decoration: none; color: #fff; background-color: #4CAF50; padding: 8px 16px; border-radius: 5px; font-weight: bold;">  Go to Home</a>
</div>



		
	<script src="js/jquery.min.js"></script>
	
	<script src="js/jquery.dataTables.min.js"></script>

	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>

</html>