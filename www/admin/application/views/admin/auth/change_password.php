<?php require_once('includes/head.php')?>

<body>

    <div id="wrapper">

            <?php require_once('includes/nav.php')?>
       
<!-- Form bordered -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-md-10">
            <div class="panel-default">
                <div class="col-sm-12 panel-body">
                        <?php echo form_open("admin/auth/change_password",'class="form-horizontal form-bordered .validate"');?>
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h6 class="panel-title"><i class="icon-menu"></i> <?php echo lang('change_password_heading');?> </h6>
                          </div>
                          <div class="panel-body">
                          <h6 style="color:red"><?php echo $message;?></h6>
                            <div class="form-group">
                              <label class="col-sm-3 control-label"><?php echo lang('change_password_old_password_label', 'old_password');?> </label>
                              <div class="col-sm-8">
                                <?php echo form_input($old_password);?>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-3 control-label"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label>
                              <div class="col-sm-8">
                                <?php echo form_input($new_password);?>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-3 control-label"><?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?></label>
                              <div class="col-sm-8">
                                <?php echo form_input($new_password_confirm);?>
                              </div>
                            </div>
                            <div class="form-actions text-right">
                            <?php echo form_submit('submit', lang('change_password_submit_btn'),'class="btn btn-primary"');?>
                            </div>
                          </div>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- /form striped -->
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

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
  
<s<Script type="text/javascript">
  $(document).ready(function(){
    $('form').validate();
  });
</script>
   