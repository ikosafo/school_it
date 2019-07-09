
<?php
include('../dbcon.php');

$deptid = $_POST['theindex'];

$qudp= $mysqli->query("select * from department where id='$deptid'");
$fet_dept = $qudp->fetch_assoc();





?>




<div class="row">

    <div class="col-md-12 col-sm-12">


        <div class="form-group col-md-12">
            <label for="form-field-username">Department</label>

            <div>
                <input type="text" id="dept_name_ed" placeholder="Enter department name"
                       style="width:90%" required value="<?php echo $fet_dept['name'];?>"/>
            </div>
        </div>
        <input type="hidden" value="<?php echo $deptid;?>" id="dept_id"/>


        <div class="space-4"></div>

    </div>
</div>

