<?php require_once('includes/head.php')?>



<body>



    <div id="wrapper">

        

    <?php require_once('includes/nav.php')?>

<?php //print_r($tbldata);?>



        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h2 class="page-header"><?php echo "Send Mail"; ?></h2>
					
					<?php if($this->session->flashdata('msg')){?>
						<div class="alert alert-success"> 
							<button type="button" class="close" data-dismiss="alert">×</button>		
							<?php echo $this->session->flashdata('msg')?>
						</div>
					<?php } ?>
					
					<?php if($this->session->flashdata('errmsg')){?>
						<div class="alert alert-danger fade in block-inner"> 
							<button type="button" class="close" data-dismiss="alert">×</button>		
							<?php echo $this->session->flashdata('errmsg')?>
						</div>
					<?php } ?>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default table-responsive">

                        <div class="panel-heading table-responsive sectionhead">

                            <?php echo "Compose Mail"; ?>
                            <?php if(!empty($emails)) { ?>
               <div style="float:right;"><button type="button" onclick="location.href='<?php echo site_url();?>admin/Dashboard_feedback/index'" class="btn closebtn">Back</button></div>
        
                            <?php    } else { ?>
                            <div style="float:right;"><button type="button" onclick="location.href='<?php echo site_url();?>admin/Dashbord_welcome/index'" class="btn closebtn">Back</button></div>
                            <?php } ?>
                        </div>

                        

                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">

                                <form name="mail_form" action="<?php echo base_url();?>index.php/admin/Dashboard_send_mail/send_email" method="post">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>E-mail : </th><td><input type="text" value="<?php if(!empty($emails)) echo $emails;?>" name="email" class="form-control input-sm"></td>

                                        </tr>

                                        <tr>

                                            <th>Subject :</th><td><input type="text" value="" name="subject" class="form-control input-sm"></td>

                                        </tr>

                                        <tr>

                                            <th style="VERTICAL-ALIGN: -webkit-baseline-middle;">Message : </th>

                                            <td><textarea name="message" style="width: 100%; height:270px" value="" class="form-control input-sm">

                                            

                                            </textarea></td>

                                        </tr>

                                        <tr>

                                        <th></th><td><button type="submit" value="save" class="btn btn-success subbtn" style="float:right" >Send</button></td>

                                        </tr>

                                        

                                    </thead>

                                    

                                      

                                </table>

                                    </form>

                            </div>

                            <!-- /.table-responsive -->

                            

                        </div>

                        <!-- /.panel-body -->

                    </div>

                    <!-- /.panel -->

                </div>

            </div>

          

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

   

    <!-- For Editor -->

    <script type="text/javascript" src="<?php echo base_url();?>assets/bower_components/editor/nicEdit-latest.js">"></script>

    <script type="text/javascript">

//<![CDATA[

        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

  //]]>

  </script>

    

</body>



</html>

