<?php

include('../../config.php');


$section_name = mysqli_real_escape_string($mysqli, $_POST['section_name']);
$section_id = mysqli_real_escape_string($mysqli, $_POST['section_id']);


$chk = $mysqli->query("select * from `section` where section_id = '$section_id'");

$count = mysqli_num_rows($chk);

$ct = mysqli_num_rows($mysqli->query("select * from `section` where section_name = '$section_name'"));


if ($count == "0") {

    if ($ct == "0") {


        $mysqli->query("INSERT INTO `section`
            (`section_name`,
             `section_id`)
VALUES ('$section_name',
        '$section_id')") or die(mysqli_error($mysqli));

        echo 1;

    }

    else {

        echo 2;
    }


}

else {

    if ($ct == "0") {

        $mysqli->query(" UPDATE `section`
SET 
  `section_name` = '$section_name'
  
WHERE `section_id` = '$section_id'") or die(mysqli_error($mysqli));

        echo 3;

    }

    else {

        echo 4;
    }

}
?>