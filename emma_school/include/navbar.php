<?php

$username = $_SESSION['username'];
$user_type = $_SESSION['user_type'];
$fullname = $_SESSION['name'];
?>

<div class="navbar-container" id="navbar-container">
    <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
        <span class="sr-only">Toggle sidebar</span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>
    </button>

    <div class="navbar-header pull-left">
        <a href="../index_ad.php" class="navbar-brand">
            <small>
                <i class="fa fa-university"></i>
                TESHIE ST. JOHN SCHOOLS
            </small>
        </a>

        <button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons">
            <span class="sr-only">Toggle user menu</span>

            <img src="../assets/avatars/user.jpg" alt="Jason's Photo" />
        </button>
    </div>

    <div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
        <ul class="nav ace-nav">


            <li class="light-blue">
                <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                    <img class="nav-user-photo" src="../assets/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php if ($username == "admin"){
                                        echo "Admin";
                                    }

                                    else {
                                        echo $fullname;
                                    }

                                    ?>
								</span>

                    <i class="ace-icon fa fa-caret-down"></i>
                </a>

                <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                   <!-- <li>
                        <a href="#">
                            <i class="ace-icon fa fa-cog"></i>
                            Settings
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="ace-icon fa fa-user"></i>
                            Profile
                        </a>
                    </li>-->



                    <li>
                        <a href="../login.php?action=logout">
                            <i class="ace-icon fa fa-power-off"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div><!-- /.navbar-container -->