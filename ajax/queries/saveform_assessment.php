<?php

include('../../config.php');

$department = mysqli_real_escape_string($mysqli, $_POST['department']);
$classmark = mysqli_real_escape_string($mysqli, $_POST['classmark']);
$exammark = mysqli_real_escape_string($mysqli, $_POST['exammark']);


$chk = $mysqli->query("select * from assessment_config where department = '$department'");

$count = mysqli_num_rows($chk);


if ($count == "0") {


    $mysqli->query("INSERT INTO `assessment_config`
            (`department`,
             `classmark`,
             `exammark`)
VALUES ('$department',
        '$classmark',
        '$exammark')") or die(mysqli_error($mysqli));

    echo 1;

}

else {

    echo 2;

}
?>