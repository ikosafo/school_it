<?php

include('../../config.php');


$course_id=$_POST['id_index'];



$mysqli->query("delete from course_class where course_id = '$course_id'")
or die(mysqli_error($mysqli));

echo $course_id;

?>