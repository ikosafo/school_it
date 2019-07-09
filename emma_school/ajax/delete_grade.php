<?php
include("../dbcon.php");

$g_id=$_POST['theindex'];

$mysqli->query("delete from grading where id='$g_id'") or die(mysqli_error($mysqli));


echo 1;
?>