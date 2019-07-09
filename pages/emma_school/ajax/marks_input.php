<?php include('../dbcon.php');

?>


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


<p style="padding-top: 10%"></p>

<select id="course"
        class="select2"
        data-placeholder="Click to Choose Course...">
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
                    url: "ajax/get_course.php",
                    data: {c_id: course_class},
                    type: 'POST',
                    beforeSend: function () {
                        $.blockUI({
                            message: '<h3><img src="../busy.gif" /> Please Wait...</h3>'
                        });
                    },
                    success: function (response) {
                        var resp = $.trim(response);
                        $("#course").html(resp);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " " + thrownError);
                    },
                    complete: function () {
                        $.unblockUI();
                    },
                });
            } else {
                $("#course").html("<option value=''></option>");
            }
        });


    });


    $(document).ready(function () {

        $("#course").change(function () {

            var course_class = $("#class").val();
            var course = $("#course").val();

            $.ajax({
                type: "POST",
                url: "ajax/marks_input_table.php",
                data: {

                    course: course,
                    course_class: course_class

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