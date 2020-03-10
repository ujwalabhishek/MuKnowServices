<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('includes/head.php')
?>
<?php require_once('includes/loader.php') ?>

<body>
    <div class="modal" style="display: none">
        <div class="center">
              <div class="loader"></div>
<!--            <img alt="" src="<?php base_url(); ?>/assets/loader.gif" />-->
        </div>
    </div>
    <!--    <div id="wrapper">-->

    <?php require_once('includes/nav.php') ?>

    <div id="page-wrapper">
        <?php if ($mode == 'add'): ?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Create Mini-Lessons</h2>
                    <a href="<?php echo site_url() ?>admin/dashboard_sequence/index" role="button"   class="pull-left"  style="margin-left: 94%;margin-top: -60px;" title=""><button type="submit"    class="btn btn-primary closebtn">Back </button></a>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="height: 50px;">
                            <form role="form" id="addsequence_form" method="post" class="validate" action="<?php echo site_url() ?>admin/Dashboard_sequence/reorder_article_page">

                                <!--                            //Sequence Details-->
                                <!--                            <a style="margin-top: -6px;float: right;" href="<?php //echo site_url()                                                                         ?>admin/Dashboard_assesment/index/"> <button type="button" class="btn btn-info">Back</button></a>-->
                                <button type="reset"   class="pull-left btn btn-warning closebtn">Reset</button>
                                <button type="submit" style="float:right;"  class="add_sequence btn smile-primary btn">Submit</button>

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

                            <div class="form-group">
                                <h4><strong>Title*</strong><h4>
                                        <input type="text"  name="title" id="title" class="form-control required" maxlength="20"/>
                                        <h5><p style="display:none;" class="error" id="title_label" >Please enter the title.</p></h5>

                                        <input type="hidden" name="curl" value="<?php echo base_url(uri_string()); ?>"
                                               </div>
                                        <div class="row">
                                            <div class="col-lg-4">

                                                <h4><strong>Select Group to push Mini-Lessons *</strong></h4>
                                                <h5><p style="display:none;" class="error" id="group_label" >Please select the group.</p></h5>
                                            </div>

                                        </div>
                                        <?php if (!empty($group)): ?>


                                            <div class="row">
                                                <?php foreach ($group as $group_row) { ?>
                                                    <div class="col-lg-3">

                                                        <div class="panel panel-info">
                                                            <div class="panel-heading" style="padding: 5px 5px; background-color:#ed1c24;color:#fff;">
                                                                <input type="checkbox" name="group[]" value="<?php echo $group_row->id ?>" style="float: left;margin-right: 10px;"/>
                                                                <?php echo ucfirst($group_row->title); ?>

                                                            </div>
                                                        </div>


                                                    </div>
                                                <?php } ?>



                                            </div>
                                            <?php
                                        endif;
                                        ?>

                                        <!--                                                  
                                        <!-- /.row (nested) -->
