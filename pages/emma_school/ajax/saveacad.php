<?php

include("../dbcon.php");


$academic_year=mysqli_real_escape_string($mysqli,$_POST['academic_year']);
$term=mysqli_real_escape_string($mysqli,$_POST['term']);
$date_from=mysqli_real_escape_string($mysqli,$_POST['date_from']);
$date_to=mysqli_real_escape_string($mysqli,$_POST['date_to']);
$session_id=mysqli_real_escape_string($mysqli,$_POST['session_id']);
$term_begins=mysqli_real_escape_string($mysqli,$_POST['term_begins']);


$get = $mysqli->query("select * from academic_session where date_to >= '$date_from' and (year = '$academic_year' and term ='$term')");
$count = mysqli_num_rows($get);

if ($count == "0"){

        $mysqli->query("INSERT INTO `academic_session`
            (`year`,
             `term`,
             `date_from`,
             `date_to`,
             `term_begins`,
             `session_id`)
VALUES ('$academic_year',
        '$term',
        '$date_from',
        '$date_to',
        '$term_begins',
        '$session_id')")
        or die(mysqli_error($mysqli));


        echo 1;




}


else  if ($count == "1"){

    echo 2;
}


?>