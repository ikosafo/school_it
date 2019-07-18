<?php

include('../../config.php');

$id_index = $_POST['id_index'];

$classq = $mysqli->query("select * from class where id = '$id_index'");
$classr = $classq->fetch_assoc();

$classid = $classr['class_id'];


?>
<div class="card m-b-30">

    <div class="card-header bg-white">
        <h5 class="card-title text-black">Update Class</h5>
    </div>
    <div class="card-body">

        <label for="department_edit">Department</label>
        <div class="input-group mb-3">
            <select id="department_edit" style="width: 100%">
                <option value="">Select Department</option>


                <?php

                $departmentid = $classr['department'];

                $query = $mysqli->query("select * from department ORDER BY department_name");

                while ($result = $query->fetch_assoc()) { ?>

                    <option <?php if (@$departmentid == $result['id']) echo "Selected" ?>
                            value="<?php echo $result['id'] ?>"><?php echo $result['department_name'] ?></option>

                <?php } ?>


            </select>
        </div>


        <label for="class_name_edit">Class Name</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-laptop"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Class Name" id="class_name_edit"
            value="<?php echo $classr['class_name']; ?>">
        </div>


        <div class="input-group-append mb-3">

            <button class="btn btn-secondary mr-2"  type="button" id="btn_cancel_class">Cancel</button>
            <button class="btn btn-warning ml-2" type="submit" id="btn_update_class">Update</button>
        </div>


    </div>
</div>


<script>

    $("#department_edit").select2();


    $("#btn_update_class").click(function () {

        var class_name = $("#class_name_edit").val();
        var department = $("#department_edit").val();
        var class_id = '<?php echo $classid; ?>';

        //alert(department);

        var error = '';


        if (department == "") {
            error += 'Please select department \n';
        }

        if (class_name == "") {
            error += 'Please enter class name \n';
            $("#class_name").focus();
        }



        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_class.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/images/load.gif"/>'
                    });
                },
                data: {

                    class_name: class_name,
                    department: department,
                    class_id: class_id

                },
                success: function (text) {

                    //alert(text);

                    if (text == 1 || text == 3) {

                        $.notify("Class Saved", "success", {position: "top center"});

                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/config_class_form.php",
                            beforeSend: function () {

                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });

                            },
                            success: function (text) {
                                $('#class_form_div').html(text);
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
                            url: "ajax/tables/config_class_table.php",
                            beforeSend: function () {

                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });

                            },
                            success: function (text) {
                                $('#class_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });

                    }

                    else if (text == 2 || text == 4) {

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




    $("#btn_cancel_class").click(function () {


        $.ajax({
            type: "POST",
            url: "ajax/forms/config_class_form.php",
            beforeSend: function () {
                $.blockUI({
                    message: '<img src="assets/images/load.gif"/>'
                });
            },
            success: function (text) {
                $('#class_form_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                $.unblockUI();
            },

        });

    });


</script>
