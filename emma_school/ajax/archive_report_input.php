<?php include('../dbcon.php');

?>


<select name="academic_year"
        id="academic_year"
        class="select2">
    <option value="">
        Select Academic Year
    </option>
    <option value="2017/2018">2017 / 2018</option>
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

</select>

<p style="padding-top: 5%"></p>



<select name="term"
        id="term"
        class="select2">
    <option value="">
        Select Term
    </option>
    <option value="Term One">Term One</option>
    <option value="Term Two">Term Two</option>
    <option value="Term Three">Term Three</option>
</select>

<p style="padding-top: 5%"></p>


<select id="class"
        class="select2"
        data-placeholder="Click to Choose Class...">
    <option value=""></option>


    <?php $que = $mysqli->query("select * from department order by id");

    while ($fet = $que->fetch_assoc()) {

        ?>


        <optgroup label="<?php echo $dept = $fet['name'] ?>">

            <?php
            $sql = "select * from `class` where department = '$dept'";
            $res = $mysqli->query($sql);
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_object($res)) {
                    echo "<option value='" . $row->name . "'>" . $row->name . "</option>";
                }
            }
            ?>

        </optgroup>

        <?php
    }
    ?>


</select>


<p style="padding-top: 5%"></p>

<select id="student_name"
        class="select2"
        data-placeholder="Click to Choose Student Name...">
    <option></option>
</select>


<script>


    $('.select2').css('width', '200px').select2({allowClear: true})
    $('#select2-multiple-style .btn').on('click', function (e) {
        var target = $(this).find('input[type=radio]');
        var which = parseInt(target.val());
        if (which == 2) $('.select2').addClass('tag-input-style');
        else $('.select2').removeClass('tag-input-style');
    });


    $(document).ready(function () {

        $("#class").change(function () {
            var course_class = $(this).val();
            if (course_class != "") {

                $.ajax({
                    url: "ajax/get_student.php",
                    data: {c_id: course_class},
                    type: 'POST',
                    beforeSend: function () {
                        $.blockUI({
                            message: '<h3><img src="../busy.gif" /> Please Wait...</h3>'
                        });
                    },
                    success: function (response) {
                        var resp = $.trim(response);
                        $("#student_name").html(resp);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " " + thrownError);
                    },
                    complete: function () {
                        $.unblockUI();
                    },
                });
            } else {
                $("#student_name").html("<option value=''></option>");
            }
        });


    });


    $(document).ready(function () {

        $("#student_name").change(function () {

            var student_name = $("#student_name").val();
            var academic_year = $("#academic_year").val();
            var term = $("#term").val();

            $.ajax({
                type: "POST",
                url: "ajax/archive_student_terminal_report.php",
                data: {

                    student_id: student_name,
                    academic_year:academic_year,
                    term:term

                },
                success: function (text) {

                    $('#marks_here').html(text);

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },

            });


        });


    });



</script>