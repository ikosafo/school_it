<?php

include('../dbcon.php');


@session_start();

$course_name=mysqli_real_escape_string($mysqli,$_POST['course_name']);
$course_type=mysqli_real_escape_string($mysqli,$_POST['course_type']);
$course_code=mysqli_real_escape_string($mysqli,$_POST['course_code']);



    foreach ($_POST['course_class'] as $course_class)
    {

        $qu = $mysqli->query("select * from class where id='$course_class'");
        $re = $qu->fetch_assoc();
        $class = $re['name'];


        $res=$mysqli->query("select * from course_class where `course` = '$course_name' and `class` = '$class'");
        $rowcount = mysqli_num_rows($res);

        if ($rowcount == "0"){



        $mysqli->query("INSERT INTO `course_class`
            (`course`,
             `class`,
             `type`,
             `code`)
VALUES ('$course_name',
        '$class',
        '$course_type',
        '$course_code');")
        or die(mysqli_error($mysqli));


            echo 1;
    }

        else {


            echo 2;

        }


}











?>