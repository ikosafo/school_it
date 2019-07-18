<?php

include('../../config.php');

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
        <h5 class="card-title text-black">Enter Fees and Attendance</h5>
    </div>
    <div class="card-body">

        <label for="academicyear">Academic Year</label>
        <div class="input-group mb-3">
            <select id="academicyear" style="width: 100%">
                <option value="">Select Academic Year</option>

                <option value="2018/2019">2018 / 2019</option>
                <option value="2019/2020">2019 / 2020</option>
                <option value="2020/2021">2020 / 2021</option>
                <option value="2021/2022">2021 / 2022</option>
                <option value="2022/2023">2022 / 2023</option>
                <option value="2023/2024">2023 / 2024</option>
                <option value="2024/2025">2024 / 2025</option>
                <option value="2025/2026">2025 / 2026</option>
                <option value="2026/2027">2026 / 2027</option>
                <option value="2027/2028">2027 / 2028</option>
                <option value="2028/2029">2028 / 2029</option>
                <option value="2029/2030">2029 / 2030</option>
                <option value="2030/2031">2030 / 2031</option>
                <option value="2031/2032">2031 / 2032</option>
                <option value="2032/2033">2032 / 2033</option>
                <option value="2033/2034">2033 / 2034</option>
                <option value="2034/2035">2034 / 2035</option>
                <option value="2035/2036">2035 / 2036</option>
                <option value="2036/2037">2036 / 2037</option>
                <option value="2037/2038">2037 / 2038</option>
                <option value="2038/2039">2038 / 2039</option>
                <option value="2039/2040">2039 / 2040</option>
                <option value="2040/2041">2040 / 2041</option>
                <option value="2041/2042">2041 / 2042</option>
                <option value="2042/2043">2042 / 2043</option>
                <option value="2043/2044">2043 / 2044</option>
                <option value="2044/2045">2044 / 2045</option>
                <option value="2045/2046">2045 / 2046</option>
                <option value="2046/2047">2046 / 2047</option>
                <option value="2047/2048">2047 / 2048</option>
                <option value="2048/2049">2048 / 2049</option>
                <option value="2049/2050">2049 / 2050</option>

            </select>
        </div>


        <label for="academicterm">Term</label>
        <div class="input-group mb-3">
            <select id="academicterm" style="width: 100%">
                <option value="">Select Term</option>

                <option value="Term One">Term One</option>
                <option value="Term Two">Term Two</option>
                <option value="Term Three">Term Three</option>

            </select>
        </div>


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


        <label for="schoolfees">Fees</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-money"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Fees"
                   id="schoolfees" onkeypress="return isNumber(event)">
        </div>


        <label for="attendance">Attendance</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-check-circle-o"></i> </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Attendance"
                   id="attendance" onkeypress="return isNumber(event)">
        </div>




        <div class="input-group-append mb-3 mt-lg-5">
            <button class="btn btn-primary" type="button" id="btn_save_feesatt">Submit</button>
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



    $("#btn_save_feesatt").click(function () {

        var academic_year = $("#academicyear").val();
        var academic_term = $("#academicterm").val();
        var department = $("#department").val();
        var schoolfees = $("#schoolfees").val();
        var attendance = $("#attendance").val();

        //alert(academicyear);

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
                url: "ajax/queries/saveform_feesatt.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/images/load.gif"/>'
                    });
                },
                data: {

                    academic_year : academic_year,
                    academic_term: academic_term,
                    department: department,
                    schoolfees: schoolfees,
                    attendance: attendance

                },
                success: function (text) {

                    //alert(text);

                    if (text == 1) {

                        $.notify("Academic Session Saved", "success", {position: "top center"});


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
