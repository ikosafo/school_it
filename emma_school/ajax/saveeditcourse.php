<?php

include('../dbcon.php');


@session_start();

$course_name=mysqli_real_escape_string($mysqli,$_POST['course_name']);
$course_code=mysqli_real_escape_string($mysqli,$_POST['course_code']);
$course_type=mysqli_real_escape_string($mysqli,$_POST['course_type']);
$course_id=mysqli_real_escape_string($mysqli,$_POST['course_id']);



$mysqli->query("UPDATE `course_class`
SET `course` = '$course_name',
  `type` = '$course_type',
  `code` = '$course_code'

WHERE `id` = '$course_id'")

or die(mysqli_error($mysqli));


echo 1;





?>