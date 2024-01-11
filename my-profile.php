<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
checklogin();
$aid = $_SESSION['id'];

$errorMessages = array(
    'fname' => '',
    'mname' => '',
    'lname' => '',
    'contact' => ''
);

if (isset($_POST['update'])) {
    // $regno = $_POST['regno'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $contactno = $_POST['contact'];

    // if (!preg_match('/^\d+$/', $regno)) {
    //     $errorMessages['regno'] = 'Registration No must contain only digits';
    // }
    if (!preg_match('/^[A-Za-z]+$/', $fname)) {
        $errorMessages['fname'] = 'First Name must contain only letters';
    }
    if (!preg_match('/^[A-Za-z]*$/', $mname)) {
        $errorMessages['mname'] = 'Middle Name must contain only letters';
    }
    if (!preg_match('/^[A-Za-z]+$/', $lname)) {
        $errorMessages['lname'] = 'Last Name must contain only letters';
    }
    if (!preg_match('/^\d{10}$/', $contactno)) {
        $errorMessages['contact'] = 'Contact No must be 10 digits';
    }

    if (empty(array_filter($errorMessages))) {
        $query = "UPDATE userregistration SET firstName=?, middleName=?, lastName=?, gender=?, contactNo=? WHERE id=?";
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            die("Error: " . $mysqli->error);
        }
        
        $rc = $stmt->bind_param('ssssis', $fname, $mname, $lname, $gender, $contactno, $aid);
        if (!$rc) {
            die("Error in binding parameters: " . $stmt->error);
        }

        $stmt->execute();
        echo "<script>alert('Profile updated Successfully');</script>";
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
    <title>Profile Updation</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="js/validation.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript">
        function valid() {
            if (document.registration.password.value != document.registration.cpassword.value) {
                alert("Password and Re-Type Password Field do not match!!");
                document.registration.cpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body style="background-color:antiquewhite">
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <?php
                $aid = $_SESSION['id'];
                $ret = "select * from userregistration where id=?";
                $stmt = $mysqli->prepare($ret);
                $stmt->bind_param('i', $aid);
                $stmt->execute();
                $res = $stmt->get_result();
                $cnt = 1;
                while ($row = $res->fetch_object()) {
                ?>
                    <div class="row">
                        <div class="col-md-12"><br>
                            <h2 class="page-title" style="font-size: 20px; color:green"><?php echo $row->firstName; ?>'s&nbsp;Profile </h2>
                            <!-- <img src="img/profile.jpg" alt="sorry" width="90px" height="89px"><br><br> -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-primary">
                                      
                                        <div class="panel-body">
                                            <form method="post" action="" name="registration" class="form-horizontal" onSubmit="return valid();">
                                                <!-- <div class="form-group">
                                                    <label class="col-sm-2 control-label"> Registration No : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="regno" id="regno" class="form-control <?php if ($errorMessages['regno']) echo 'error-field'; ?>" required="required" value="<?php echo $row->regNo; ?>">
                                                        <span class="error-msg"><?php echo $errorMessages['regno']; ?></span>
                                                    </div> -->
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">First Name : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="fname" id="fname" class="form-control <?php if ($errorMessages['fname']) echo 'error-field'; ?>" value="<?php echo $row->firstName; ?>" required="required">
                                                        <span class="error-msg"><?php echo $errorMessages['fname']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Middle Name : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="mname" id="mname" class="form-control <?php if ($errorMessages['mname']) echo 'error-field'; ?>" value="<?php echo $row->middleName; ?>">
                                                        <span class="error-msg"><?php echo $errorMessages['mname']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Last Name : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="lname" id="lname" class="form-control <?php if ($errorMessages['lname']) echo 'error-field'; ?>" value="<?php echo $row->lastName; ?>" required="required">
                                                        <span class="error-msg"><?php echo $errorMessages['lname']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Gender:</label>
                                                    <div class="col-sm-8">
                                                        <select name="gender" class="form-control" required="required">
                                                            <!-- Remove the <option> tag that echoes the value of $row->gender -->
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                            <option value="others">Others</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Contact No : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="contact" id="contact" class="form-control <?php if ($errorMessages['contact']) echo 'error-field'; ?>" maxlength="10" value="<?php echo $row->contactNo; ?>" required="required">
                                                        <span class="error-msg"><?php echo $errorMessages['contact']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Email id: </label>
                                                    <div class="col-sm-8">
                                                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $row->email; ?>" readonly>
                                                        <span id="user-availability-status" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-sm-offset-4">
                                                    <input type="submit" name="update" Value="Update Profile" class="btn btn-primary" style="background-color:yellow">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: left; font-size: 12px; color: #ff5733; background-color: #f1f1f1; padding: 12px; border-radius: 8px;">
                                    <a href="dashboard.php" style="text-decoration: none; color: #fff; background-color: #4CAF50; padding: 8px 16px; border-radius: 5px; font-weight: bold;">  Go to Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
   <script src="js/jquery.dataTables.min.js"></script>
	
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
    <script type="text/javascript">
        $(document).ready(function(){
          
        });
    </script>
    <script>
function checkAvailability() {

$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});s
}
</script>
</html>

