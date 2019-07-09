<?php include('../dbcon.php');

$date = date("Y-m-d");

$sess = $mysqli->query("select * from `academic_session` where date_from <= '$date' AND date_to >= '$date'");
$res_ses = $sess->fetch_assoc();
$academic_year = $res_ses['year'];
$term = $res_ses['term'];
$term_begins = $res_ses['term_begins'];

?>
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="alert alert-block alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>

            <i class="ace-icon fa fa-check green"></i>

            Contact Developer for assistance
            <strong class="green">



            </strong>

        </div>

        <div class="row">
            <div class="space-6"></div>

            <div class="col-sm-7 infobox-container">
                <div class="infobox infobox-green">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-phone"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                            Tel
                        </span>
                        <div class="infobox-content">0276737464</div>
                    </div>


                </div>

                <div class="infobox infobox-blue">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-envelope"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                            Email
                        </span>
                        <div class="infobox-content">ikosafo@yahoo.com</div>
                    </div>

                </div>


                <div class="space-6"></div>

            </div>

            <div class="vspace-12-sm"></div>


        </div><!-- /.row -->

        <div class="hr hr32 hr-dotted"></div>


        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->