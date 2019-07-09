<?php

include('../../config.php');


$institution_name = mysqli_real_escape_string($mysqli, $_POST['institution_name']);
$institution_address = mysqli_real_escape_string($mysqli, $_POST['institution_address']);
$institution_location = mysqli_real_escape_string($mysqli, $_POST['institution_location']);
$institution_telephone = mysqli_real_escape_string($mysqli, $_POST['institution_telephone']);
$institution_email = mysqli_real_escape_string($mysqli, $_POST['institution_email']);
$institution_motto = mysqli_real_escape_string($mysqli, $_POST['institution_motto']);
$random_id = mysqli_real_escape_string($mysqli, $_POST['random_id']);


$datetime = date("Y-m-d H:i:s");

$chk = $mysqli->query("select * from institution_details where randomid = '$random_id'");

$count = mysqli_num_rows($chk);

if ($count == "0"){


    $mysqli->query("INSERT INTO `institution_details`
            (`name`,
             `address`,
             `location`,
             `telephone`,
             `email_address`,
             `randomid`,
             `motto`)
VALUES ('$institution_name',
        '$institution_address',
        '$institution_location',
        '$institution_telephone',
        '$institution_email',
        '$random_id',
        '$institution_motto')") or die(mysqli_error($mysqli));

    echo 1;



}

else {


    $mysqli->query(" UPDATE `institution_details`
SET 
  `name` = '$institution_name',
  `address` = '$institution_address',
  `location` = '$institution_location',
  `telephone` = '$institution_telephone',
  `email_address` = '$institution_email',
  `motto` = '$institution_motto'
  
WHERE `randomid` = '$random_id'") or die(mysqli_error($mysqli));

}







?>