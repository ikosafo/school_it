<?php

include("../dbcon.php");

@session_start();


$name=mysqli_real_escape_string($mysqli,$_POST['name']);
$motto=mysqli_real_escape_string($mysqli,$_POST['motto']);
$country=mysqli_real_escape_string($mysqli,$_POST['country']);
$city=mysqli_real_escape_string($mysqli,$_POST['city']);
$state=mysqli_real_escape_string($mysqli,$_POST['state']);
$mobile=mysqli_real_escape_string($mysqli,$_POST['mobile']);
$altmobile=mysqli_real_escape_string($mysqli,$_POST['alt_mobile']);
$telephone=mysqli_real_escape_string($mysqli,$_POST['telephone']);
$email=mysqli_real_escape_string($mysqli,$_POST['email']);
$inst_id=mysqli_real_escape_string($mysqli,$_POST['inst_id']);
$address=mysqli_real_escape_string($mysqli,$_POST['address']);




$res=$mysqli->query("select * from institution LIMIT 1");
$get_id = $res->fetch_assoc();
$id = $get_id['id'];

$rowcount = mysqli_num_rows($res);


if ($rowcount == "0"){



    $mysqli->query("INSERT INTO `institution`
            (`name`,
             `motto`,
             `city`,
             `state`,
             `mobile`,
             `altmobile`,
             `telephone`,
             `email`,
             `country`,
             `address`,
             `school_id`)
VALUES ('$name',
        '$motto',
        '$city',
        '$state',
        '$mobile',
        '$altmobile',
        '$telephone',
        '$email',
        '$country',
        '$address',
        '$inst_id'
        )")

    or die(mysqli_error($mysqli));





}

else {

    $insert = $mysqli->query("UPDATE `institution`
SET
  `name` = '$name',
  `motto` = '$motto',
  `city` = '$city',
  `state` = '$state',
  `mobile` = '$mobile',
  `altmobile` = '$altmobile',
  `telephone` = '$telephone',
  `email` = '$email',
  `country` = '$country'

WHERE `id` = '$id'") or die (mysql_error());


}



?>




