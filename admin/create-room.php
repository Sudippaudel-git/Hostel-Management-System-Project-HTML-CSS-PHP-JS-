<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
checklogin();
//code for add courses
if($_POST['submit'])
{

$roomno=$_POST['rmno'];
$fees=$_POST['fee'];
$sql="SELECT room_no FROM rooms where room_no=?";
$stmt1 = $mysqli->prepare($sql);
$stmt1->bind_param('i',$roomno);
$stmt1->execute();
$stmt1->store_result(); 
$row_cnt=$stmt1->num_rows;;
if($row_cnt>0)
{
echo"<script>alert('Room already exist');</script>";
}
else
{
$query="insert into  rooms (room_no,fees) values(?,?)";
$stmt = $mysqli->prepare($query);
$rc=$stmt->bind_param('ii',$roomno,$fees);
$stmt->execute();
echo"<script>alert('Room has been added successfully');</script>";
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
	<title>Create Room</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<style>
        body {
            background-color: aquamarine;
        }

        .page-title {
            text-align: center;
            font-size: x-large;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .panel-body {
            padding: 20px;
            border-radius: 5px;
            background-color: #f8f8f8;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-horizontal .form-group {
            margin: 0 0 20px;
        }

        .form-horizontal .control-label {
            text-align: left;
            font-size: larger;
            padding-top: 7px;
        }

        .form-horizontal .form-control {
            width: 100%;
            height: 34px;
            font-size: 14px;
            padding: 6px 12px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
        }

        .form-horizontal .form-control:focus {
            border-color: #66afe9;
            outline: 0;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
        }

        .btn-primary {
            background-color: #337ab7;
            border-color: #2e6da4;
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active {
            background-color: #286090;
            border-color: #204d74;
        }
    </style>

    <script>
        // JavaScript validation (same as before)
        function validateForm() {
            // ...
        }
    </script>










</head>

<body style="background-color:azure ">
    <?php include('includes/header.php');?>
    <div class="ts-main-content">
        <?php include('includes/sidebar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div>
                        <br><br>

                        <h2 class="page-title" style="text-align:center; font-size:x-large; font-weight:bold;" >Add  Room </h2>

                        <div class="row">
                            <div>
                                <div>
                                    <div class="panel-body">
                                        <?php if(isset($_POST['submit'])) { ?>
                                            <!-- <p style="color: red"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></p> -->
                                        <?php } ?>
                                        <form method="post" class="form-horizontal" onsubmit="return validateForm();">
                                            <div class="hr-dashed"></div>
                                            <!-- <div class="form-group" style="text-align: center; font-size: larger;">
                                                <label class="col-sm-2 control-label">Select Seater</label>
                                                <div class="col-sm-8">
                                                    <select name="seater" class="form-control" required>
                                                        <option value="">Select Seater</option>
                                                        <option value="1">Single Seater</option>
                                                        <option value="2">Two Seater</option>
                                                        <option value="3">Three Seater</option>
                                                        <option value="4">Four Seater</option>
                                                        <option value="5">Five Seater</option>
                                                    </select>
                                                </div>
                                            </div> -->
                                            <div class="form-group" style="text-align: center; font-size: larger;">
                                                <label class="col-sm-2 control-label">Room No.</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="rmno" id="rmno" value="" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group" style="text-align: center; font-size: larger;">
                                                <label class="col-sm-2 control-label">Fees(Per Month)</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="fee" id="fee" value="" required="required">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-sm-offset-2" style="text-align:center;">
                                                <input class="btn btn-primary" type="submit" name="submit" value="Add Room">
                                            </div>
                                        </form>
                                        <div style="text-align: center; font-size: 22px; color: #ff5733; background-color: #f1f1f1; padding: 21px; border-radius: 10px;">
    <a href="dashboard.php" style="text-decoration: none; color: #fff; background-color: #4CAF50; padding: 10px 20px; border-radius: 5px; font-weight: bold;">  Go to Dashboard</a>
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
    
    <script>
        // JavaScript validation
        function validateForm() {
            // var seater = document.getElementsByName('seater')[0].value;
            var roomno = document.getElementById('rmno').value;
            var fees = document.getElementById('fee').value;

            // if (seater === '') {
            //     alert('Please select a Seater');
            //     return false;
            // }

            if (isNaN(roomno) || roomno.trim() === '') {
                alert('Please enter a valid room number');
                return false;
            }

            if (isNaN(fees) || fees.trim() === '' || fees < 0) {
                alert('Fees must be a positive numeric value');
                return false;
            }
			// if (isNaN(roomno) || roomno.trim() === ''&&isNaN(fees) || fees.trim() === '' && fees < 0){
			// 	alert('Please enter valid data');
			// 	return false;
			// }

            return true;
        }
    </script>
</body>
<!-- Rest of your HTML code -->
<script src="js/jquery.min.js"></script>
	<!-- <script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script> -->
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</html>
