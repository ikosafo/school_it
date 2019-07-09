<?php

include("../dbcon.php");


$academic_year = mysqli_real_escape_string($mysqli, $_POST['academic_year']);
$term = mysqli_real_escape_string($mysqli, $_POST['term']);
$date_from = mysqli_real_escape_string($mysqli, $_POST['date_from']);
$date_to = mysqli_real_escape_string($mysqli, $_POST['date_to']);
$form_id = mysqli_real_escape_string($mysqli, $_POST['form_id']);
$session_id = mysqli_real_escape_string($mysqli, $_POST['session_id']);
$term_begins = mysqli_real_escape_string($mysqli, $_POST['term_begins']);
$total_attendance = mysqli_real_escape_string($mysqli, $_POST['total_attendance']);


$mysqli->query("UPDATE `academic_session`

SET

  `year` = '$academic_year',
  `term` = '$term',
  `term_begins` = '$term_begins',
  `total_attendance` = '$total_attendance'


WHERE `session_id` = '$session_id'")

or die(mysqli_error($mysqli));



?>