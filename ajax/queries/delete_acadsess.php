<?php

include('../../config.php');


$acad_id=$_POST['id_index'];



$mysqli->query("delete from academic_session where id='$acad_id'")
or die(mysqli_error($mysqli));


?>