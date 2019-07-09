<?php
include("../dbcon.php");

$class_id=$_POST['theindex'];

$mysqli->query("delete from class where id='$class_id'") or die(mysqli_error($mysqli));


echo 1;
?>