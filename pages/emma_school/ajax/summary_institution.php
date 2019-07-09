<?php include('../dbcon.php');

@session_start();

$get = $mysqli->query("select * from institution LIMIT 1");
$res = $get->fetch_assoc();

?>



<form class="form-horizontal"
      method="post" enctype="multipart/form-data" autocomplete="off">


    <input type="hidden" id="student_id" value="<?php echo $res['id']; ?>"/>





    <div class="form-group">
        <label
            class="col-xs-12 col-sm-2 no-padding-right">Name</label>

        <div class="col-xs-12 col-sm-10">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['name'] ?>
            </div>
        </div>

        </div>

    <div class="form-group">


        <label
            class="col-xs-12 col-sm-2 no-padding-right">Motto</label>

        <div class="col-xs-12 col-sm-10">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['motto'] ?>
            </div>
        </div>



    </div>


    <div class="space-2"></div>

    <div class="form-group">
        <label
            class="col-xs-12 col-sm-4 no-padding-right">Country</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['country'] ?>
            </div>
        </div>

        </div>

    <div class="form-group">

        <label
            class="col-xs-12 col-sm-4 no-padding-right">City</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['city'] ?>
            </div>
        </div>

    </div>


    <div class="space-2"></div>

    <div class="form-group">
        <label
            class="col-xs-12 col-sm-4 no-padding-right">State</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['state'] ?>
            </div>
        </div>

        </div>

    <div class="form-group">


        <label
            class="col-xs-12 col-sm-4 no-padding-right">Mobile</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['mobile'] ?>
            </div>
        </div>


    </div>


    <div class="form-group">

        <label
            class="col-xs-12 col-sm-4 no-padding-right">Alt Mobile</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['altmobile'] ?>
            </div>
        </div>

        </div>

    <div class="form-group">

        <label
            class="col-xs-12 col-sm-4 no-padding-right">Telephone</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['telephone'] ?>
            </div>
        </div>


    </div>

    <div class="form-group">

        <label
            class="col-xs-12 col-sm-4 no-padding-right">Email</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix" style="font-weight: 700">
                <?php echo $res['email'] ?>
            </div>
        </div>


    </div>

    <div class="form-group">

        <label
            class="col-xs-12 col-sm-4 no-padding-right">Logo</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix" style="font-weight: 700">
                 <span class="profile-picture" style="width:34%">
    <img class="editable img-responsive" src="../<?php echo $res['logo'] ?>" id="avatar2"
         alt="" style="width: 100%">
															</span>
            </div>
        </div>


    </div>


    <div class="form-group">

        <label
            class="col-xs-12 col-sm-4 no-padding-right">Signature</label>

        <div class="col-xs-12 col-sm-8">
            <div class="clearfix" style="font-weight: 700">
                <span class="profile-picture" style="width:34%">
    <img class="editable img-responsive" src="../<?php echo $res['signature'] ?>" id="avatar2"
         alt="" style="width: 100%">
															</span>
            </div>
        </div>


    </div>


</form>

