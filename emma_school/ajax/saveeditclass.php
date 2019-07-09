<?php

include("../dbcon.php");


$class_name=mysqli_real_escape_string($mysqli,$_POST['class_name']);
$class_dept=mysqli_real_escape_string($mysqli,$_POST['class_dept']);
$class_id=mysqli_real_escape_string($mysqli,$_POST['class_id']);



$mysqli->query("UPDATE `class`
SET
`name` = '$class_name',
`department` = '$class_dept'

WHERE `id` = '$class_id'")
or die();

echo 1;






?>