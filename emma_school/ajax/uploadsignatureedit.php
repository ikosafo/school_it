<?php
include('../dbcon.php');
session_start();

$randno = $_POST['randno'];
$today = date('Y-m-d H:i:s');

$target_path = "photos/";

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



$q = $mysqli->query("select * from institution LIMIT 1");
$get = $q->fetch_assoc();
$id = $get['id'];

if ($newfile == ""){

    $insertfile  = $mysqli->query("UPDATE `institution`
SET `signature` = '$randno'

WHERE `id` = '$id'") or die (mysql_error());




}

else if ($newfile != "") {

    $insertfile  = $mysqli->query("UPDATE `institution`
SET `signature` = '$newfile'

WHERE `id` = '$id'") or die (mysql_error());


}



?>
