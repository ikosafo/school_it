<?php

include('../../config.php');

$course_name = mysqli_real_escape_string($mysqli, $_POST['course_name']);
$course_type = mysqli_real_escape_string($mysqli, $_POST['course_type']);
$course_id = mysqli_real_escape_string($mysqli, $_POST['course_id']);



$chk = $mysqli->query("select * from course_class where course_name = '$course_name' AND `type` = '$course_type'");

$count = mysqli_num_rows($chk);


if ($count == "0") {


    $mysqli->query("UPDATE `course_class`
SET 
  `course_name` = '$course_name',
  `type` = '$course_type'
  
WHERE `course_id` = '$course_id'") or die(mysqli_error($mysqli));

    echo 1;

}

else {

    echo 2;
}


?>