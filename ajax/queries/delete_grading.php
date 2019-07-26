<?php

include('../../config.php');


$grade_id=$_POST['id_index'];



$mysqli->query("delete from grading where id='$grade_id'")
or die(mysqli_error($mysqli));


?>