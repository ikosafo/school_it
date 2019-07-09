<?php

include("../dbcon.php");

//session_start();



$username=mysqli_real_escape_string($mysqli,$_POST['username']);
$password=mysqli_real_escape_string($mysqli,$_POST['password']);
$pass= md5($password);

$res=$mysqli->query("SELECT * FROM user_main WHERE `pass` = '$pass' AND `username` = '$username'");
$getdetails = $res->fetch_assoc();
$rowcount = mysqli_num_rows($res);

$passd = $getdetails['pass'];
$username = $getdetails['username'];

$_SESSION['password'] = $passd;
$_SESSION['username'] = $username;

if ($rowcount == "0"){

    echo 2;

}

else {


    echo 1;

}










?>