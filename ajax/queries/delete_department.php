<?php

include('../../config.php');


$dept_id=$_POST['id_index'];



$mysqli->query("delete from department where id='$dept_id'")
or die(mysqli_error($mysqli));


?>