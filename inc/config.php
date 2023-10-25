
<?php

// Database configuration 
$dbHost     = "sql980.main-hosting.eu";
$dbUsername = "u894825870_gameadmin";
$dbPassword = "@?E6KRScm(WFX%gz";
$dbName     = "u894825870_real_engine";


// Create database connection 
$con = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection 
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$con->set_charset("utf8");

?>