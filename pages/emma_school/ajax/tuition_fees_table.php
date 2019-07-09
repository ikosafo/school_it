<?php include('../dbcon.php');

@session_start();


$qucel=$mysqli->query("select * from tuition_fees ORDER BY year DESC, term DESC, department,id DESC");


?>

<script>
    function checkDec(el){
        var ex = /^[0-9]+\.?[0-9]*$/;
        if(ex.test(el.value)==false){
            el.value = el.value.substring(0,el.value.length - 1);
        }
    }
</script>


<a href="#modal-form_fees" role="button" class="blue"
   data-toggle="modal">
    <button type="submit"
            class="btn btn-sm btn-primary btn-white btn-round">

        <i class="icon-on-right ace-icon fa fa-plus-circle"></i>

        <span class="bigger-110">New Fees</span>
    </button>
</a>

<p></p>
<p></p>
<p></p>




<div id="modal-form_fees" class="modal fade" tabindex="-1">
    <div class="modal-dialog" id="error_loc_fees">
        <form method="post" action="" name="fees_form"
              id="dep_form" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger">Please fill the
                        following form fields</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12 col-sm-12">


                            <?php $todate = date("Y-m-d");
                            $random_id = rand(1, 1000000).$todate?>
                            <input type="hidden" id="session_id" value="<?php echo $random_id; ;?>"/>



                            <div class="form-group">
                                <label
                                    class="control-label col-xs-12 col-sm-4 no-padding-right">Academic Year:</label>

                                <div class="col-xs-12 col-sm-8">
                                    <div class="clearfix">
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
                                                id="term"
                                                class="select2">
                                            <option value="">
                                                Select Term
                                            </option>
                                            <option value="Term One">Term One</option>
                                            <option value="Term Two">Term Two</option>
                                            <option value="Term Three">Term Three</option>
                                        </select>
                                    </div>
                                </div>


                            </div>


                            <hr/>


                            <div class="form-group" style="padding-top:4%">

                                <label
                                    class="control-label col-xs-12 col-sm-4 no-padding-right">Department:</label>

                                <div class="col-xs-12 col-sm-8">
                                    <div class="clearfix">
                                        <select id="dept"
                                                class="select2"
                                                data-placeholder="Click to Choose..."
                                                required>
                                            <option value="">&nbsp;</option>
                                            <?php
                                            $cl_name = $mysqli->query("SELECT * FROM department ORDER BY id");
                                            while ($row=$cl_name->fetch_assoc()) {
                                                ?>
                                                <?php echo '<option value="' . $row['name'] . '"';

                                                echo '> ' . $row['name'] . '</option>';
                                                //   echo $row['sign_name'];
                                                ?>


                                                <?php

                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>


                            </div>

                            <div class="space-4"></div>


                            <div class="form-group" style="padding-top: 4%">

                                <label
                                    class="control-label col-xs-12 col-sm-4 no-padding-right">Tuition Fees:</label>

                                <div class="col-xs-12 col-sm-8">
                                    <div class="clearfix">
                                        <input type="text" id="amount"
                                               class="col-xs-12 col-sm-9"
                                               onkeyup="checkDec(this);"
                                            />
                                    </div>
                                </div>


                            </div>



                            <div class="space-4"></div>



                            <div class="form-group" style="padding-top: 4%">

                                <label
                                    class="control-label col-xs-12 col-sm-4 no-padding-right">Attendance:</label>

                                <div class="col-xs-12 col-sm-8">
                                    <div class="clearfix">
                                        <input type="text" id="attendance"
                                               class="col-xs-12 col-sm-9"
                                               onkeyup="checkDec(this);"
                                            />
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-sm"
                            data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Cancel
                    </button>

                    <button class="btn btn-sm btn-primary"
                            type="submit"
                            id="save_fees_btn">
                        <i class="ace-icon fa fa-check"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>





<table id="" class="table table-striped table-bordered table-hover dynamic-table">
    <thead>
    <tr>

        <th align="center">Academic Year</th>
        <th align="center">Term</th>
        <th align="center">Department</th>
        <th align="center">Tuition Fee</th>
        <th align="center">Attendance</th>


        <th align="center" style="text-align: center">Action</th>

    </tr>
    </thead>

    <tbody>

    <?php
    while($fet_cel=$qucel->fetch_assoc())
    {

        ?>

        <tr>



            <td><?php echo $fet_cel['year'];?></td>
            <td><?php echo $fet_cel['term'];?></td>
            <td><?php echo $fet_cel['department'];?></td>
            <td><?php echo $fet_cel['amount'];?></td>
            <td><?php echo $fet_cel['attendance'];?></td>

            <td align="center">
                <a href="#" class="delete_fee" i_index="<?php echo $fet_cel['id'];?>">
                    Delete</a></td>


        </tr>

        <?php
    }
    ?>

    </tbody>
</table>


<script type="text/javascript">
    jQuery(function($) {
        //initiate dataTables plugin
        var oTable1 =
            $('.dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable( {
                    bAutoWidth: false,
                    "aoColumns": [
                        { "bSortable": false },
                        null, null,null, null, null,
                        { "bSortable": false }
                    ],
                    "aaSorting": [],

                    //,
                    //"sScrollY": "200px",
                    //"bPaginate": false,

                    //"sScrollX": "100%",
                    //"sScrollXInner": "120%",
                    //"bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                    //"iDisplayLength": 50
                } );
        //oTable1.fnAdjustColumnSizing();


        //TableTools settings
        TableTools.classes.container = "btn-group btn-overlap";
        TableTools.classes.print = {
            "body": "DTTT_Print",
            "info": "tableTools-alert gritter-item-wrapper gritter-info gritter-center white",
            "message": "tableTools-print-navbar"
        }

        //initiate TableTools extension
        var tableTools_obj = new $.fn.dataTable.TableTools( oTable1, {
            "sSwfPath": "assets/swf/copy_csv_xls_pdf.swf",

            "sRowSelector": "td:not(:last-child)",
            "sRowSelect": "multi",
            "fnRowSelected": function(row) {
                //check checkbox when row is selected
                try { $(row).find('input[type=checkbox]').get(0).checked = true }
                catch(e) {}
            },
            "fnRowDeselected": function(row) {
                //uncheck checkbox
                try { $(row).find('input[type=checkbox]').get(0).checked = false }
                catch(e) {}
            },

            "sSelectedClass": "success",
            "aButtons": [
                {
                    "sExtends": "copy",
                    "sToolTip": "Copy to clipboard",
                    "sButtonClass": "btn btn-white btn-primary btn-bold",
                    "sButtonText": "<i class='fa fa-copy bigger-110 pink'></i>",
                    "fnComplete": function() {
                        this.fnInfo( '<h3 class="no-margin-top smaller">Table copied</h3>\
									<p>Copied '+(oTable1.fnSettings().fnRecordsTotal())+' row(s) to the clipboard.</p>',
                            1500
                        );
                    }
                },

                {
                    "sExtends": "csv",
                    "sToolTip": "Export to CSV",
                    "sButtonClass": "btn btn-white btn-primary  btn-bold",
                    "sButtonText": "<i class='fa fa-file-excel-o bigger-110 green'></i>"
                },

                {
                    "sExtends": "pdf",
                    "sToolTip": "Export to PDF",
                    "sButtonClass": "btn btn-white btn-primary  btn-bold",
                    "sButtonText": "<i class='fa fa-file-pdf-o bigger-110 red'></i>"
                },

                {
                    "sExtends": "print",
                    "sToolTip": "Print view",
                    "sButtonClass": "btn btn-white btn-primary  btn-bold",
                    "sButtonText": "<i class='fa fa-print bigger-110 grey'></i>",

                    "sMessage": "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand' href='#'><small>Optional Navbar &amp; Text</small></a></div></div>",

                    "sInfo": "<h3 class='no-margin-top'>Print view</h3>\
									  <p>Please use your browser's print function to\
									  print this table.\
									  <br />Press <b>escape</b> when finished.</p>",
                }
            ]
        } );
        //we put a container before our table and append TableTools element to it
        $(tableTools_obj.fnContainer()).appendTo($('.tableTools-container'));

        //also add tooltips to table tools buttons
        //addding tooltips directly to "A" buttons results in buttons disappearing (weired! don't know why!)
        //so we add tooltips to the "DIV" child after it becomes inserted
        //flash objects inside table tools buttons are inserted with some delay (100ms) (for some reason)
        setTimeout(function() {
            $(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function() {
                var div = $(this).find('> div');
                if(div.length > 0) div.tooltip({container: 'body'});
                else $(this).tooltip({container: 'body'});
            });
        }, 200);



        //ColVis extension
        var colvis = new $.fn.dataTable.ColVis( oTable1, {
            "buttonText": "<i class='fa fa-search'></i>",
            "aiExclude": [0, 6],
            "bShowAll": true,
            //"bRestore": true,
            "sAlign": "right",
            "fnLabel": function(i, title, th) {
                return $(th).text();//remove icons, etc
            }

        });

        //style it
        $(colvis.button()).addClass('btn-group').find('button').addClass('btn btn-white btn-info btn-bold')

        //and append it to our table tools btn-group, also add tooltip
        $(colvis.button())
            .prependTo('.tableTools-container .btn-group')
            .attr('title', 'Show/hide columns').tooltip({container: 'body'});

        //and make the list, buttons and checkboxed Ace-like
        $(colvis.dom.collection)
            .addClass('dropdown-menu dropdown-light dropdown-caret dropdown-caret-right')
            .find('li').wrapInner('<a href="javascript:void(0)" />') //'A' tag is required for better styling
            .find('input[type=checkbox]').addClass('ace').next().addClass('lbl padding-8');



        /////////////////////////////////
        //table checkboxes
        $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

        //select/deselect all rows according to table header checkbox
        $('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
            var th_checked = this.checked;//checkbox inside "TH" table header

            $(this).closest('table').find('tbody > tr').each(function(){
                var row = this;
                if(th_checked) tableTools_obj.fnSelect(row);
                else tableTools_obj.fnDeselect(row);
            });
        });

        //select/deselect a row when the checkbox is checked/unchecked
        $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
            var row = $(this).closest('tr').get(0);
            if(!this.checked) tableTools_obj.fnSelect(row);
            else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
        });




        $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
            e.stopImmediatePropagation();
            e.stopPropagation();
            e.preventDefault();
        });


        //And for the first simple table, which doesn't have TableTools or dataTables
        //select/deselect all rows according to table header checkbox
        var active_class = 'active';
        $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
            var th_checked = this.checked;//checkbox inside "TH" table header

            $(this).closest('table').find('tbody > tr').each(function(){
                var row = this;
                if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
            });
        });

        //select/deselect a row when the checkbox is checked/unchecked
        $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
            var $row = $(this).closest('tr');
            if(this.checked) $row.addClass(active_class);
            else $row.removeClass(active_class);
        });



        /********************************/
        //add tooltip for small view action buttons in dropdown menu
        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

        //tooltip placement on right or left
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            //var w2 = $source.width();

            if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
            return 'left';
        }

    })
