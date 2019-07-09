<?php

include('../../config.php');


$class_id=$_POST['id_index'];



$mysqli->query("delete from class where id='$class_id'")
or die(mysqli_error($mysqli));


?>