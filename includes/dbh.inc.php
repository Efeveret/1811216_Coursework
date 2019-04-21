<?php


$dbServername = "CSDM-WEBDEV";
$dbUsername = "1811216";
$dbPassword = "1811216";
$dbName = "db1811216_cmm007";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
/*
if (!$conn){
    die("Connection Failed: ". mysqli_connect_error()."<br>"."Connection Failed:". mysqli_connect_errno());
}else{
    echo "Connected";
}
*/