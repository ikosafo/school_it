<?php

include('../../config.php');

$clubid = date("ymdhis").rand(1,10);

?>

<div class="card m-b-30">

    <div class="card-header bg-white">
        <h5 class="card-title text-black">Enter Club</h5>
    </div>
    <div class="card-body">

        <label for="club_name">Club Name</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-laptop"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Club Name" id="club_name">
        </div>


        <div class="input-group-append mb-3">
            <button class="btn btn-primary" type="button" id="btn_save_club">Submit</button>
        </div>


    </div>
</div>


<script>

    $("#btn_save_club").click(function () {

        var club_name = $("#club_name").val();
        var club_id = '<?php echo $clubid; ?>';


        var error = '';


        if (club_name == "") {
            error += 'Please enter club name \n';
            $("#club_name").focus();
        }



        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_club.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/images/load.gif"/>'
                    });
                },
                data: {

                    club_name: club_name,
                    club_id: club_id

                },
                success: function (text) {

                    //alert(text);

                    if (text == 1) {

                        $.notify("Club Saved", "success", {position: "top center"});


                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/config_club_form.php",
                            beforeSend: function () {

                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });

                            },
                            success: function (text) {
                                $('#club_form_div').html(text);
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
                            url: "ajax/tables/config_club_table.php",
                            beforeSend: function () {

                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });

                            },
                            success: function (text) {
                                $('#club_table_div').html(text);
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

                        $.notify("Club name already exists,", {position: "top center"});

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
