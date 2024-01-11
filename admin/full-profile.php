<?php
session_start();
include("includes/config.php");
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysqli_database = "hostel";
$prefix = "";
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysqli_database) or die("Could not connect to the database");
?>
<script language="javascript" type="text/javascript">
function f2() {
    window.close();
}
function f3() {
    window.print();
}
</script>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Student Information</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="hostel.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="1">
    <?php 
    $ret = mysqli_query($bd, "SELECT * FROM hostelbook WHERE id = '".$_GET['id']."'");
    while ($row = mysqli_fetch_array($ret)) {
        ?>
        <tr>
            <td colspan="2" class="font1">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2"  class="font1">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="2" class="font"><?php echo ucfirst($row['firstName']);?> <?php echo ucfirst($row['lastName']);?>'S <span class="font1"> information &raquo;</span> </td>
        </tr>
        <!-- <tr>
            <td colspan="2" class="font">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div align="right">Reg Date : <span class="comb-value"><?php echo $row['postingDate'];?></span></div></td>
        </tr> -->
        <tr>
            <td colspan="2" class="heading" style="color: red;">Room Related Info &raquo; </td>
        </tr>
        <tr>
            <td colspan="2" class="font1">
                <table width="100%" border="0">
                    <tr>
                        <td width="32%" valign="top" class="heading">Room no : </td>

                        <td class="comb-value1"><span class="comb-value"><?php echo $row['roomno'];?></span></td>
                    </tr>
                    <!-- <tr>
                        <td width="22%" valign="top" class="heading">Seater : </td>

                        <td class="comb-value1"><span class="comb-value</span></td>
                    </tr> -->

                    <tr>
                        <td width="12%" valign="top" class="heading">Fees PM : </td>
                        <td class="comb-value1"><?php echo $fpm=$row['feespm'];?></td>
                    </tr>
                    <tr>
                        <td width="12%" valign="top" class="heading">Food Status: </td>
                        <td class="comb-value1"><?php echo $row['foodstatus'] == 0 ? "Without Food" : "With Food";?></td>
                    </tr>
                     <tr>
                        <td width="12%" valign="top" class="heading">Staying From: </td>
                        <td class="comb-value1"><?php echo $row['stayfrom'];?></td>
                    </tr> 
                    <tr>
                        <td width="12%" valign="top" class="heading">Duration: </td>
                        <td class="comb-value1"><?php echo $dr=$row['duration'];?></td>
                    </tr>
                    <tr>
                        <td width="12%" valign="top" class="heading">Total Fee: </td>
                        <td class="comb-value1">
                            <?php 
                            if ($row['foodstatus'] == 1) { 
                                $fd = 2000; 
                                echo (($dr * $fpm) + $fd);
                            } else {
                                echo $dr * $fpm;
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" class="heading" style="color: red;">Personal Info &raquo; </td>
                    </tr>

                    <!-- <tr>
                        <td width="12%" valign="top" class="heading">Course: </td>
                        <td class="co
                    </tr> -->

                    <!-- <tr>
                        <td width="12%" valign="top" class="heading">Reg no: </td>
                        <td class="comb-value1"><?php echo $row['regno'];?></td>
                    </tr> -->

                    <tr>
                        <td width="12%" valign="top" class="heading">First Name: </td>
                        <td class="comb-value1"><?php echo $row['firstName'];?></td>
                    </tr>

                    <tr>
                        <td width="12%" valign="top" class="heading">Middle name: </td>
                        <td class="comb-value1"><?php echo $row['middleName'];?></td>
                    </tr>

                    <tr>
    <td width="12%" valign="top" class="heading">LastName: </td>
    <td class="comb-value1"><?php echo (empty($row['lastName']) || $row['lastName'] === '0') ? "Not Available" : $row['lastName']; ?></td>
</tr>

                    <tr>
                        <td width="12%" valign="top" class="heading">Gender: </td>
                        <td class="comb-value1"><?php echo $row['gender'];?></td>
                    </tr>

                    <tr>
                        <td width="12%" valign="top" class="heading">Contact No: </td>
                        <td class="comb-value1"><?php echo $row['contactno'];?></td>
                    </tr>

                    <tr>
                        <td width="12%" valign="top" class="heading">Email id: </td>
                        <td class="comb-value1"><?php echo $row['emailid'];?></td>
                    </tr>
<!-- 
                    <tr>
                        <td width="12%" valign="top" class="heading">Emergency Contact: </td>
                        <td class="comb-value1"><?php echo $row['egycontactno'];?></td>
                    </tr> -->
                    <tr>
    <td width="12%" valign="top" class="heading">Guardian Name: </td>
    <td class="comb-value1"><?php echo empty($row['guardianName']) ? "Not Available" : $row['guardianName']; ?></td>
</tr>

<tr>
    <td width="12%" valign="top" class="heading">Guardian Relation: </td>
    <td class="comb-value1"><?php echo empty($row['guardianRelation']) ? "Not Available" : $row['guardianRelation']; ?></td>
</tr>


<tr>
    <td width="12%" valign="top" class="heading">Guardian Contact: </td>
    <td class="comb-value1"><?php echo empty($row['guardianContactno']) ? "Not Available" : $row['guardianContactno']; ?></td>
</tr>
                    <tr>
                        <td colspan="2" class="heading" style="color: red;"> Address &raquo; </td>
                    </tr>

                    <tr>
                        <td width="12%" valign="top" class="heading">Address: </td>
                        <td class="comb-value1"><?php echo $row['address'];?></td>
                    </tr>

      

                    <!-- <tr>
                        <td width="12%" valign="top" class="heading">State: </td>
                        <td class="c
                    </tr> -->

                   

                    <!-- <tr>
                        <td colspan="2" class="heading" style="color: red;">Permanent Address &raquo; </td>
                    </tr>

                    <tr>
                        <td width="12%" valign="top" class="heading">Address: </td>
                        <td class="comb-value1"><?php echo $row['pmntAddress'];?></td>
                    </tr> -->

                
                   

                   

                   
        <?php } ?>
    </table>
</body>
</html>
