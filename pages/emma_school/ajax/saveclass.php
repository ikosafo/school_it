<?php

include("../dbcon.php");



$class_name=mysqli_real_escape_string($mysqli,$_POST['class_name']);
$class_dept=mysqli_real_escape_string($mysqli,$_POST['class_dept']);

$res=$mysqli->query("select * from class where `name` = '$class_name'");
$rowcount = mysqli_num_rows($res);


if ($rowcount == "0"){

    $mysqli->query("INSERT INTO `class`
            (`name`,
             `department`)
VALUES ('$class_name',
        '$class_dept')")
    or die(mysqli_error($mysqli));

    echo 1;

}

else {


    echo 2;

}










?>