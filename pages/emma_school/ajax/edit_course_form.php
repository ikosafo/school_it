<?php include('../dbcon.php');

@session_start();
$course_name=$_POST['theindex'];

$quer =$mysqli->query("select * from course_class where course = '$course_name' ORDER BY id,course,class,type");
$resu = $quer->fetch_assoc();
$id = $resu['id'];
?>
<form method="post" action="" name="course_form"
      autocomplete="off">

    <div class="row">

        <div class="col-md-12 col-sm-12">


            <div class="form-group col-md-12">
                <label
                    for="form-field-username">Course
                    Name</label>

                <div>
                    <input type="text"
                           id="course_name_ed"
                           name="course_name"
                           placeholder="Enter name of course"
                           style="width:80%"
                           value="<?php echo $course_name; ?>"/>
                </div>
            </div>


            <div class="form-group col-md-12">
                <label
                    for="form-field-username">Course Code</label>

                <div>
                    <input type="text"
                           id="course_code_ed"
                           name="course_code"
                           placeholder="Enter course code"
                           style="width:80%"
                           value="<?php echo $resu['code'] ?>"/>
                </div>
            </div>


            <div class="form-group col-md-12">
                <label for="form-field-username">Select Type</label>

                <?php $type = $resu['type']?>

                <div>
                    <select id="course_type_ed"
                            class="select2"
                            data-placeholder="Click to Choose...">
                        <option value="<?php echo $type;?>"><?php echo $type;?></option>
                        <?php
                        $cl_name = $mysqli->query("SELECT DISTINCT(type) FROM course_class where type != '$type' ORDER BY id");
                        while ($row=$cl_name->fetch_assoc()) {
                            ?>
                            <?php echo '<option value="' . $row['type'] . '"';

                            echo '> ' . $row['type'] . '</option>';
                            //   echo $row['sign_name'];
                            ?>


                            <?php

                        }
                        ?>

                    </select>
                </div>
            </div>

<input type="hidden" id="course_id" value="<?php echo $id; ?>"/>
            <div class="space-4"></div>

        </div>
    </div>

</form>


<script>


    $('.select2').css('width','200px').select2({allowClear:true})
    $('#select2-multiple-style .btn').on('click', function(e){
        var target = $(this).find('input[type=radio]');
        var which = parseInt(target.val());
        if(which == 2) $('.select2').addClass('tag-input-style');
        else $('.select2').removeClass('tag-input-style');
    });

</script>