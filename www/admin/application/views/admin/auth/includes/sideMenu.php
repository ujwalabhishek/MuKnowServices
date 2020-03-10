<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <li>
                <?php
//        if ($this->session->userdata('session_data'))
//            $data = $this->session->userdata('session_data');
                ?>
                <a href="<?php echo site_url() ?>admin/Dashbord_welcome/index"><i class="fa fa-dashboard fa-fw" id="sidemenuicon"></i> <?php echo 'Dashboard'; ?></a>
            </li>
            <?php if ($this->ion_auth->is_admin() || $this->ion_auth->is_facilitator()): ?>
                <li>
                    <a href="#" id="cat"><i class="fa fa-list-ul" id="sidemenuicon"></i> <?php echo 'Category'; ?><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li>
                            <a href="<?php echo site_url() ?>/admin/dashbord_category/maincategory"><i class="fa fa-th fa-fw" id="sidemenuicon"></i> <?php echo 'Main Category'; ?></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url() ?>/admin/dashbord_category/index"><i class="fa fa-sitemap fa-fw" id="sidemenuicon"></i>  <?php echo 'Sub Category'; ?></a>
                        </li>


                    </ul>
                </li>
				
<!--				<li>
                    <a href="#" id="cat"><i class="glyphicon glyphicon-user" id="sidemenuicon"></i> <?php echo 'Subscription'; ?><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
						<li>
                            <a href="<?php echo site_url() ?>admin/Dashboard_courses_scratchcard"><i class="fa fa-credit-card fa-fw" id="sidemenuicon"></i>  <?php echo 'Course Scratch Card'; ?></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url() ?>admin/Dashboard_coupon"><i class="fa fa-th fa-codepen" id="sidemenuicon"></i> <?php echo 'Generate Promocode'; ?></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url() ?>admin/Dashboard_subscription"><i class="fa fa-money fa-fw" id="sidemenuicon"></i>  <?php echo 'Create Subscription'; ?></a>
                        </li>
						<li>
                            <a href="<?php echo site_url() ?>admin/Dashboard_scratchcard"><i class="fa fa-credit-card fa-fw" id="sidemenuicon"></i>  <?php echo 'Create Scratch Card'; ?></a>
                        </li>

                    </ul>
                </li>-->
				
            <?php endif; ?>
            <?php if ($this->ion_auth->is_admin() || $this->ion_auth->is_facilitator()): ?>
<!--                <li>
                    <a href="#" id="user"><i class="fa fa-users" id="sidemenuicon"></i> <?php //echo project_name.' Normal users';?> <?php echo ''; ?><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li>
                            <a href="<?php echo site_url() ?>admin/Dashboard_users/index/subscriber"><i class="fa fa-user fa-fw" id="sidemenuicon"></i><?php  echo 'Subscriber'; ?></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url() ?>admin/Dashboard_users/index/facilitator"><i class="fa fa-user fa-fw" id="sidemenuicon"></i><?php echo 'Trainer'; ?></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url() ?>admin/Dashboard_users/index/non_subscriber"><i class="fa  fa-user fa-fw" id="sidemenuicon"></i><?php echo 'Non-Subscriber'; ?></a>
                        </li>
                       
                    </ul>
                </li>-->
                <li>
                            <a href="<?php echo site_url() ?>/admin/Dashboard_users/index/facilitator/fb"><i class="fa fa-user fa-fw" id="sidemenuicon"></i><?php echo 'Trainer'; ?></a>
<!--                    <ul class="nav nav-second-level">

                        <li>
                            <a href="<?php echo site_url() ?>admin/Dashboard_users/index/subscriber/fb"><i class="fa fa-user fa-fw" id="sidemenuicon"></i><?php  echo 'Subscriber'; ?></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url() ?>admin/Dashboard_users/index/facilitator/fb"><i class="fa fa-user fa-fw" id="sidemenuicon"></i><?php echo 'Trainer'; ?></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url() ?>admin/Dashboard_users/index/non_subscriber/fb"><i class="fa  fa-user fa-fw" id="sidemenuicon"></i><?php echo 'Non-Subscriber'; ?></a>
                        </li>
                       
                    </ul>-->
                </li>
            <?php endif; ?>
            <li>
                <a id="art_menu" href="<?php echo site_url() ?>/admin/Dashboard_articles/index/<?php echo $this->ion_auth->user()->row()->id; ?>"><i class="fa fa-newspaper-o fa-fw" id="sidemenuicon"></i>  <?php echo 'Articles'; ?></a>
            </li>
<!--             <li>
                <a id="subart_menu" href="<?php echo site_url() ?>admin/Dashboard_subarticles/index/<?php echo $this->ion_auth->user()->row()->id; ?>"><i class="fa fa-newspaper-o fa-fw" id="sidemenuicon"></i> Sub articles</a>
            </li>
