<?php

include('../../config.php');

$id_index = $_POST['id_index'];

$depq = $mysqli->query("select * from section where id = '$id_index'");
$depr = $depq->fetch_assoc();

$section_id = $depr['section_id'];


?>


<div class="card m-b-30">

    <div class="card-header bg-white">
        <h5 class="card-title text-black">Update Section Details</h5>
    </div>
    <div class="card-body">

        <label for="section_name_edit">Section Name</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-laptop"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Section Name" id="section_name_edit"
                   value="<?php echo $depr['section_name']; ?>">
        </div>


        <div class="input-group-append mb-3">

            <button class="btn btn-secondary mr-2"  type="button" id="btn_cancel_section">Cancel</button>
            <button class="btn btn-warning ml-2" type="button" id="btn_update_section">Update</button>

        </div>


    </div>
</div>


<script>


    $("#btn_update_section").click(function () {

        var section_name_edit = $("#section_name_edit").val();
        var section_id = '<?php echo $section_id; ?>';

        var error = '';


        if (section_name_edit == "") {
            error += 'Please enter section name\n';
            $("#section_name_edit").focus();
        }


        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_section.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/images/load.gif"/>'
                    });
                },
                data: {

                    section_name: section_name_edit,
                    section_id: section_id

                },
                success: function (text) {

                    //alert(text);

                    if (text == 3) {



                        $.notify("Section Updated", "success", {position: "top center"});


                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/config_section_form.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });
                            },
                            success: function (text) {
                                $('#section_form_div').html(text);
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
                            url: "ajax/tables/config_section_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });
                            },
                            success: function (text) {
                                $('#section_table_div').html(text);
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
                        $.notify("Section name already exists",{position:"top center"});
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




    $("#btn_cancel_section").click(function () {


        $.ajax({
            type: "POST",
            url: "ajax/forms/config_section_form.php",
            beforeSend: function () {
                $.blockUI({
                    message: '<img src="assets/images/load.gif"/>'
                });
            },
            success: function (text) {
                $('#section_form_div').html(text);
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
