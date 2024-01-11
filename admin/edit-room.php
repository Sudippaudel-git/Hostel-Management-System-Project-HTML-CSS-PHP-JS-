<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
checklogin();
//code for add courses
if ($_POST['submit']) {
  
    $fees = $_POST['fees'];
    $id = $_GET['id'];
    $query = "update rooms set fees=? where id=?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ii',  $fees, $id);
    $stmt->execute();
    echo "<script>alert('Room Details has been Updated successfully');</script>";
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
    <title>Edit Room Details</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color:hwb(hue white black);
        }

        .ts-main-content {
            margin-top: 20px;
        }

        .page-title {
            margin-bottom: 20px;
        }

        .panel {
            margin-bottom: 20px;
        }

        .panel-heading {
            background-color: #f5f5f5;
            border-bottom: 1px solid #ddd;
            padding: 10px 15px;
        }

        .panel-body {
            padding: 20px;
        }

        .form-horizontal .form-group {
            margin-left: -15px;
            margin-right: -15px;
        }

        .form-horizontal .control-label {
            padding-top: 7px;
            margin-bottom: 0;
            text-align: right;
        }

        .form-horizontal .col-sm-2 {
            width: 16.66666667%;
        }

        .form-horizontal .col-sm-8 {
            width: 66.66666667%;
        }

        .form-horizontal .form-control {
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        }

        .form-horizontal input[type="submit"] {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: normal;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            color: #333;
            background-color: yellow;
            border-color: yellow;
        }

        .help-block.m-b-none {
            margin-bottom: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Edit Room Details</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Edit Room Details</div>
                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal" onsubmit="return validateForm();">
                                            <?php
                                            $id = $_GET['id'];
                                            $ret = "select * from rooms where id=?";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->bind_param('i', $id);
                                            $stmt->execute();
                                            $res = $stmt->get_result();
                                            while ($row = $res->fetch_object()) {
                                            ?>
                                                <!-- Your existing form fields -->
                                                <!-- <div class="form-group">
                                                    <label class="col-sm-2 control-label">Seater</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="seater" value="<?php echo $row->seater; ?>" class="form-control">
                                                    </div>
                                                </div> -->
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Room no</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="rmno" id="rmno" value="<?php echo $row->room_no; ?>" disabled>
                                                        <span class="help-block m-b-none">Room no can't be changed.</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Fees (PM)</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="fees" id="fees" value="<?php echo $row->fees; ?>">
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <input type="submit" name="submit" value="Update Room Details">
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

    <script>
        function validateForm() {
            var fees = document.getElementById('fees').value;

            if (isNaN(fees) || fees.trim() === '' || fees < 0) {
                alert('Fees (PM) must be in Number format');
                return false;
            }

            return true;
        }
    </script>

    <script src="js/jquery.min.js"></script>
    <!-- <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script> -->
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    
    <script src="js/main.js"></script>
</body>

</html>
