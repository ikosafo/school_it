<?php

include('../../config.php');


$course_name = mysqli_real_escape_string($mysqli,$_POST['course_name']);
//$course_code = mysqli_real_escape_string($mysqli,$_POST['course_code']);
$course_type = mysqli_real_escape_string($mysqli,$_POST['course_type']);
$course_id = mysqli_real_escape_string($mysqli,$_POST['course_id']);



foreach ($_POST['assign_class'] as $assign_class)
{

    $qu = $mysqli->query("select * from class where id='$assign_class'");
    $re = $qu->fetch_assoc();
    $classid = $re['id'];


    $res=$mysqli->query("select * from course_class where `course_name` = '$course_name' 
                   and `classid` = '$classid'");
    $rowcount = mysqli_num_rows($res);

    if ($rowcount == "0"){



        $mysqli->query("INSERT INTO `course_class`
            (`course_name`,
             `classid`,
             `type`,
             `course_id`)
VALUES ('$course_name',
        '$classid',
        '$course_type',
        '$course_id');")
        or die(mysqli_error($mysqli));


        echo 1;
    }

    else {


        echo 2;

    }


}











?>