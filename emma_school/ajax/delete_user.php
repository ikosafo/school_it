<?php
include("../dbcon.php");

$user_id=$_POST['theindex'];

$mysqli->query("delete from users where username='$user_id'") or die(mysqli_error($mysqli));



echo 1;
?>