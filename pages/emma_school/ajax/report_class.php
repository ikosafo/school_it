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

            var stud_class = $("#class").val();


            $.ajax({
                type: "POST",
                url: "ajax/class_terminal_report.php",
                data: {

                    stud_class: stud_class

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