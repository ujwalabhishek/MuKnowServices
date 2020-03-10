<?php require_once('includes/head.php') ?>

<body>

    <div id="wrapper">

        <?php require_once('includes/nav.php') ?>

        <?php if ($mode == 'all'): ?>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header"><i class="fa fa-th fa-fw" id="sidemenuicon"></i> Slider</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="alert alert-success fade in block-inner hidden" id="ajax_sucess">            
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="icon-checkmark-circle"></i> Created successfully. </div>

                <div class="alert alert-danger fade in block-inner hidden" id="ajax_danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="icon-checkmark-circle"></i> Sorry!, Try Again</div>

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
                                <?php if ($this->uri->segment(3) == 'slider'): ?><?php
                                else: echo "";
                                endif;
                                ?>
                              
                                    <a role="button"  class="align-left" title="Add Slider"><button type="button"style="float: right;margin-top: -4px;"  data1="builder_0" class="model_form1 btn smile-primary animated bounceIn">Add Slider <i class="fa fa-plus" style="color:#fff;"></i></button></a>

                                <?php if (!empty($categories)): ?>
                                    <a href = "<?php echo site_url('admin/Dashbord_slider/reorder_slider_page/slider') ;?>"role = "button" class = "" title = "Add sub Topics"><button type = "button"style = "margin-top: -6px;" data1 = "builder_0" class = "btn smile-primary">Click here to Reorder Slider
                                          </button></a>
                                    <input type="hidden" name="cat_type" value=""/>
                                <?php endif;
                                ?>
                            </div>

                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Sl. No.</th>
                                                <th>Name</th>
                                               
                                                    <th>Image</th>
                                               
    <!--                                            <th>Mobile No.</th>
    <th>Email Id</th>-->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php //print_r($categories); exit(); ?>
                                            <?php
                                            if (isset($categories) && count($categories)):
                                                $i = 1;
                                                foreach ($categories as $row) {
                                                    ?>

                                                    <tr class="odd gradeX">
                                                        <td ><?php echo $i; ?></td>
                                                        <td ><?php echo ucfirst($row->name) ?></td>
                                                        

                                                            <td><img src="<?php echo base_url() ?>assets/uploads/slider_image/<?php echo $row->raw_name . $row->file_ext ?>" width="100px"/>
                                                           
                                                        <td class="text-center">

                                                            <script>var builder_<?php echo $row->id ?> = <?php echo json_encode($row); ?></script>
                    <!--                                                        <a  href="#"><i  data1="<?php echo 'builder_' . $row->id ?>" class="model_form fa fa-pencil"></i></a>-->


                                                           
                                                    <a  href="javascript:;" title="View" class="model_form1edit tip" value="<?php echo $row->id ?>" rel="<?php echo $row->name; ?>" burm="<?php echo $row->url; ?>" rel2="<?php echo $row->name; ?>"  rel3="<?php echo base_url("assets/uploads/slider_image/" . $row->raw_name . $row->file_ext) ?>" rel4="<?php echo $row->imgid ?>" ><i  class="fa fa-pencil-square-o" title="Edit"></i></a>    

                                                    <a  href="#"><i   data="<?php echo $row->id ?>" class="status_check1 fa fa-remove"></i></a></td>
                                               
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




            </div>
            <!-- /#page-wrapper -->
        <?php endif;
        ?>
        
        
    </div>
    <!-- /#wrapper -->

   
    <?php $this->load->view('admin/dashboard_slider_edit') ?>
    <!-- Form modal -->
    <div id="form_modal1" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header smile-primary" style="border-radius:0px !important;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">&times;</button>
                    <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Add</span> Slider </h4>
                </div>
                <!-- Form inside modal -->
                <?php echo form_open_multipart(site_url() . '/admin/dashbord_slider/add_slider', 'id="cat_form1" class=".validate" enctype="multipart/form-data"'); ?>
                <div class="modal-body with-padding">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Name:</label>
                                <input type="text" id="name1" name="name" class="form-control required" maxlength="50" value="">
                            </div>
                        </div>
                    </div> 
                   
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>URL:</label>
                                <input type="text" id="bm_lang_name" name="bm_lang_name" class="form-control " maxlength="100" value="">
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
   
  
    <script type="text/javascript" src="<?php echo base_url() ?>assets/bower_components/graph/test/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/bower_components/graph/test/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/bower_components/graph/jquery.canvasjs.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/bower_components/graph/canvasjs.min.js"></script>
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
<!--    <script src="<?php echo base_url("assets/js/bootstrap-confirmation.min.js"); ?>"></script>-->
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
                                $(document).ready(function () {
                                    var sbcat_name = $('#get_subcat').attr('subcatname_data');
                                    $('#subcat_name').html(sbcat_name);
                                    var sbcat_name1 = $('#get_subcat1').attr('subcatname_data');
                                    $('#subcat_name1').html(sbcat_name1);
                                    // alert(sbcat_name);
                                    // alert(sbcat_name);
                                    $('#cat_form').validate();
                                    $('#cat_form2').validate();
                                    $('#cat_form1').validate();
                                    $('#dataTables-example').DataTable({
                                        responsive: true,
                                        'columnDefs': [{'orderable': false, 'targets': 2}], // hide sort icon on this column
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
                                        } else
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
                                    
                                    
                                   $(document).on('click', '.model_form1edit', function () {
                                        var id = $(this).attr('value');
                                        var name = $(this).attr('rel');
                                        var chname = $(this).attr('rel2');
                                        var buname = $(this).attr('burm');
                                        var src = $(this).attr('rel3');
                                        var imgid = $(this).attr('rel4');
                                        //var home_front = $(this).attr('home_front');
                                        //var checkvalue = $("#home_front").val();
                                        $('#idedt').val(id);
                                        $('#name1edt').val(name);
                                        $('#ch_lang_nameedt').val(chname);
                                        $('#bm_lang_nameedit1').val(buname);
                                        $('#image1_idedt').val(id);
                                        $('#imgidedt').val(imgid);
                                      //$('#home_front').val(home_front);
                                       // alert($("#home_front").val());
                                        if(!($("#home_front").val())){
                                            $('#home_front').prop( 'checked', false );
                                            $('#home_front').val('yes');

                                        }
                                        else{
                                            $('#home_front').prop( 'checked', true );
                                          //  $('#home_front').val('yes');
                                        }
                                        $('#imgedt').attr("src", src);
                                        $('#form_modal1edit').modal({
                                            keyboard: false,
                                            show: true,
                                            backdrop: 'static'
                                        });
                                    });

                                    $(document).on('click', '.status_check1', function () {
                                        if (confirm("Are you sure to delete data")) {
                                            var current_element = $(this);
                                            // alert ()
                                           var url = "<?php echo site_url() ?>/admin/Dashbord_slider/delete_slider";

                                          // alert(url);
                                            $.ajax({
                                                type: "POST",
                                                url: url,
                                                data: {ct_id: $(current_element).attr('data')},
                                                success: function (data)
                                                {
                                                   
                                                    if (data) {

                                                        alert("Successfully Deleted");
                                                        location.reload();

                                                    } else
                                                    {
                                                        alert("You cant delete this slider.");
                                                        //location.reload();
                                                    }
                                                    //alert("Successfully Deleted");
                                                    //location.reload();

                                                }
                                            });
                                        }

                                    });
                                   
                                });
    </script>

</body>

</html>
