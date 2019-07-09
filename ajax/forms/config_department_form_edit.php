<?php

include('../../config.php');

$id_index = $_POST['id_index'];

$depq = $mysqli->query("select * from department where id = '$id_index'");
$depr = $depq->fetch_assoc();

$department_id = $depr['department_id'];


?>


<div class="card m-b-30">

    <div class="card-header bg-white">
        <h5 class="card-title text-black">Update Department Details</h5>
    </div>
    <div class="card-body">

        <label for="department_name_edit">Department Name</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-laptop"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Department Name" id="department_name_edit"
            value="<?php echo $depr['department_name']; ?>">
        </div>


        <div class="input-group-append mb-3">

            <button class="btn btn-secondary mr-2"  type="button" id="btn_cancel_department">Cancel</button>
            <button class="btn btn-primary ml-2" type="button" id="btn_update_department">Update</button>

        </div>


    </div>
</div>


<script>


    $("#btn_update_department").click(function () {

        var department_name_edit = $("#department_name_edit").val();
        var department_id = '<?php echo $department_id; ?>';

        var error = '';


        if (department_name_edit == "") {
            error += 'Please enter department name\n';
            $("#department_name_edit").focus();
        }


        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_department.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/images/load.gif"/>'
                    });
                },
                data: {

                    department_name: department_name_edit,
                    department_id: department_id

                },
                success: function (text) {

                    //alert(text);

                    if (text == 3) {



                        $.notify("Department Updated", "success", {position: "top center"});


                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/config_department_form.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });
                            },
                            success: function (text) {
                                $('#department_form_div').html(text);
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
                            url: "ajax/tables/config_department_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });
                            },
                            success: function (text) {
                                $('#department_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });


                    }

                    else if (text == 4) {
                        $.notify("Department name already exists",{position:"top center"});
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











    $("#btn_cancel_department").click(function () {


        $.ajax({
            type: "POST",
            url: "ajax/forms/config_department_form.php",
            beforeSend: function () {
                $.blockUI({
                    message: '<img src="assets/images/load.gif"/>'
                });
            },
            success: function (text) {
                $('#department_form_div').html(text);
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
