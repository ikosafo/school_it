<?php
include("../dbcon.php");

$course_name=$_POST['theindex'];

$mysqli->query("delete from course_class where course='$course_name'") or die(mysqli_error($mysqli));


echo 1;
?>