<?php

include('../../config.php');

$id = $_POST['id_index'];

$getdetails = $mysqli->query("select * from grading where id = '$id'");
$resdetails = $getdetails->fetch_assoc();



?>

<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>



<div class="card m-b-30">

    <div class="card-header bg-white">
        <h5 class="card-title text-black">Update Grading Configuration</h5>
    </div>
    <div class="card-body">

        <label for="department">Department</label>
        <div class="input-group mb-3">
            <select id="department" style="width: 100%" disabled>
                <option value="">Select Department</option>


                <?php
                $departmentid = $resdetails['department'];

                $query = $mysqli->query("select * from department ORDER BY department_name");
                while ($result = $query->fetch_assoc()) { ?>
                    <option <?php if (@$departmentid == @$result['id']) echo "Selected" ?>>
                        <?php echo $result['department_name'] ?></option>
                <?php } ?>


            </select>
        </div>


        <label for="markfrom">Marks From</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-pencil-square-o"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Mark"
                   id="markfrom" onkeypress="return isNumber(event)" autocomplete="off"
                   value="<?php echo $resdetails['markfrom'] ?>">
        </div>


        <label for="markto">Marks To</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-pencil-square-o"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Mark" autocomplete="off"
                   id="markto" onkeypress="return isNumber(event)"
                   value="<?php echo $resdetails['markto'] ?>">
        </div>


        <label for="computinggrade">Grade for Computing</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-pencil"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Grade" autocomplete="off"
                   id="computinggrade" onkeypress="return isNumber(event)"
                   value="<?php echo $resdetails['grade'] ?>">
        </div>


        <label for="displaygrade">Grade to Display</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-check"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Grade" autocomplete="off"
                   id="displaygrade" value="<?php echo $resdetails['displaygrade'] ?>">
        </div>


        <label for="remark">Remark</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-comment-o"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Remark" autocomplete="off"
                   id="remark" value="<?php echo $resdetails['remark'] ?>">
        </div>



        <div class="input-group-append mb-3 mt-lg-5">

            <button class="btn btn-secondary mr-2"  type="button" id="btn_cancel_grading">Cancel</button>
            <button class="btn btn-warning ml-2" type="button" id="btn_update_grading">Update</button>

        </div>



    </div>
</div>


<script>

    $("#department").select2({
        placeholder: 'Select Department'
    });



    $("#btn_save_grading").click(function () {

        var department = $("#department").val();
        var markfrom = $("#markfrom").val();
        var markto = $("#markto").val();
        var remark = $("#remark").val();
        var displaygrade = $("#displaygrade").val();
        var computinggrade = $("#computinggrade").val();
        var gradeid = '<?php echo $id; ?>';



        //alert(sum);

        var error = '';


        if (department == "") {
            error += 'Please select department \n';
        }

        if (markfrom == "") {
            error += 'Please enter mark from \n';
            $('#markfrom').focus()
        }

        if (markto == "") {
            error += 'Please enter mark to \n';
            $('#markto').focus()
        }

        if (computinggrade == "") {
            error += 'Please enter grade for computing \n';
            $('#computinggrade').focus()
        }

        if (displaygrade == "") {
            error += 'Please enter grade to display \n';
            $('#displaygrade').focus()
        }

        if (remark == "") {
            error += 'Please enter remark \n';
            $('#remark').focus()
        }




        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_grading_edit.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/images/load.gif"/>'
                    });
                },
                data: {

                    department:department,
                    markfrom:markfrom,
                    markto:markto,
                    remark:remark,
                    displaygrade:displaygrade,
                    computinggrade:computinggrade,
                    gradeid:gradeid

                },
                success: function (text) {

                    alert(text);

                    if (text == 1) {

                        $.notify("Grade Configuration Updated", "success", {position: "top center"});


                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/config_grading_form.php",
                            beforeSend: function () {

                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });

                            },
                            success: function (text) {
                                $('#grading_form_div').html(text);
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
                            url: "ajax/tables/config_grading_table.php",
                            beforeSend: function () {

                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });

                            },
                            success: function (text) {
                                $('#grading_table_div').html(text);
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

                        $.notify("Configuration for department already exist", {position: "top center"});

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






    $("#btn_cancel_grading").click(function () {


        $.ajax({
            type: "POST",
            url: "ajax/forms/config_grading_form.php",
            beforeSend: function () {
                $.blockUI({
                    message: '<img src="assets/images/load.gif"/>'
                });
            },
            success: function (text) {
                $('#grading_form_div').html(text);
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
