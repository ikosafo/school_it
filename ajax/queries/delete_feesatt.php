<?php

include('../../config.php');


$fee_id=$_POST['id_index'];



$mysqli->query("delete from fees_attendance where id='$fee_id'")
or die(mysqli_error($mysqli));


?>