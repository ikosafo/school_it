<?php

include('../../config.php');

$id_index = $_POST['id_index'];

$depq = $mysqli->query("select * from club where id = '$id_index'");
$depr = $depq->fetch_assoc();

$club_id = $depr['club_id'];


?>


<div class="card m-b-30">

    <div class="card-header bg-white">
        <h5 class="card-title text-black">Update Club Details</h5>
    </div>
    <div class="card-body">

        <label for="club_name_edit">Club Name</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-laptop"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Club Name" id="club_name_edit"
                   value="<?php echo $depr['club_name']; ?>">
        </div>


        <div class="input-group-append mb-3">

            <button class="btn btn-secondary mr-2"  type="button" id="btn_cancel_club">Cancel</button>
            <button class="btn btn-warning ml-2" type="button" id="btn_update_club">Update</button>

        </div>


    </div>
</div>


<script>


    $("#btn_update_club").click(function () {

        var club_name_edit = $("#club_name_edit").val();
        var club_id = '<?php echo $club_id; ?>';

        var error = '';


        if (club_name_edit == "") {
            error += 'Please enter club name\n';
            $("#club_name_edit").focus();
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

                    club_name: club_name_edit,
                    club_id: club_id

                },
                success: function (text) {

                    //alert(text);

                    if (text == 3) {



                        $.notify("Club Updated", "success", {position: "top center"});


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

                    else if (text == 4) {
                        $.notify("Club name already exists",{position:"top center"});
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











    $("#btn_cancel_club").click(function () {


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

    });


</script>
