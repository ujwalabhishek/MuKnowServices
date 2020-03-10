<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 require_once('includes/head.php') ?>

<body>

<!--    <div id="wrapper">-->

        <?php require_once('includes/nav.php') ?>




        <!-- Form bordered -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Moderator Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <p><?php echo lang('edit_user_subheading'); ?><a href="<?php site_url()?>/admin/Dashboard_createuser/index"><button style="float: right;" type="button" class="btn btn-info"  align="right">Back</button></a></p> 
                            
                        </div>
                        <div class="panel-body">
                            <h6 style="color:red"><?php echo $message; ?></h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php echo form_open(uri_string()); ?>
                                    <div class="form-group">
                                        <label><?php echo lang('edit_user_fname_label', 'first_name');?> </label>
                                        <?php echo form_input($first_name);?>
<!--                                            <p class="help-block">Example block-level help text here.</p>-->
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('edit_user_lname_label', 'last_name');?>  </label>
                                         <?php echo form_input($last_name);?>
                                    </div>
                                    <div class="form-group">
                                        <label> <?php echo lang('edit_user_company_label', 'company');?> </label>
                                        <?php echo form_input($company);?>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label> <?php echo lang('edit_user_phone_label', 'phone');?></label>
                                        <?php echo form_input($phone);?>
                                    </div>
                                    <div class="form-group">
                                        <label> <?php echo lang('edit_user_password_label', 'password');?></label>
                                        <?php echo form_input($password);?>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('edit_user_password_confirm_label', 'password_confirm');?></label>
                                        <?php echo form_input($password_confirm);?>
                                    </div>
                                    <div class="form-group">
                                        
          

      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>

      <p><?php echo form_submit('submit', lang('edit_user_submit_btn'));?></p>

<?php echo form_close();?>
                                    </div>

                                   
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

