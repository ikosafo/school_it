<?php

include('../dbcon.php');

$class= $_POST['c_id'];
$sql = "select * from `course_class` where `class`='$class'";
$res = $mysqli->query($sql);
if(mysqli_num_rows($res) > 0) {
    echo "<option value=''></option>";
    while($row = mysqli_fetch_object($res)) {
        echo "<option value='".$row->course."'>".$row->course."</option>";
    }
}

?>
