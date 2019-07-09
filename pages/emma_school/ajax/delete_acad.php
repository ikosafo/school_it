<?php
include("../dbcon.php");

$acad_id=$_POST['theindex'];

$mysqli->query("DELETE
FROM `academic_session`
WHERE `id` = '$acad_id'") or die(mysqli_error($mysqli));


echo 1;
?>