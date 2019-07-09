<?php

include("../dbcon.php");

//session_start();



$username=mysqli_real_escape_string($mysqli,$_POST['username']);
$password=mysqli_real_escape_string($mysqli,$_POST['password']);
$pass= md5($password);

$res=$mysqli->query("select * from users where `username` = '$username' and `password` = '$pass'");
$getdetails = $res->fetch_assoc();
$rowcount = mysqli_num_rows($res);


$usernamed = $getdetails['username'];
$passwordd = $getdetails['password'];
$name = $getdetails['name'];
$user_type  = $getdetails['admin_type'];
$branch  = $getdetails['branch'];


$_SESSION['username'] = $username;
$_SESSION['name'] = $name;
$_SESSION['user_type'] = $user_type;
$_SESSION['branch'] = $branch;


if ($rowcount == "0"){

    echo 2;

}

else {


    echo 1;

}










?>