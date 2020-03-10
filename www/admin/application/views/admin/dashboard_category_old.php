<?php require_once('includes/head.php') ?>

<body>

    <div id="wrapper">

        <?php require_once('includes/nav.php') ?>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php if ($this->uri->segment(3) == 'maincategory'): ?> Main<?php endif; ?> Sub categories</h1>
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
                        <div class="panel-heading">
                            <?php $abuilder = array('id' => '', 'name' => ''); ?>
                            <script>var builder_0 = <?php echo json_encode($abuilder) ?></script>
                            Sub categories Details
                            <?php if ($this->uri->segment(3) == 'index'): ?>
                                <a role="button"  class="align-left" title="Add Categories"><button type="button"style="float: right;margin-top: -6px;"  data1="builder_0" class="model_form btn smile-primary">Add subcategory</button></a>

            <!--                                    <a role="button" style="padding-left: 759px;" class="align-left" title="Add Categories"><i  data1="builder_0" class="model_form fa fa-plus-circle"></i></a>-->
                            <?php else: ?>
                                <a role="button"  class="align-left" title="Add Categories"><button type="button"style="float: right;margin-top: -6px;"  data1="builder_0" class="model_form1 btn smile-primary">Add category</button></a>

                            <?php endif; ?>
                        </div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <?php if ($this->uri->segment(3) == 'index'): ?>
                                                <th>Category type</th>

                                            <?php else: ?>
                                                <th>Image</th>
                                            <?php endif; ?>
