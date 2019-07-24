<?php

include('../../config.php');


$academic_year = mysqli_real_escape_string($mysqli, $_POST['academic_year']);
$academic_term = mysqli_real_escape_string($mysqli, $_POST['academic_term']);
$department = mysqli_real_escape_string($mysqli, $_POST['department']);
$schoolfees = mysqli_real_escape_string($mysqli, $_POST['schoolfees']);
$attendance = mysqli_real_escape_string($mysqli, $_POST['attendance']);
$fid = mysqli_real_escape_string($mysqli, $_POST['fid']);


$chk = $mysqli->query("select * from fees_attendance where academicyear = '$academic_year' AND 
                            term = '$academic_term'");

$getid = $mysqli->query("select * from department where department_name = '$department'");
$resid = $getid->fetch_assoc();
$deptid = $resid['id'];


$mysqli->query("UPDATE fees_attendance 

SET department = '$deptid',
    schoolfees = '$schoolfees',
    attendance = '$attendance'
    
    Where id = '$fid'
") or die(mysqli_error($mysqli));

echo 1;

?>