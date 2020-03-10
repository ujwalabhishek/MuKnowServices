<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Muknow Admin </title>


        <link href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">


        <link href="<?php echo base_url() ?>assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/dist/css/sb-admin-2.css" rel="stylesheet">


        <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


    </head>



    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">


                        <div class="panel-heading">
                            <div align="center">
                                <h3>MuKnow</h3>
                            </div>
                            <!--                            <div align="center">
                                                          <image  style="padding-bottom: 10px;" src="<?php echo base_url() ?>assets/images/bakester_120.png" />
                                                         </div>-->

                            <h3 style="font-weight:bold" class="panel-title" align="center">Admin</h3>
                        </div>
                        <div class="panel-body">

                            <?php echo form_open("admin/auth/login"); ?>
                            <fieldset>
                                <div id="infoMessage" style="color: red"class="error"><?php echo $message; ?></div>
                                <div class="row">


                                    <div class="col-xs-4">
                                        <label><?php echo lang('create_user_phone_label', 'phone'); ?></label>

                                        <?php if (isset($tele_code) && count($tele_code)): ?>
                                            <select name="telcode" class="form-control">
                                                <?php foreach ($tele_code as $row) { ?>
                                                    <option value="<?php echo $row->code;?>"><?php echo $row->code." ";echo ucfirst($row->name); ?></option>

                                                <?php } ?>
                                            </select>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-xs-8">

                                        <?php echo form_input($identity); ?>
                                    </div>

                                </div>
                                <br>
                                <div class="form-group">
                                    <?php echo form_input($password); ?>
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <input style=" color: #333;background-color: #6563a4 !important;" type="submit" class="btn btn-lg  btn-block" value="Login">
                            </fieldset>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>