<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('includes/head.php')
?>

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url() ?>assets/global/plugins/jquery-nestable/jquery.nestable.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<!--<link href="<?php echo base_url() ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />-->

<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="<?php echo base_url() ?>assets/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="<?php echo base_url() ?>assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME LAYOUT STYLES -->
<link rel="shortcut icon" href="favicon.ico" />
<style>
    .dd-handle{
        height:35px !important;
        background-color: #fff ;

    }
</style>
<body>
    <div class="modal" style="display: none">
        <div class="center">
            <img alt="" src="<?php base_url(); ?>/assets/loader.gif" />
        </div>
    </div>
    <!--    <div id="wrapper">-->
    <?php require_once('includes/nav.php') ?>
    <div id="page-wrapper">


        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Confirm and Complete</h1>

            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 50px;">
                        <form role="form" id="add_form" method="post" action="<?php echo site_url() ?>admin/Dashboard_courses/add_edit_data">
                             <h4>List of chapter</h4>

                    </div>
                    <?php //echo form_open_multipart(site_url() . '/admin/Dashboard_articles/add_edit_article', 'id="cat_form" class=".validate"'); ?>
                    <div class="panel-body">
                        <?php if ($this->session->flashdata('message')) { ?>
                            <div class="alert alert-success fade in block-inner">            
                                <button type="button" class="close" data-dismiss="alert">X</button>
                                <i class="icon-checkmark-circle"></i> <?php echo $this->session->flashdata('message') ?> </div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('error')) { ?>
                            <div class="alert alert-danger fade in block-inner">
                                <button type="button" class="close" data-dismiss="alert">X</button>
                                <i class="icon-checkmark-circle"></i> <?php echo $this->session->flashdata('error') ?> </div>
                        <?php } ?>
						
						<input type="hidden" name="course_id" value="<?php echo $course_id; ?>"/>
						<input type="hidden" name="author" value="<?php echo $author; ?>"/>
						 <input type="hidden" name="chapter" value="<?php echo count($courses_detail); ?>">
		  
						 <div class="row">
                            <div class="col-md-12">
                               <textarea id="nestable_list_1_output" name="category_id" class="form-control col-md-12 margin-bottom-10" style="display:none;"></textarea>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-10">
                                <div class="portlet light">
                                    <div class="portlet-body">
                                        <div class="dd" id="nestable_list_1">
                                            <ol class="dd-list">
                                                <?php if (!empty($courses_detail)): $i = 1; ?>

                                                    <?php //echo '<pre>';  print_r($courses_detail); exit;
													foreach ($courses_detail as $article_row) { 
													?>
                                                        <li class="dd-item" data-id="<?php echo $article_row->chapter_id ?>">
                                                            <div class="pull-right" style="margin-right:30px; margin-top: 8px;">
																<a href="<?php echo site_url(); ?>admin/Dashboard_courses/add_edit_courses/<?php echo $article_row->courses_id; ?>/<?php echo $article_row->chapter_id; ?>"  title="Edit" class="tip" style=""><i class="fa fa-pencil" title="Edit"></i>Edit</a>
                                                                </div>
															<div class="dd-handle">
                                                                <div class="pull-left">
                                                                    <strong style="margin-right:20px;" id="dragndrop"><?php echo $i; ?></strong>
                                                                </div>
                                                                <div class="pull-left">
                                                                    <strong><?php echo ucfirst($article_row->title); ?></strong>
                                                                </div>
																
                                                            </div>
															
                                                        </li> 
                                                        <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                <?php endif; ?>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>						
                        </div>
						 </br></br>
                        <button type="submit" name="continue" value="continue" class="add_courses btn smile-primary btn">Continue next</button>
                        <button type="submit" name="complete" value="complete" class="btn btn btn-warning">Complete</a>


                        </form> 
                        <!-- /.panel-body -->

                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div> 
        <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->


        <script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS reorder -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-nestable/jquery.nestable.js" type="text/javascript"></script>


        <!-- END PAGE LEVEL PLUGINS reorder-->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
        <script src="<?php echo base_url(); ?>assets/pages/scripts/ui-nestable.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('#sequence_menu').addClass('active');
            });
        </script>
