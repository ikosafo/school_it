<?php

include('../../config.php');

$id = $_POST['id_index'];

$getdetails = $mysqli->query("select * from assessment_config where id = '$id'");
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
        <h5 class="card-title text-black">Update Assessment Configuration</h5>
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


        <label for="classmark">Class Mark/Score</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-pencil-square-o"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Mark"
                   id="classmark" onkeypress="return isNumber(event)" autocomplete="off"
            value="<?php echo $resdetails['classmark'] ?>">
        </div>


        <label for="exammark">Exam Mark/Score</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-pencil-square-o"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Mark" autocomplete="off"
                   id="exammark" onkeypress="return isNumber(event)"
                   value="<?php echo $resdetails['exammark'] ?>">
        </div>



        <div class="input-group-append mb-3 mt-lg-5">

            <button class="btn btn-secondary mr-2"  type="button" id="btn_cancel_assessment">Cancel</button>
            <button class="btn btn-warning ml-2" type="button" id="btn_update_assessment">Update</button>

        </div>



    </div>
</div>


<script>

    $("#department").select2({
        placeholder: 'Select Department'
    });



    $("#btn_update_assessment").click(function () {

        var department = $("#department").val();
        var classmark = $("#classmark").val();
        var exammark = $("#exammark").val();
        var sum = parseInt(classmark) + parseInt(exammark);
        var assid = '<?php echo $id ?>';


        //alert(sum);

        var error = '';


        if (department == "") {
            error += 'Please select department \n';
        }

        if (classmark == "") {
            error += 'Please enter class mark \n';
            $('#classmark').focus()
        }

        if (exammark == "") {
            error += 'Please enter exam mark \n';
            $('#exammark').focus()
        }

        if (sum != 100) {
            error += 'Sum is not up to 100% \n';
            $('#classmark').focus()
        }





        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_assessment_edit.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/images/load.gif"/>'
                    });
                },
                data: {

                    department: department,
                    classmark: classmark,
                    exammark: exammark,
                    assid:assid

                },
                success: function (text) {

                    //alert(text);

                    if (text == 1) {

                        $.notify("Assessment Configuration Updated", "success", {position: "top center"});


                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/config_assessment_form.php",
                            beforeSend: function () {

                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });

                            },
                            success: function (text) {
                                $('#assessment_form_div').html(text);
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
                            url: "ajax/tables/config_assessment_table.php",
                            beforeSend: function () {

                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });

                            },
                            success: function (text) {
                                $('#assessment_table_div').html(text);
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




    $("#btn_cancel_assessment").click(function () {


        $.ajax({
            type: "POST",
            url: "ajax/forms/config_assessment_form.php",
            beforeSend: function () {
                $.blockUI({
                    message: '<img src="assets/images/load.gif"/>'
                });
            },
            success: function (text) {
                $('#assessment_form_div').html(text);
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
