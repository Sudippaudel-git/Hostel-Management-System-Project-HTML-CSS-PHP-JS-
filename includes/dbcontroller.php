<?php
$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "hostel";

$DB_con = mysqli_connect($DB_host, $DB_user, $DB_pass, $DB_name);
if (!$DB_con) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

?>