<?php

include('../../config.php');

$sectionid = date("ymdhis").rand(1,10);

?>

<div class="card m-b-30">

    <div class="card-header bg-white">
        <h5 class="card-title text-black">Enter Section</h5>
    </div>
    <div class="card-body">

        <label for="section_name">Section Name</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-laptop"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Section Name" id="section_name">
        </div>


        <div class="input-group-append mb-3">
            <button class="btn btn-primary" type="button" id="btn_save_section">Submit</button>
        </div>


    </div>
</div>


<script>

    $("#btn_save_section").click(function () {

        var section_name = $("#section_name").val();
        var section_id = '<?php echo $sectionid; ?>';


        var error = '';


        if (section_name == "") {
            error += 'Please enter section name \n';
            $("#section_name").focus();
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

                    section_name: section_name,
                    section_id: section_id

                },
                success: function (text) {

                    //alert(text);

                    if (text == 1) {

                        $.notify("Section Saved", "success", {position: "top center"});


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

                    else if (text == 2) {

                        $.notify("Section name already exists,", {position: "top center"});

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
