


</div><!-- /.page-content -->
</div>
</div><!-- /.main-content -->

<?php include('include/footer.php'); ?>

</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script src="assets/js/jquery.2.1.1.min.js"></script>

<!-- <![endif]-->


<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!-- ace scripts -->
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/jquery.blockui.min.js"></script>
<script src="assets/js/sweetalert.js"></script>
<script src="assets/js/notify.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="assets/js/dataTables.tableTools.min.js"></script>
<script src="assets/js/dataTables.colVis.min.js"></script>




<!--[if lte IE 8]>
<script src="assets/js/excanvas.min.js"></script>
<![endif]-->
<script src="assets/js/jquery-ui.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/jquery.easypiechart.min.js"></script>
<script src="assets/js/jquery.sparkline.min.js"></script>
<script src="assets/js/jquery.flot.min.js"></script>
<script src="assets/js/jquery.flot.pie.min.js"></script>
<script src="assets/js/jquery.flot.resize.min.js"></script>
<script src="assets/js/fuelux.wizard.min.js"></script>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/additional-methods.min.js"></script>
<script src="assets/js/bootbox.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/bootstrap-timepicker.min.js"></script>
<script src="assets/js/daterangepicker.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/typeahead.jquery.min.js"></script>
<!-- ace scripts -->
<script src="uploadify/jquery.uploadifive.js"></script>

<script src="assets/js/jquery.colorbox.min.js"></script>


<!-- page specific plugin scripts -->




<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($) {
        $('#sidebar2').insertBefore('.page-content');

        $('.navbar-toggle[data-target="#sidebar2"]').insertAfter('#menu-toggler');


        $(document).on('settings.ace.two_menu', function(e, event_name, event_val) {
            if(event_name == 'sidebar_fixed') {
                if( $('#sidebar').hasClass('sidebar-fixed') ) {
                    $('#sidebar2').addClass('sidebar-fixed');
                    $('#navbar').addClass('h-navbar');
                }
                else {
                    $('#sidebar2').removeClass('sidebar-fixed')
                    $('#navbar').removeClass('h-navbar');
                }
            }
        }).triggerHandler('settings.ace.two_menu', ['sidebar_fixed' ,$('#sidebar').hasClass('sidebar-fixed')]);
    })
</script>
</body>
</html>

