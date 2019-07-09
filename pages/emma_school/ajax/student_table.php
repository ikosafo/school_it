<?php include('../dbcon.php');

$qustud = $mysqli->query("select * from student where status is null ORDER BY lastname,firstname,othername");


?>


<table id="" class="table table-striped table-bordered table-hover dynamic-table">
    <thead>
    <tr>

        <th width="10%">Image</th>
        <th width="35%">Personal</th>
        <th width="35%">Courses</th>
        <th width="20%">Action</th>

    </tr>
    </thead>

    <tbody>

    <?php
    while ($row = $qustud->fetch_assoc()) {

        $stud_id = $row['student_id'];

        ?>

        <tr style="font-size: x-small">


            <td><span class="profile-picture" style="width:70%">
    <img class="editable img-responsive" src="../<?php echo $row['picture'] ?>" id="avatar2"
         alt="" style="width: 100%">
															</span></td>

            <td><b>Full
                    Name: <?php echo $row['lastname'] . ' ' . $row['firstname'] . ' ' . $row['othername']; ?></b><br/>
                <b>Gender:</b> <?php echo $row['gender']; ?><br/>
                <b>House:</b> <?php echo $row['house']; ?><br/>
                <b>Program:</b> <?php echo $row['program']; ?><br/>
            </td>


            <td>
                <b>Class:</b> <?php echo $row['class']; ?><br/>
                <b>Student ID:</b> <?php echo $row['stud_id']; ?><br/>

                <?php

                $rs = $mysqli->query("select * from course where student_id = '$stud_id'");

                while ($rw = $rs->fetch_assoc()) {

                    echo $rw['course'] . ";";

                }

                ?>

            </td>


            <td style="font-size: small" align="center">
                <a href="#" class="edit_student" i_index="<?php echo $row['id']; ?>">
                    Edit </a> |
                <a href="#" class="delete_student" i_index="<?php echo $row['id']; ?>">
                    Delete</a>
            </td>

        </tr>
        <?php
    }
    ?>

    </tbody>
</table>

<span class="btn btn-sm btn-light no-hover">
			<span class="line-height-1 bigger-170 blue"> <?php $res = $mysqli->query("SELECT * FROM student where status is null ");
                $num_rows = mysqli_num_rows($res);

                echo "$num_rows\n";

                ?> </span>



													<br/>
													<span class="line-height-1 smaller-90"> Total Students </span>
												</span>

<span class="btn btn-sm btn-yellow no-hover">
													<span
                                                        class="line-height-1 bigger-170"> <?php $res2 = $mysqli->query("SELECT * FROM student WHERE status is null and gender='Male'");
                                                        $num_rows = mysqli_num_rows($res2);

                                                        echo "$num_rows\n";

                                                        ?> </span>

													<br/>
													<span class="line-height-1 smaller-90"> Males </span>
												</span>

<span class="btn btn-sm btn-yellow no-hover">
													<span
                                                        class="line-height-1 bigger-170"> <?php $res3 = $mysqli->query("SELECT * FROM student WHERE status is null and gender='Female'");
                                                        $num_rows = mysqli_num_rows($res3);

                                                        echo "$num_rows\n";

                                                        ?> </span>

													<br/>
													<span class="line-height-1 smaller-90"> Females </span>
												</span>


