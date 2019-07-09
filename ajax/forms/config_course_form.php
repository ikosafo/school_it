<?php

include('../../config.php');

$courseid = date("ymdhis").rand(1,10);

?>
<div class="card m-b-30">

    <div class="card-header bg-white">
        <h5 class="card-title text-black">Enter Course</h5>
        <small>Field marked * are required</small>
    </div>
    <div class="card-body">

        <label for="course_name">Course Name *</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-laptop"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Course Name" id="course_name"
            autocomplete="off">
        </div>

        <label for="course_code">Course Code</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-code"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Course Code" id="course_code">
        </div>

        <label for="assign_class">Assign Course to Class *</label>
        <div class="input-group mb-3">
            <select name="states[]" style="width: 100%" multiple id="assign_class">
                <option value=""></option>

                <?php
                $query = $mysqli->query("select * from class ORDER BY department");

                while ($result = $query->fetch_assoc()) { ?>

                    <option value="<?php echo $result['id'] ?>"><?php echo $result['class_name'] ?></option>

                <?php } ?>


            </select>
        </div>

        <label for="course_type">Course Type</label>
        <div class="input-group mb-3">
            <select id="course_type" style="width:100%">
                <option value=""></option>
                <option value="Core">Core</option>
                <option value="Elective">Elective</option>
            </select>
        </div>


        <div class="input-group-append mb-3">
            <button class="btn btn-primary" type="button" id="btn_save_course">Submit</button>
        </div>


    </div>
</div>


<script>

    $("#assign_class").selectize({
        placeholder: 'Assign to Class'
    });

    $("#course_type").select2({
        placeholder: 'Select Course Type'
    });


    $("#btn_save_course").click(function () {


        var course_name = $("#course_name").val();
        var course_code = $("#course_code").val();
        var course_type = $("#course_type").val();
        var assign_class = $("#assign_class").val();
        var course_id = '<?php echo $courseid; ?>';


        var error = '';


        if (course_name == "") {
            error += 'Please enter course name \n';
            $('#course_name').focus();
        }

        if (assign_class == "") {
            error += 'Please assign course to class \n';
            $('#assign_class').focus();
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
                    course_code:course_code,
                    course_type : course_type,
                    assign_class: assign_class,
                    course_id : course_id

                },
                success: function (text) {

                    //alert(text);

                    var nwtext = text.substring(0, 1);

                    //alert(nwtext);

                    if (nwtext == 1) {

                        $.notify("Course Saved", "success", {position: "top center"});


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

                    else if (nwtext == 2) {

                        $.notify("Course name already exists for class,", {position: "top center"});

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
