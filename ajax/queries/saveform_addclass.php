<?php

include('../../config.php');

$course_name = mysqli_real_escape_string($mysqli, $_POST['course_name']);
$addclass = mysqli_real_escape_string($mysqli, $_POST['addclass']);



$chk = $mysqli->query("select * from course_class where classid = '$addclass' 
                                 AND course_name = '$course_name'");

$count = mysqli_num_rows($chk);


    if ($count == "0") {


        $mysqli->query("INSERT INTO `course_class`
            (`course_name`,
             `classid`)
VALUES ('$course_name', 
        '$addclass')") or die(mysqli_error($mysqli));

        echo 1;

    }

    else {

        echo 2;
    }


?>