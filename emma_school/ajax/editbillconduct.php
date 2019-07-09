<?php

include("../dbcon.php");


$promoted_to=mysqli_real_escape_string($mysqli,$_POST['promoted_to']);
$attendance=mysqli_real_escape_string($mysqli,$_POST['attendance']);
$attendance_total=mysqli_real_escape_string($mysqli,$_POST['attendance_total']);
$conduct=mysqli_real_escape_string($mysqli,$_POST['conduct']);
$attitude=mysqli_real_escape_string($mysqli,$_POST['attitude']);
$interest=mysqli_real_escape_string($mysqli,$_POST['interest']);
$teacher_remark=mysqli_real_escape_string($mysqli,$_POST['teacher_remark']);
$head_teacher_remark=mysqli_real_escape_string($mysqli,$_POST['head_teacher_remark']);
$arrears=mysqli_real_escape_string($mysqli,$_POST['arrears']);
$tuition_fee=mysqli_real_escape_string($mysqli,$_POST['tuition_fee']);
$ict=mysqli_real_escape_string($mysqli,$_POST['ict']);
$others=mysqli_real_escape_string($mysqli,$_POST['others']);
$student_id=mysqli_real_escape_string($mysqli,$_POST['student_id']);
$academic_year=mysqli_real_escape_string($mysqli,$_POST['academic_year']);
$term=mysqli_real_escape_string($mysqli,$_POST['term']);
$table_id=mysqli_real_escape_string($mysqli,$_POST['table_id']);

$total = $tuition_fee + $ict + $others + $arrears;


$get = $mysqli->query("select * from bill_conduct where student_id = '$student_id' and academic_year = '$academic_year' and term = '$term'");
$count = mysqli_num_rows($get);

if ($count == "1"){


    $mysqli->query("UPDATE `bill_conduct`
SET
  `promoted_to` = '$promoted_to',
  `attendance_from` = '$attendance',
  `attendance_to` = '$attendance_total',
  `conduct` = '$conduct',
  `attitude` = '$attitude',
  `interest` = '$interest',
  `class_teachers_remark` = '$teacher_remark',
  `head_teachers_remark` = '$head_teacher_remark',
  `arrears` = '$arrears',
  `tution_fee` = '$tuition_fee',
  `total` = '$total',
  `ict` = '$ict',
  `others` = '$others'

WHERE `id` = '$table_id'")
    or die(mysqli_error($mysqli));

    echo 1;




}




?>