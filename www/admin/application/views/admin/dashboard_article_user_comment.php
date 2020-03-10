<?php require_once('includes/head.php') ?>


<body>

    <div id="wrapper">

        <?php require_once('includes/nav.php') ?>
        
          

        <div id="page-wrapper">
             
            
            <div class="row">
                <div class="col-lg-12"> 
                    
                    <h2 class="page-header"><i class="fa fa-user fa-fw" id="sidemenuicon"></i>User Comments</h2>
                   
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                       <div class="panel panel-default">
                     <div class="panel-heading">
                                                    User comments     
                                                </div>
                           </div>
                  
                   
                    <div class="panel panel-default">
<!--                        <div class="panel-heading" style="text-align:center;">
                                                 <b> <?php echo $user->username;?> </b>    
                                                </div>-->
                        <div class="panel-body">
                            <div class="dataTable_wrapper"> 
                                
                                <table width="80%" cellspacing="2" cellpadding="10" class="table table-striped table-bordered table-hover" >
                        <tr>
                            <th>Username </th>
                            <th>Email </th>
                            <th>Rating </th>
                            <th>Comment</th> 
                            <th>Created on</th>
                        </tr>
                                                              <tbody> 
                                                                   <?php foreach($user_comments as $user) {  ?>
                                                                  <tr>
                                                                       <td> <?php echo $user->username;?> </td>  
                                                                       <td ><a href="mailto:<?php if(!empty($user->email)) echo $user->email;?>"><?php if(!empty($user->email)) echo $user->email;?></a></td>  
                                                                        <td ><?php echo $user->rate;?></td>
                                                                        <td ><?php echo $user->comment;?></td>
                                                                        <td ><?php echo $user->created_on;?></td>
                                                                    </tr>
                                                                   <?php }?>
                                                                    
                                                                                                                            </tbody></table>
                                
                               
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                   
                   
                    </div>
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->




        </div>
        <!-- /#page-wrapper -->

    </div>
   <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>



    <!-- Bootstrap Core JavaScript -->

    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>



    <!-- Metis Menu Plugin JavaScript -->

    <script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>



    <!-- DataTables JavaScript -->

    <script src="<?php echo base_url(); ?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>



    <!-- Custom Theme JavaScript -->

    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>



    <!-- For Editor -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/bower_components/editor/nicEdit-latest.js">"></script>

   

                  

                    </body>

                    </html>
