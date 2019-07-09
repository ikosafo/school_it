<?php

include('../../config.php');

$courseid = date("ymdhis");

?>
<div class="card m-b-30">

    <div class="card-header bg-white">
        <h5 class="card-title text-black">Enter Course</h5>
    </div>
    <div class="card-body">


        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-laptop"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Course Name" id="course_name">
        </div>


        <div class="input-group mb-3">
            <select id="course_type" style="width:100%">
                <option value=""></option>
                <option value="Core">Core</option>
                <option value="Elective">Elective</option>
            </select>
        </div>


        <div class="input-group mb-3">
            <select name="states[]" style="width: 100%" multiple id="assign_class">
                <option value="">Assign to Class</option>

                <?php
                $query = $mysqli->query("select * from class ORDER BY class_name");

                while ($result = $query->fetch_assoc()) { ?>

                    <option value="<?php echo $result['id'] ?>"><?php echo $result['class_name'] ?></option>

                <?php } ?>


            </select>
        </div>


        <div class="input-group-append mb-3">
            <button class="btn btn-primary" type="submit" id="btn_save_course">Submit</button>
        </div>


    </div>
</div>


<script>

    $("#assign_class").selectize({
        placeholder: 'Assign to Class'
    });

    $("#course_type").selectize({
        placeholder: 'Course Type'
    });


    $("#btn_save_course").click(function () {

        var course_name = $("#course_name").val();
        var course_type = $("#course_type").val();
        var assign_class = $("#assign_class").val();
        var course_id = '<?php echo $courseid; ?>';

        //alert(department);

        var error = '';


        if (department == "") {
            error += 'Please select department \n';
        }

        if (course_name == "") {
            error += 'Please enter class name \n';
            $("#course_name").focus();
        }



        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_course.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/images/load.gif"/>'
                    });
                },
                data: {

                    course_name : course_name,
                    course_type : course_type,
                    assign_class: assign_class,
                    course_id : course_id

                },
                success: function (text) {

                    //alert(text);

                    if (text == 1) {

                        $.notify("Class Saved", "success", {position: "top center"});

                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/config_course_form.php",
                            beforeSend: function () {

                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });

                            },
                            success: function (text) {
                                $('#course_form_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });


                        $.ajax({
                            type: "POST",
                            url: "ajax/tables/config_course_table.php",
                            beforeSend: function () {

                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });

                            },
                            success: function (text) {
                                $('#course_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });

                    }

                    else if (text == 2) {

                        $.notify("Class name already exists,", {position: "top center"});

                    }


                },

                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    $.unblockUI();
                },

            });

        }


        else {

            $.notify(error, {position: "top left"});

        }

        return false;

    });


</script>
