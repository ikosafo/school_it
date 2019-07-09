<?php include('../dbcon.php');

@session_start();
$session_id=$_POST['theindex'];

$query =$mysqli->query("select * from academic_session where id = '$session_id'");
$result = $query->fetch_assoc();
$id = $result['id'];

?>
<div class="row">

    <div class="col-md-12 col-sm-12">


        <input type="hidden" id="form_id" value="<?php echo $id; ;?>"/>



        <div class="form-group">
            <label
                class="control-label col-xs-12 col-sm-4 no-padding-right">Academic Year:</label>

            <div class="col-xs-12 col-sm-8">
                <div class="clearfix">
                    <input type="text" id="date_from_ed"
                           class="col-xs-12 col-sm-9"
                           value="<?php echo $result['year'] ?>" readonly/>
                </div>
            </div>

        </div>

        <hr/>

        <div class="form-group">
            <label
                class="control-label col-xs-12 col-sm-4 no-padding-right">Term:</label>

            <div class="col-xs-12 col-sm-8">
                <div class="clearfix">
                    <input type="text" id="date_from_ed"
                           class="col-xs-12 col-sm-9"
                           value="<?php echo $result['term'] ?>" readonly/>
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
                           class="col-xs-12 col-sm-9"
                           value="<?php echo $result['date_from'] ?>" readonly/>
                </div>
            </div>

        </div>

        <hr/>

        <div class="form-group">

            <label
                class="control-label col-xs-12 col-sm-4 no-padding-right">Date To:</label>

            <div class="col-xs-12 col-sm-8">
                <div class="clearfix">
                    <input type="text" id="date_from_ed"
                           class="col-xs-12 col-sm-9"
                           value="<?php echo $result['date_to'] ?>" readonly/>
                </div>
            </div>


        </div>



        <div class="form-group" style="padding-top: 7%">

            <label
                class="control-label col-xs-12 col-sm-4 no-padding-right">Term Begins:</label>

            <div class="col-xs-12 col-sm-8">
                <div class="clearfix">
                    <input type="text" id="date_from_ed"
                           class="col-xs-12 col-sm-9"
                           value="<?php echo $result['term_begins'] ?>" readonly/>
                </div>
            </div>


        </div>


        <div class="form-group" style="padding-top: 4%">

            <label
                class="control-label col-xs-12 col-sm-4 no-padding-right">Total Attendance:</label>

            <div class="col-xs-12 col-sm-8">
                <div class="clearfix">
                    <input type="text" id="date_from_ed"
                           class="col-xs-12 col-sm-9"
                           value="<?php echo $result['total_attendance'] ?>" readonly/>
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