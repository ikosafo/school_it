<?php

include('../../config.php');


$academic_year = mysqli_real_escape_string($mysqli, $_POST['academic_year']);
$academic_term = mysqli_real_escape_string($mysqli, $_POST['academic_term']);
$department = mysqli_real_escape_string($mysqli, $_POST['department']);
$schoolfees = mysqli_real_escape_string($mysqli, $_POST['schoolfees']);
$attendance = mysqli_real_escape_string($mysqli, $_POST['attendance']);


$chk = $mysqli->query("select * from fees_attendance where academicyear = '$academic_year' AND 
                            term = '$academic_term'");

$count = mysqli_num_rows($chk);


if ($count == "0") {


    $mysqli->query("INSERT INTO `fees_attendance`
            (`academicyear`,
             `term`,
             `department`,
             `schoolfees`,
             `attendance`)
VALUES ('$academic_year',
        '$academic_term',
        '$department',
        '$schoolfees',
        '$attendance')") or die(mysqli_error($mysqli));

    echo 1;

}

else {

    echo 2;

}
?>