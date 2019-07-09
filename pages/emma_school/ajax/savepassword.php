<?php

include("../dbcon.php");


$old_password=mysqli_real_escape_string($mysqli,$_POST['old_password']);
$new_password=mysqli_real_escape_string($mysqli,$_POST['new_password']);

$old = md5($old_password);
$new = md5($new_password);



$get = $mysqli->query("select * from user_main where pass = '$old'");
$count = mysqli_num_rows($get);

if ($count == "1"){

    $mysqli->query("UPDATE `user_main`
SET
  `pass` = '$new'

WHERE `pass` = '$old'")
    or die(mysqli_error($mysqli));


    echo 1;




}


else {

    echo 2;
}









?>