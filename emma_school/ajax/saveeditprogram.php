<?php

include("../dbcon.php");


$program_name=mysqli_real_escape_string($mysqli,$_POST['program_name']);
$program_dept=mysqli_real_escape_string($mysqli,$_POST['program_dept']);
$program_id=mysqli_real_escape_string($mysqli,$_POST['program_id']);



$mysqli->query("UPDATE `program`
SET
`name` = '$program_name',
`department` = '$program_dept'

WHERE `id` = '$program_id'")
or die();

echo 1;






?>