<!--                                        <input type="text" name="select_article[]" class="select_art" id="result_art_selected" value=""/>-->
                                        <div class="result"></div>
                                        <h4><strong>Select Articles *</strong><h4>
                                                <h5><p style="display:none;" class="error" id="article_label" >Please select the any article.</p></h5>
                                                <?php
                                                if (!empty($category)):

                                                    foreach ($category as $category_row) {
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <h4><strong style="color:#333;">Category: <?php echo ucfirst($category_row->name); ?></strong><h4>
                                                                        </div>
                                                                        </div>
                                                                        <?php
                                                                        if (!empty($article)):
                                                                            $i = 1;
                                                                            ?>

                                                                            <!-- /.panel-heading -->
                                                                            <div class="panel-body">

                                                                                <div class="dataTable_wrapper">
                                                                                    <table width="100%" class="table table-striped table-bordered table-hover dataTables-example " id="table-style">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Select</th>
                                                                                                <th>Article Title</th>
                                                                                                <th>Action</th>

                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>


                                                                                            <?php
                                                                                            foreach ($article as $article_row) {
                                                                                                if ($category_row->id == $article_row->cat_id):
                                                                                                    ?>
                                                                                                    <tr class="odd gradeX">
                                                                                                        <td><input type="checkbox" name="select_article[]" class="select_art" value="<?php echo $article_row->id ?>"/></td>
                                                                                                        <td><?php echo ucfirst($article_row->title) ?></td>
                                                                                                        <td>

                                                                                                            <a  href="<?php echo site_url(); ?>admin/Dashboard_sequence/preview_article/<?php echo $article_row->id; ?>"  target="_blank"  title="View" class="tip">Preview</a>
                                                                                                        </td>                                                                                                                                                                                     </tr>
                                                                                                    <?php
                                                                                                endif;
                                                                                            }
                                                                                        endif;
                                                                                        ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <!-- /.table-responsive -->

                                                                        </div>
                                                                        <?php
                                                                    }
                                                                else:
                                                                    echo "Sorry! There is no article question is present to select." . "<br>";
                                                                endif;
                                                                ?>

                                                                <br>

                                                                <button type="button" class="add_sequence btn smile-primary subbtn">Submit</button>
                                                                <button style="float:right" type="reset" class="btn btn btn-warning closebtn">Reset</button>


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
                                                                            <?php //echo form_open_multipart(site_url() . '/admin/Dashboard_articles/add_edit_article', 'id="cat_form" class=".validate"');         ?>
                                                                            <div class="panel-body">
                                                                                <div class="row">
                                                                                    <div class="col-lg-9 validate" >
                                                                                        <form role="form" id="edit_form" method="post" action="<?php echo site_url() ?>admin/Dashboard_assesment/add_edit_data">

                                                                                            <div class="form-group">
                                                                                                <label>Department:</label>
                                                                                                <strong><?php echo ucfirst($department->name); ?></strong>

                                                                                            </div>



                                                                                    </div>

                                                                                    <?php //echo form_close();         ?>
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
                                                                                                                                                echo "checked" . " " . "disabled";

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
                                                                                                    <input type="hidden" name="article_id"  value="<?php echo $this->uri->segment(4); ?>"/>
                                                                                                    <button type="button" class="edit_assessment btn smile-primary btn">Submit</button>
                                                                                                    <button style="float:right" type="reset" class="btn btn btn-warning">Reset</button>
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
                                                                                                                     Mini-Lessons Details 
                                                                                                                    <a style="margin-top: -6px;float: right;" href="<?php echo site_url() ?>admin/Dashboard_assesment/index/"> <button type="button" class="btn btn-info">Back</button></a>
                                                                                                                </div>
                                                                                                                <?php //echo form_open_multipart(site_url() . '/admin/Dashboard_articles/add_edit_article', 'id="cat_form" class=".validate"');         ?>
                                                                                                                <div class="panel-body">
                                                                                                                    <div class="row">
                                                                                                                        <div class="col-lg-9 validate" >
                                                                                                                            <form role="form" id="edit_form" method="post" action="<?php echo site_url() ?>admin/Dashboard_assesment/add_edit_data">

                                                                                                                                <div class="form-group">
                                                                                                                                    <label>Department:</label>
                                                                                                                                    <strong><?php echo ucfirst($department->name); ?></strong>

                                                                                                                                </div>



                                                                                                                        </div>

                                                                                                                        <?php //echo form_close();         ?>
                                                                                                                    </div>
                                                                                                                    <!-- /.row (nested) -->
                                                                                                                    <?php
                                                                                                                    if (!empty($article)):

                                                                                                                        foreach ($article as $article_row) {
                                                                                                                            ?>
                                                                                                                            <div class="row">
                                                                                                                                <div class="col-lg-6">
                                                                                                                                    <?php
                                                                                                                                    //if (!empty($article)):
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
                                                                                                                                        <!--                                                                                                                                                        <div class="modal" style="display: none">
                                                                                                                                                                                            <div class="center">
                                                                                                                                                                                            <img alt="" src="<?php base_url(); ?>/assets/loader.gif" />
                                                                                                                                                                                            </div>
                                                                                                                                                                                            </div>-->
                                                                                                                                        <div class="row">
                                                                                                                                            <div class="col-lg-12">
                                                                                                                                                <h2 class="page-header"><i class="fa fa-graduation-cap fa-fw" id="sidemenuicon"></i> Mini-Lessons Details </h2>

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
                                                                                                                                                    <div class="panel-heading sectionhead">
                                                                                                                                                        Mini-Lessons Details
                                                                                                                                                        <a href="<?php echo site_url() ?>admin/Dashboard_sequence/add_edit" role="button"   title=""><button type="button" style="float:right;margin-top:-5px !important;" class="btn smile-primary">Create Mini-Lessons <i class="fa fa-plus fa-fw"></i></button></a>
                                                                                                                                                    </div>

                                                                                                                                                    <!-- /.panel-heading -->
                                                                                                                                                    <div class="panel-body">
                                                                                                                                                        <div class="dataTable_wrapper">
                                                                                                                                                            <table width="100%" class="table table-striped table-bordered table-hover " id="dataTables-example">
                                                                                                                                                                <thead>
                                                                                                                                                                    <tr>
                                                                                                                                                                        <th>Sl. No.</th>
                                                                                                                                                                        <th>Title</th>
                                                                                                                                                                        <th>Status</th>
                                                                                                                                                                        <th>Created On</th>
                                                                                                                                                                        <th>Action</th>
                                                                                                                                                                    </tr>
                                                                                                                                                                </thead>
                                                                                                                                                                <tbody>

                                                                                                                                                                    <?php
                                                                                                                                                                    if (isset($sequence_list) && count($sequence_list)):
                                                                                                                                                                        $i = 1;
                                                                                                                                                                        foreach ($sequence_list as $row) {
                                                                                                                                                                            ?>

                                                                                                                                                                            <tr class="odd gradeX">
                                                                                                                                                                                <td><?php echo $i; ?></td>
                                                                                                                                                                                <td><?php echo ucfirst($row->title); ?></td>
                                                                                                                                                                                <td>
                                                                                                                                                                                    <select class="form-control status_check_active" data="<?php echo $row->id; ?>">
                                                                                                                                                                                        <option value="Active" <?php echo ($row->status == 'Active') ? "selected=selected" : ""; ?>>Active</option>
                                                                                                                                                                                        <option value="Inactive" <?php echo ($row->status == 'Inactive') ? "selected=selected" : ""; ?>>Inactive</option>
                                                                                                                                                                                    </select>
                                                                                                                                                                                </td>
                                                                                                                                                                                <td><?php echo $row->created_on; ?></td>

                                                                                                                                                                                <td>
                                                                                                                                                                                   <a href="<?php echo site_url("admin/Dashboard_sequence/view_details/$row->id"); ?>" title="View" class="tip"><i class="fa fa-eye" title="View"></i></a>
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
//                                                                                                                                        
                                                                                                                                        $(document).ready(function () {
                                                                                                                                            var url = "<?php echo site_url() ?>admin/Dashboard_sequence/destory_selectearticle"
                                                                                                                                            $.ajax({
                                                                                                                                                type: "POST",
                                                                                                                                                url: url,
                                                                                                                                                //data: {select_article: values},
                                                                                                                                                success: function (data)
                                                                                                                                                {
                                                                                                                                                    // $(".modal").hide();
                                                                                                                                                    //alert("Successfully Deleted");
                                                                                                                                                    //location.reload();

                                                                                                                                                }
                                                                                                                                            });
                                                                                                                                            var rows_selected = [];
                                                                                                                                            var oTable = $('.dataTables-example').dataTable({
                                                                                                                                                responsive: true,
                                                                                                                                                stateSave: true,
                                                                                                                                                bStateSave: false,
                                                                                                                                                fnStateSave: function (settings, oTable) {
                                                                                                                                                    localStorage.setItem("dataTables_state", JSON.stringify(oTable));
                                                                                                                                                },
                                                                                                                                                fnStateLoad: function (settings) {
                                                                                                                                                    return JSON.parse(localStorage.getItem("dataTables_state"));
                                                                                                                                                }

                                                                                                                                            });
                                                                                                                                            //var row = oTable.api().row(tr);
                                                                                                                                            var tableControl = document.getElementsByClassName('dataTables-example');
                                                                                                                                            $('#jqcc').click(function () {

                                                                                                                                            });
                                                                                                                                            $('.dataTables-example').on('click', 'tr', function () {
                                                                                                                                                var dtata = oTable.$('input[type="checkbox"]').serialize();
                                                                                                                                                var final = '';
                                                                                                                                                var oData = oTable.fnGetData(this);
                                                                                                                                                console.log(dtata);
                                                                                                                                                var nRow = $(this).parents('tr')[0];
                                                                                                                                                var result = []
//                                                                                                                                                $('input:checkbox:checked', tableControl).each(function () {
//                                                                                                                                        result.push($(this).parent().next().text());
//                                                                                                                                        });
                                                                                                                                                var aData = oTable.fnGetData(this);
                                                                                                                                                console.log(oData);
                                                                                                                                                $('.select_art:checked').each(function () {


                                                                                                                                                 
                                                                                                                                                    var url = "<?php echo site_url() ?>admin/Dashboard_sequence/set_article"
                                                                                                                                                    $.ajax({
                                                                                                                                                        type: "POST",
                                                                                                                                                        url: url,
                                                                                                                                                        async: true,
                                                                                                                                                        data: {select_article: $(this).val() + ','},
                                                                                                                                                        success: function (data)
                                                                                                                                                        {


                                                                                                                                                        }
                                                                                                                                                    });

                                                                                                                                                });


                                                                                                                                                /* we join the array separated by the comma */
                                                                                                                                                //var selected;
                                                                                                                                                //selected = chkArray.join(',') + ",";
                                                                                                                                                //alert(selected);
                                                                                                                                                $('input[type="checkbox"]').bind('click', function () {

                                                                                                                                                    if ($(this).is(':checked')) {

                                                                                                                                                        $('#result_art_selected').html($(this).val());
                                                                                                                                                    }
                                                                                                                                                });

//                                                                                                                                              
////
                                                                                                                                            });
//
////                                                                                                                                         
//                                                          

                                                                                                                                            $(document).on('click', '.status_check', function () {
                                                                                                                                                if (confirm("Are you sure to delete data")) {
                                                                                                                                                    var current_element = $(this);
                                                                                                                                                    // alert ($(current_element).attr('data'))
                                                                                                                                                    url = "<?php echo site_url() ?>admin/Dashboard_sequence/delete";
                                                                                                                                                    $(".modal").show();
                                                                                                                                                    //alert(url);
                                                                                                                                                    $.ajax({
                                                                                                                                                        type: "POST",
                                                                                                                                                        url: url,
                                                                                                                                                        data: {id: $(current_element).attr('data')},
                                                                                                                                                        success: function (data)
                                                                                                                                                        {
                                                                                                                                                            $(".modal").hide();
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
                                                                                                                                                url = "<?php echo site_url() ?>/admin/Dashboard_sequence/active";
                                                                                                                                                $(".modal").show();
                                                                                                                                                //alert(url);
                                                                                                                                                $.ajax({
                                                                                                                                                    type: "POST",
                                                                                                                                                    url: url,
                                                                                                                                                    data: {id: id, status: status},
                                                                                                                                                    success: function (data)
                                                                                                                                                    {
                                                                                                                                                        $(".modal").hide();
                                                                                                                                                        //alert("Successfully Deleted");
                                                                                                                                                        location.reload();

                                                                                                                                                    }
                                                                                                                                                });
                                                                                                                                                 }

                                                                                                                                            });
//                                                                                                                                                   

                                                                                                                                            $('.add_sequence').click(function () {
                                                                                                                                                $("#addsequence_form").valid();
                                                                                                                                                $('#title_label').hide();
                                                                                                                                                $('#group_label').hide();
                                                                                                                                                $(".modal").show();
                                                                                                                                                event.preventDefault();
                                                                                                                                                var tit = $('#title').val();
                                                                                                                                                if ($('#title').val() == '') {
                                                                                                                                                    $("#title").focus();
                                                                                                                                                    $('#title_label').show();
                                                                                                                                                }
                                                                                                                                                else
                                                                                                                                                if (!$("input[name='group[]']").is(':checked')) {
                                                                                                                                                    //$("#").focus();
                                                                                                                                                    $('#group_label').show();
                                                                                                                                                }
                                                                                                                                                else
                                                                                                                                                if ($('#title').val() == '') {
                                                                                                                                                    $("#title").focus();
                                                                                                                                                    $('#title_label').show();
                                                                                                                                                } else
                                                                                                                                                {
                                                                                                                                                    if ($('.select_art').is(':checked')) {

                                                                                                                                                        //$('#group_label').show()
                                                                                                                                                        $(".modal").hide();
                                                                                                                                                        $('#addsequence_form').submit();
//                                                                                                                                                  
                                                                                                                                                    }
                                                                                                                                                    else {
                                                                                                                                                        $(".modal").hide();
                                                                                                                                                        $('#article_label').show();
                                                                                                                                                    }
                                                                                                                                                }
                                                                                                                                                $(".modal").hide();
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
                                                                                                                                            $('#btn_search').click(function () {
                                                                                                                                                //$("#edit_form").valid();
                                                                                                                                                var oTable = $('#calltable').dataTable();
                                                                                                                                                var rowcollection = oTable.$(".call-checkbox:checked", {"page": "all"});
                                                                                                                                                rowcollection.each(function (index, elem) {
                                                                                                                                                    var checkbox_value = $(elem).val();
                                                                                                                                                    //Do something with 'checkbox_value'
                                                                                                                                                });
                                                                                                                                                $('#search_error').hide();
                                                                                                                                                event.preventDefault();
                                                                                                                                                var book = $('#book_name').val();
                                                                                                                                                alert(book);
                                                                                                                                                var url = "<?php echo site_url('admin/Dashboard_sequence/search_article') ?>";
                                                                                                                                                if (book) {
                                                                                                                                                    //alert('selected');
                                                                                                                                                    //$('#form_search').submit();
                                                                                                                                                    //location.reload();
                                                                                                                                                    // window.location.href = url;
                                                                                                                                                    jQuery.ajax({
                                                                                                                                                        type: "POST",
                                                                                                                                                        url: "<?php echo site_url(); ?>" + "admin/Dashboard_sequence/search_article",
                                                                                                                                                        dataType: 'json',
                                                                                                                                                        data: {search: user_name, pwd: password},
                                                                                                                                                        success: function (res) {
                                                                                                                                                            alert(res);
                                                                                                                                                            if (res)
                                                                                                                                                            {
                                                                                                                                                                // Show Entered Value
                                                                                                                                                                //                                                                                                                                                                    jQuery("div#result").show();
                                                                                                                                                                //                                                                                                                                                                    jQuery("div#value").html(res.username);
                                                                                                                                                                //                                                                                                                                                                    jQuery("div#value_pwd").html(res.pwd);
                                                                                                                                                            }
                                                                                                                                                        }
                                                                                                                                                    });
                                                                                                                                                } else
                                                                                                                                                {
                                                                                                                                                    $('#search_error').show();
                                                                                                                                                    setTimeout(function () {
                                                                                                                                                        $('#search_error').fadeOut();
                                                                                                                                                    }, 1000);
                                                                                                                                                }


                                                                                                                                            });
                                                                                                                                        });
                                                                                                                                    </script>

                                                                                                                                    </body>

                                                                                                                                    </html>