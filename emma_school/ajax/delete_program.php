<?php
include("../dbcon.php");

$program_id=$_POST['theindex'];

$mysqli->query("delete from program where id='$program_id'") or die(mysqli_error($mysqli));


echo 1;
?>