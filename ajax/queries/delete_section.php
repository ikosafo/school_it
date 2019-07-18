<?php

include('../../config.php');


$section_id=$_POST['id_index'];



$mysqli->query("delete from `section` where id = '$section_id'")
or die(mysqli_error($mysqli));


?>