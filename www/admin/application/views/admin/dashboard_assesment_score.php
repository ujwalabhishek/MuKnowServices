<?php require_once('includes/head.php') ?>


<body>

    <div id="wrapper">

        <?php require_once('includes/nav.php') ?>
        
          

        <div id="page-wrapper">
             
            
            <div class="row">
                <div class="col-lg-12"> 
                    
                    <h2 class="page-header"><i class="fa fa-user fa-fw" id="sidemenuicon"></i>Mini Certification Scores</h2>
                   
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                       <div class="panel panel-default">
                     <div class="panel-heading">
                                                    Mini Certification Scores      
                                                </div>
                           </div>
                    <?php foreach($certify_user as $user) { 
                       
                        $scores = $this->Assessment_model->get_score_user($user->id);
                         // echo '<pre>'; print_r($scores); exit;
                        ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align:center;">
                                                 <b> <?php echo $user->username;?> </b>    
                                                </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper"> 
                                
                                <table width="80%" cellspacing="2" cellpadding="10" class="table table-striped table-bordered table-hover" >
                        <tr>
                            <th>Mini Certificate Title </th>
                            <th>Score</th>
                            <th>Result</th>
                            <th>Redeem status</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Created on</th>
                        </tr>
                                                              <tbody> 
                                                                  <?php foreach($scores as $score) { ?>
                                                                  <tr>
                                                                        
                                                                        <td ><?php echo $score->title;?></td>
                                                                        <td ><?php echo $score->score;?></td>
                                                                        <td ><?php echo $score->result;?></td>
                                                                        <td ><?php echo $score->redemed;?></td>
                                                                        <td ><a href="mailto:<?php if(!empty($score->email)) echo $score->email;?>"><?php if(!empty($score->email)) echo $score->email;?></a></td>
                                                                        <td ><?php echo $score->mobile;?></td>
                                                                        <td ><?php echo $score->created_on;?></td>
                                                                    </tr>
                                                                  <?php } ?>
                                                                    
                                                                                                                            </tbody></table>
                                
                               
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <?php } ?>
                    <!-- /.panel -->
                      <?php if(!empty($subscription)) { ?>
                    <div class="panel panel-default">
                    <div class="panel-heading">
                                                    Subscription details            
                                                </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper"> 
                                
                                <table width="80%" cellspacing="2" cellpadding="10" class="table table-striped table-bordered table-hover" >
                        <tr>
                            <th>Subscription </th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                                                              <tbody> 
                                                                  <?php  if(!empty($subscription)) { foreach($subscription as $sub) { ?>
                                                                  <tr>
                                                                        
                                                                        <td ><?php echo $sub->name;?></td>
                                                                        <td ><?php echo $sub->start_date;?></td>
                                                                        <td ><?php echo $sub->end_date;?></td>
                                                                    </tr>
                                                                  <?php } } ?>
                                                                    
                                                                                                                            </tbody></table>
                                
                               
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                        </div>
                      <?php } if(!empty($scratchcard)) { ?>
                        <div class="panel panel-default">
                    <div class="panel-heading">
                                                    Scratchcard details            
                                                </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper"> 
                                
                                <table width="80%" cellspacing="2" cellpadding="10" class="table table-striped table-bordered table-hover" >
                        <tr>
                            <th>Scratchcard </th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                                                              <tbody> 
                                                                  <?php  if(!empty($scratchcard)) { foreach($scratchcard as $scratch) { ?>
                                                                  <tr>
                                                                        
                                                                        <td ><?php echo $scratch->name;?></td>
                                                                        <td ><?php echo $scratch->start_date;?></td>
                                                                        <td ><?php echo $scratch->end_date;?></td>
                                                                    </tr>
                                                                  <?php } } ?>
                                                                    
                                                                                                                            </tbody></table>
                                
                               
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                        </div>
                        <?php } ?>
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
