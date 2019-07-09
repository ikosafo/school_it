<?php

include("../dbcon.php");



$program_name=mysqli_real_escape_string($mysqli,$_POST['program_name']);
$program_dept=mysqli_real_escape_string($mysqli,$_POST['program_dept']);

$res=$mysqli->query("select * from program where `name` = '$program_name'");
$rowcount = mysqli_num_rows($res);


if ($rowcount == "0"){

    $mysqli->query("INSERT INTO `program`
            (`name`,
             `department`)
VALUES ('$program_name',
        '$program_dept')")
    or die(mysqli_error($mysqli));

    echo 1;

}

else {


    echo 2;

}










?>