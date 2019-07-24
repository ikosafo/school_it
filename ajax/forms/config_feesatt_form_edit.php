<?php

include('../../config.php');

$id = $_POST['id_index'];

$getdetails = $mysqli->query("select * from fees_attendance where id = '$id'");
$resdetails = $getdetails->fetch_assoc();


?>

<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>


<div class="card m-b-30">

    <div class="card-header bg-white">
        <h5 class="card-title text-black">Update Fees and Attendance</h5>
    </div>
    <div class="card-body">

        <label for="academicyear">Academic Year</label>
        <div class="input-group mb-3">
            <select id="academicyear" style="width: 100%" disabled>
                <option value="">Select Academic Year</option>

                <option <?php if (@$resdetails['academicyear'] == "2018/2019") echo "Selected" ?>>2018 / 2019</option>
                <option <?php if (@$resdetails['academicyear'] == "2019/2020") echo "Selected" ?>>2019 / 2020</option>
                <option <?php if (@$resdetails['academicyear'] == "2020/2021") echo "Selected" ?>>2020 / 2021</option>
                <option <?php if (@$resdetails['academicyear'] == "2021/2022") echo "Selected" ?>>2021 / 2022</option>
                <option <?php if (@$resdetails['academicyear'] == "2022/2023") echo "Selected" ?>>2022 / 2023</option>
                <option <?php if (@$resdetails['academicyear'] == "2023/2024") echo "Selected" ?>>2023 / 2024</option>
                <option <?php if (@$resdetails['academicyear'] == "2024/2025") echo "Selected" ?>>2024 / 2025</option>
                <option <?php if (@$resdetails['academicyear'] == "2025/2026") echo "Selected" ?>>2025 / 2026</option>
                <option <?php if (@$resdetails['academicyear'] == "2026/2027") echo "Selected" ?>>2026 / 2027</option>
                <option <?php if (@$resdetails['academicyear'] == "2027/2028") echo "Selected" ?>>2027 / 2028</option>
                <option <?php if (@$resdetails['academicyear'] == "2028/2029") echo "Selected" ?>>2028 / 2029</option>
                <option <?php if (@$resdetails['academicyear'] == "2029/2030") echo "Selected" ?>>2029 / 2030</option>
                <option <?php if (@$resdetails['academicyear'] == "2030/2031") echo "Selected" ?>>2030 / 2031</option>
                <option <?php if (@$resdetails['academicyear'] == "2031/2032") echo "Selected" ?>>2031 / 2032</option>
                <option <?php if (@$resdetails['academicyear'] == "2032/2033") echo "Selected" ?>>2032 / 2033</option>
                <option <?php if (@$resdetails['academicyear'] == "2033/2034") echo "Selected" ?>>2033 / 2034</option>
                <option <?php if (@$resdetails['academicyear'] == "2034/2035") echo "Selected" ?>>2034 / 2035</option>
                <option <?php if (@$resdetails['academicyear'] == "2035/2036") echo "Selected" ?>>2035 / 2036</option>
                <option <?php if (@$resdetails['academicyear'] == "2036/2037") echo "Selected" ?>>2036 / 2037</option>
                <option <?php if (@$resdetails['academicyear'] == "2037/2038") echo "Selected" ?>>2037 / 2038</option>
                <option <?php if (@$resdetails['academicyear'] == "2038/2039") echo "Selected" ?>>2038 / 2039</option>
                <option <?php if (@$resdetails['academicyear'] == "2039/2040") echo "Selected" ?>>2039 / 2040</option>
                <option <?php if (@$resdetails['academicyear'] == "2040/2041") echo "Selected" ?>>2040 / 2041</option>
                <option <?php if (@$resdetails['academicyear'] == "2041/2042") echo "Selected" ?>>2041 / 2042</option>
                <option <?php if (@$resdetails['academicyear'] == "2042/2043") echo "Selected" ?>>2042 / 2043</option>
                <option <?php if (@$resdetails['academicyear'] == "2043/2044") echo "Selected" ?>>2043 / 2044</option>
                <option <?php if (@$resdetails['academicyear'] == "2044/2045") echo "Selected" ?>>2044 / 2045</option>
                <option <?php if (@$resdetails['academicyear'] == "2045/2046") echo "Selected" ?>>2045 / 2046</option>
                <option <?php if (@$resdetails['academicyear'] == "2046/2047") echo "Selected" ?>>2046 / 2047</option>
                <option <?php if (@$resdetails['academicyear'] == "2047/2048") echo "Selected" ?>>2047 / 2048</option>
                <option <?php if (@$resdetails['academicyear'] == "2048/2049") echo "Selected" ?>>2048 / 2049</option>
                <option <?php if (@$resdetails['academicyear'] == "2049/2050") echo "Selected" ?>>2049 / 2050</option>

            </select>
        </div>


        <label for="academicterm">Term</label>
        <div class="input-group mb-3">
            <select id="academicterm" style="width: 100%" disabled>
                <option value="">Select Term</option>

                <option <?php if (@$resdetails['term'] == "Term One") echo "Selected" ?>>Term One</option>
                <option <?php if (@$resdetails['term'] == "Term Two") echo "Selected" ?>>Term Two</option>
                <option <?php if (@$resdetails['term'] == "Term Three") echo "Selected" ?>>Term Three</option>

            </select>
        </div>


        <label for="department">Department</label>
        <div class="input-group mb-3">
            <select id="department" style="width: 100%">
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


        <label for="schoolfees">Fees</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-money"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Fees"
                   id="schoolfees" onkeypress="return isNumber(event)" value="<?php echo $resdetails['schoolfees']; ?>">
        </div>


        <label for="attendance">Attendance</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-check-circle-o"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Attendance"
                   id="attendance" onkeypress="return isNumber(event)" value="<?php echo $resdetails['attendance']; ?>">
        </div>


        <div class="input-group-append mb-3 mt-lg-5">

            <button class="btn btn-secondary mr-2"  type="button" id="btn_cancel_feesatt">Cancel</button>
            <button class="btn btn-warning ml-2" type="button" id="btn_update_feesatt">Update</button>

        </div>

    </div>
