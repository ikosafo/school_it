<?php

include("../dbcon.php");



$class_score=mysqli_real_escape_string($mysqli,$_POST['class_score']);
$exam_score=mysqli_real_escape_string($mysqli,$_POST['exam_score']);
$dept_name=mysqli_real_escape_string($mysqli,$_POST['dept_name']);

$res=$mysqli->query("select * from assessment where department = '$dept_name'");
$result = $res->fetch_assoc();
$id = $result['id'];
$rowcount = mysqli_num_rows($res);


if ($rowcount == "0"){

    $mysqli->query("INSERT INTO `assessment`
            (`class_score`,
             `exam_score`,
             `department`
             )
VALUES ('$class_score',
        '$exam_score',
        '$dept_name'
        )")
    or die(mysqli_error($mysqli));

    echo 1;

}

else {

    $mysqli->query("UPDATE `assessment`
SET `class_score` = '$class_score',
  `exam_score` = '$exam_score',
  `department` = '$dept_name'
WHERE `id` = '$id'")
    or die(mysqli_error($mysqli));


    echo 2;

}










?>