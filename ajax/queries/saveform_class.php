<?php

include('../../config.php');


$class_name = mysqli_real_escape_string($mysqli, $_POST['class_name']);
$department = mysqli_real_escape_string($mysqli, $_POST['department']);
$class_id = mysqli_real_escape_string($mysqli, $_POST['class_id']);


$chk = $mysqli->query("select * from class where class_id = '$class_id'");

$count = mysqli_num_rows($chk);

$ct = mysqli_num_rows($mysqli->query("select * from class where class_name = '$class_name' 
                                        AND department = '$department'"));


if ($count == "0") {

    if ($ct == "0") {


        $mysqli->query("INSERT INTO `class`
            (`class_name`,
             `department`,
             `class_id`)
VALUES ('$class_name', 
        '$department',
        '$class_id')") or die(mysqli_error($mysqli));

        echo 1;

    } else {

        echo 2;
    }


} else {

    if ($ct == "0") {

        $mysqli->query(" UPDATE `class`
SET 
  `class_name` = '$class_name',
  `department` = '$department'
  
WHERE `class_id` = '$class_id'") or die(mysqli_error($mysqli));

        echo 3;

    } else {

        echo 4;
    }

}
?>