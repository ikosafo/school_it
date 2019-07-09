<?php
include("../dbcon.php");

$fees_id=$_POST['theindex'];

$mysqli->query("DELETE
FROM `tuition_fees`
WHERE `id` = '$fees_id'") or die(mysqli_error($mysqli));


echo 1;
?>