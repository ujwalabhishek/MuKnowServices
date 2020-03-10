<div class="navbar-default sidebar" role="navigation" style="background-color:#fff;">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

    <li>
                <a href="<?php echo site_url() ?>admin/Dashbord_welcome/index""><i class ="fa fa-dashboard fa-fw" id="sidemenuicon"></i> <?php echo $lang_dashboard;?></a>
            </li>
           <?php if ($this->ion_auth->is_admin() || $this->ion_auth->is_facilitator()): ?>
                <li>
                    <a href="#" id="cat"><i class="fa fa-list-ul"></i> <?php echo $lang_menu_category;?><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li>
                            <a href="<?php echo site_url() ?>admin/dashbord_category/maincategory"><i class="fa fa-th fa-fw"  id="sidemenuicon"></i> <?php echo $lang_menu_maincategory?></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url() ?>admin/dashbord_category/index"><i class="fa fa-sitemap fa-fw" id="sidemenuicon"></i> <?php echo $lang_menu_subcategory;?></a>
                        </li>


                    </ul>
                </li>
            <?php endif; ?>
            <li>
                <a href="#" id="user"><i class="fa fa-users" id="sidemenuicon"></i> <?php echo project_name;?> <?php echo $lang_menu_users;?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">

                    <li>
                        <a href="<?php echo site_url() ?>admin/Dashboard_users/index/contributor"><i class="fa fa-user fa-fw" id="sidemenuicon"></i><?php echo $lang_menu_contributor;?></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url() ?>admin/Dashboard_users/index/facilitator"><i class="fa fa-user fa-fw"id="sidemenuicon"></i><?php echo $lang_menu_facilitator;?></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url() ?>admin/Dashboard_users/index/subscriber"><i class="fa  fa-user fa-fw"id="sidemenuicon"></i><?php echo $lang_menu_subscriber;?></a>
                    </li>
                    <?php if ($this->ion_auth->is_admin()): ?>
                        <li>
                            <a href="<?php echo site_url() ?>admin/Dashboard_createuser/index/facilitator"><i class="fa fa-star" id="sidemenuicon"></i> <?php echo $lang_menu_createfacilitator;?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->ion_auth->is_admin() || $this->ion_auth->is_facilitator()): ?>
                        <li>
                            <a href="<?php echo site_url() ?>admin/Dashboard_createuser/index/contributor"><i class="fa fa-star" id="sidemenuicon"></i>  <?php echo $lang_menu_createcontributor;?></a>
                        </li>

                        <li>
                        <li>
                            <a href="<?php echo site_url() ?>admin/Dashboard_createuser/index/subscriber"><i class="fa fa-star" id="sidemenuicon"></i> <?php echo $lang_menu_createsubscriber;?></a>
                        </li>
                    <?php endif; ?>

                </ul>
            </li>
            <li>
                <a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_articles/index/<?php echo $this->ion_auth->user()->row()->id; ?>"><i class="fa fa-dashboard fa-fw" id="sidemenuicon"></i> <?php echo $lang_menu_article;?></a>
            </li>
              <?php if ($this->ion_auth->is_admin() || $this->ion_auth->is_facilitator()): ?>
            <li>
                <a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_assesment/index/"><i class="fa fa-dashboard fa-fw" id="sidemenuicon"></i> <?php echo $lang_menu_assessment;?></a>
            </li>
             <li>
                <a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_create_group/index/"><i class="fa fa-group fa-fw" id="sidemenuicon"></i> <?php echo $lang_menu_creategroup;?></a>
            </li>
			<li>
                <a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_send_mail/index"><i class="fa fa-envelope fa-fw" id="sidemenuicon"></i> <?php echo $lang_menu_sendmail;?></a>
            </li>
            <li>
                <a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_sequence/index/"><i class="fa fa-dashboard fa-fw" id="sidemenuicon"></i> <?php echo $lang_menu_sequence;?></a>
            </li>
              <?php endif; ?>
            <?php if ($this->ion_auth->is_admin() || $this->ion_auth->is_facilitator()): ?>
                <li>
                    <a href="#" id="cat"><i class="fa fa-list-ul" id="sidemenuicon"></i> <?php echo $lang_reportanalysis;?><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li>
                            <a href="<?php echo site_url() ?>/admin/Dashboard_articleview_report/index"><i class="fa fa-th fa-fw" id="sidemenuicon"></i> <?php echo $lang_articleview_report?></a>
                        </li>
                  <li>
                            <a href="<?php echo site_url() ?>/admin/Dashboard_articleview_report/article_total_duration"><i class="fa fa-sitemap fa-fw" id="sidemenuicon"></i> <?php echo $lang_article_total_duration;?></a>
                        </li>


                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>