</div>


<script>


    $("#academicyear").select2({
        placeholder: 'Select Academic Year'
    });

    $("#academicterm").select2({
        placeholder: 'Select Academic Term'
    });

    $("#department").select2({
        placeholder: 'Select Department'
    });



    $("#btn_cancel_feesatt").click(function () {


        $.ajax({
            type: "POST",
            url: "ajax/forms/config_feesatt_form.php",
            beforeSend: function () {
                $.blockUI({
                    message: '<img src="assets/images/load.gif"/>'
                });
            },
            success: function (text) {
                $('#feesatt_form_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                $.unblockUI();
            },

        });

    });



    $("#btn_update_feesatt").click(function () {

        var academic_year = $("#academicyear").val();
        var academic_term = $("#academicterm").val();
        var department = $("#department").val();
        var schoolfees = $("#schoolfees").val();
        var attendance = $("#attendance").val();
        var fid = '<?php echo $id; ?>';

        //alert(department);

        var error = '';


        if (academic_year == "") {
            error += 'Please select academic year \n';
        }

        if (academic_term == "") {
            error += 'Please select academic term \n';
        }

        if (department == "") {
            error += 'Please select department \n';
        }

        if (schoolfees == "") {
            error += 'Please enter fees \n';
            $('#schoolfees').focus()
        }

        if (attendance == "") {
            error += 'Please enter attendance \n';
            $('#attendance').focus()
        }


        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_feesatt_edit.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/images/load.gif"/>'
                    });
                },
                data: {

                    academic_year: academic_year,
                    academic_term: academic_term,
                    department: department,
                    schoolfees: schoolfees,
                    attendance: attendance,
                    fid:fid

                },
                success: function (text) {

                    //alert(text);

                    if (text == 1) {

                        $.notify("Academic Session Updated", "success", {position: "top center"});


                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/config_feesatt_form.php",
                            beforeSend: function () {

                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });

                            },
                            success: function (text) {
                                $('#feesatt_form_div').html(text);
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
                            url: "ajax/tables/config_feesatt_table.php",
                            beforeSend: function () {

                                $.blockUI({
                                    message: '<img src="assets/images/load.gif"/>'
                                });

                            },
                            success: function (text) {
                                $('#feesatt_table_div').html(text);
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

                        $.notify("Date Started is already in session,", {position: "top center"});

                    }

                    else if (text == 3) {

                        $.notify("Session details already exists,", {position: "top center"});

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
