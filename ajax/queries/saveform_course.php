<?php

include('../../config.php');


$course_name = mysqli_real_escape_string($mysqli,$_POST['course_name']);
$course_code = mysqli_real_escape_string($mysqli,$_POST['course_code']);
$course_type = mysqli_real_escape_string($mysqli,$_POST['course_type']);
$course_id = mysqli_real_escape_string($mysqli,$_POST['course_id']);



foreach ($_POST['assign_class'] as $assign_class)
{

    $qu = $mysqli->query("select * from class where id='$assign_class'");
    $re = $qu->fetch_assoc();
    $class = $re['class_name'];


    $res=$mysqli->query("select * from course_class where `course_name` = '$course_name' 
                   and `class` = '$class'");
    $rowcount = mysqli_num_rows($res);

    if ($rowcount == "0"){



        $mysqli->query("INSERT INTO `course_class`
            (`course_name`,
             `class`,
             `type`,
             `course_id`,
             `course_code`)
VALUES ('$course_name',
        '$class',
        '$course_type',
        '$course_id',
        '$course_code');")
        or die(mysqli_error($mysqli));


        echo 1;
    }

    else {


        echo 2;

    }


}











?>