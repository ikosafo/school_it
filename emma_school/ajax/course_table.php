<?php include('../dbcon.php');

@session_start();


$qucel=$mysqli->query("select DISTINCT(course) from course_class ORDER BY course, class");


?>


<a href="#modal-form_course" role="button" class="blue"
   data-toggle="modal">
    <button type="submit"
            class="btn btn-sm btn-primary btn-white btn-round">

        <i class="icon-on-right ace-icon fa fa-plus-circle"></i>

        <span class="bigger-110">New Course</span>
    </button>
</a>

<div id="modal-form_course" class="modal fade" tabindex="-1">
    <div class="modal-dialog" id="error_loc_course"
         style="width: 40%">
        <form method="post" action="" name="course_form"
              autocomplete="off">
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
                                    for="form-field-username">Course
                                    Name</label>

                                <div>
                                    <input type="text"
                                           id="course_name"
                                           name="course_name"
                                           placeholder="Enter name of course"
                                           style="width:80%"/>
                                </div>
                            </div>


                            <div class="form-group col-md-12">
                                <label
                                    for="form-field-username">Course Code</label>

                                <div>
                                    <input type="text"
                                           id="course_code"
                                           name="course_code"
                                           placeholder="Enter course code"
                                           style="width:80%"/>
                                </div>
                            </div>


                            <div class="form-group col-md-12">
                                <label for="form-field-username">Select Type</label>

                                <div>
                                    <select id="course_type"
                                            class="select2"
                                            data-placeholder="Click to Choose..."
                                            required>
                                        <option value="">&nbsp;</option>
                                        <option value="Core">Core</option>
                                        <option value="Elective">Elective</option>


                                    </select>
                                </div>
                            </div>

                            <div class="hr hr-dotted"></div>

                            <h5><b>Assign course to class</b></h5>



                            <div
                                class="form-group col-md-12">

                                <div>
                                    <select
                                        id="course_class"
                                        name="course_class[]"
                                        class="select2"
                                        data-placeholder="Click to Select Class(es)..."
                                        style="width: 200%"
                                        multiple required>
                                        <option
                                            value="">
                                            &nbsp;</option>
                                        <?php
                                        $cl_name = $mysqli->query("SELECT * FROM class ORDER BY department");
                                        while ($row=$cl_name->fetch_assoc()) {
                                            ?>
                                            <?php echo '<option value="' . $row['id'] . '"';

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
                            type="button"
                            name="save_course"
                            id="save_course_btn">
                        <i class="ace-icon fa fa-check"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>






<div id="view-course-table" class="modal fade" tabindex="-1">
    <div class="modal-dialog" id="error_loc_pos_ed">
        <form method="post" action="" name="">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger">Please fill the following form fields</h4>
                </div>


                <div class="modal-body" id="course-table">


                </div>


            </div>
        </form>
    </div>
</div>





<div id="update-course" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" action="" name="course_form_ed">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger">Update Course</h4>
                </div>


                <div class="modal-body" id="course-form">


                </div>

                <div class="modal-footer">
                    <button class="btn btn-sm" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Cancel
                    </button>

                    <button class="btn btn-sm btn-primary" type="button" id="edit_course_btn">
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

        <th width="40%" align="center">Course name</th>
        <th colspan="3" width="60%" align="center">Action</th>

    </tr>
    </thead>

    <tbody>

    <?php
    while($fet_cel=$qucel->fetch_assoc())
    {

        ?>

        <tr>



            <td><?php echo $fet_cel['course'];?></td>

            <td width="20%" align="center">
                <a href="#" data-toggle="modal" data-target="#update-course"
                   class="getfulldetails" i_index="<?php echo $fet_cel['course'];?>">Edit Course</a></td>

            <td width="20%" align="center">
                <a href="#" data-toggle="modal" data-target="#view-course-table"
                   class="getfulldetails" i_index="<?php echo $fet_cel['course'];?>">Delete Class Assigned</a></td>

            <td width="20%" align="center">
                <a href="#" class="delete_course" i_index="<?php echo $fet_cel['course'];?>">
                    Delete Course</a></td>


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
            url: "ajax/view_course_table.php",
            data:{theindex:theindex},
            dataType: "html",
            beforeSend: function(){

            },
            success: function(text) {

                $('#course-table').html(text);

            },
            complete: function(){

            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(xhr.status + " " + thrownError);
            }
        });



    });




    $(document).on('click','.getfulldetails',function(){
        var theindex = $(this).attr('i_index');

        $.ajax({
            type: "POST",
            url: "ajax/edit_course_form.php",
            data:{theindex:theindex},
            dataType: "html",
            beforeSend: function(){

            },
            success: function(text) {

                $('#course-form').html(text);

            },
            complete: function(){

            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(xhr.status + " " + thrownError);
            }
        });



    });




    $(document).on('click','.delete_course',function() {
        var theindex = $(this).attr('i_index');
        swal({
                title: "Do you want to delete this course?",
                text: "This will delete this course for all classes",
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
                        url: "ajax/delete_course.php",
                        data: {theindex: theindex},
                        dataType: "html",

                        success:function(text) {

                            $.ajax({
                                url: "ajax/course_table.php",
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

                    swal("Deleted!", "Course has been deleted.", "success");

                } else {
                    swal("Cancelled", "Data is safe.", "error");
                }
            });


    });



    $('#save_course_btn').click(function () {

        var course_name = $('#course_name').val();
        var course_class = $('#course_class').val();
        var course_type = $('#course_type').val();
        var course_code = $('#course_code').val();


        var error = '';


        if (course_name == "") {
            error += 'Please enter course\n';
            document.course_form.course_name.focus();
        }

        if (course_type == "") {
            error += 'Please select course type \n';
            document.course_form.course_type.focus();
        }



        if (error == "") {

            $.ajax({
                type: "POST",
                url: "ajax/savecourse.php",
                data: {
                    course_name: course_name,
                    course_class: course_class,
                    course_type: course_type,
                    course_code: course_code
                },
                success: function (text) {

                    if (text == 2){
                        swal("Course already exist for class", "", "error");
                    }

                    else {

                        swal("Submitted!", "Course Saved", "success");


                        $.ajax({
                            url: "ajax/course_table.php",
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



                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },

            });


        }
        else {

            $('#error_loc_course').notify(error);


        }
        return false;
    });






    $('#edit_course_btn').click(function () {

        var course_name = $('#course_name_ed').val();
        var course_type = $('#course_type_ed').val();
        var course_code = $('#course_code_ed').val();
        var course_id = $('#course_id').val();


        var error = '';


        if (course_name == "") {
            error += 'Please enter course\n';
            document.course_form_ed.course_name.focus();
        }

        if (course_type == "") {
            error += 'Please select course type \n';
            document.course_form_ed.course_type.focus();
        }



        if (error == "") {

            $.ajax({
                type: "POST",
                url: "ajax/saveeditcourse.php",
                data: {
                    course_name: course_name,
                    course_type: course_type,
                    course_code: course_code,
                    course_id:course_id
                },
                success: function (text) {



                        swal("Submitted!", "Course Updated", "success");


                        $.ajax({
                            url: "ajax/course_table.php",
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

            $('#error_loc_course').notify(error);


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