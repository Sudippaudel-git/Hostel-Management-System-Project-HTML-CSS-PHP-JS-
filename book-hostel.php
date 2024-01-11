<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
 checklogin();
 $errors = array(); // Initialize an empty array to store validation errors

if(isset($_POST['submit']))
{
$roomno=$_POST['room'];
$foodstatus=$_POST['foodstatus'];
$feespm=$_POST['fpm'];
$stayfrom=$_POST['stayf'];
$duration=$_POST['duration'];
$fname=$_POST['fname'];
$mname=$_POST['mname'];
$lname=$_POST['lname'];
$gender=$_POST['gender'];
$contactno=$_POST['contact'];
$emailid=$_POST['email'];
$gurname=$_POST['gname'];
$gurrelation=$_POST['grelation'];
$gurcntno=$_POST['gcontact'];
$address=$_POST['address'];

if (empty($gurname)) {
	$errors['gname'] = "Guardian Name is required";
} elseif (!preg_match('/^[a-zA-Z\s]+$/', $gurname)) {
	$errors['gname'] = "Guardian Name can only contain letters";
}
if (empty($gurrelation)) {
	$errors['grelation'] = "Guardian Relation is required";
} elseif (!preg_match('/^[a-zA-Z\s]+$/', $gurrelation)) {
	$errors['grelation'] = "Guardian Relation can only contain letters";
}
if (empty($gurcntno)) {
	$errors['gcontact'] = " Guardian Contact Number   is required";
} elseif (!is_numeric($gurcntno) || strlen($gurcntno) !== 10) {
	$errors['gcontact'] = " Guardian Contact No must be a 10-digit number";
}

if (empty($errors)) {
	$query="insert into  hostelbook(roomno,foodstatus ,feespm,stayfrom,duration,firstName,middleName,lastName,gender,contactno,emailid,guardianName,guardianRelation,guardianContactno,address) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

	$stmt = $mysqli->prepare($query);
	 if ($stmt === false) {
		trigger_error('Error: ' . $mysqli->error, E_USER_ERROR);
	 }
	$stmt->bind_param('iiisissssisssis', $roomno, $foodstatus, $feespm, $stayfrom,$duration,  $fname, $mname, $lname, $gender, $contactno, $emailid,  $gurname, $gurrelation, $gurcntno, $address);

	if ($stmt->execute()) {
		echo "<script>alert('User Successfully Book hostel');</script>";
	} else {
		echo "<script>alert('Error registering User');</script>";
	}

	 $stmt->close();
	
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
	<title>Student Hostel Registration</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">
	<script>
document.addEventListener('DOMContentLoaded', function () {
    const stayFromDateInput = document.getElementById('stayf');
    stayFromDateInput.addEventListener('input', function () {
        const selectedDate = new Date(this.value);
        const currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0); // Set time to midnight for accurate comparison
        if (selectedDate < currentDate) {
            this.setCustomValidity('Please select a date that is not in the past.');
        } else {
            this.setCustomValidity('');
        }
    });
});
</script>

<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
 <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script> 
<script>
function getSeater(val) {
$.ajax({
type: "POST",
url: "get_seater.php",
data:'roomid='+val,
success: function(data){
//alert(data);
$('#seater').val(data);
}
});

$.ajax({
type: "POST",
url: "get_seater.php",
data:'rid='+val,
success: function(data){
//alert(data);
$('#fpm').val(data);
}
});
}

</script>

  


</head>
<body style="background-color:antiquewhite">
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12"><br>
					
						<h2 class="page-title" style="color:green" >Fill all Information </h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-primary">
									
									<div class="panel-body">
										<form method="post" action="" class="form-horizontal">
							<?php
$uid=$_SESSION['login'];
							 $stmt=$mysqli->prepare("SELECT emailid FROM hostelbook WHERE emailid=? ");
				$stmt->bind_param('s',$uid);
				$stmt->execute();
				$stmt -> bind_result($email);
				$rs=$stmt->fetch();
				$stmt->close();
				//  $mysqli->close();
	//  $mysqli->close();
				if($rs)
				{ ?>
			<h3 style="color: red" >Hostel already booked by you</h3>
				<?php }
				else{
							echo "";
							}			
							?>			


<div class="form-group">
<label class="col-sm-2 control-label">Room no. </label>
<div class="col-sm-8">
<select name="room" id="room"class="form-control"  onChange="getSeater(this.value);" onBlur="checkAvailability()" required> 
<option value="">Select Room</option>
<?php $query ="SELECT * FROM rooms";
$stmt2 = $mysqli->prepare($query);
$stmt2->execute();
$res=$stmt2->get_result();
while($row=$res->fetch_object())
{
?>
<option value="<?php echo $row->room_no;?>"> <?php echo $row->room_no;?></option>
<?php } ?>
</select> 
<span id="room-availability-status" style="font-size:12px;"></span>

</div>
</div>
											


<div class="form-group">
<label class="col-sm-2 control-label">Fees Per Month</label>
<div class="col-sm-8">
<input type="text" name="fpm" id="fpm"  class="form-control" >
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Food Status
<div class="col-sm-8">
<input type="radio" value="0" name="foodstatus" checked="checked"> Without Food
<input type="radio" value="1" name="foodstatus"> With Food(Rs 2000.00 Per Month Extra)</label>
</div>
</div>	


<div class="form-group">
<label class="col-sm-2 control-label">Stay From
<div class="col-sm-8">
<input type="date" name="stayf" id="stayf"  class="form-control" ></label>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Duration</label>
<div class="col-sm-8">
<select name="duration" id="duration" class="form-control">
<option value="" selected>  In Month </option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>
</div>
</div>



<div class="form-group">
<label class="col-sm-2 control-label"><h4 style="color: green" >Personal info </h4> </label>
</div>



<?php	
$aid=$_SESSION['id'];
	$ret="select * from userregistration where id=?";
		$stmt= $mysqli->prepare($ret) ;
	 $stmt->bind_param('i',$aid);
	 $stmt->execute() ;//ok
	 $res=$stmt->get_result();
	 $cnt=1;
	   while($row=$res->fetch_object())
	  {
	  	?>

<!-- <div class="form-group">
<label class="col-sm-2 control-label">Registration No : 
<div class="col-sm-8">
<input type="text" name="regno" id="regno"  class="form-control" value="<?php echo $row->regNo;?>" readonly ></label>
</div> -->
</div>


<div class="form-group">
<label class="col-sm-2 control-label">First Name : 
<div class="col-sm-8">
<input type="text" name="fname" id="fname"  class="form-control" value="<?php echo $row->firstName;?>" readonly></label>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Middle Name : 
<div class="col-sm-8">
<input type="text" name="mname" id="mname"  class="form-control" value="<?php echo $row->middleName;?>"  readonly></label>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Last Name :
<div class="col-sm-8">
<input type="text" name="lname" id="lname"  class="form-control" value="<?php echo $row->lastName;?>" readonly> </label>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Gender : 
<div class="col-sm-8">
<input type="text" name="gender" value="<?php echo $row->gender;?>" class="form-control" readonly></label>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Contact No : 
<div class="col-sm-8">
<input type="text" name="contact" id="contact" value="<?php echo $row->contactNo;?>"  class="form-control" readonly></label>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Email id : 
<div class="col-sm-8">
<input type="email" name="email" id="email"  class="form-control" value="<?php echo $row->email;?>"  readonly></label>
</div>
</div>
<?php } ?>
<!-- <div class="form-group">
<label class="col-sm-2 control-label">Emergency Contact: 
<div class="col-sm-8">
<input type="text" name="econtact" id="econtact"  class="form-control" required="required" value="<?php if(isset($emcntno)) echo $emcntno; ?>"></label>
<?php if(isset($errors['econtact'])) echo "<span style='color: red;'>".$errors['econtact']."</span>"; ?>
</div> -->
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Guardian  Name : 
<div class="col-sm-8">
<input type="text" name="gname" id="gname"  class="form-control" required="required" value="<?php if(isset($gurname)) echo $gurname; ?>"></label>
<?php if(isset($errors['gname'])) echo "<span style='color: red;'>".$errors['gname']."</span>"; ?>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Guardian  Relation : 
<div class="col-sm-8">
<input type="text" name="grelation" id="grelation"  class="form-control" required="required" value="<?php if(isset($gurrelation)) echo $gurrelation; ?>"></label>
<?php if(isset($errors['grelation'])) echo "<span style='color: red;'>".$errors['grelation']."</span>"; ?>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Guardian Contact no : 
<div class="col-sm-8">
<input type="text" name="gcontact" id="gcontact"  class="form-control" required="required"value="<?php if(isset($gurcntno)) echo $gurcntno; ?>" ></label>
<?php if(isset($errors['gcontact'])) echo "<span style='color: red;'>".$errors['gcontact']."</span>"; ?>
</div>
</div>	

<div class="form-group">
<label class="col-sm-3 control-label"><h4 style="color: green" align="left"> Address </h4> </label>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Address : 
<div class="col-sm-8">
<textarea  rows="5" name="address"  id="address" class="form-control" required="required" value="<?php if(isset($address)) echo $address; ?>"></textarea></label>
<?php if(isset($errors['address'])) echo "<span style='color: red;'>".$errors['address']."</span>"; ?>
</div>
</div>



	

<!-- <div class="form-group">
<label class="col-sm-3 control-label"><h4 style="color: green" align="left"> Address </h4> </label>
</div>


<div class="form-group">
<label class="col-sm-5 control-label">Permanent Address same as Correspondense address :
<div class="col-sm-4">
<input type="checkbox" name="adcheck" value="1"/> </label>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Address : 
<div class="col-sm-8">

</div> -->
</div>


					


</div>	


<div class="col-sm-6 col-sm-offset-4"><br>
<input type="submit" name="submit" Value="Book Hostel" class="btn btn-primary" style="background-color:yellow">
</div>
<div class="col-sm-6 col-sm-offset-4"><br>
<button class="btn btn-default" type="reset" style="background-color:red">Reset</button>
</div>
</form>

<div style="text-align: left; color: #3498db; padding: 20px; margin-top: 20px;">
        <a href="cancelbook.php" style="text-decoration: none; font-size: 18px; font-weight: bold; border: 2px solid #fff; padding: 10px 20px; border-radius: 5px; transition: background-color 0.3s;">Cancel Book</a>
    </div>

									</div><br><br>
									<div style="text-align: left; font-size: 12px; color: #ff5733; background-color: #f1f1f1; padding: 12px; border-radius: 8px;">
    <a href="dashboard.php" style="text-decoration: none; color: #fff; background-color: #4CAF50; padding: 8px 16px; border-radius: 5px; font-weight: bold;">  Go to Dashboard</a>
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
	</div>
	

	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	
</body>

	<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'roomno='+$("#room").val(),
type: "POST",
success:function(data){
$("#room-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>


<script type="text/javascript">

$(document).ready(function() {
	$('#duration').keyup(function(){
		var fetch_dbid = $(this).val();
		$.ajax({
		type:'POST',
		url :"ins-amt.php?action=id",
		data :{userinfo:fetch_dbid},
		success:function(data){
	    $('.result').val(data);
		}
		});
		

})});
</script>

</html>