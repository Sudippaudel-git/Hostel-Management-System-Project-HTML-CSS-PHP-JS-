<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
checklogin();

if(isset($_GET['del']))
{
	$id=intval($_GET['del']);
	$adn="delete from hostelbook where id=?";
		$stmt= $mysqli->prepare($adn);
		$stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	   
        echo "<script>alert('Data Deleted');</script>" ;
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
	<title>Manage Rooms</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style.css">
<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+510+',height='+430+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
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
					<div class="col-md-12">
						<h2 class="page-title">Manage Rooms</h2>
						<div class="panel panel-default">
							<div class="panel-heading">All Room Details</div>
							<div class="panel-body">
								<table id="zctb" cellspacing="0" width="100%" border="1">
									<thead>
										<tr>
											<th>Sno.</th>
											<th>User Name</th>
										
											<th>Contact no </th>
											<th>room no  </th>
											
											 <th>Staying From </th>
											<th>Action</th>
										</tr>
									</thead>
									
									<tbody>
<?php	
$aid=$_SESSION['id'];
$ret="select * from hostelbook";
$stmt= $mysqli->prepare($ret) ;
// $stmt->bind_param('i',$aid);
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
	  {
 $fullName = $row->firstName . " " . $row->middleName . " " . $row->lastName;
    $fullName = trim($fullName); // Trim leading/trailing whitespaces

    // If any of the name parts are empty or contain "0", display a message
    if (empty($fullName) || $fullName === "0") {
        $fullName = "Name not available";
	}
	  	?>
<tr><td><?php echo $cnt;;?></td>
  <td><?php echo $fullName; ?></td>

<td><?php echo $row->contactno;?></td>
<td><?php echo $row->roomno;?></td>

 <td><?php echo $row->stayfrom;?></td> 
<td>
<a href="javascript:void(0);"  onClick="popUpWindow('http://localhost/hostel/admin/full-profile.php?id=<?php echo $row->id;?>');" title="View Full Details"><i > &#128065;</i></a>&nbsp;&nbsp;
<a href="manage-students.php?del=<?php echo $row->id;?>" title="Delete Record" onclick="return confirm("Do you want to delete");><i >&#10008;</i></a></td>
										</tr>
									<?php
$cnt=$cnt+1;
									 } ?>
											
										
									</tbody>
								</table>

								
							</div>
						</div>

					
					</div>
				</div><br><br><br><br><br>
				<div style="text-align: center; font-size: 22px; color: #ff5733; background-color: #f1f1f1; padding: 21px; border-radius: 10px;">
    <a href="dashboard.php" style="text-decoration: none; color: #fff; background-color:seagreen; padding: 10px 20px; border-radius: 5px; font-weight: bold; ">  Go to Dashboard</a>
</div>
			

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
