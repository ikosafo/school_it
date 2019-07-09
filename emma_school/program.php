<?php include('top.php'); ?>

<div class="main-content-inner">
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try {
                ace.settings.check('breadcrumbs', 'fixed')
            } catch (e) {
            }
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Home</a>
            </li>

            <li>
                <a href="#">Configuration</a>
            </li>
            <li class="active">Program</li>
        </ul>
        <!-- /.breadcrumb -->


        <!-- /.nav-search -->
    </div>
</div>

<p style="padding-top: 5%"></p>


<div id="here"></div>


<?php include('bottom.php'); ?>


<script type="text/javascript">

    $(document).ready(function () {

        $.ajax({
            url: "ajax/program_table.php",
            beforeSend: function () {
                $.blockUI({
                    message: '<h3><img src="busy.gif" /> Please Wait...</h3>'
                });
            },
            success: function (text) {
                $('#here').html(text);
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
