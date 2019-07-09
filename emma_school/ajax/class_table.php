<?php include('../dbcon.php');

@session_start();


$qucel=$mysqli->query("select * from class ORDER BY department,id");


?>

<a href="#modal-form_class" role="button" class="blue"
   data-toggle="modal">
    <button type="submit"
            class="btn btn-sm btn-primary btn-white btn-round">

        <i class="icon-on-right ace-icon fa fa-plus-circle"></i>

        <span class="bigger-110">New Class</span>
    </button>
</a>


<div id="modal-form_class" class="modal fade" tabindex="-1">
    <div class="modal-dialog" id="error_loc_class">
        <form method="post" action="" name="class_form"
              id="class_form" autocomplete="off">
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


                            <div class="form-group col-md-12">
                                <label
                                    for="form-field-username">Class</label>

                                <div>
                                    <input type="text"
                                           id="class_name"
                                           placeholder="Enter class name"
                                           style="width:90%"
                                           required/>


                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="form-field-username">Department</label>

                                <div>
                                    <select id="class_dept"
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


                            <div class="space-4"></div>

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
                            id="save_class_btn">
                        <i class="ace-icon fa fa-check"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



<div id="edit-class-form" class="modal fade" tabindex="-1">
    <div class="modal-dialog" id="error_loc_class_ed">
        <form method="post" action="" name="class_form_ed" id="class_form_ed" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger">Please fill the following form fields</h4>
                </div>

                <div class="modal-body" id="edit-class-body">


                </div>

                <div class="modal-footer">
                    <button class="btn btn-sm" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Cancel
                    </button>

                    <button class="btn btn-sm btn-primary" type="submit" id="edit_class_btn">
                        <i class="ace-icon fa fa-edit"></i>
                        Edit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>






<p></p>
<p></p>
<p></p>



<table id="" class="table table-striped table-bordered table-hover dynamic-table">
    <thead>
    <tr>

        <th style="width: 35%">Class name</th>
        <th style="width: 35%">Department</th>
        <th colspan="2" style="width: 30%">Action</th>

    </tr>
    </thead>

    <tbody>

    <?php
    while($fet_cel=$qucel->fetch_assoc())
    {

        ?>

        <tr>



            <td><?php echo $fet_cel['name'];?></td>

            <td><?php echo $fet_cel['department'];?></td>

            <td>
                <a href="#" data-toggle="modal" data-target="#edit-class-form"
                   class="getfulldetails" i_index="<?php echo $fet_cel['id'];?>">Edit</a></td>
            <td>
                <a href="#" class="delete_class" i_index="<?php echo $fet_cel['id'];?>">
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



    $(document).on('click','.getfulldetails',function(){
        var theindex = $(this).attr('i_index');

        $.ajax({
            type: "POST",
            url: "ajax/edit_class_form.php",
            data:{theindex:theindex},
            dataType: "html",
            beforeSend: function(){

            },
            success: function(text) {

                $('#edit-class-body').html(text);

            },
            complete: function(){

            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(xhr.status + " " + thrownError);
            }
        });



    });




    $(document).on('click','.delete_class',function() {
        var theindex = $(this).attr('i_index');
        swal({
                title: "Do you want to delete this class?",
                text: "You will not be able to recover this data!",
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
                        url: "ajax/delete_class.php",
                        data: {theindex: theindex},
                        dataType: "html",

                        success:function(text) {

                            $.ajax({
                                url: "ajax/class_table.php",
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

                    swal("Deleted!", "Class has been deleted.", "success");

                } else {
                    swal("Cancelled", "Data is safe.", "error");
                }
            });


    });




    $('#save_class_btn').click(function () {

        var class_name = $('#class_name').val();
        var class_dept = $('#class_dept').val();


        var error = '';


        if (class_name == "") {
            error += 'Please enter class \n';
            document.class_form.class_name.focus();
        }

        if (class_dept == "") {
            error += 'Please select department \n';
            document.class_form.class_dept.focus();
        }


        if (error == "") {

            $.ajax({
                type: "POST",
                url: "ajax/saveclass.php",
                data: {
                    class_name: class_name,
                    class_dept: class_dept
                },
                success: function (text) {


                    if (text == 1) {
                        swal("Submitted!", "Class Saved", "success");


                        $.ajax({
                            url: "ajax/class_table.php",
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
                        swal("Class already exist", "", "error");
                    }


                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },

            });


        }
        else {

            $('#error_loc_class').notify(error);


        }
        return false;
    });



    $('#edit_class_btn').click(function () {


        var class_name = $('#class_name_ed').val();
        var class_dept = $('#class_dept_ed').val();
        var class_id = $('#class_id').val();


        var error = '';

        if (class_name == "") {
            error += 'Please enter class \n';
            document.class_form_ed.class_name.focus();
        }


        if (error == "") {

            $.ajax({
                type: "POST",
                url: "ajax/saveeditclass.php",
                data: {
                    class_name: class_name,
                    class_dept:class_dept,
                    class_id: class_id

                },
                success: function (text) {
                    swal("Submitted!", "Class Edited", "success");


                    $.ajax({
                        url: "ajax/class_table.php",
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


                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },

            });


        }
        else {

            $('#error_loc_cel_ed').notify(error);


        }
        return false;
    });





    $('.select2').css('width','200px').select2({allowClear:true})
    $('#select2-multiple-style .btn').on('click', function(e){
        var target = $(this).find('input[type=radio]');
        var which = parseInt(target.val());
        if(which == 2) $('.select2').addClass('tag-input-style');
        else $('.select2').removeClass('tag-input-style');
    });




</script>