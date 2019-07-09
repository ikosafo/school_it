<?php
include('../dbcon.php');
session_start();

$randno = $_POST['randno'];
$today = date('Y-m-d');

$target_path = "../photos/";

$rand = rand(1,100000);


$ext = pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);

$filename =  $_FILES['Filedata']['name'];
$newfile = 'photos/'.date('Ymd').$rand.".".$ext;
$target_path = "../photos/".date('Ymd').$rand.".".$ext;


$filetype =  $_FILES['Filedata']['type'];
$filesize =  $_FILES['Filedata']['size'];


if(move_uploaded_file($_FILES['Filedata']['tmp_name'], $target_path)) {

    echo $success =  "The file ".  basename( $_FILES['Filedata']['name']). " has been uploaded";
}
else
{

    echo $error = "There was an error uploading the file, please try again!";

}

$res=$mysqli->query("select * from institution where `school_id` = '$randno'");
$rowcount = mysqli_num_rows($res);


if ($rowcount == "0"){

    $insertfile  = $mysqli->query("INSERT INTO  institution (signature, school_id)
	values ('$newfile', '$randno') ") or die (mysql_error());




}

else {

    $insertfile  = $mysqli->query("UPDATE `institution`
SET `signature` = '$newfile'

WHERE `school_id` = '$randno'") or die (mysql_error());


}


?>