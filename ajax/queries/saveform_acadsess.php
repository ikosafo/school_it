<?php

include('../../config.php');

$academic_year = mysqli_real_escape_string($mysqli, $_POST['academic_year']);
$academic_term = mysqli_real_escape_string($mysqli, $_POST['academic_term']);
$date_started = mysqli_real_escape_string($mysqli, $_POST['date_started']);
$date_ended = mysqli_real_escape_string($mysqli, $_POST['date_ended']);


$chk = $mysqli->query("select * from academic_session where academicyear = '$academic_year' AND 
                            term = '$academic_term'");

$count = mysqli_num_rows($chk);

$ct = mysqli_num_rows($mysqli->query("select * from academic_session where 
                                    date_started BETWEEN '$date_started' AND '$date_ended'"));


if ($count == "0") {

    if ($ct == "0") {


        $mysqli->query("INSERT INTO `academic_session`
            (`academicyear`,
             `term`,
             `date_started`,
             `date_ended`)
VALUES ('$academic_year',
        '$academic_term',
        '$date_started',
        '$date_ended')") or die(mysqli_error($mysqli));

        echo 1;

    }

    else {

        echo 2;
    }


}

else {

   echo 3;

}
?>