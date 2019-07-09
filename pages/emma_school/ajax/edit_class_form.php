
<?php
include('../dbcon.php');

$classid = $_POST['theindex'];

$quce= $mysqli->query("select * from class where id='$classid'");
$fet_class = $quce->fetch_assoc();





?>




<div class="row">

    <div class="col-md-12 col-sm-12">


        <div class="form-group col-md-12">
            <label for="form-field-username">Class name</label>

            <div>
                <input type="text" id="class_name_ed" placeholder="Enter class name"
                       style="width:90%" required value="<?php echo $fet_class['name'];?>"/>
            </div>
        </div>

        <div class="form-group col-md-12">
            <label for="form-field-username">Department</label>

            <?php $dept = $fet_class['department']?>

            <div>
                <select id="class_dept_ed"
                        class="select2"
                        data-placeholder="Click to Choose..."
                        required>
                    <option value="<?php echo $fet_class['department']?>"><?php echo $fet_class['department']?></option>
                    <?php
                    $cl_name = $mysqli->query("SELECT * FROM department where name!='$dept' ORDER BY id");
                    while ($row=$cl_name->fetch_assoc()) {
                        ?>
                        <?php echo '<option value="' . $row['name'] . '"';

                        echo '> ' . $row['name'] . '</option>';
                        //   echo $row['sign_name'];
                        ?>


                        <?php

                    }
                    ?>

                </select>
            </div>
        </div>

        <input type="hidden" value="<?php echo $classid;?>" id="class_id"/>


        <div class="space-4"></div>

    </div>
</div>


<script>


    $('.date-picker').datepicker({
        autoclose: true,
        todayHighlight: true
    });


    $('.select2').css('width','200px').select2({allowClear:true})
    $('#select2-multiple-style .btn').on('click', function(e){
        var target = $(this).find('input[type=radio]');
        var which = parseInt(target.val());
        if(which == 2) $('.select2').addClass('tag-input-style');
        else $('.select2').removeClass('tag-input-style');
    });

</script>
