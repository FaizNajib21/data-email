<?php
$databaseHost = 'localhost';
$databaseName = 'crud';
$databaseUsername = 'username';
$databasePassword = 'pw';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>