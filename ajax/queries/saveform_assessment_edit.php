<?php

include('../../config.php');

$department = mysqli_real_escape_string($mysqli, $_POST['department']);
$classmark = mysqli_real_escape_string($mysqli, $_POST['classmark']);
$exammark = mysqli_real_escape_string($mysqli, $_POST['exammark']);
$assid = mysqli_real_escape_string($mysqli, $_POST['assid']);


$chk = $mysqli->query("select * from assessment_config where department = '$department'");
$count = mysqli_num_rows($chk);

$getid = $mysqli->query("select * from department where department_name = '$department'");
$resid = $getid->fetch_assoc();
$deptid = $resid['id'];



if ($count == "0") {


    $mysqli->query("UPDATE `assessment_config`
SET 
  `classmark` = '$classmark',
  `exammark` = '$exammark',
  `department` = '$deptid'
  
WHERE `id` = '$assid'") or die(mysqli_error($mysqli));

    echo 1;

}

else {

    echo 2;

}
?>