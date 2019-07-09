
<?php include('top.php'); ?>

<div id="here"></div>


<?php include ('bottom.php'); ?>


<script type="text/javascript">
    $(document).ready(function () {


        $.ajax({
            url: "ajax/contact.php",
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
