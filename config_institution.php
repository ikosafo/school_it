<?php require ('includes/header.php');?>

    <!-- Start XP Breadcrumbbar -->
    <div class="xp-breadcrumbbar">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <h4 class="xp-page-title">Institution Details</h4>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="xp-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">System Configuration</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- End XP Breadcrumbbar -->

    <!-- Start XP Contentbar -->
    <div class="xp-contentbar">

        <!-- Start XP Row -->
        <div class="row">

            <!-- Start XP Col -->
            <div class="col-lg-6">

                <div id="institution_form_div"></div>

            </div>
            <!-- End XP Col -->

            <!-- Start XP Col -->
            <div class="col-lg-6">

                <div id="institution_table_div"></div>

            </div>
            <!-- End XP Col -->

        </div> <!-- end row -->

    </div>
    <!-- End XP Contentbar -->


<?php require ('includes/footer.php');?>



<script>

    $.ajax({
        type: "POST",
        url: "ajax/forms/config_institution_form.php",
        beforeSend: function () {
            $.blockUI({
                message: '<img src="assets/images/load.gif"/>'
            });
        },
        success: function (text) {
            $('#institution_form_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            $.unblockUI();
        },

    });


    $.ajax({
        type: "POST",
        url: "ajax/tables/config_institution_table.php",
        beforeSend: function () {
            $.blockUI({
                message: '<img src="assets/images/load.gif"/>'
            });
        },
        success: function (text) {
            $('#institution_table_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            $.unblockUI();
        },

    });

</script>
