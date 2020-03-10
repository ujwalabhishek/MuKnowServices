<?php require_once('includes/head.php')?>

<body>

    <div id="wrapper">
        
    <?php require_once('includes/nav.php')?>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1 class="page-header"><i class="fa fa-dashboard fa-fw" id="sidemenuicon"></i> <?php echo $lang_dashboard;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <a class="dashboardlink" href="<?php echo site_url();?>/admin/Dashboard_articles/index/<?php echo $user_id?>#tab1"><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="panel1 panel panel-primary animated fadeInUp">
                        <div class="panel-heading" id="panel1">
                            <div class="row dashboard-row">
                                <div class="col-lg-7 col-md-7 col-sm-7">
                                    <i class="fa fa-times-circle-o fa-4x"></i>
									<div class="infodashboard"><?php echo $lang_pendingarticles;?>!</div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 text-right">
                                    <div class="huge"><?php echo $pending_articles; ?></div> 							
                                </div>
                            </div>
                        </div>
                    </div></a>
                </div>
                <a class="dashboardlink" href="<?php echo site_url();?>/admin/Dashboard_articles/index/<?php echo $user_id?>#tab2"><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="panel2 panel panel-green animated fadeInUp">
                        <div class="panel-heading" id="panel2">
                            <div class="row dashboard-row">
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                    <i class="fa fa-check-circle-o fa-4x"></i>
									<div class="infodashboard"><?php echo $lang_approvedarticles;?>!</div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 text-right">
                                    <div class="huge"><?php echo $approved_articles; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				 </a>
                    
<!--                     <a class="dashboardlink" href="<?php echo site_url();?>admin/Dashboard_users/index/subscriber"><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="panel3 panel panel-primary animated fadeInUp">
                        <div class="panel-heading" id="panel1">
                            <div class="row dashboard-row">
                                <div class="col-lg-7 col-md-7 col-sm-7">
                                    <i class="fa fa-caret-square-o-right fa-4x"></i>
									<div class="infodashboard">Subscriber</div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 text-right">
                                    <div class="huge"><?php echo $subscriber; ?></div>							
                                </div>
                            </div>
                        </div>
                    </div>
					</div></a>
                    
                    <a class="dashboardlink" href="<?php echo site_url();?>admin/Dashboard_users/index/non_subscriber"><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="panel3 panel panel-primary animated fadeInUp">
                        <div class="panel-heading" id="panel1">
                            <div class="row dashboard-row">
                                <div class="col-lg-7 col-md-7 col-sm-7">
                                    <i class="fa fa-times-circle-o fa-4x"></i>
									<div class="infodashboard">Un Subscriber</div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 text-right">
                                    <div class="huge"><?php echo $unsubscriber; ?></div>							
                                </div>
                            </div>
                        </div>
                    </div>
					</div></a>-->
                    
                    
<!--				   <a class="dashboardlink" href="<?php echo site_url();?>admin/Dashboard_articleview_report/index"><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="panel3 panel panel-primary animated fadeInUp">
                        <div class="panel-heading" id="panel1">
                            <div class="row dashboard-row">
                                <div class="col-lg-7 col-md-7 col-sm-7">
                                    <i class="fa fa-bar-chart fa-4x"></i>
									<div class="infodashboard">Article View Report</div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 text-right">
                                    							
                                </div>
                            </div>
                        </div>
                    </div>
					</div></a>-->
                <!--<div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-check-circle-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">10</div>
                                    <div>Active Report Lapse!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-times-circle-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">10</div>
                                    <div>Inactive ReportLapse!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>-->
          
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
 <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url();?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/dist/js/sb-admin-2.js"></script>

</body>

</html>
