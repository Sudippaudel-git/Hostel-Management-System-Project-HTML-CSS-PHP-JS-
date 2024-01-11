<?php
 session_start();
include('includes/config.php');
$errors = array(); // Initialize an empty array to store validation errors

if(isset($_POST['submit'])) {
    // Retrieve form data
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $contactno = $_POST['contact'];
    $emailid = $_POST['email'];
    $password = $_POST['password'];

    // Validate form data
   

    if (empty($fname)) {
        $errors['fname'] = "First Name is required";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $fname)) {
        $errors['fname'] = "First Name can only contain letters and spaces";
    }

    if (!empty($mname) && !preg_match('/^[a-zA-Z\s]+$/', $mname)) {
        $errors['mname'] = "Middle Name can only contain letters and spaces";
    }

    if (empty($lname)) {
        $errors['lname'] = "Last Name is required";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $lname)) {
        $errors['lname'] = "Last Name can only contain letters and spaces";
    }

    // if (empty($gender)) {
    //     $errors['gender'] = "Gender is required";
    // }

    if (empty($contactno)) {
        $errors['contact'] = "Contact No is required";
    } elseif (!is_numeric($contactno) || strlen($contactno) !== 10) {
        $errors['contact'] = "Contact No must be a 10-digit number";
    }

    if (empty($emailid)) {
        $errors['email'] = "Email is required";
    } elseif (!preg_match('/^[a-zA-Z][a-zA-Z0-9._-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/i', $emailid)) {
        $errors['email'] = "Invalid email format";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    }

    // If there are no validation errors, proceed with registration
    if (empty($errors)) {
        $query = "INSERT INTO userregistration ( firstName, middleName, lastName, gender, contactNo, email, password)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli->prepare($query);
        if ($stmt === false) {
            trigger_error('Error: ' . $mysqli->error, E_USER_ERROR);
        }
        

        $stmt->bind_param('ssssiss',  $fname, $mname, $lname, $gender, $contactno, $emailid, $password);
       
        if ($stmt->execute()) {
            $insertedUserId = $stmt->insert_id; // Get the ID of the inserted user

            // Insert data into userlog table
            $logQuery = "INSERT INTO userlog (userId, userEmail,Password)
                         VALUES (?, ?,?)";
            $logStmt = $mysqli->prepare($logQuery);
            if ($logStmt === false) {
                trigger_error('Error: ' . $mysqli->error, E_USER_ERROR);
            }
            $logStmt->bind_param('sss', $insertedUserId, $emailid,$password);
            $logStmt->execute();
            $logStmt->close();

            echo "<script>alert('User Successfully registered');</script>";
        } else {
            echo "<script>alert('Error registering User');</script>";
        }

        $stmt->close();
        $mysqli->close();
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
    <title>User Registration</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript">
function valid()
{
    if(document.registration.password.value != document.registration.cpassword.value)
    {
        alert("Password and Re-Type Password Field do not match!");
        document.registration.cpassword.focus();
        return false;
    }
    return true;
}
</script>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            color: #333;
        }

        h1 {
            text-align: left;
            font-size: 36px;
            color: #3399cc;
            margin-top: 30px;
        }

        div.container {
            max-width: 40px;
            margin: 0 auto;
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        }
        form label {
            display: block;
            font-size: 18px;
            margin-top: 10px;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            width: 50%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            ;
        }

        form select {
            width: 50%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 20px;
        }

        form button {
            margin-top: 20px;
            background-color: #ff4444;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        form input[type="submit"] {
            background-color: #f9c30b;
            margin-left: 10px;
        }

        form button, form input[type="submit"] {
            font-size: 18px;
        }

        div.text-center {
            text-align: center;
            margin-top: 25px;
            font-size: 22px;
        }

        div.text-center a {
            text-decoration: none;
            color: #555;
            background-color: #e6e6e6;
            padding: 8px 25px;
            border-radius: 5px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
    </style>
</head>
<body >
   
    
                
                   
                        <h2  style="font-size:xx-large; color:blueviolet;text-align:left"> Registration Form</h2>
                        <div class="row">
                            <div >
                            <form method="post" action="" name="registration" class="form-horizontal" onSubmit="return valid();">
            <!-- <div>
                <label for="regno">Registration No:</label>
                <div>
                    <input type="text" name="regno" id="regno" class="form-control" required="required" value="<?php if(isset($regno)) echo $regno; ?>">
                    <?php if(isset($errors['regno'])) echo "<span style='color: red;'>".$errors['regno']."</span>"; ?> 
                </div> -->
            </div>
            <div>
                <label for="fname">First Name:</label>
                <div>
                    <input type="text" name="fname" id="fname" class="form-control" required="required" value="<?php if(isset($fname)) echo $fname; ?>">
                    <?php if(isset($errors['fname'])) echo "<span style='color: red;'>".$errors['fname']."</span>"; ?>
                </div><br>
            </div>
            <div>
                <label for="mname">Middle Name:</label>
                <div>
                    <input type="text" name="mname" id="mname" class="form-control" value="<?php if(isset($mname)) echo $mname; ?>">
                    <?php if(isset($errors['mname'])) echo "<span style='color: red;'>".$errors['mname']."</span>"; ?>
                </div>
            </div><br>
            <div>
                <label for="lname">Last Name:</label>
                <div>
                    <input type="text" name="lname" id="lname" class="form-control" required="required" value="<?php if(isset($lname)) echo $lname; ?>">
                    <?php if(isset($errors['lname'])) echo "<span style='color: red;'>".$errors['lname']."</span>"; ?>
                </div>
            </div><br>
            <div>
                <label for="gender">Gender:</label>
                <div>
                    <select name="gender" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option value="male" <?php if(isset($gender) && $gender === "male") echo "selected"; ?>>Male</option>
                        <option value="female" <?php if(isset($gender) && $gender === "female") echo "selected"; ?>>Female</option>
                        <option value="others" <?php if(isset($gender) && $gender === "others") echo "selected"; ?>>Others</option>
                    </select>
                    <?php if(isset($errors['gender'])) echo "<span style='color: red;'>".$errors['gender']."</span>"; ?>
                </div>
            </div>
            <div><br>
                <label for="contact">Contact No:</label>
                <div>
                    <input type="text" name="contact" id="contact" class="form-control" required="required" value="<?php if(isset($contactno)) echo $contactno; ?>">
                    <?php if(isset($errors['contact'])) echo "<span style='color: red;'>".$errors['contact']."</span>"; ?>
                </div>
            </div><br>
            <div>
                <label for="email">Email id:</label>
                <div>
                    <input type="email" name="email" id="email" class="form-control" onBlur="checkAvailability()" required="required" value="<?php if(isset($emailid)) echo $emailid; ?>">
                    <span id="user-availability-status" style="font-size: 12px;"></span>
                    <?php if(isset($errors['email'])) echo "<span style='color: red;'>".$errors['email']."</span>"; ?>
                </div>
            </div><br>
            <div>
                <label for="password">Password:</label>
                <div>
                    <input type="password" name="password" id="password" class="form-control" required="required">
                    <?php if(isset($errors['password'])) echo "<span style='color: red;'>".$errors['password']."</span>"; ?>
                </div>
            </div><br>
            <div>
                <label for="cpassword">Confirm Password:</label>
                <div>
                    <input type="password" name="cpassword" id="cpassword" class="form-control" required="required">
                </div>
            </div><br>
            <div>
                <button type="submit" style="background-color:#ff4444">Cancel</button>
                <input type="submit" name="submit" value="Register" style="background-color:#f9c30b">
            </div><br>
        </form>
        <div class="text-center" style="text-align: left;" >
            Already a member? <a href="login.php" style="background-color:aquamarine">Login here</a>
        </div>
                            </div>
                        </div>
                    
    </div>
    <div style="text-align: center; font-size: 22px; color: #ff5733; background-color: #f1f1f1; padding: 21px; border-radius: 10px;">
    <a href="dashboard.php" style="text-decoration: none; color: #fff; background-color:seagreen; padding: 10px 20px; border-radius: 5px; font-weight: bold; ">  Go to Dashboard</a>
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
        data: 'emailid='+$("#email").val(),
        type: "POST",
        success: function(data) {
            $("#user-availability-status").html(data);
            $("#loaderIcon").hide();
        },
        error: function() {
            event.preventDefault();
            alert('error');
        }
    });
}
</script>
</html>
