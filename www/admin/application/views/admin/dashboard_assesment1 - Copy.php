<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('includes/head.php')
?>

<body>

    <!--    <div id="wrapper">-->

    <?php require_once('includes/nav.php') ?>

    <div id="page-wrapper">
        <?php if ($mode == 'add'): ?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Create Assessment</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Assessment Details
                            <a style="margin-top: -6px;float: right;" href="<?php echo site_url() ?>admin/Dashboard_assesment/index/"> <button type="button" class="btn btn-info">Back</button></a>
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

                            <div class="row">
                                <div class="col-lg-9 validate" >
                                    <form role="form" id="add_form" method="post" action="<?php echo site_url() ?>admin/Dashboard_assesment/add_edit_data">

                                        <div class="form-group">
                                            <label>Select Department</label>
                                            <?php
                                            $department1 = $department;
                                            $department1 [''] = 'Select a Department';

                                            $options = 'data-placeholder="Choose a category..." class="form-control category_id select-full required"  tabindex="2"';
                                            echo form_dropdown('department_id', $department1, @$main_category->id, $options);
                                            ?>

                                        </div>



                                </div>
                                <?php //echo form_close(); ?>
                            </div>
                            <!-- /.row (nested) -->
                            <?php
                            if (!empty($department)):

                                if (!empty($category)):

                                    foreach ($category as $category_row) {
                                        ?>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h4><srtrong>Category: <?php echo ucfirst($category_row->name); ?></strong><h4>
                                                            </div>
                                                            </div>
                                                            <?php
                                                            if (!empty($article)):
                                                                $i = 1;
                                                                ?>


                                                                <?php
                                                                foreach ($article as $article_row) {
                                                                    if ($category_row->id == $article_row->cat_id):
                                                                        ?>
                                                                        <div class="row">
                                                                            <div class="col-lg-12">

                                                                                <div class="panel panel-info">
                                                                                    <div class="panel-heading" style="padding: 5px 5px;">
                                                                                        <input type="checkbox" class="select_art" name="question[]" style="float: right;" value="<?php echo $article_row->id; ?>"/>
                                                                                        <?php echo ucfirst($article_row->title) ?>

                                                                                    </div>
                                                                                    <div class="panel-body" style="height:100px">
                                                                                        <p><?php echo ucfirst($article_row->question); ?></p>
                                                                                    </div>                                    

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                        $i++;

                                                                    endif;
                                                                }
                                                                ?>

                                                                <?php
                                                            else:
                                                                echo "No article found";
                                                            endif;
                                                            ?>

                                                            <?php
                                                        }
                                                    else:
                                                        echo "Sorry! There is no article question is present to select."."<br>";
                                                    endif;
                                                else:
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-lg-12">

                                                            <div class="panel panel-info">

                                                                <div class="panel-body" style="height:100px">
                                                                    <p>Sorry! No department found to create assessment</p>
                                                                </div>                                    

                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                endif;
                                                ?>
                                                <br>
                                                <?php if (!empty($department)): ?>
                                                    <button type="button" class="add_assessment btn smile-primary btn">Submit</button>
                                                    <button style="float:right" type="reset" class="btn btn btn-warning">Cancel</button>

                                                <?php endif;
                                                ?>
                                                </form> 
                                                <!-- /.panel-body -->
                                                </div>
                                                <!-- /.panel -->
                                                </div>
                                                <!-- /.col-lg-12 -->
                                                </div>
                                                <!-- /.row -->
                                                </div> 
                                            <?php endif;
                                            ?>
                                            <?php if ($mode == 'edit'): ?>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h1 class="page-header">Edit Assessment</h1>
                                                    </div>
                                                    <!-- /.col-lg-12 -->
                                                </div>
                                                <!-- /.row -->
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                Article Details
                                                                <a style="margin-top: -6px;float: right;" href="<?php echo site_url() ?>admin/Dashboard_assesment/index/"> <button type="button" class="btn btn-info">Back</button></a>
                                                            </div>
                                                            <?php //echo form_open_multipart(site_url() . '/admin/Dashboard_articles/add_edit_article', 'id="cat_form" class=".validate"');   ?>
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-lg-9 validate" >
                                                                        <form role="form" id="edit_form" method="post" action="<?php echo site_url() ?>admin/Dashboard_assesment/add_edit_data">

                                                                            <div class="form-group">
                                                                                <label>Department:</label>
                                                                                <strong><?php echo ucfirst($department->name); ?></strong>

                                                                            </div>



                                                                    </div>

                                                                    <?php //echo form_close();   ?>
                                                                </div>
                                                                <!-- /.row (nested) -->
                                                                <?php
                                                                if (!empty($category)):

                                                                    foreach ($category as $category_row) {
                                                                        ?>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <h4><srtrong>Category: <?php echo ucfirst($category_row->name); ?></strong><h4>
                                                                                            </div>
                                                                                            </div>
                                                                                            <?php
                                                                                            if (!empty($article)):
                                                                                                $i = 1;
                                                                                                ?>


                                                                                                <?php
                                                                                                foreach ($article as $article_row) {
                                                                                                    if ($category_row->id == $article_row->cat_id):
                                                                                                        ?>
                                                                                                        <div class="row">
                                                                                                            <div class="col-lg-12">

                                                                                                                <div class="panel panel-info">
                                                                                                                    <div class="panel-heading" style="padding: 5px 5px;">
                                                                                                                        <input type="checkbox" name="question[]" class="sel_check" style="float: right;" value="<?php echo $article_row->id; ?>"
                                                                                                                        <?php
                                                                                                                        for ($i = 0; $i < count($selected_article); $i++) {

                                                                                                                            if ($selected_article[$i] == $article_row->id):
                                                                                                                                echo "checked"." "."disabled";

                                                                                                                            endif;
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                               />
                                                                                                                               <?php echo ucfirst($article_row->title) ?>

                                                                                                                    </div>
                                                                                                                    <div class="panel-body" style="height:100px">
                                                                                                                        <p><?php echo ucfirst($article_row->question); ?></p>
                                                                                                                    </div>                                    

                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <?php
                                                                                                        $i++;

                                                                                                    endif;
                                                                                                }
                                                                                                ?>

                                                                                                <?php
                                                                                            endif;
                                                                                            ?>

                                                                                            <?php
                                                                                        }
                                                                                    else:
                                                                                        echo "no aticle found";
                                                                                    endif;
                                                                                    ?>
                                                                                    <br>
                                                                                    <input type="hidden" name="assess_id"  value="<?php echo $this->uri->segment(4); ?>"/>
                                                                                    <button type="button" class="edit_assessment btn smile-primary btn">Submit</button>
                                                                                    <button style="float:right" type="reset" class="btn btn btn-warning">Cancel</button>
                                                                                    </form> 
                                                                                    <!-- /.panel-body -->
                                                                                    </div>
                                                                                    <!-- /.panel -->
                                                                                    </div>
                                                                                    <!-- /.col-lg-12 -->
                                                                                    </div>
                                                                                    <!-- /.row -->
                                                                                    </div> 
                                                                                <?php endif;
                                                                                ?>
                                                                                <?php if ($mode == 'view'): ?>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <h1 class="page-header">View Assessment</h1>
                                                                                        </div>
                                                                                        <!-- /.col-lg-12 -->
                                                                                    </div>
                                                                                    <!-- /.row -->
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="panel panel-default">
                                                                                                <div class="panel-heading">
                                                                                                    Assessment Details
                                                                                                    <a style="margin-top: -6px;float: right;" href="<?php echo site_url() ?>admin/Dashboard_assesment/index/"> <button type="button" class="btn btn-info">Back</button></a>
                                                                                                </div>
                                                                                                <?php //echo form_open_multipart(site_url() . '/admin/Dashboard_articles/add_edit_article', 'id="cat_form" class=".validate"');   ?>
                                                                                                <div class="panel-body">
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-9 validate" >
                                                                                                            <form role="form" id="edit_form" method="post" action="<?php echo site_url() ?>admin/Dashboard_assesment/add_edit_data">

                                                                                                                <div class="form-group">
                                                                                                                    <label>Department:</label>
                                                                                                                    <strong><?php echo ucfirst($department->name); ?></strong>

                                                                                                                </div>



                                                                                                        </div>

                                                                                                        <?php //echo form_close();   ?>
                                                                                                    </div>
                                                                                                    <!-- /.row (nested) -->
                                                                                                    <?php
                                                                                                    if (!empty($article)):

                                                                                                       foreach ($article as $article_row) {
                                                                                                            ?>
                                                                                                            <div class="row">
                                                                                                                <div class="col-lg-6">
                                                                                                                    <?php //if (!empty($article)):
                                                                                                                                   // $i = 1;
                                                                                                                                    ?>
                                                                                                                    <h4><srtrong>Category: <?php echo ucfirst($article_row->category_name); ?></strong><h4>
                                                                                                                                </div>
                                                                                                                                </div>
                                                                                                                                
                                                                                                                               


                                                                                                                                    <?php
                                                                                                                                    //foreach ($article as $article_row) {
                                                                                                                                       // if ($category_row->id == $article_row->cat_id):
                                                                                                                                            ?>
                                                                                                                                            <div class="row">
                                                                                                                                                <div class="col-lg-12">

                                                                                                                                                    <div class="panel panel-info">
                                                                                                                                                        <div class="panel-heading" style="padding: 5px 5px;">

                                                                                                                                                            <?php echo ucfirst($article_row->title) ?>

                                                                                                                                                        </div>
                                                                                                                                                        <div class="panel-body" style="height:100px">
                                                                                                                                                            <p><?php echo ucfirst($article_row->question); ?></p>
                                                                                                                                                        </div>                                    

                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                            <?php
                                                                                                                                            //$i++;
                                                                                                                                            //else:
                                                                                                                                                //echo "no Assessment found";
                                                                                                                                       // endif;
                                                                                                                                    //}
                                                                                                                                    ?>

                                                                                                                                    <?php
                                                                                                                                //endif;
                                                                                                                                ?>

                                                                                                                                <?php
                                                                                                                            }
                                                                                                                        else:
                                                                                                                            echo "No Assessment found";
                                                                                                                        endif;
                                                                                                                        ?>
                                                                                                                        <br>
                                                                                                                        <input type="hidden" name="assess_id"  value="<?php echo $this->uri->segment(4); ?>"/>
                                                                                                                        
                                                                                                                        </form> 
                                                                                                                        <!-- /.panel-body -->
                                                                                                                        </div>
                                                                                                                        <!-- /.panel -->
                                                                                                                        </div>
                                                                                                                        <!-- /.col-lg-12 -->
                                                                                                                        </div>
                                                                                                                        <!-- /.row -->
                                                                                                                        </div> 
                                                                                                                    <?php endif;
                                                                                                                    ?>
                                                                                                                    <?php if ($mode == 'all'): ?>
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-lg-12">
                                                                                                                                <h1 class="page-header">Assessment Details </h1>

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
                                                                                                                        <?php if ($this->session->flashdata('warning')) { ?>
                                                                                                                            <div class="alert alert-info fade in block-inner">
                                                                                                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                                                                                                <i class="icon-checkmark-circle"></i> <?php echo $this->session->flashdata('warning') ?> </div>
                                                                                                                        <?php } ?>
                                                                                                                        <!-- /.row -->
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-lg-12">
                                                                                                                                <div class="panel panel-default">
                                                                                                                                    <div class="panel-heading">
                                                                                                                                        Assessment Details
                                                                                                                                        <a href="<?php echo site_url() ?>admin/Dashboard_assesment/add_edit" role="button"   title=""><button type="button" style="margin-left: 72%;" class="btn smile-primary">Create Assessment</button></a>
                                                                                                                                    </div>

                                                                                                                                    <!-- /.panel-heading -->
                                                                                                                                    <div class="panel-body">
                                                                                                                                        <div class="dataTable_wrapper">
                                                                                                                                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                                                                                                                <thead>
                                                                                                                                                    <tr>
                                                                                                                                                        <th>Sl. No.</th>
                                                                                                                                                        <th>Department</th>
                                                                                                                                                        <th>Created On</th>
                                                                                                                                                        <th>Action</th>
                                                                                                                                                    </tr>
                                                                                                                                                </thead>
                                                                                                                                                <tbody>

                                                                                                                                                    <?php
                                                                                                                                                    if (isset($assesment_list) && count($assesment_list)):
                                                                                                                                                        $i = 1;
                                                                                                                                                        foreach ($assesment_list as $row) {
                                                                                                                                                            ?>

                                                                                                                                                            <tr class="odd gradeX">
                                                                                                                                                                <td><?php echo $i; ?></td>
                                                                                                                                                                <td><?php echo ucfirst($row->department_name); ?></td>
                                                                                                                                                                <td><?php echo $row->created_on; ?></td>







                                                                                                                                                                <td>

                                                                                                                                                                    <a  href="<?php echo site_url() ?>/admin/Dashboard_assesment/add_edit/<?php echo $row->id ?>"><i  data1="<?php echo 'builder_' . $row->id ?>" class="model_form fa fa-pencil"></i></a>
                                                                                                                                                                    <a  href="<?php echo site_url() ?>/admin/Dashboard_assesment/view/<?php echo $row->id ?>"><i  data1="<?php echo 'builder_' . $row->id ?>" class="model_form fa fa-eye"></i></a>

                                                                                                                                                                    <a  href="#"><i   data="<?php echo $row->id ?>" class="status_check fa fa-remove"></i></a></td>

                                                                                                                                                                <?php
                                                                                                                                                                $i++;
                                                                                                                                                            }
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
                                                                                                                    <?php endif; ?>



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
                                                                                                                                    url = "<?php echo site_url() ?>admin/Dashboard_assesment/delete";

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
                                                                                                                                if (confirm("Are you sure want to perform this action ?")) {

                                                                                                                                    var id = $(this).attr('data');
                                                                                                                                    var status = $(this).val();
                                                                                                                                    // alert ($(current_element).attr('data'))
                                                                                                                                    url = "<?php echo site_url() ?>/admin/Dashboard_createuser/active";

                                                                                                                                    //alert(url);
                                                                                                                                    $.ajax({
                                                                                                                                        type: "POST",
                                                                                                                                        url: url,
                                                                                                                                        data: {id: id, status: status},
                                                                                                                                        success: function (data)
                                                                                                                                        {

                                                                                                                                            //alert("Successfully Deleted");
                                                                                                                                            location.reload();

                                                                                                                                        }
                                                                                                                                    });
                                                                                                                                }

                                                                                                                            });
                                                                                                                            $('.add_assessment').click(function () {
                                                                                                                                //$("#add_form").valid();

                                                                                                                                event.preventDefault();
                                                                                                                                if ($('.select_art').is(':checked')) {
                                                                                                                                    //alert('selected');
                                                                                                                                    $('#add_form').submit();
                                                                                                                                } else
                                                                                                                                {
                                                                                                                                    alert('Please select any question.')
                                                                                                                                }



                                                                                                                            });
                                                                                                                            $('.edit_assessment').click(function () {
                                                                                                                                //$("#edit_form").valid();

                                                                                                                                event.preventDefault();

                                                                                                                                if ($('.sel_check').is(':checked')) {
                                                                                                                                    //alert('selected');
                                                                                                                                    $('#edit_form').submit();
                                                                                                                                } else
                                                                                                                                {
                                                                                                                                    alert('Please select any question.')
                                                                                                                                }


                                                                                                                            });
                                                                                                                        });
                                                                                                                    </script>

                                                                                                                    </body>

                                                                                                                    </html>