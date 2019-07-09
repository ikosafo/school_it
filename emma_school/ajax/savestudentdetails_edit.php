<?php

include("../dbcon.php");

@session_start();


$surname = mysqli_real_escape_string($mysqli,$_POST["surname"]);
$firstname = mysqli_real_escape_string($mysqli,$_POST["firstname"]);
$othername = mysqli_real_escape_string($mysqli,$_POST["othername"]);
$gender = mysqli_real_escape_string($mysqli,$_POST["gender"]);
$house = mysqli_real_escape_string($mysqli,$_POST["house"]);
$student_class = mysqli_real_escape_string($mysqli,$_POST["student_class"]);
$student_id = mysqli_real_escape_string($mysqli,$_POST["student_id"]);
$stud_id = mysqli_real_escape_string($mysqli,$_POST["stud_id"]);

$full_name = $surname.' '.$firstname.' '.$othername;


$date = date("Y-m-d H:i:s");



$mysqli->query("UPDATE `student`

SET `firstname` = '$firstname',
  `lastname` = '$surname',
  `othername` = '$othername',
  `gender` = '$gender',
  `house` = '$house',
  `class` = '$student_class',
  `stud_id` = '$stud_id'

WHERE `student_id` = '$student_id'")
or die(mysqli_error($mysqli));

echo 1;



foreach ($_POST['course_class'] as $course_class)
{

    $r = $mysqli->query("select * from course where student_id = '$student_id' and course = '$course_class'");
    $result = mysqli_num_rows($r);

    if ($result == "0"){


        $mysqli->query("INSERT INTO `course`
            (`student`,
             `course`,
             `student_id`)
VALUES ('$full_name',
    '$course_class',
    '$student_id')")

        or die(mysqli_error($mysqli));

    }

    else {

        $mysqli->query("UPDATE `course`
SET
  `student` = '$full_name',
  `course` = '$course_class'

WHERE `id` = '$student_id'")

        or die(mysqli_error($mysqli));

    }




}










?>