$lang_menu_assessment
-->
<!-- <li>
                    <a href="#" id="cat"><i class="fa fa-database fa-fw" id="sidemenuicon"></i> <?php echo 'Mini Certification'; ?><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                         <li>
                    <a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_assesment/index/"><i class="fa fa-database fa-fw" id="sidemenuicon"></i>  <?php echo 'Mini Certification'; ?></a>
                </li>
                  <li>
                    <a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_assesment_score/score/"><i class="fa fa-database fa-fw" id="sidemenuicon"></i>  <?php echo 'Mini Certification Score'; ?></a>
                </li>
                        </ul>
                    </li>-->
					
<!--					<li>
						<a href="#" id="cat"><i class="fa fa-database fa-fw" id="sidemenuicon"></i> <?php echo 'Courses'; ?><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
                         <li>
							<a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_courses/index/"><i class="fa fa-database fa-fw" id="sidemenuicon"></i>  <?php echo 'Courses'; ?></a>
						</li>
						 <li>
							<a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_courses_score/score/"><i class="fa fa-database fa-fw" id="sidemenuicon"></i>  <?php echo 'Courses Score'; ?></a>
						</li> 
                        </ul>
                    </li>-->
					
            <?php if ($this->ion_auth->is_admin() || $this->ion_auth->is_facilitator()): ?>  
              
<!--                <li>
                    <a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_create_group/index/"><i class="fa fa-group fa-fw" id="sidemenuicon"></i> <?php echo $lang_menu_creategroup; ?></a>
                </li>-->
<!--                <li>
                    <a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_send_mail/index"><i class="fa fa-envelope fa-fw" id="sidemenuicon"></i> <?php echo 'Send mail'; ?></a>
                </li>
                <li>
                    <a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_feedback/index"><i class="fa fa-comments" id="sidemenuicon"></i> <?php echo 'Users Feedback'; ?></a>
                </li>
                 <li>
                    <a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_bank/index"><i class="fa fa-bank" id="sidemenuicon"></i> <?php echo 'Bank Details'; ?></a>
                </li>
				-->
				<!--  <li>
					<a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_payment/index"><i class="fa fa-credit-card" id="sidemenuicon"></i> <?php echo 'Payment Details'; ?></a>                </li>
                  
                 <li>-->
<!--				 <li>
				    <a href="#" id="cat"><i class="fa fa-credit-card" id="sidemenuicon"></i> <?php echo 'Payment Details'; ?><span class="fa arrow"></span></a>

                    <ul class="nav nav-second-level">
                         <li>
					<a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_payment/index"><i class="fa fa-credit-card" id="sidemenuicon"></i> <?php echo 'OK$ Payment Details'; ?></a>                </li>
                  <li>
					<a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_payment/telenor"><i class="fa fa-credit-card" id="sidemenuicon"></i> <?php echo 'Telenor Payment Details'; ?></a>                </li>
                        </ul>
                    </li>-->
				
<!--                <li>
                    <a id="art_menu" href="<?php echo site_url() ?>admin/dashbord_slider/slider"><i class="fa fa-credit-card" id="sidemenuicon"></i> <?php echo 'Slider'; ?></a>
                </li>-->
<!--                <li>
                    <a id="art_menu" href="<?php echo site_url() ?>admin/Cache"><i class="fa fa-credit-card" id="sidemenuicon"></i> <?php echo 'Delete Cache'; ?></a>
                </li>-->
<!--                <li>
                    <a id="art_menu" href="<?php echo site_url() ?>admin/Dashboard_sequence/index/"><i class="fa fa-graduation-cap fa-fw" id="sidemenuicon"></i> <?php echo $lang_menu_sequence; ?></a>
                </li>-->
            <?php endif; ?>
            <?php if ($this->ion_auth->is_admin() || $this->ion_auth->is_facilitator()): ?>
<!--                <li>
                    <a href="#" id="cat"><i class="fa fa-list-ul" id="sidemenuicon"></i> <?php echo 'Report Analysis'; ?><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li>
                            <a href="<?php echo site_url() ?>/admin/Dashboard_articleview_report/index"><i class="fa fa-th fa-fw" id="sidemenuicon"></i> <?php echo 'Articles View Report'; ?></a>
                        </li>
                                             <li>
                                                    <a href="<?php echo site_url() ?>/admin/Dashboard_articleview_report/article_total_duration"><i class="fa fa-sitemap fa-fw" id="sidemenuicon"></i> <?php echo 'Article total duration';?></a>
                                                </li>


                    </ul>
                </li>-->
            <?php endif; ?>
<!--                <li>
                      <a id="chat" href="<?php echo site_url() ?>/admin/Online_chat1/article"><i class="fa  fa-wechat" id="sidemenuicon"></i> <?php echo 'Online chat'; ?></a>
                    </li>-->
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>