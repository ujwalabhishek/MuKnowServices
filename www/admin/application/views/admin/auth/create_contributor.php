<?php require_once('includes/head.php') ?>
<?php require_once('includes/loader.php') ?>
<body>
    <div class="modal modal_load" style="display: none">
        <div class="center">
            <div class="loader"></div>
<!--            <img alt="" src="<?php base_url(); ?>/assets/loader.gif" />-->
        </div>
    </div>
    <!--    <div id="wrapper">-->

    <?php require_once('includes/nav.php') ?>




    <!-- Form bordered -->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"><i class="fa fa-plus-circle" id="sidemenuicon"></i> Create <?php
                    echo "Contributor";
                    ?></h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading sectionhead">
                        <p><?php echo lang('create_user_subheading'); ?><button onclick="goBack()" style="float: right;margin-top:-4px;" type="button" class="btn btn-info closebtn"  align="right">Back</button></p> 

                    </div>
                    <div class="panel-body">
<?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success fade in block-inner">            
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <i class="icon-checkmark-circle"></i> <?php echo $this->session->flashdata('success') ?> </div>
<?php } ?>
                        <h6 style="color:red"><?php echo $message; ?></h6>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
<?php echo form_open("admin/auth/create_contributor", 'class="validate"'); ?>
                                <div class="row">
								<div class="col-md-6 form-group">
                                    <label>Full Name : </label>
<?php echo form_input($username); ?>
<!--                                            <p class="help-block">Example block-level help text here.</p>-->
                                </div>
                                <div class="col-md-6 form-group">

                                    <div class="form-group">
                                        <label>Select the user type</label>
                                        <!--                                        <label>Selects Categories</label>-->

                                        <select name="user_type" class="form-control">
                                            <option value="Contributor">Contributor</option>

                                        </select>


                                    </div>
                                </div>
								</div>
                                <div class="row">


                                    <div class="col-md-3">
                                        <label><?php echo lang('create_user_phone_label', 'phone'); ?>*</label>

<?php if (isset($tele_code) && count($tele_code)): ?>
                                            <select name="telcode" class="form-control">
                                            <?php foreach ($tele_code as $row) { ?>
                                                    <option value="<?php echo $row->code ?>" <?php echo (set_value('telcode') == $row->code) ? " selected=' selected'" : "" ?>><?php echo $row->code . " ";
                                        echo ucfirst($row->name) ?></option>

                                                <?php } ?>
                                            </select>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-3">

                                        <?php echo form_input($phone); ?>
                                    </div>
									<div class="col-md-6 form-group">
                                    <label><?php echo lang('create_user_email_label', 'email'); ?></label>
                                    <?php echo form_input($email); ?>
                                </div>

                                </div>
                                <br>
                                
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label><?php echo lang('create_user_company_label', 'company'); ?>*</label>
                                    <?php
                                    //$options = array('-1' => 'SELECT COMPANY', '1' => 'Small Shirt', 'med' =>
                                    //'Medium Shirt', 'large' => 'Large Shirt', 'xlarge' => 'Extra Large Shirt',);
                                    //echo form_dropdown('company',$company,'', 'class="form-control" id="my_id"');
                                    //form_dropdown('name', $array, '', 'class="my_class" id="my_id"')
                                    ?>
                                    <?php if (isset($company) && count($company)): ?>
                                        <select name="company" class="company form-control">
                                            <option value="">Choose a company</option>
                                            <?php foreach ($company as $row) { ?>
                                                <option value="<?php echo $row->id ?>"><?php echo ucfirst($row->name) ?></option>

                                            <?php } ?>
                                        </select>
                                    <?php endif; ?>
<!--                                                                            <label><?php ///echo lang('create_user_company_label', 'company');      ?></label>-->
                                    <?php // echo form_input($company);    ?>
                                </div>
                                <div class="col-md-6 form-group">

                                    <div class="form-group">
                                        <label>Select a Department:*</label>
                                        <!--                                        <label>Selects Categories</label>-->
                                        <select id="department" name="department" data-placeholder="Choose a department..." class="form-control select-full required" tabindex="2">
                                            <option value="">Choose a department</option>
                                        </select>

                                    </div>
                                </div>
								</div>
								<div class="row">
                                <div class="col-md-4 form-group">
                                    <label>Learner Id:</label>
                                    <?php echo form_input($empid); ?>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label><?php echo lang('create_user_password_label', 'password'); ?>*</label>
                                    <?php echo form_input($password); ?>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label><?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?>*</label>
                                    <?php echo form_input($password_confirm); ?>
                                </div>
								</div>
                                <div class="form-actions text-right">
                                    <?php echo form_submit('submit', lang('create_user_submit_btn')); ?>
                                </div>


                                </form>
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
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $(document).on('change', '.company', function () {
                $(".modal").show();
                var value = $(this).val();
                var url = "<?php echo site_url() ?>admin/Dashboard_createuser/department/" + value;
                $.ajax({
                    url: url,
                    success: function (data)
                    {
                        if (data)
                            $('#department').html(data);
                        $(".modal").hide();
                    }
                });
                $('#department').select("val", "");
            });
            $('#user').addClass('active');
             $('.number').keydown(function(event) {
                // Allow special chars + arrows 
                if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
                    || event.keyCode == 27 || event.keyCode == 13 
                    || (event.keyCode == 65 && event.ctrlKey === true) 
                    || (event.keyCode >= 35 && event.keyCode <= 39)){
                        return;
                }else {
                    // If it's not a number stop the keypress
                    if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                        event.preventDefault(); 
                    }   
                }
            });
        });
    </script>
	
	<script>
function goBack() {
    window.history.back();
}
</script>