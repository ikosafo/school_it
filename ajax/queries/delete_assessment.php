<?php

include('../../config.php');


$assess_id=$_POST['id_index'];



$mysqli->query("delete from assessment_config where id='$assess_id'")
or die(mysqli_error($mysqli));


?>