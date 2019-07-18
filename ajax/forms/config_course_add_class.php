<?php

include('../../config.php');

$courseid = $_POST['id_index'];

$getdetails = $mysqli->query("select * from course_class where course_id = '$courseid'");
$resdetails = $getdetails->fetch_assoc();
$course_name = $resdetails['course_name'];


?>
<div class="card m-b-30">

    <div class="card-header bg-white">
        <h5 class="card-title text-black">Update Class</h5>
        <small>Field marked * are required</small>
    </div>
    <div class="card-body">

        <label>
            Assign <b style="text-transform: uppercase"><?php echo $course_name ?></b> to Class
        </label>

        <p></p>

        <label for="addclass">Add Class</label>
        <div class="input-group mb-3">
            <select style="width: 100%" id="addclass">

                <option value=""></option>

                <?php
                $query = $mysqli->query("select * from class ORDER BY department");

                while ($result = $query->fetch_assoc()) { ?>

                    <option value="<?php echo $result['id'] ?>"><?php echo $result['class_name'] ?></option>

                <?php } ?>



            </select>
        </div>


        <div class="input-group-append mb-3">

            <button class="btn btn-secondary mr-2"  type="button" id="btn_cancel_course">Cancel</button>
            <button class="btn btn-warning ml-2" type="button" id="btn_addclass">Add Class</button>
        </div>



    </div>
</div>


<script>

    $("#addclass").select2({
        placeholder: 'Select to add Class'
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


    $("#btn_addclass").click(function () {

        var course_name = '<?php echo $course_name ?>';
        var addclass = $("#addclass").val();

        var error = '';


        if (addclass == "") {
            error += 'Please select class \n';
        }



        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_addclass.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/images/load.gif"/>'
                    });
                },
                data: {

                    course_name : course_name,
                    addclass : addclass

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
