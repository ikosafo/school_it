<?php

include('../dbcon.php');


@session_start();
$branch = $_SESSION['branch'];

$user_username=mysqli_real_escape_string($mysqli,$_POST['user_username']);
$user_fullname=mysqli_real_escape_string($mysqli,$_POST['user_fullname']);

$user_password=mysqli_real_escape_string($mysqli,$_POST['user_password']);
$user_type=mysqli_real_escape_string($mysqli,$_POST['user_type']);

$new_pass = md5($user_password);



$res=$mysqli->query("select * from users where `username` = '$user_username'");
$rowcount = mysqli_num_rows($res);




if ($rowcount == "0" && $user_username!= 'admin'){

    $mysqli->query("INSERT INTO `users`
            (`name`,
             `username`,
             `password`,
             `admin_type`,
             `branch`)
VALUES ('$user_fullname',
        '$user_username',
        '$new_pass',
        '$user_type',
        '$branch')")
    or die(mysqli_error($mysqli));



    foreach ($_POST['permission'] as $permission)
    {




        $mysqli->query("INSERT INTO `permission`
            (`username`,
             `permission`)
VALUES ('$user_username',
    '$permission')")
        or die(mysqli_error($mysqli));





    }

    echo 1;

}

else {


    echo 2;

}










?>