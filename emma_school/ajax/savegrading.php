<?php

include("../dbcon.php");


$dept_name=mysqli_real_escape_string($mysqli,$_POST['dept_name']);
$mark_from=mysqli_real_escape_string($mysqli,$_POST['mark_from']);
$mark_to=mysqli_real_escape_string($mysqli,$_POST['mark_to']);
$remark=mysqli_real_escape_string($mysqli,$_POST['remark']);
$grade=mysqli_real_escape_string($mysqli,$_POST['grade']);
$grade_display=mysqli_real_escape_string($mysqli,$_POST['grade_display']);


$get = $mysqli->query("select * from grading where department = '$dept_name' and (

(mark_from <= $mark_from and mark_to >= $mark_to) or

(mark_from <= $mark_from and mark_to >= $mark_from)

)");
$count = mysqli_num_rows($get);

if ($count == "0"){

    $mysqli->query("INSERT INTO `grading`
            (`department`,
             `mark_from`,
             `mark_to`,
             `remark`,
             `grade_display`,
             `grade`)
VALUES ('$dept_name',
        '$mark_from',
        '$mark_to',
        '$remark',
        '$grade_display',
        '$grade')")
    or die(mysqli_error($mysqli));


    echo 1;




}


else {

    echo 2;
}









?>