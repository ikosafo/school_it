<?php
include("../dbcon.php");

$c_id=$_POST['theindex'];

$mysqli->query("delete from course where id='$c_id'") or die(mysqli_error($mysqli));

echo 1;

?>