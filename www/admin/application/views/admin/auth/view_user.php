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

            <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-star" id="sidemenuicon"></i> <?php if ($this->uri->segment(4) == 'contributor'): echo 'Contributor'; endif;?>
                        <?php if ($this->uri->segment(4) == 'facilitator'): echo 'Facilitator'; endif;?>
                        <?php if ($this->uri->segment(4) == 'subscriber'): echo 'Subscriber'; endif;?>
                        Details (Create/Ban User)</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <?php if ($this->session->flashdata('message')) { ?>
                <div class="alert alert-success fade in block-inner">            
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="icon-checkmark-circle"></i> <?php echo $this->session->flashdata('message') ?> </div>
            <?php } ?>
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger fade in block-inner">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="icon-checkmark-circle"></i> <?php echo $this->session->flashdata('error') ?> </div>
            <?php } ?>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading sectionhead">
                            <?php $abuilder = array('id' => '', 'name' => ''); ?>
                            <script>var builder_0 = <?php echo json_encode($abuilder) ?></script>
                            
                            <?php if ($this->uri->segment(4) == 'contributor'): ?>
                            <?php echo ucfirst($this->uri->segment(4))?> Details
                                <a href="<?php echo site_url()?>admin/auth/create_contributor" role="button"   title=""><button type="button" style="float:right;margin-top:-5px !important;" class="btn smile-primary">Create contributor <i class="fa fa-plus" style="color:#fff;"></i></button></a>
                            <?php endif; ?>
                                
                                <?php if ($this->uri->segment(4) == 'facilitator'): ?>
                                 <?php echo ucfirst($this->uri->segment(4))?> Details
                                <a href="<?php echo site_url()?>admin/auth/create_user" role="button"   title=""><button type="button" style="float:right;margin-top:-5px !important;" class="btn smile-primary">Create facilitator <i class="fa fa-plus" style="color:#fff;"></i></button></a>
                            <?php endif; ?>
                                <?php if ($this->uri->segment(4) == 'subscriber'): ?>
                                 <?php echo ucfirst($this->uri->segment(4))?> Details
<!--                                <a href="////<?php echo site_url()?>/admin/auth/create_user/?user_type=subscriber" role="button" style="float: right;" class="align-left" title="Add Advertise"><i  data1="builder_0" class="model_form fa fa-plus-circle"></i></a>-->
                            <?php endif; ?>
                        </div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Sl. No</th>
                                            <th>Full Name</th>
                                            <th>email</th>
                                            <th>Phone</th>
                                            <th>Company Name</th>
                                            <th>Department Name</th>
                                            <th>Status</th>
                                            <th>Created on</th>

<!--                                            <th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if (isset($all_user) && count($all_user)):
                                            $i=1;
                                            foreach ($all_user as $row) {
                                                ?>

                                                <tr class="odd gradeX">
                                                   
                                                    <td><?php echo $i;   ?></td>
                                                    <td><?php echo ucfirst($row->username);   ?></td>
                                                     
                                                      <td><?php echo ucfirst($row->email);   ?></td>
                                                      <?php if(!empty($row->phone))
                                                      {?>
                                                          <td><?php echo ucfirst($row->phone);   ?></td>
                                                     <?php  }  else {?>
    

                                                          <td>Not found</td>
                                                        <?php } ?>
                                                      <?php if(!empty($row->company))
                                                      {?>
                                                          <td><?php echo ucfirst($row->company_name);   ?></td>
                                                     <?php  }  else {?>
    

                                                          <td>Not found</td>
                                                        <?php } ?>
                                                          <?php if(!empty($row->department))
                                                      {?>
                                                          <td><?php echo ucfirst($row->department_name);   ?></td>
                                                     <?php  }  else {?>
    

                                                          <td>Not found</td>
                                                        <?php } ?>
                                                                  <td>
                                                                      <select class="form-control status_check_active" data="<?php echo $row->id; ?>">
                                                                          <option value="1" <?php echo ($row->active=='1') ?  "selected=selected" : "";?>>Active</option>
                                                                          <option value="0" <?php echo ($row->active=='0') ?  "selected=selected" : "";?>>Inactive</option>
                                                              </select></td>
                                                      
                                                       <td><?php echo $row->created_on;   ?></td>
                                                   
                                                   
                                                 
<!--                                                    <td>
                                                        <script>var builder_<?php echo $row->id ?> = <?php echo json_encode($row); ?></script>
                                                        <a  href="<?php echo site_url()?>/admin/auth/edit_user/<?php echo $row->id?>"><i  data1="<?php echo 'builder_' . $row->id ?>" class="model_form fa fa-pencil"></i></a>


                                                            <a  href="#"><i   data="<?php echo $row->id ?>" class="status_check fa fa-remove"></i></a></td>
                                                   -->
                                                <?php
                                                $i++; }
                                            endif;
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->

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

    </div>
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
                                $(document).ready(function () {
                                   
                                    $('#dataTables-example').DataTable({
                                        responsive: true
                                    });
                                   $(document).on('click', '.status_check', function () {
                                        if (confirm("Are you sure to delete data")) {
                                            var current_element = $(this);
                                          // alert ($(current_element).attr('data'))
                                            url = "<?php echo site_url() ?>/admin/Dashboard_createuser/delete";

                                            //alert(url);
                                            $.ajax({
                                                type: "POST",
                                                url: url,
                                                data: {id: $(current_element).attr('data')},
                                                success: function (data)
                                                {

                                                    //alert("Successfully Deleted");
                                                    location.reload();

                                                }
                                            });
                                        }

                                    });
                                    $(document).on('change', '.status_check_active', function () {
                                        if (confirm("Are you sure want to perform this operation ?")) {
                                            
                                            var id=$(this).attr('data');
                                            var status = $(this).val();
                                          // alert ($(current_element).attr('data'))
                                            url = "<?php echo site_url() ?>/admin/Dashboard_createuser/active";

                                            //alert(url);
                                            $.ajax({
                                                type: "POST",
                                                url: url,
                                                data: {id:id,status:status},
                                                success: function (data)
                                                {

                                                    //alert("Successfully Deleted");
                                                    location.reload();

                                                }
                                            });
                                        }

                                    });
                                     $('#user').addClass('active');
                                });
</script>

</body>

</html>