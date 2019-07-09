<?php
include("../dbcon.php");

$s_id=$_POST['theindex'];

$query = $mysqli->query("select * from student where id = '$s_id'");
$res = $query->fetch_assoc();
$filename =  $res['picture'];

//$use = substr($filename,strpos($filename,"/")+1);

$mysqli->query("UPDATE `student`
SET
  `status` = 'disabled'

WHERE `id` = '$s_id'") or die(mysqli_error($mysqli));



//unlink("../photos/".$use);


echo 1;
?>