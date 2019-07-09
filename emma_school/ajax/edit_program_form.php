
<?php
include('../dbcon.php');

$programid = $_POST['theindex'];

$quce= $mysqli->query("select * from program where id='$programid'");
$fet_program = $quce->fetch_assoc();





?>




<div class="row">

    <div class="col-md-12 col-sm-12">


        <div class="form-group col-md-12">
            <label for="form-field-username">Program name</label>

            <div>
                <input type="text" id="program_name_ed" placeholder="Enter program name"
                       style="width:90%" required value="<?php echo $fet_program['name'];?>"/>
            </div>
        </div>

        <div class="form-group col-md-12">
            <label for="form-field-username">Department</label>

            <?php $dept = $fet_program['department']?>

            <div>
                <select id="program_dept_ed"
                        class="select2"
                        data-placeholder="Click to Choose..."
                        required>
                    <option value="<?php echo $fet_program['department']?>"><?php echo $fet_program['department']?></option>
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

        <input type="hidden" value="<?php echo $programid;?>" id="program_id"/>


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
