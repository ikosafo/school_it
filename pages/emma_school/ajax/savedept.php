<?php

include("../dbcon.php");



$dept_name=mysqli_real_escape_string($mysqli,$_POST['dept_name']);
$dept_branch=mysqli_real_escape_string($mysqli,$_POST['dept_branch']);

$res=$mysqli->query("select * from department where `name` = '$dept_name'");
$rowcount = mysqli_num_rows($res);


if ($rowcount == "0"){

    $mysqli->query("INSERT INTO `department`
            (`name`,
             `branch`)
VALUES ('$dept_name',
        '$dept_branch')")
    or die(mysqli_error($mysqli));

    echo 1;

}

else {


    echo 2;

}










?>