<?php

include('../../config.php');


$club_id=$_POST['id_index'];



$mysqli->query("delete from club where id='$club_id'")
or die(mysqli_error($mysqli));


?>