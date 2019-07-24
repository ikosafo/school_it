<?php

include('../../config.php');

$department = mysqli_real_escape_string($mysqli, $_POST['department']);
$markfrom = mysqli_real_escape_string($mysqli, $_POST['markfrom']);
$markto = mysqli_real_escape_string($mysqli, $_POST['markto']);
$remark = mysqli_real_escape_string($mysqli, $_POST['remark']);
$displaygrade = mysqli_real_escape_string($mysqli, $_POST['displaygrade']);
$computinggrade = mysqli_real_escape_string($mysqli, $_POST['computinggrade']);


$chk = $mysqli->query("select * from grading where department = '$department'");

$count = mysqli_num_rows($chk);


if ($count == "0") {


    $mysqli->query("INSERT INTO `grading`
            (`department`,
             `markfrom`,
             `markto`,
             `remark`,
             `grade`,
             `displaygrade`)
VALUES ('$department',
        '$markfrom',
        '$markto',
        '$remark',
        '$computinggrade',
        '$displaygrade')") or die(mysqli_error($mysqli));

    echo 1;

}

else {

    echo 2;

}
?>