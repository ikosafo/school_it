<?php include('../../config.php');


$qinst = $mysqli->query("select * from institution_details LIMIT 1");
$qres = $qinst->fetch_assoc();


?>

<!-- Kitchen Sink Card -->
<div class="card m-b-30">

    <?php $randomid = $qres['randomid']; ?>

    <div class="card-body">
        <h5 class="card-title">Institution Name</h5>
        <p class="card-text"><?php echo $qres['name'] ?>
        </p>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <h5 class="card-title">Institution Address</h5>
            <p class="card-text"><?php echo $qres['address'] ?>
            </p>
        </li>
        <li class="list-group-item">
            <h5 class="card-title">Institution Location</h5>
            <p class="card-text"><?php echo $qres['location'] ?>
            </p>
        </li>
        <li class="list-group-item">
            <h5 class="card-title">Institution Telephone</h5>
            <p class="card-text"><?php echo $qres['telephone'] ?>
            </p>
        </li>
        <li class="list-group-item">
            <h5 class="card-title">Institution Email Address</h5>
            <p class="card-text"><?php echo $qres['email_address'] ?>
            </p>
        </li>
        <li class="list-group-item">
            <h5 class="card-title">Institution Motto</h5>
            <p class="card-text"><?php echo $qres['motto'] ?>
            </p>
        </li>
        <li class="list-group-item">
            <h5 class="card-title">Logo</h5>
            <p class="card-text"><img src="<?php echo $qres['logofile'] ?>" style="width: 25%"/>
            </p>
        </li>
    </ul>
    <div class="card-body">
        <a href="#" class="card-link">
            <button type="button" id="update_institution" class="btn btn-rounded btn-warning">
                <i class="mdi mdi-upload mr-2"></i> Update
            </button>
        </a>
    </div>
</div>
<!-- Kitchen Sink Card -->

<script>
    $("#update_institution").click(function () {

        var randomid = '<?php echo $randomid ?>';

        $.ajax({
            type: "POST",
            url: "ajax/forms/config_institution_form_edit.php",
            data:{randomid:randomid},
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


    })
</script>