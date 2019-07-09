<?php

include('../../config.php');


$courseclass_id = $_POST['courseclass_id'];



$mysqli->query("delete from course_class where id = '$courseclass_id'")
or die(mysqli_error($mysqli));

echo $course_id;

?>