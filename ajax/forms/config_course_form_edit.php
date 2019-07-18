<?php

include('../../config.php');

$courseid = $_POST['id_index'];

$getdetails = $mysqli->query("select * from course_class where course_id = '$courseid'");
$resdetails = $getdetails->fetch_assoc();
$course_name = $resdetails['course_name'];


?>
<div class="card m-b-30">

    <div class="card-header bg-white">
        <h5 class="card-title text-black">Update Course</h5>
        <small>Field marked * are required</small>
    </div>
    <div class="card-body">

        <label for="course_name">Course Name *</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-laptop"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Course Name" id="course_name"
                   autocomplete="off" value="<?php echo $resdetails['course_name'] ?>">
        </div>

        <!--<label for="course_code">Course Code</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-code"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Course Code"
                   id="course_code" value="<?php /*echo $resdetails['course_code'] */?>">
        </div>-->


        <label for="course_type">Course Type</label>
        <div class="input-group mb-3">
            <select id="course_type" style="width:100%">
                <option value=""></option>
                <option <?php if (@$resdetails['type'] == "Core") echo "Selected" ?>>Core</option>
                <option <?php if (@$resdetails['type'] == "Elective") echo "Selected" ?>>Elective</option>
            </select>
        </div>


        <div class="input-group-append mb-3">

            <button class="btn btn-secondary mr-2"  type="button" id="btn_cancel_course">Cancel</button>
            <button class="btn btn-warning ml-2" type="submit" id="btn_update_course">Update</button>
        </div>



    </div>
</div>


<script>

    $("#add_class").select2({
        placeholder: 'Select to add Class'
    });

    $("#course_type").select2({
        placeholder: 'Select Course Type'
    });


    $("#btn_cancel_course").click(function () {


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

    });


    $("#btn_update_course").click(function () {


        var course_name = $("#course_name").val();
        var course_type = $("#course_type").val();
        var course_id = '<?php echo $courseid; ?>';


        var error = '';


        if (course_name == "") {
            error += 'Please enter course name \n';
            $('#course_name').focus();
        }



        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_course_edit.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/images/load.gif"/>'
                    });
                },
                data: {

                    course_name : course_name,
                    course_type : course_type,
                    course_id : course_id

                },
                success: function (text) {

                    //alert(text);


                    if (text == 1) {

                        $.notify("Course Updated", "success", {position: "top center"});


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
