<?php

include("../dbcon.php");


$dept_name=mysqli_real_escape_string($mysqli,$_POST['dept_name']);
$dept_id=mysqli_real_escape_string($mysqli,$_POST['dept_id']);


$mysqli->query("UPDATE `department`
SET
`name` = '$dept_name'

WHERE `id` = '$dept_id'")
or die();

echo 1;






?>