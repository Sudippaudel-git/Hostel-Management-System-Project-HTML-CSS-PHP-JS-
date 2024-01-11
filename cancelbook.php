<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
checklogin();
$errors = array(); // Initialize an empty array to store validation errors

if (isset($_POST['cancel'])) {
    $roomno = $_POST['room'];

    // Validate if the room number exists in the 'hostelbook' table
    $query = "SELECT COUNT(*) FROM hostelbook WHERE roomno = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $roomno);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // If room number exists, proceed with the cancellation
        $query = "DELETE FROM hostelbook WHERE roomno = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $roomno);
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('Booking Cancelled Successfully');</script>";
    } else {
        // If room number doesn't exist, show an error message
        echo "<script>alert('Invalid Room Number. Please enter a valid Room Number.');</script>";
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
	<title>Cancel Booking</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <!-- Head content remains unchanged -->
</head>
<body style="background-color:antiquewhite">
    <?php include('includes/header.php');?>
    <div class="ts-main-content">
        <?php include('includes/sidebar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">
               
                <form method="post" action="" class="form-horizontal" style="text-align:center">
                    
                    <div class="form-group"><br><br>
                    <h1> Cancel Booking</h1>
                        <label class="col-sm-2 control-label">Room No : </label>
                        <div class="col-sm-8">
                            <input type="text" name="room" id="room"  class="form-control" placeholder="Enter Room No" required>
                        </div>
                    </div>
                    <div class="col-sm-6 col-sm-offset-4"><br><br>
                        <input type="submit" name="cancel" value="Cancel Booking" class="btn btn-primary" style="background-color: red;text-align:center">
                    </div><br>
          
                </form>
                <div style="text-align: center; color: #3498db; padding: 20px; margin-top: 20px;">
        <a href="book-hostel.php" style="text-decoration: none; font-size: 18px; font-weight: bold; border: 2px solid #fff; padding: 10px 20px; border-radius: 5px; transition: background-color 0.3s;">Go to Book Hostel</a>
    </div>
            </div>
        </div>
    </div>
    <!-- JavaScript scripts and other HTML content remain unchanged -->
  
</body>
<script src="js/jquery.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</html>
