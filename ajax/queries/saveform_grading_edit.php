<?php

include('../../config.php');

$department = mysqli_real_escape_string($mysqli, $_POST['department']);
$markfrom = mysqli_real_escape_string($mysqli, $_POST['markfrom']);
$markto = mysqli_real_escape_string($mysqli, $_POST['markto']);
$remark = mysqli_real_escape_string($mysqli, $_POST['remark']);
$displaygrade = mysqli_real_escape_string($mysqli, $_POST['displaygrade']);
$computinggrade = mysqli_real_escape_string($mysqli, $_POST['computinggrade']);
$gradeid = mysqli_real_escape_string($mysqli, $_POST['gradeid']);


$getid = $mysqli->query("select * from department where department_name = '$department'");
$resid = $getid->fetch_assoc();
$deptid = $resid['id'];



$chk = $mysqli->query("select * from grading where department = '$deptid' and (

(markfrom <= $markfrom and markto >= $markto) or

(markfrom <= $markfrom and markto >= $markfrom)

)");

$count = mysqli_num_rows($chk);


if ($count == "0") {


    $mysqli->query("UPDATE `grading`
SET 
  `department` = '$deptid',
  `markfrom` = '$markfrom',
  `markto` = '$markto',
  `remark` = '$remark',
  `grade` = '$computinggrade',
  `displaygrade` = '$displaygrade'
  
WHERE `id` = '$gradeid'") or die(mysqli_error($mysqli));

    echo 1;

}

else {

    echo 2;

}
?>