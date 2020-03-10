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

        <?php if ($mode == 'add_memeber'): ?>



            <div class="row">

                <div class="col-lg-12">

                    <h2 class="page-header">Add member to the <?php echo ucfirst($get_group->title); ?> group </h2>



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

            <?php if ($this->session->flashdata('error')) { ?>

                <div class="alert alert-info fade in block-inner">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <i class="icon-checkmark-circle"></i> <?php echo $this->session->flashdata('e') ?> </div>

            <?php } ?>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <?php echo form_open(site_url() . 'admin/dashboard_create_group/add_group_members', 'id="add_member_form" class=".validate" '); ?>



                    <div class="panel panel-default">

                        <div class="panel-heading">



                            <button type="reset"   class="pull-left btn btn-warning">Reset</button>

                            <a href="#" role="button"   title=""><button type="submit"  style="margin-left:90%" class="btn smile-primary">Submit</button></a>

                            <input type="hidden" name="group_id" value="<?php echo $get_group->id ?>"/>

                            <input type="hidden" name="curl" value="<?php echo base_url(uri_string()); ?>"/>

                        </div>



                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">



                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th></th>

                                            <th>Full Name</th>

                                            <th>Mobile No.</th>

                                            <th>User type</th>

                                            <th>Company </th>

                                            <th>Department</th>

                                            <th>Created on</th>



                                        </tr>

                                    </thead>

                                    <tbody>



                                        <?php
                                        if (isset($register_user) && count($register_user)):

                                            $i = 1;

                                            foreach ($register_user as $row) {
                                                ?>













                                                <tr class="odd gradeX">

                                                    <td><input type="checkbox" name="user[]" value="<?php echo $row->id ?>"/></td>

                                                    <td><?php echo ucfirst($row->username); ?></td>

                                                    <td>

                                                        <?php echo $row->phone; ?>

                                                    </td>

                                                    <td>

                                                        <?php echo $row->user_type; ?>

                                                    </td>

                                                    <td>

                                                        <?php echo $row->company_name; ?>

                                                    </td>

                                                    <td>

                                                        <?php echo $row->department_name; ?>

                                                    </td>





                                                    <td><?php echo $row->created_on; ?></td>







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

                        <?php echo form_close(); ?>

                    </div>

                    <!-- /.panel -->

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->



        <?php endif;
        ?>

        <?php if ($mode == 'addedit_memeber'): ?>



            <div class="row">

                <div class="col-lg-12">

                    <h2 class="page-header" style="color: #414042; border-bottom: 1px solid #adadad !important;">Add/Remove member from the <?php echo ucfirst($get_group->title); ?> group </h2>                            

                           <!-- <a href="<?php echo site_url() ?>admin/dashboard_create_group/index" role="button"   class="pull-left"  style="margin-left: 94%;margin-top: -60px;" title=""><button type="submit"    class="btn btn-primary">Back </button></a> -->





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

                    <?php echo form_open(site_url() . 'admin/dashboard_create_group/addedit_group_members', 'id="add_member_form" class=".validate" '); ?>



                    <div class="panel panel-default">

                        <div class="panel-heading">



                            <button type="reset"   class="pull-left btn btn-warning closebtn">Reset</button>

                            <a href="#" role="button"   title=""><button type="submit"  style="margin-left:85%" class="btn smile-primary">Submit</button></a>

                            <input type="hidden" name="group_id" value="<?php echo $get_group->id ?>"/>

                            <input type="hidden" name="curl" value="<?php echo base_url(uri_string()); ?>"/>

                        </div>



                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">



                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTxables-example">

                                    <thead>

                                        <tr>

                                            <th></th>

                                            <th>Full Name</th>

                                            <th>Mobile No.</th>

                                            <th>User type</th>

                                            <th>Company </th>

                                            <th>Department</th>

                                            <th>Created on</th>



                                        </tr>

                                    </thead>

                                    <tbody>



                                        <?php
                                        if (isset($register_user) && count($register_user)):

                                            $i = 1;

                                            foreach ($register_user as $row) {

                                                //foreach($get_group_member as $get_group_member_row)
                                                // {
                                                ?>



                                                <tr class="odd gradeX">

                                                    <td><input type="checkbox" name="user[]" value="<?php echo $row->id ?>" <?php
                                                        foreach ($get_group_member as $get_group_member_row) {

                                                            if ($get_group_member_row->user_id == $row->id)
                                                                echo "checked";
                                                        }
                                                        ?>/></td>

                                                    <td><?php echo ucfirst($row->username); ?></td>

                                                    <td>

                                                        <?php echo $row->telcode . $row->phone; ?>

                                                    </td>

                                                    <td>

                                                        <?php echo $row->user_type; ?>

                                                    </td>

                                                    <td>

                                                        <?php echo $row->company_name; ?>

                                                    </td>

                                                    <td>

                                                        <?php echo $row->department_name; ?>

                                                    </td>





                                                    <td><?php echo $row->created_on; ?></td>







                                                    <?php
                                                    $i++;

                                                    //}
                                                }

                                            endif;
                                            ?>

                                    </tbody>

                                </table>

                            </div>

                            <!-- /.table-responsive -->



                        </div>

                        <!-- /.panel-body -->

                        <?php echo form_close(); ?>

                    </div>

                    <!-- /.panel -->

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->



        <?php endif;
        ?>

        <?php if ($mode == 'edit'): ?>



        <?php endif;
        ?>

        <?php if ($mode == 'view'): ?> 

        <?php endif;
        ?>

        <?php if ($mode == 'all'): ?>

            <div class="row">

                <div class="col-lg-12">

                    <h2 class="page-header">Group details </h2>



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

                            Group details

                            <a href="#" role="button"   title=""><button type="button" style="float:right; margin-top:-5px !important;" class="model_form btn smile-primary">Create group <i class="fa fa-plus fa-fw"></i></button></a>

                        </div>



                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">

                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>Sl.No</th>

                                            <th>Title</th>

                                            <th>Status</th>

                                            <th>Image</th>

                                            <th>Add member to group</th>

                                            <th>Action</th>



                                        </tr>

                                    </thead>

                                    <tbody>



                                        <?php
                                        if (isset($create_group_list) && count($create_group_list)):

                                            $i = 1;

                                            foreach ($create_group_list as $row) {

                                                // foreach ($get_group_member as $get_group_member_row) {
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



                                                    <td><img src="<?php echo base_url() ?>assets/uploads/create_group_image/<?php echo $row->raw_name . $row->file_ext ?>" width="100px"/></td>

                                                    <td> 



                                                        <a href="<?php echo site_url(); ?>admin/dashboard_create_group/add_edit/<?php echo $row->id; ?>" role="button"   title=""><button type="button"  class="btn btn-primary">Add/Remove member</button></a>



                                                        <?php
                                                        // else:
                                                        ?>

                        <!--                                                                <a href="<?php echo site_url(); ?>admin/dashboard_create_group/add/<?php echo $row->id; ?>" role="button"   title=""><button type="button"  class="btn smile-primary">Add member</button></a>-->



                                                        <?php //endif;
                                                        ?>

                                                    </td>







                                                    <td>




                                                        <a  href="javascript:;" title="View" class="model_formedit tip" value="<?php echo $row->id ?>" rel="<?php echo $row->title; ?>"  rel3="<?php echo base_url("assets/uploads/create_group_image/" . $row->raw_name . $row->file_ext) ?>" rel4="<?php echo $row->imgid ?>" ><i  class="fa fa-pencil" title="Edit"></i></a> 

                                                        <a  href="#"><i   data="<?php echo $row->id ?>" class="status_check fa fa-remove"></i></a>

                                                    </td>



                                                    <?php
                                                    $i++;

                                                    // }
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



<!-- Form modal -->

<div id="form_modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header smile-primary" style="border-radius:0px;">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">&times;</button>

                <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Create group</span>  </h4>

            </div>

            <!-- Form inside modal -->

            <?php echo form_open_multipart(site_url() . '/admin/dashboard_create_group/add_group', 'id="cat_form1" class=".validate" enctype="multipart/form-data"'); ?>

            <div class="modal-body with-padding">



                <div class="form-group">

                    <div class="row">

                        <div class="col-sm-12">

                            <label>Group name:</label>

                            <input type="text" id="name1" name="name" class="form-control required" value="">

                        </div>

                    </div>

                </div> 

                <div class="form-group">

                    <div class="row">

                        <div class="col-sm-12">

                            <label>Image:</label>

                            <input type="file" name="image_file" class="form-control required" value="">

                        </div>

                    </div>

                </div> 





            </div>            

            <div class="modal-footer">

                <button type="button" class="btn btn-warning closebtn" data-dismiss="modal">Close</button>

                <span id="add">

                    <input type="hidden" name="id" value="" id="id">

                    <input type="hidden" name="category_type" value="<?php echo $this->uri->segment(3) ?>" >

                    <button type="submit" class="btn btn-primary subbtn" id="add_city">Submit</button>

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

<div id="form_modaledit" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header smile-primary" style="border-radius:0px;">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">&times;</button>

                <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Edit group</span>  </h4>

            </div>

            <!-- Form inside modal -->

            <?php echo form_open_multipart(site_url() . '/admin/dashboard_create_group/edit_group', 'id="cat_form1edt" class=".validate" enctype="multipart/form-data"'); ?>

            <div class="modal-body with-padding">



                <div class="form-group">

                    <div class="row">

                        <div class="col-sm-12">

                            <label>Group name:</label>

                            <input type="text" id="name1edt" name="name" class="form-control required" value="">

                        </div>

                    </div>

                </div> 

                <div class="form-group">

                    <div class="row">

                        <div class="col-sm-12">

                            <label>Image:</label>

                            <input type="file" name="image_file" class="form-control required" value="">

                        </div>

                    </div>

                </div> 

                <label><?php echo $lang_previousimage ?></label>
                <div class="form-group"><image id="imgedt" src="" height="80px" width="100px"/></div>
                <input type="hidden" name="image1_idedt" value="">




            </div>            

            <div class="modal-footer">

                <button type="button" class="btn btn-warning closebtn" data-dismiss="modal">Close</button>

                <span id="add">

                    <input type="hidden" name="id" value="" id="idedt">
                    <input type="hidden" name="imgid" value="" id="imgidedt">
                    <input type="hidden" name="category_type" value="<?php echo $this->uri->segment(3) ?>" >

                    <button type="submit" class="btn btn-primary subbtn" id="add_city">Submit</button>

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

<script src="<?php echo base_url(); ?>assets/bower_components/datatables-responsive/js/jquery.filtertable.js"></script>

<!-- Custom Theme JavaScript -->

<script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>



<!-- Page-Level Demo Scripts - Tables - Use for reference -->

<script>

    $(document).ready(function () {

        //$('tbody tr').addClass('visible');

        $('table').filterTable({filterExpression: 'filterTableFindAny'});



        $('#cat_form1').validate();

        $('#dataTables-example').DataTable({
            responsive: true

        });

        $(document).on('click', '.model_form', function () {

            $('#form_modal').modal({
                keyboard: false,
                show: true,
                backdrop: 'static'

            });

        });

        $(document).on('click', '.status_check', function () {

            if (confirm("Are you sure to delete data")) {

                var current_element = $(this);

                // alert ($(current_element).attr('data'))

                url = "<?php echo site_url() ?>admin/Dashboard_create_group/delete";



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

            if (confirm("Are you sure do you want to do this action")) {



                var id = $(this).attr('data');

                var status = $(this).val();

                alert(status);

                // alert ($(current_element).attr('data'))

                url = "<?php echo site_url() ?>admin/Dashboard_create_group/active";



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

                alert('please select any question.')

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

                alert('please select any question.')

            }





        });
        $(document).on('click', '.model_formedit', function () {
            var id = $(this).attr('value');
            var name = $(this).attr('rel');
            var src = $(this).attr('rel3');
            var imgid = $(this).attr('rel4');
            $('#idedt').val(id);
            $('#name1edt').val(name);
            $('#image1_idedt').val(id);
            $('#imgidedt').val(imgid);
            $('#imgedt').attr("src", src);
            $('#form_modaledit').modal({
                keyboard: false,
                show: true,
                backdrop: 'static'

            });

        });

    });

</script>



</body>



</html>