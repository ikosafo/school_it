<?php

include('../../config.php');

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
        <h5 class="card-title text-black">Enter Assessment Configuration</h5>
    </div>
    <div class="card-body">

        <label for="department">Department</label>
        <div class="input-group mb-3">
            <select id="department" style="width: 100%">
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


        <label for="classmark">Class Mark/Score</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-pencil-square-o"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Mark"
                   id="classmark" onkeypress="return isNumber(event)" autocomplete="off">
        </div>


        <label for="exammark">Exam Mark/Score</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-pencil-square-o"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Mark" autocomplete="off"
                   id="exammark" onkeypress="return isNumber(event)">
        </div>




        <div class="input-group-append mb-3 mt-lg-5">
            <button class="btn btn-primary" type="button" id="btn_save_assessment">Submit</button>
        </div>


    </div>
</div>


<script>

    $("#department").select2({
        placeholder: 'Select Department'
    });



    $("#btn_save_assessment").click(function () {

        var department = $("#department").val();
        var classmark = $("#classmark").val();
        var exammark = $("#exammark").val();
        var sum = parseInt(classmark) + parseInt(exammark);


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
                url: "ajax/queries/saveform_assessment.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/images/load.gif"/>'
                    });
                },
                data: {

                    department: department,
                    classmark: classmark,
                    exammark: exammark

                },
                success: function (text) {

                    //alert(text);

                    if (text == 1) {

                        $.notify("Assessment Configuration Saved", "success", {position: "top center"});


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


</script>
