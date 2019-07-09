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

$total = $tuition_fee + $ict + $others + $arrears;



    $mysqli->query("INSERT INTO `bill_conduct`
            (`promoted_to`,
             `attendance_from`,
             `attendance_to`,
             `conduct`,
             `attitude`,
             `interest`,
             `class_teachers_remark`,
             `head_teachers_remark`,
             `academic_year`,
             `term`,
             `student_id`,
             `arrears`,
             `tution_fee`,
             `total`,
             `ict`,
             `others`)
VALUES ('$promoted_to',
        '$attendance',
        '$attendance_total',
        '$conduct',
        '$attitude',
        '$interest',
        '$teacher_remark',
        '$head_teacher_remark',
        '$academic_year',
        '$term',
        '$student_id',
        '$arrears',
        '$tuition_fee',
        '$total',
        '$ict',
        '$others')")
    or die(mysqli_error($mysqli));

    echo 1;






?>