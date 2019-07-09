<?php
include("../dbcon.php");

$dept_id=$_POST['theindex'];

$mysqli->query("delete from department where id='$dept_id'") or die(mysqli_error($mysqli));


echo 1;
?>