</script>



<script>

    $('.date-picker').datepicker({
        autoclose: true,
        todayHighlight: true
    });




    $(document).on('click','.delete_fee',function() {
        var theindex = $(this).attr('i_index');
        swal({
                title: "Do you want to delete this fee and attendance?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: "POST",
                        url: "ajax/delete_fees.php",
                        data: {theindex: theindex},
                        dataType: "html",

                        success:function(text) {

                            $.ajax({
                                url: "ajax/tuition_fees_table.php",
                                beforeSend: function(){$.blockUI({
                                    message: '<h3><img src="../busy.gif" /> Please Wait...</h3>'});},
                                success: function (text) {
                                    $('#here').html(text);
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    alert(xhr.status + " " + thrownError);
                                },
                                complete: function(){ $.unblockUI();},
                            });

                        },

                        complete: function () {

                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        }
                    });

                    swal("Deleted!", "Fee and Attendance has been deleted.", "success");

                } else {
                    swal("Cancelled", "Data is safe.", "error");
                }
            });


    });


    $('.select2').css('width','200px').select2({allowClear:true})
    $('#select2-multiple-style .btn').on('click', function(e){
        var target = $(this).find('input[type=radio]');
        var which = parseInt(target.val());
        if(which == 2) $('.select2').addClass('tag-input-style');
        else $('.select2').removeClass('tag-input-style');
    });




    $('#save_fees_btn').click(function () {

        var academic_year = $('#academic_year').val();
        var term = $('#term').val();
        var amount = $('#amount').val();
        var attendance = $('#attendance').val();
        var dept = $('#dept').val();



        var error = '';

        if (academic_year == "") {
            error += 'Please select academic year \n';
            document.fees_form.academic_year.focus();
        }
        if (term == "") {
            error += 'Please select term \n';
            document.fees_form.term.focus();
        }
        if (amount == "") {
            error += 'Please enter amount\n';
            document.fees_form.amount.focus();
        }
        if (attendance == "") {
            error += 'Please enter attendance\n';
            document.fees_form.attendance.focus();
        }
        if (dept == "") {
            error += 'Please select department \n';
        }




        if (error == "") {

            $.ajax({
                type: "POST",
                url: "ajax/savefees.php",
                data: {
                    academic_year: academic_year,
                    term: term,
                    amount: amount,
                    dept: dept,
                    attendance:attendance

                },

                success: function (text) {

                    if (text == 1) {


                        swal("Submitted!", "Fee and Attendance Added", "success");


                        $.ajax({
                            url: "ajax/tuition_fees_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<h3><img src="../busy.gif" /> Please Wait...</h3>'
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

                    }

                    else {
                        swal("Error!", "Sorry! Fee for this department already exists", "error");

                    }



                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },

            });


        }
        else {

            $.notify(error, {position: "top center"});


        }
        return false;
    });





</script>