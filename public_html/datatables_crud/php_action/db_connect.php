<?php

$servername = "localhost";
$username = "root";
$password = "r007";
$dbname = "secure_login";


//create connection

$connect=new mysqli($servername, $username, $password, $dbname);

//check connection

if($connect->connect_error){
    die("Connection Failed: ".$connect->connect_error);
}else{
    echo"Successfully Connected";
}