<?php

include('../../config.php');


$club_name = mysqli_real_escape_string($mysqli, $_POST['club_name']);
$club_id = mysqli_real_escape_string($mysqli, $_POST['club_id']);


$chk = $mysqli->query("select * from club where club_id = '$club_id'");

$count = mysqli_num_rows($chk);

$ct = mysqli_num_rows($mysqli->query("select * from club where club_name = '$club_name'"));


if ($count == "0") {

    if ($ct == "0") {


        $mysqli->query("INSERT INTO `club`
            (`club_name`,
             `club_id`)
VALUES ('$club_name',
        '$club_id')") or die(mysqli_error($mysqli));

        echo 1;

    }

    else {

        echo 2;
    }


}

else {

    if ($ct == "0") {

        $mysqli->query(" UPDATE `club`
SET 
  `club_name` = '$club_name'
  
WHERE `club_id` = '$club_id'") or die(mysqli_error($mysqli));

        echo 3;

    }

    else {

        echo 4;
    }

}
?>