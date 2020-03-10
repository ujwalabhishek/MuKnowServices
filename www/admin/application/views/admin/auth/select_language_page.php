<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo project_name;?> Admin </title>


        <link href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">


        <link href="<?php echo base_url() ?>assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/dist/css/sb-admin-2.css" rel="stylesheet">


        <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


    </head>



    <body background="<?php echo base_url(); ?>assets/images/banner2.jpg">

        <div class="container loginsection">
            <div class="row">
			<div class="col-md-1 hidden-xs">
				</div>
                <div class="col-md-10 col-xs-12">
                    <div class="login-panel panel panel-default animated fadeIn" style="margin-top:20%;">
                      <div class="col-md-6 loginleft">
					   <img src="<?php echo base_url(); ?>assets/images/2a.jpg" class="img-responsive">
					   </div>
					   <div class="col-md-6 loginleft">
					   <div class="panel-heading loginhead">
                            <div align="center">
                                <h3>Please choose the language</h3>
                            </div>


                            <!-- <h3 style="font-weight:bold" class="panel-title" align="center">Admin</h3>-->
                        </div>
                        <div class="panel-body loginbody">

                            <?php echo form_open(site_url() . 'admin/Admin_language/select_language', 'method="post"'); ?>
                            <fieldset>

                                <div class="row">

                                <div class="col-md-1 hidden-xs"></div>

                                    <div class="form-group col-md-10 col-xs-12 loginform">
                                        <!--<label>Select language</label>-->
                                        <select id="subcategory_id" name="language" data-placeholder="Choose a Subcategory..." class="form-control select-full required logintelcode" tabindex="2">
                                            <option value="english">English</option>
<!--                                            <option value="chinese">Chinese</option>-->
                                            <option value="burmese">Burmese</option>
                                        </select>

                                    </div>
                                <div class="col-md-1 hidden-xs"></div>

                                </div>
                                <br>


                                <!-- Change this to a button or input when using this as a form -->
                                <div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10 loginform">
								<input id="mainpagepopup" type="submit" class="btn btn-md  col-md-12" value="CONTINUE">
                                 </div>
								 <div class="col-md-1"></div>
								 </div>
							</fieldset>
                            <?php echo form_close(); ?>
                        </div>
						</div>
                    </div>
                </div>
				<div class="col-md-1 hidden-xs">
				</div>
            </div>
        </div>
    </body>
</html>