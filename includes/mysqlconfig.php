<?php

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "hostel";

$DB_con = new mysqli($DB_host, $DB_user, $DB_pass, $DB_name);
if ($DB_con->connect_errno) {
    die("Failed to connect to MySQL: " . $DB_con->connect_error);
}
?>