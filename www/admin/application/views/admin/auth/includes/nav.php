<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url() ?>/admin/Dashbord_welcome/index"><?php echo project_name; ?> <?php echo $lang_menu_admin;?> </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right" id="adminprofilemenu">
                
               
               
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" style="color:#fff;" data-toggle="dropdown" href="#"><?php echo $lang_Hi;?>, <?php echo ucfirst($this->ion_auth->user()->row()->username);?>
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated flipInX" id="profiledropdown">
<!--                     <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>-->
                        </li>
                        <li id="demo"><a href="<?php echo site_url()?>Dedaabox_dev_auth/changepassword"><i class="fa fa-lock fa-lock"></i> <?php echo $lang_menu_passwordchange;?></a></li>
                        <li id="demo"><a href="<?php echo site_url()?>Dedaabox_dev_auth/logout"><i class="fa fa-sign-out fa-fw"></i> <?php echo $lang_menu_logout;?></a>
                        </li>                        
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

           <?php require_once('sideMenu.php');?>
            <!-- /.navbar-static-side -->
        </nav>
