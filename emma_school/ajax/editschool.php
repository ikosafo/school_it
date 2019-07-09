<?php

include("../dbcon.php");


$q = $mysqli->query("select * from institution LIMIT 1");
$get = $q->fetch_assoc();
$id = $get['id'];




$name=mysqli_real_escape_string($mysqli,$_POST['name']);
$motto=mysqli_real_escape_string($mysqli,$_POST['motto']);
$logo=mysqli_real_escape_string($mysqli,$_POST['logo']);
$country=mysqli_real_escape_string($mysqli,$_POST['country']);
$city=mysqli_real_escape_string($mysqli,$_POST['city']);
$state=mysqli_real_escape_string($mysqli,$_POST['state']);
$mobile=mysqli_real_escape_string($mysqli,$_POST['mobile']);
$altmobile=mysqli_real_escape_string($mysqli,$_POST['alt_mobile']);
$telephone=mysqli_real_escape_string($mysqli,$_POST['telephone']);
$email=mysqli_real_escape_string($mysqli,$_POST['email']);
$inst_id=mysqli_real_escape_string($mysqli,$_POST['inst_id']);
$address=mysqli_real_escape_string($mysqli,$_POST['address']);



$mysqli->query("UPDATE `institution`
SET `name` = '$name',
  `motto` = '$motto',
  `logo` = '$logo',
  `city` = '$city',
  `state` = '$state',
  `mobile` = '$mobile',
  `altmobile` = '$altmobile',
  `telephone` = '$telephone',
  `email` = '$email',
  `country` = '$country',
  `address` = '$address'

WHERE `id` = '$id'")
or die(mysqli_error($mysqli));

echo 1;









?>