<script type="text/javascript">
    jQuery(function ($) {
        //initiate dataTables plugin
        var oTable1 =
            $('.dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    bAutoWidth: false,
                    "aoColumns": [
                        {"bSortable": false},
                        null, null, null, null, null,
                        {"bSortable": false}
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
                });
        //oTable1.fnAdjustColumnSizing();


        //TableTools settings
        TableTools.classes.container = "btn-group btn-overlap";
        TableTools.classes.print = {
            "body": "DTTT_Print",
            "info": "tableTools-alert gritter-item-wrapper gritter-info gritter-center white",
            "message": "tableTools-print-navbar"
        }

        //initiate TableTools extension
        var tableTools_obj = new $.fn.dataTable.TableTools(oTable1, {
            "sSwfPath": "assets/swf/copy_csv_xls_pdf.swf",

            "sRowSelector": "td:not(:last-child)",
            "sRowSelect": "multi",
            "fnRowSelected": function (row) {
                //check checkbox when row is selected
                try {
                    $(row).find('input[type=checkbox]').get(0).checked = true
                }
                catch (e) {
                }
            },
            "fnRowDeselected": function (row) {
                //uncheck checkbox
                try {
                    $(row).find('input[type=checkbox]').get(0).checked = false
                }
                catch (e) {
                }
            },

            "sSelectedClass": "success",
            "aButtons": [
                {
                    "sExtends": "copy",
                    "sToolTip": "Copy to clipboard",
                    "sButtonClass": "btn btn-white btn-primary btn-bold",
                    "sButtonText": "<i class='fa fa-copy bigger-110 pink'></i>",
                    "fnComplete": function () {
                        this.fnInfo('<h3 class="no-margin-top smaller">Table copied</h3>\
									<p>Copied ' + (oTable1.fnSettings().fnRecordsTotal()) + ' row(s) to the clipboard.</p>',
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
        });
        //we put a container before our table and append TableTools element to it
        $(tableTools_obj.fnContainer()).appendTo($('.tableTools-container'));

        //also add tooltips to table tools buttons
        //addding tooltips directly to "A" buttons results in buttons disappearing (weired! don't know why!)
        //so we add tooltips to the "DIV" child after it becomes inserted
        //flash objects inside table tools buttons are inserted with some delay (100ms) (for some reason)
        setTimeout(function () {
            $(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function () {
                var div = $(this).find('> div');
                if (div.length > 0) div.tooltip({container: 'body'});
                else $(this).tooltip({container: 'body'});
            });
        }, 200);


        //ColVis extension
        var colvis = new $.fn.dataTable.ColVis(oTable1, {
            "buttonText": "<i class='fa fa-search'></i>",
            "aiExclude": [0, 6],
            "bShowAll": true,
            //"bRestore": true,
            "sAlign": "right",
            "fnLabel": function (i, title, th) {
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
        $('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function () {
            var th_checked = this.checked;//checkbox inside "TH" table header

            $(this).closest('table').find('tbody > tr').each(function () {
                var row = this;
                if (th_checked) tableTools_obj.fnSelect(row);
                else tableTools_obj.fnDeselect(row);
            });
        });

        //select/deselect a row when the checkbox is checked/unchecked
        $('#dynamic-table').on('click', 'td input[type=checkbox]', function () {
            var row = $(this).closest('tr').get(0);
            if (!this.checked) tableTools_obj.fnSelect(row);
            else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
        });


        $(document).on('click', '#dynamic-table .dropdown-toggle', function (e) {
            e.stopImmediatePropagation();
            e.stopPropagation();
            e.preventDefault();
        });


        //And for the first simple table, which doesn't have TableTools or dataTables
        //select/deselect all rows according to table header checkbox
        var active_class = 'active';
        $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function () {
            var th_checked = this.checked;//checkbox inside "TH" table header

            $(this).closest('table').find('tbody > tr').each(function () {
                var row = this;
                if (th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
            });
        });

        //select/deselect a row when the checkbox is checked/unchecked
        $('#simple-table').on('click', 'td input[type=checkbox]', function () {
            var $row = $(this).closest('tr');
            if (this.checked) $row.addClass(active_class);
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

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
            return 'left';
        }

    })
</script>


<script>


    $(document).on('click', '.edit_student', function () {

        var theindex = $(this).attr('i_index');

        $.ajax({
            type: "POST",
            url: "ajax/edit_student.php",
            data: {theindex: theindex},
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

    });


    $(document).on('click', '.delete_student', function () {
        var theindex = $(this).attr('i_index');
        swal({
                title: "Do you want to delete this student?",
                text: "You will not be able to recover this data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: "POST",
                        url: "ajax/delete_student.php",
                        data: {theindex: theindex},
                        dataType: "html",

                        success: function (text) {

                            $.ajax({
                                url: "ajax/student_table.php",
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

                            $.ajax({
                                url: "ajax/summary_table.php",
                                beforeSend: function () {
                                    $.blockUI({
                                        message: '<h3><img src="../busy.gif" /> Please Wait...</h3>'
                                    });
                                },
                                success: function (text) {
                                    $('#summary_here').html(text);
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    alert(xhr.status + " " + thrownError);
                                },
                                complete: function () {
                                    $.unblockUI();
                                },
                            });

                        },

                        complete: function () {

                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        }
                    });

                    swal("Deleted!", "Student has been deleted.", "success");

                } else {
                    swal("Cancelled", "Data is safe.", "error");
                }
            });


    });


</script>