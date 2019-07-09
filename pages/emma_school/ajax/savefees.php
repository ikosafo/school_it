<?php

include("../dbcon.php");


$academic_year=mysqli_real_escape_string($mysqli,$_POST['academic_year']);
$term=mysqli_real_escape_string($mysqli,$_POST['term']);
$dept=mysqli_real_escape_string($mysqli,$_POST['dept']);
$amount=mysqli_real_escape_string($mysqli,$_POST['amount']);
$attendance=mysqli_real_escape_string($mysqli,$_POST['attendance']);


$get = $mysqli->query("select * from tuition_fees where year = '$academic_year' and term = '$term' and department = '$dept'");
$count = mysqli_num_rows($get);

if ($count == "0"){

    $mysqli->query("INSERT INTO `tuition_fees`
            (`year`,
             `term`,
             `amount`,
             `attendance`,
             `department`)
VALUES ('$academic_year',
        '$term',
        '$amount',
        '$attendance',
        '$dept')")
    or die(mysqli_error($mysqli));


    echo 1;




}


else {

    echo 2;
}


?>