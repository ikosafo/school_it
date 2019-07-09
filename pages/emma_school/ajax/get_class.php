<?php

include('../dbcon.php');

$dept= $_POST['c_id'];
$sql = "select * from `class` where `department`='$dept'";
$res = $mysqli->query($sql);
if(mysqli_num_rows($res) > 0) {
    echo "<option value=''></option>";
    while($row = mysqli_fetch_object($res)) {
        echo "<option value='".$row->name."'>".$row->name."</option>";
    }
}

?>