<!--                                            <th>Mobile No.</th>
                                   <th>Email Id</th>-->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if (isset($categories) && count($categories)):

                                            foreach ($categories as $row) {
                                                ?>

                                                <tr class="odd gradeX">
                                                    <td ><?php echo ucfirst($row->name) ?></td>
                                                    <?php if ($this->uri->segment(3) == 'index'): ?>
                                                        <td <?php if ($row->parent_id == '1') { ?>style="color:#2196F3"<?php } ?>> <?php echo ucfirst($row->maincategory) ?></td>
                                                    <?php else: ?>
                                                        <td><image src="<?php echo base_url() ?>assets/uploads/category_image/<?php echo $row->raw_name . $row->file_ext ?>" height="100" width="100px"/>
                                                        <?php endif; ?>
                                                    <td>
                                                        <script>var builder_<?php echo $row->id ?> = <?php echo json_encode($row); ?></script>
        <!--                                                        <a  href="#"><i  data1="<?php echo 'builder_' . $row->id ?>" class="model_form fa fa-pencil"></i></a>-->


                                                        <?php if ($this->uri->segment(3) == 'index'): ?>
                                                            <a  href="#"><i   title="delete" data="<?php echo $row->id ?>" class="status_check fa fa-remove"></i></a></td>
                                                    <?php else: ?>
                                                <a  href="#"><i   data="<?php echo $row->id ?>" class="status_check1 fa fa-remove"></i></a></td>
                                            <?php endif; ?>
                                            <?php
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




        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Form modal -->
    <div id="form_modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header smile-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Add/Edit</span> Sub category </h4>
                </div>
                <!-- Form inside modal -->
                <?php echo form_open_multipart(site_url() . '/admin/dashbord_category/add_edit', 'id="cat_form" class=".validate"'); ?>
                <div class="modal-body with-padding">
                    <div class="select_maincategory form-group">
                        <label>Selects</label>
                        <?php if (isset($maincategory) && count($maincategory)): ?>
                            <select name="maincat" class="form-control">
                                <?php foreach ($maincategory as $row) { ?>
                                    <option value="<?php echo $row->id ?>"><?php echo ucfirst($row->name) ?></option>

                                <?php } ?>
                            </select>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Name:</label>
                                <input type="text" id="name1" name="name" class="form-control required" value="">
                            </div>
                        </div>
                    </div> 


                </div>            
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <span id="add">
                        <input type="hidden" name="id" value="" id="id">
                        <input type="hidden" name="category_type" value="<?php echo $this->uri->segment(3) ?>" >
                        <button type="submit" class="btn btn-primary" id="add_city">Submit</button>
                    </span><!-- 
                    <span id="edit">

                      <button type="submit" class="btn btn-primary" id="update_city" >Update Categories</button>
                    </span> -->
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /form modal -->

    <!-- Form modal -->
    <div id="form_modal1" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header smile-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Add/Edit</span> Category </h4>
                </div>
                <!-- Form inside modal -->
                <?php echo form_open_multipart(site_url() . '/admin/dashbord_category/add_category', 'id="cat_form1" class=".validate" enctype="multipart/form-data"'); ?>
                <div class="modal-body with-padding">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Name:</label>
                                <input type="text" id="name1" name="name" class="form-control required" value="">
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Image:</label>
                                <input type="file" name="image_file" class="form-control required" value="">
                                 <span class="help-block">Accepted formats: jpg, png, gif.(450X150)  </span>
                            </div>
                        </div>
                    </div> 


                </div>            
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <span id="add">
                        <input type="hidden" name="id" value="" id="id">
                        <input type="hidden" name="category_type" value="<?php echo $this->uri->segment(3) ?>" >
                        <button type="submit" class="btn btn-primary" id="add_city">Submit</button>
                    </span><!-- 
                    <span id="edit">

                      <button type="submit" class="btn btn-primary" id="update_city" >Update Categories</button>
                    </span> -->
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /form modal -->
    <!-- jQuery -->
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
                                    $('#cat_form').validate();
                                    $('#cat_form1').validate();
                                    $('#dataTables-example').DataTable({
                                        responsive: true,
										'columnDefs': [{ 'orderable': false, 'targets': 2 }]
                                    });
                                    $(document).on('click', '.model_form', function () {
                                        $('#form_modal').modal({
                                            keyboard: false,
                                            show: true,
                                            backdrop: 'static'
                                        });

                                        $('label.error').hide();
                                        var data = eval($(this).attr('data1'));
                                        var iddata = data.id;
                                        if (!iddata)
                                        {
                                            $('.select_maincategory').show();
                                        }
                                        else
                                        {
                                            $('.select_maincategory').hide();
                                        }
                                        $('#name1').val(data.name);
                                        $('#id').val(data.id);

                                    });
                                    $(document).on('click', '.model_form1', function () {
                                        $('#form_modal1').modal({
                                            keyboard: false,
                                            show: true,
                                            backdrop: 'static'
                                        });
                                    });
                                    $(document).on('click', '.status_check', function () {
                                        if (confirm("Are you sure to delete data")) {
                                            var current_element = $(this);
                                            // alert ()
                                            url = "<?php echo site_url() ?>admin/dashbord_category/delete_subcategory";

                                            //alert(url);
                                            $.ajax({
                                                type: "POST",
                                                url: url,
                                                data: {ct_id: $(current_element).attr('data')},
                                                success: function (data)
                                                {

                                                    //alert("Successfully Deleted");
                                                    location.reload();

                                                }
                                            });
                                        }

                                    });
                                    $(document).on('click', '.status_check1', function () {
                                        if (confirm("Are you sure to delete data")) {
                                            var current_element = $(this);
                                            // alert ()
                                            url = "<?php echo site_url() ?>/admin/dashbord_category/delete_maincategory";

                                            //alert(url);
                                            $.ajax({
                                                type: "POST",
                                                url: url,
                                                data: {ct_id: $(current_element).attr('data')},
                                                success: function (data)
                                                {
                                                    //alert(data);
                                                    if (data) {

                                                        alert("Successfully Deleted");
                                                        location.reload();

                                                    } else
                                                    {
                                                        alert("You cant delete this category.");
                                                        location.reload();
                                                    }
                                                    //alert("Successfully Deleted");
                                                    //location.reload();

                                                }
                                            });
                                        }

                                    });
                                    $('#cat').addClass('active');
                                });
    </script>

</body>

</html>
