<?php include('../dbcon.php');

@session_start();
$session_id=$_POST['theindex'];

$query =$mysqli->query("select * from academic_session where id = '$session_id'");
$result = $query->fetch_assoc();
$id = $result['id'];
$session_id = $result['session_id'];

?>
<div class="row">

    <div class="col-md-12 col-sm-12">


        <input type="hidden" id="form_id" value="<?php echo $id; ;?>"/>
        <input type="hidden" id="session_id" value="<?php echo $session_id; ;?>"/>




        <div class="form-group">
            <label
                class="control-label col-xs-12 col-sm-4 no-padding-right">Academic Year:</label>

            <div class="col-xs-12 col-sm-8">
                <div class="clearfix">
                    <select name="academic_year"
                            id="academic_year_ed"
                            class="select2">

                        <option value="">Select Academic Year</option>
                        <option <?php if(@$result['year'] == "2017/2018") echo "Selected" ?>>2017/2018</option>
                        <option <?php if(@$result['year'] == "2018/2019") echo "Selected" ?>>2018/2019</option>
                        <option <?php if(@$result['year'] == "2019/2020") echo "Selected" ?>>2019/2020</option>
                        <option <?php if(@$result['year'] == "2020/2021") echo "Selected" ?>>2020/2021</option>
                        <option <?php if(@$result['year'] == "2021/2022") echo "Selected" ?>>2021/2022</option>
                        <option <?php if(@$result['year'] == "2022/2023") echo "Selected" ?>>2022/2023</option>
                        <option <?php if(@$result['year'] == "2023/2024") echo "Selected" ?>>2023/2024</option>
                        <option <?php if(@$result['year'] == "2024/2025") echo "Selected" ?>>2024/2025</option>
                        <option <?php if(@$result['year'] == "2025/2026") echo "Selected" ?>>2025/2026</option>
                        <option <?php if(@$result['year'] == "2026/2027") echo "Selected" ?>>2026/2027</option>
                        <option <?php if(@$result['year'] == "2027/2028") echo "Selected" ?>>2027/2028</option>
                        <option <?php if(@$result['year'] == "2028/2029") echo "Selected" ?>>2028/2029</option>
                        <option <?php if(@$result['year'] == "2029/2030") echo "Selected" ?>>2029/2030</option>

                    </select>
                </div>
            </div>

        </div>

        <hr/>

        <div class="form-group">
            <label
                class="control-label col-xs-12 col-sm-4 no-padding-right">Term:</label>

            <div class="col-xs-12 col-sm-8">
                <div class="clearfix">
                    <select name="term"
                            id="term_ed"
                            class="select2">
                        <option <?php if(@$result['term'] == "Term One") echo "Selected" ?>>Term One</option>
                        <option <?php if(@$result['term'] == "Term Two") echo "Selected" ?>>Term Two</option>
                        <option <?php if(@$result['term'] == "Term Three") echo "Selected" ?>>Term Three</option>
                    </select>
                </div>
            </div>


        </div>

        <hr/>

        <div class="form-group" style="padding-top: 3%">
            <label
                class="control-label col-xs-12 col-sm-4 no-padding-right">Date From:</label>

            <div class="col-xs-12 col-sm-8">
                <div class="clearfix">
                    <input type="text" id="date_from_ed"
                           class="col-xs-12 col-sm-9  date-picker" data-date-format="yyyy-mm-dd"
                        value="<?php echo $result['date_from'] ?>"/>
                </div>
            </div>

        </div>

        <hr/>

        <div class="form-group">

            <label
                class="control-label col-xs-12 col-sm-4 no-padding-right">Date To:</label>

            <div class="col-xs-12 col-sm-8">
                <div class="clearfix">
                    <input type="text" id="date_to_ed"
                           class="col-xs-12 col-sm-9  date-picker" data-date-format="yyyy-mm-dd"
                           value="<?php echo $result['date_to'] ?>"/>
                </div>
            </div>


        </div>



        <div class="form-group" style="padding-top: 7%">

            <label
                class="control-label col-xs-12 col-sm-4 no-padding-right">Term Begins:</label>

            <div class="col-xs-12 col-sm-8">
                <div class="clearfix">
                    <input type="text" id="term_begins"
                           class="col-xs-12 col-sm-9  date-picker" data-date-format="yyyy-mm-dd"
                           value="<?php echo $result['term_begins'] ?>"/>
                </div>
            </div>


        </div>


        <div class="form-group" style="padding-top: 4%">

            <label
                class="control-label col-xs-12 col-sm-4 no-padding-right">Total Attendance:</label>

            <div class="col-xs-12 col-sm-8">
                <div class="clearfix">
                    <input type="text" id="total_attendance_ed"
                           class="col-xs-12 col-sm-9"
                           value="<?php echo $result['total_attendance'] ?>"/>
                </div>
            </div>


        </div>



        <div class="space-4"></div>

    </div>
</div>

<script>


    $('.date-picker').datepicker({
        autoclose: true,
        todayHighlight: true
    });


    $('.select2').css('width','200px').select2({allowClear:true})
    $('#select2-multiple-style .btn').on('click', function(e){
        var target = $(this).find('input[type=radio]');
        var which = parseInt(target.val());
        if(which == 2) $('.select2').addClass('tag-input-style');
        else $('.select2').removeClass('tag-input-style');
    });

</script>