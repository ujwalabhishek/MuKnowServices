<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('includes/head.php')
?>
<style type="text/css">
    body
    {
        font-family: Arial;
        font-size: 10pt;
    }
    .modal
    {
        position: fixed;
        y-index: 999;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        background-color: Black;
        filter: alpha(opacity=60);
        opacity: 0.6;
        -moz-opacity: 0.8;
    }
    .center
    {
        z-index: 1000;
        margin: 300px auto;
        padding: 10px;
        width: 130px;
        background-color: White;
        border-radius: 10px;
        filter: alpha(opacity=100);
        opacity: 1;
        -moz-opacity: 1;
    }
    .center img
    {
        height: 128px;
        width: 128px;
    }

</style>

<body>
    <div class="modal" style="display: none">
        <div class="center">
            <img alt="" src="<?php base_url(); ?>/assets/loader.gif" />
        </div>
    </div>
    <!--    <div id="wrapper">-->

    <?php require_once('includes/nav.php') ?>

    <div id="page-wrapper">
        <?php if ($mode == 'view'): ?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Mini-Lessons Details</h1>
                    <a href="<?php echo site_url() ?>admin/dashboard_sequence/index" role="button"   class="pull-left"  style="margin-left: 94%;margin-top: -60px;" title=""><button type="submit"    class="btn btn-primary">Back </button></a>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="height: 50px;">
                            
                                <!--                            //Sequence Details-->
                                <!--                            <a style="margin-top: -6px;float: right;" href="<?php //echo site_url()                                                                         ?>admin/Dashboard_assesment/index/"> <button type="button" class="btn btn-info">Back</button></a>-->
                                
								<?php foreach ($view_sequence as $sequence){
									echo $sequence->title;
								} ?>
								
								<?php //print_r($article_sequence); ?>

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

                           <div class="dataTable_wrapper">
                                                                                                                                                            <table width="100%" class="table table-striped table-bordered table-hover " id="dataTables-example">
                                                                                                                                                                <thead>
                                                                                                                                                                    <tr>
                                                                                                                                                                        <th>Article title</th>
                                                                                                                                                                        <th>Category</th>
																																								</tr>
												</thead>
												
												<tbody>
                                                                                                                                                                    <tr>
																																									 <?php foreach($article_sequence as $article){ ?>
                                                                                                                                                                        <td><?php echo $article->title?></td>
                                                                                                                                                                        <td><?php echo $article->name?></td>
																																										
																																								</tr>
												</tbody>
												<?php } ?>
												</table>
                                       
</div>
                                                              

                                                                
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
                                                                                               /.row -->
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-12">
                                                                                                            <div class="panel panel-default">
                                                                                                                <div class="panel-heading">
                                                                                                                    Sequence Details
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
                                                                                                                                                <h1 class="page-header">Sequence Details </h1>

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
                                                                                                                                                        Sequence Details
                                                                                                                                                        <a href="<?php echo site_url() ?>admin/Dashboard_sequence/add_edit" role="button"   title=""><button type="button" style="float:right;margin-top:-7px" class="btn smile-primary">Create Sequence</button></a>
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
                                                                                                                                                //if (confirm("Are you sure want to perform this action ?")) {

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
                                                                                                                                                        //location.reload();

                                                                                                                                                    }
                                                                                                                                                });
                                                                                                                                                // }

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