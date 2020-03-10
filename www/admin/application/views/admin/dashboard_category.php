<?php require_once('includes/head.php') ?>

<body>

    <div id="wrapper">

        <?php require_once('includes/nav.php') ?>

        <?php if ($mode == 'all'): ?>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header"><?php if ($this->uri->segment(3) == 'maincategory'): ?><i class="fa fa-th fa-fw" id="sidemenuicon"></i> Main Category<?php
                            else: echo '<i class="fa fa-sitemap fa-fw" id="sidemenuicon"></i>' . " Sub Category";
                            endif;
                            ?>  </h2>
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
                                <?php if ($this->uri->segment(3) == 'maincategory'): ?><?php
                                else: echo "";
                                endif;
                                ?>
                                <?php if ($this->uri->segment(3) == 'index'): ?>
                                    <a role="button"  class="align-left" title="Add sub Categories"><button type="button"style="float: right;margin-top: -4px;"  data1="builder_0" class="model_form btn smile-primary animated bounceIn">Add <i class="fa fa-plus" style="color:#fff;"></i></button></a>

                                                                                                                                                            <!--                                    <a role="button" style="padding-left: 759px;" class="align-left" title="Add Categories"><i  data1="builder_0" class="model_form fa fa-plus-circle"></i></a>-->
                                <?php else: ?>
                                    <a role="button"  class="align-left" title="Add Categories"><button type="button"style="float: right;margin-top: -4px;"  data1="builder_0" class="model_form1 btn smile-primary animated bounceIn">Add Category <i class="fa fa-plus" style="color:#fff;"></i></button></a>

                                <?php endif; ?>
                                <?php if (!empty($categories)): ?>
                                    <a href = "<?php echo site_url('/admin/Dashbord_category/reorder_category_page') . "/" . $this->uri->segment(3) . "/" . $this->uri->segment(4) ?>"role = "button" class = "" title = "Add sub Topics"><button type = "button"style = "margin-top: -6px;" data1 = "builder_0" class = "btn smile-primary">Click here to Reorder <?php if ($this->uri->segment(3) == 'maincategory'): ?> Main Topics<?php
                                            else: echo "Sub Categories";
                                            endif;
                                            ?></button></a>
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
                                                <?php if ($this->uri->segment(3) == 'index'): ?>
                                                    <th>Topic type</th>
                                                    <th>Graph Representation</th>
                                                <?php else: ?>
                                                    <th>Image</th>
                                                <?php endif; ?>
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
                                                        <?php if ($this->uri->segment(3) == 'index'): ?>
                                                            <td <?php if ($row->parent_id == '1') { ?>style="color:#2196F3"<?php } ?>> <?php echo ucfirst($row->maincategory) ?></td>
                                                            <td><span><a href="#" id="model_graph" data_catid="<?php echo $row->id ?>">Click Here </a>(View Total No.of Article graph)</span>
                                                            </td>
                                                        <?php else: ?>

                                                            <td><img src="<?php echo base_url() ?>assets/uploads/category_image/<?php echo $row->raw_name . $row->file_ext ?>" width="100px"/>
                                                            <?php endif; ?>
                                                        <td class="text-center">

                                                            <script>var builder_<?php echo $row->id ?> = <?php echo json_encode($row); ?></script>
                    <!--                                                        <a  href="#"><i  data1="<?php echo 'builder_' . $row->id ?>" class="model_form fa fa-pencil"></i></a>-->


                                                            <?php if ($this->uri->segment(3) == 'index'): ?>
                                                                <a href="javascript:;" role="button"  class="submodel_formss align-left" value="<?php echo $row->id; ?>" rel="<?php echo $row->name; ?>" rel2="<?php echo $row->chname; ?>" burm="<?php echo $row->bm_name; ?>" rel3="<?php echo $row->maincategory; ?>" rel4="<?php echo $row->parent_id; ?>" title="Add sub-sub Topics"><i class="fa fa-pencil" title="Edit"></i> </a>

                                                                <a  href="#"><i   title="delete" data="<?php echo $row->id ?>" class="status_check fa fa-remove"></i></a>
                                                                <!--<a   href="<?php echo site_url(); ?>/admin/Dashbord_category/subcategory/<?php echo $row->id; ?>"><i   title="Add sub subtopic" data="<?php echo $row->id ?>" class="fa fa-sitemap"></i></a></td>-->

                                                        <?php else: ?>
                                                    <a  href="javascript:;" title="View" class="model_form1edit tip" value="<?php echo $row->id ?>" rel="<?php echo $row->name; ?>" burm="<?php echo $row->bm_lang_name; ?>" rel2="<?php echo $row->ch_lang_name; ?>"  rel3="<?php echo base_url("assets/uploads/category_image/" . $row->raw_name . $row->file_ext) ?>" rel4="<?php echo $row->imgid ?>" home_front="<?php echo $row->home_front ?>" ><i  class="fa fa-pencil-square-o" title="Edit"></i></a>    

                                                    <a  href="#"><i   data="<?php echo $row->id ?>" class="status_check1 fa fa-remove"></i></a></td>
                                                <?php endif; ?>
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
        <?php if ($mode == 'sub1'): ?>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12" id="get_subcat" subcatname_data="<?php echo $sub_category->name; ?>">
                        <h2 class="page-header"><i class="fa fa-bars" id="sidemenuicon"></i> <?php echo ucfirst($sub_category->name); ?> sub-sub  Topics</h2><a  class="backbtntop" role="button" href="<?php echo site_url() ?>/admin/Dashbord_category/index"><span>BACK</span></a>
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
                               
                                <a href = "<?php echo site_url('/admin/Dashbord_category/reorder_category_page') . "/" . $this->uri->segment(3) . "/" . $this->uri->segment(4) ?>"role = "button" class = "" title = "Add sub Topics"><button type = "button"style = "margin-top: -6px;" data1 = "builder_0" class = "btn smile-primary">Click here to Reorder <?php if ($this->uri->segment(3) == 'maincategory'): ?> Main Topics<?php
                                        else: echo "Sub Topics";
                                        endif;
                                        ?></button></a>
                                <a role="button"  class="align-left" title="Add sub-sub Topics"><button type="button"style="float: right;"  data1="builder_0" class="submodel_form btn smile-primary">Add</button></a>
                                <?php if (!empty($categories)): ?>
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

                                                <th>Topic type</th>
                                                <th>Graph Representation</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            if (isset($categories) && count($categories)):
                                                $i = 1;
                                                foreach ($categories as $row) {
                                                    ?>

                                                    <tr class="odd gradeX">
                                                        <td ><?php echo $i; ?></td>
                                                        <td ><?php echo ucfirst($row->name) ?></td>

                                                        <td <?php if ($row->parent_id == '1') { ?>style="color:#2196F3"<?php } ?>> <?php echo ucfirst($row->maincategory) ?></td>
                                                        <td><span><a href="#" id="model_graph" data_catid="<?php echo $row->id ?>">Click Here </a>(View Total No.of Article graph)</span>
                                                        </td>
                                                        <td>
                                                            <script>var builder_<?php echo $row->id ?> = <?php echo json_encode($row); ?></script>
            <!--                                                        <a  href="#"><i  data1="<?php echo 'builder_' . $row->id ?>" class="model_form fa fa-pencil"></i></a>-->


                                                            <a href="javascript:;" role="button"  class="submodel_formedit align-left" value="<?php echo $row->id; ?>" rel="<?php echo $row->name; ?>" burm="<?php echo $row->bm_name; ?>" rel2="<?php echo $row->chname; ?>" rel3="" rel4="<?php echo $row->parent_id; ?>" rel5="<?php echo $row->maincategory; ?>" title="Add sub-sub Topics"><i class="fa fa-pencil" title="Edit"></i> </a>

                                                            <a  href="#"><i   title="delete" data="<?php echo $row->id ?>" class="subcat1_delete fa fa-remove"></i></a>

                                                            <a  href="<?php echo site_url(); ?>/admin/dashbord_category/sub_subcategory/<?php echo $row->id; ?>"><i   title="Add sub of sub subtopic" data="<?php echo $row->id ?>" class="fa fa-sitemap"></i></a></td>


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
        <?php endif;
        ?>
        <?php if ($mode == 'sub2'): ?>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12" id="get_subcat1" subcatname_data="<?php echo $sub_category->name; ?>">
                        <h2 class="page-header"><i class="fa fa-bars" id="sidemenuicon"></i> <?php echo ucfirst($sub_category->name); ?> sub-sub-sub  Topics</h2><a  class="backbtntop" href="<?php echo site_url() ?>/admin/Dashbord_category/subcategory/<?php echo $sub_category->parent_id ?>"><span>BACK</span></a>
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
                              

                                <a role="button"  class="align-left" title="Add sub of sub-sub categoryform_modal1"><button type="button"style="float: right;margin-top: 0px !important;"  data1="builder_0" class="submodel_form1 btn smile-primary">Add</button></a>
                                <?php if (!empty($categories)): ?>
                                    <a href = "<?php echo site_url('/admin/Dashbord_category/reorder_category_page') . "/" . $this->uri->segment(3) . "/" . $this->uri->segment(4) ?>"role = "button" class = "" title = "Add sub Topics"><button type = "button"style = "margin-top: -6px;" data1 = "builder_0" class = "btn smile-primary">Click here to Reorder Sub-Sub-sub Topics</button></a>
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

                                                <th>Topic type</th>
                                                <th>Graph Representation</th>

                                                                <!--                                            <th>Mobile No.</th>
                                                                <th>Email Id</th>-->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            if (isset($categories) && count($categories)):
                                                $i = 1;
                                                foreach ($categories as $row) {
                                                    ?>

                                                    <tr class="odd gradeX">
                                                        <td ><?php echo $i; ?></td>
                                                        <td ><?php echo ucfirst($row->name) ?></td>

                                                        <td <?php if ($row->parent_id == '1') { ?>style="color:#2196F3"<?php } ?>> <?php echo ucfirst($row->maincategory) ?></td>
                                                        <td><span><a href="#" id="model_graph" data_catid="<?php echo $row->id ?>">Click Here </a>(View Total No.of Article graph)</span>
                                                        </td>
                                                        <td>
                                                            <script>var builder_<?php echo $row->id ?> = <?php echo json_encode($row); ?></script>
            <!--                                                        <a  href="#"><i  data1="<?php echo 'builder_' . $row->id ?>" class="model_form fa fa-pencil"></i></a>-->

                                                            <a href="javascript:;" role="button"  class="submodel_form1edit align-left" value="<?php echo $row->id; ?>" rel="<?php echo $row->name; ?>" burm="<?php echo $row->bm_name; ?>" rel2="<?php echo $row->chname; ?>" rel3="" rel4="<?php echo $row->parent_id; ?>" rel5="<?php echo $row->maincategory; ?>" title="Add sub-sub Topics"><i class="fa fa-pencil" title="Edit"></i> </a>


                                                            <a  href="#"><i   title="delete" data="<?php echo $row->id ?>" class="subcat2_delete fa fa-remove"></i></a>



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
        <?php endif;
        ?>
    </div>
    <!-- /#wrapper -->

    <!-- Form modal -->
    <div id="form_modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header smile-primary" style="border-radius:0px !important;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Add</span> Sub Category </h4>
                </div>
                <!-- Form inside modal -->
                <?php echo form_open_multipart(site_url('/admin/dashbord_category/add_edit'), 'id="cat_form" class=".validate"'); ?>
                <div class="modal-body with-padding">
                    <div class="select_maincategory form-group">
                        <label>Selects Category</label>
                        <?php if (isset($maincategory) && count($maincategory)): ?>
                            <select name="maincat" id="maincat" class="form-control">
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
                                <input type="text" id="subcat" name="name" class="form-control required" maxlength="50" value="">
                            </div>
                        </div>
                    </div> 
                    <!--                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Name(In Chinese language):</label>
                                                    <input type="text" id="ch_lang_name" name="ch_lang_name" class="form-control required" maxlength="100" value="">
                                                </div>
                                            </div>
                                        </div> -->
<!--                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Name(In Burmese language):</label>
                                <input type="text" id="bm_lang_name" name="bm_lang_name" class="form-control required" maxlength="100" value="">
                            </div>
                        </div>
                    </div> -->


                </div>            
                <div class="modal-footer">

                    <span id="add">
                        <input type="hidden" name="id" value="" id="id">
                        <input type="hidden" name="curl" value="<?php echo site_url(uri_string()); ?>" id="id">
                        <input type="hidden" name="category_type" value="<?php echo $this->uri->segment(3) ?>" >
                        <div class="col-md-12">
                            <button type="button" class="btn btn-warning closebtn" data-dismiss="modal">Close</button>
                            <!--                            <a class="btn btn-large btn-danger" data-toggle="confirmation" data-placement="bottom">Click to toggle confirmation</a>-->
                            <button type="submit" class="btn btn-large btn-primary subbtn" data-toggle="confirmation" id="add_subcat">submit</button>
                        </div>
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
    <?php $this->load->view('admin/dashboard_category_edit') ?>
    <!-- Form modal -->
    <div id="form_modal1" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header smile-primary" style="border-radius:0px !important;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">&times;</button>
                    <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Add</span> Category </h4>
                </div>
                <!-- Form inside modal -->
                <?php echo form_open_multipart(site_url() . '/admin/dashbord_category/add_category', 'id="cat_form1" class=".validate" enctype="multipart/form-data"'); ?>
                <div class="modal-body with-padding">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Name:</label>
                                <input type="text" id="name1" name="name" class="form-control required" maxlength="50" value="">
                            </div>
                        </div>
                    </div> 
                    <!--                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Name(In Chinese language):</label>
                                                    <input type="text" id="ch_lang_name" name="ch_lang_name" class="form-control required" maxlength="100" value="">
                                                </div>
                                            </div>
                                        </div> -->
<!--                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>(In Burmese language):</label>
                                <input type="text" id="bm_lang_name" name="bm_lang_name" class="form-control required" maxlength="100" value="">
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Image:</label>
                                <input type="file" name="image_file" class="form-control required" value="">
                                <span class="help-block">Accepted formats: jpg, png, gif.(450X150)  </span>
                            </div>
                        </div>
                    </div> 

<!--                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3" style="padding-right:0px;">
                                <label>Home Category :</label>  
                                
                            </div>
							 <div class="col-sm-9" style="padding-left:10px;">
							 <input style="margin-top:5px;float:left;" type="checkbox" name="home_front" class="" value="yes">
							 </div>
                        </div>
                    </div> -->


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
    <div id="form_modal2" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header smile-primary" style="border-radius:0px !important;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">&times;</button>
                    <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Add sub-sub Topic </span> </h4>
                </div>
                <!-- Form inside modal -->
                <?php echo form_open_multipart(site_url() . '/admin/dashbord_category/add_edit', 'id="cat_form2" class=".validate"'); ?>
                <div class="modal-body with-padding">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Sub Topic name:</label>    
                                <p id="subcat_name">fdsf</p>
                            </div>
                        </div>
                    </div> 
<!--                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Sub-sub Topic name:</label>
                                <input type="text" id="subcat1"name="name" class="form-control required" maxlength="50" value="">
                            </div>
                        </div>
                    </div> -->
                    <!--                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Name(In Chinese language):</label>
                                                    <input type="text" id="ch_lang_name" name="ch_lang_name" class="form-control required" maxlength="100" value="">
                                                </div>
                                            </div>
                                        </div> -->
<!--                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Name(In Burmese language):</label>
                                <input type="text" id="bm_lang_name" name="bm_lang_name" class="form-control required" maxlength="100" value="">
                            </div>
                        </div>
                    </div> -->


                </div>            
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning closebtn" data-dismiss="modal">Close</button>
                    <span id="add">
                        <input type="hidden" name="id" value="" id="id">
                        <input type="hidden" name="curl" value="<?php echo site_url(uri_string()); ?>" id="id">
                        <input type="hidden" name="maincat" value="<?php echo $this->uri->segment(4) ?>" >
                        <button type="button" class="btn btn-primary subbtn" id="add_subcat1">Submit</button>
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
    <?php $this->load->view('admin/dashboard_category_sub_edit') ?>    
    <!-- Form modal -->
    <div id="form_modal3" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header smile-primar" style="border-radius:0px !important;background-color: #333;color:#fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">&times;</button>
                    <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Add sub-sub-sub Topic </span> </h4>
                </div>
                <!-- Form inside modal -->
                <?php echo form_open_multipart(site_url() . '/admin/dashbord_category/add_edit', 'id="cat_form3" class=".validate"'); ?>
                <div class="modal-body with-padding">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Sub-sub Topic name:</label>    
                                <p id="subcat_name1">fdsf</p>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Sub-sub-sub Topic name:</label>
                                <input type="text" id="subcat2" name="name" class="form-control required" maxlength="50" value="">
                            </div>
                        </div>
                    </div> 
                    <!--                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Name(In Chinese language):</label>
                                                    <input type="text" id="ch_lang_name" name="ch_lang_name" class="form-control required" maxlength="100" value="">
                                                </div>
                                            </div>
                                        </div> -->
<!--                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Name(In Burmese language):</label>
                                <input type="text" id="bm_lang_name" name="bm_lang_name" class="form-control required" maxlength="100" value="">
                            </div>
                        </div>
                    </div> -->

                </div>            
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning closebtn" data-dismiss="modal">Close</button>
                    <span id="add">
                        <input type="hidden" name="id" value="" id="id">
                        <input type="hidden" name="curl" value="<?php echo site_url(uri_string()); ?>" id="id">
                        <input type="hidden" name="maincat" value="<?php echo $this->uri->segment(4) ?>" >
                        <button type="button" class="btn btn-primary subbtn" id="add_subcat2">Submit</button>
                    </span><!-- 
                    <span id="edit">

                      <button type="submit" class="btn btn-primary" id="update_city" >Update Categories</button>
                    </span> -->
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/category_confirm_model'); ?>
    <?php $this->load->view('admin/category_article_graph') ?>

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
                                    $(document).on('click', '.submodel_form', function () {
                                        $('#form_modal2').modal({
                                            keyboard: false,
                                            show: true,
                                            backdrop: 'static'
                                        });
                                    });
                                    $(document).on('click', '.submodel_form1', function () {
                                        $('#form_modal3').modal({
                                            keyboard: false,
                                            show: true,
                                            backdrop: 'static'
                                        });
                                    });
                                    $(document).on('click', '.model_form1', function () {
                                        $('#form_modal1').modal({
                                            keyboard: false,
                                            show: true,
                                            backdrop: 'static'
                                        });
                                    });
                                    $(document).on('click', '.subcat_delete', function () {
                                        if (confirm("Are you sure to delete the sub topic.")) {
                                            var current_element = $(this);
                                            // alert ()
                                            url = "<?php echo site_url() ?>/admin/dashbord_category/delete_subcategory";

                                            //alert(url);
                                            $.ajax({
                                                type: "POST",
                                                url: url,
                                                data: {ct_id: $(current_element).attr('data')},
                                                success: function (data)
                                                {
                                                    alert(data)

                                                    if (data) {
                                                        alert("Successfully Deleted");
                                                        location.reload();
                                                    } else
                                                    {
                                                        alert("sorry, you cant delete this topic")
                                                    }

                                                }
                                            });
                                        }

                                    });
                                    $(document).on('click', '.subcat1_delete', function () {
                                        if (confirm("Are you sure to delete the sub-sub topic.")) {
                                            var current_element = $(this);
                                            // alert ()
                                            url = "<?php echo site_url() ?>/admin/dashbord_category/delete_subcategory1";

                                            //alert(url);
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
                                                        alert("sorry, you cant delete this topic")
                                                    }

                                                }
                                            });
                                        }

                                    });
                                    $(document).on('click', '.subcat2_delete', function () {
                                        if (confirm("Are you sure to delete the sub-sub-sub topic.")) {
                                            var current_element = $(this);
                                            // alert ()
                                            url = "<?php echo site_url() ?>/admin/dashbord_category/delete_subcategory2";

                                            //alert(url);
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
                                                        alert("sorry, you cant delete this topic")
                                                    }


                                                }
                                            });
                                        }

                                    });
                                    $(document).on('click', '.status_check', function () {
                                        if (confirm("Are you sure to delete data")) {
                                            var current_element = $(this);
                                            // alert ()
                                            url = "<?php echo site_url() ?>/admin/Dashbord_category/delete_subcategory";

                                            //alert(url);
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
                                                        alert("sorry, you cant delete this topic")
                                                    }

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

                                                    if (data) {

                                                        alert("Successfully Deleted");
                                                        location.reload();

                                                    } else
                                                    {
                                                        alert("You cant delete this topic.");
                                                        //location.reload();
                                                    }
                                                    //alert("Successfully Deleted");
                                                    //location.reload();

                                                }
                                            });
                                        }

                                    });
                                    $('#cat').addClass('active');
//                                    $("#article_edit_form").submit();
//                                    $('body').confirmation({
//                                        selector: '[data-toggle="confirmation"]'
//                                    });
//                                    $(document).on('click', '#add_subcat', function () {
//                                        url = "<?php echo site_url("admin/Dashbord_category/add_subcat_confirm_ajax") ?>";
//                                        var subcat = $('#subcat').val();
//                                        var maincat = "<?php echo $this->uri->segment(4); ?>";
//                                       
//                                        $.ajax({
//                                            type: "POST",
//                                            url: url,
//                                            data: {maincat: maincat, id: subcat},
//                                            success: function (data)
//                                            {
//                                               
//                                                if (data) {
//
//                                                    $('#form_modal2').modal('hide');
//
//                                                    $('#subcat_confirm_name').val(subcat);
//                                                    //$('#maincat_confirm_name').val(maincat);
//                                                    $('#confirm_myModal').modal({
//                                                        keyboard: false,
//                                                        show: true,
//                                                        backdrop: 'static'
//                                                    });
//
//                                                } else
//                                                {
//                                                    $("#cat_form").submit();
//                                                    
//                                                }
//                                              
//
//                                            }
//                                        });
//
//                                    });
                                    $(document).on('click', '#add_subcat1', function () {
                                        url = "<?php echo site_url("/admin/Dashbord_category/add_subcat_confirm_ajax") ?>";
                                        var subcat = $('#subcat1').val();
                                        var maincat = "<?php echo $this->uri->segment(4); ?>";

                                        $.ajax({
                                            type: "POST",
                                            url: url,
                                            data: {maincat: maincat, id: subcat},
                                            success: function (data)
                                            {

                                                if (data) {

                                                    $('#form_modal2').modal('hide');

                                                    $('#subcat_confirm_name').val(subcat);
                                                    //  $('#maincat_confirm_name').val(maincat);
                                                    $('#confirm_myModal').modal({
                                                        keyboard: false,
                                                        show: true,
                                                        backdrop: 'static'
                                                    });

                                                } else
                                                {
                                                    $("#cat_form2").submit();

                                                }


                                            }
                                        });

                                    });
                                    $(document).on('click', '#add_subcat2', function () {
                                        url = "<?php echo site_url("/admin/Dashbord_category/add_subcat_confirm_ajax") ?>";
                                        var subcat = $('#subcat2').val();
                                        var maincat = "<?php echo $this->uri->segment(4); ?>";
                                        $.ajax({
                                            type: "POST",
                                            url: url,
                                            data: {maincat: maincat, id: subcat},
                                            success: function (data)
                                            {

                                                if (data) {

                                                    $('#form_modal3').modal('hide');

                                                    $('#subcat_confirm_name').val(subcat);
                                                    //$('#maincat_confirm_name').html(maincat);
                                                    $('#confirm_myModal').modal({
                                                        keyboard: false,
                                                        show: true,
                                                        backdrop: 'static'
                                                    });

                                                } else
                                                {
                                                    $("#cat_form3").submit();
                                                    //location.reload();
                                                }


                                            }
                                        });

                                    });
                                    $(document).on('click', '#add_subcat_confirm', function () {


                                        $("#cat_ajax_confirm_form").submit();
                                    });
                                    //Graph script starts here
                                    $(document).on('click', '#model_graph', function () {


                                        url = "<?php echo site_url('/admin/Dashbord_category/category_total_article') ?>";
                                        var cat_id = $(this).attr('data_catid');
                                        $.ajax({
                                            type: "POST",
                                            url: url,
                                            data: {cat_id: cat_id},
                                            dataType: 'json',
                                            success: function (response)
                                            {
console.log(response);
                                                var chart = new CanvasJS.Chart("chartContainer",
                                                        {
                                                            title: {
                                                                text: "No. of Articles Report "
                                                            },
                                                            exportFileName: "Pie Chart",
                                                            //exportEnabled: true,
                                                            animationEnabled: true,
                                                            legend: {
                                                                verticalAlign: "bottom",
                                                                horizontalAlign: "center"
                                                            },
                                                            data: [
                                                                {
                                                                    type: "pie",
                                                                    showInLegend: true,
                                                                    toolTipContent: "{name}: <strong>{y}</strong>",
                                                                    indexLabel: "{name} {y}",
                                                                    dataPoints: response
                                                                }
                                                            ]
                                                        });
                                                chart.render();
                                                $('#form_modal_graph').modal({
                                                    keyboard: false,
                                                    show: true,
                                                    backdrop: 'static'
                                                });


                                            }
                                        });

                                    });
                                    $(document).on('click', '.submodel_form1edit', function () { 
                                        var id = $(this).attr('value');
                                        var name = $(this).attr('rel');
                                        var chname = $(this).attr('rel2');
                                        var buname = $(this).attr('burm');
                                        var category = $(this).attr('rel3');
                                        var parent = $(this).attr('rel4');
                                        //alert(buname);
                                        $('#id2edit').val(id);
                                        $('#subcat2edit').val(name);
                                        $('#ch_lang_name2edit').val(chname);
                                        $('#bm_s3_edit').val(buname);

                                        $('#maincatedit').val(category);
                                        $('#maincatparent').val(parent);
                                        var sbcat_name1 = $('#get_subcat1').attr('subcatname_data');
                                        $('#subcat_name2edit').html(sbcat_name1);
                                        $('#form_modal3edit').modal({
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
                                    $(document).on('click', '.model_form1edit', function () {
                                        var id = $(this).attr('value');
                                        var name = $(this).attr('rel');
                                        var chname = $(this).attr('rel2');
                                        var buname = $(this).attr('burm');
                                        var src = $(this).attr('rel3');
                                        var imgid = $(this).attr('rel4');
                                        var home_front = $(this).attr('home_front');
                                        //var checkvalue = $("#home_front").val();
                                        $('#idedt').val(id);
                                        $('#name1edt').val(name);
                                        $('#ch_lang_nameedt').val(chname);
                                       // $('#bm_lang_nameedit1').val(buname);
                                        $('#image1_idedt').val(id);
                                        $('#imgidedt').val(imgid);
                                      $('#home_front').val(home_front);
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
                                    $(document).on('click', '.submodel_formss', function () {
                                        var id = $(this).attr('value');
                                        var name = $(this).attr('rel');
                                        var chname = $(this).attr('rel2');
                                        var category = $(this).attr('rel3');
                                        var parent = $(this).attr('rel4');
                                        var buname = $(this).attr('burm');
                                        $('#idedit').val(id);
                                        $('#subcatedit').val(name);
                                        $('#ch_lang_nameedit').val(chname);
                                        $('#maincatedit').val(category);
                                        $('#maincatparent').val(parent);
                                        //$('#bm_lang_nameedit').val(buname);
                                        $('#form_modal_edit').modal({
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
                                    $(document).on('click', '.submodel_form1edit', function () {
                                        var id = $(this).attr('value');
                                        var name = $(this).attr('rel');
                                        var chname = $(this).attr('rel2');
                                        var category = $(this).attr('rel3');
                                        var parent = $(this).attr('rel4');
                                        $('#id2edit').val(id);
                                        $('#subcat2edit').val(name);
                                        $('#ch_lang_name2edit').val(chname);
                                        $('#maincatedit').val(category);
                                        $('#maincatparent').val(parent);
                                        var sbcat_name1 = $('#get_subcat1').attr('subcatname_data');
                                        $('#subcat_name2edit').html(sbcat_name1);
                                        $('#form_modal3edit').modal({
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
                                    $(document).on('click', '.submodel_formedit', function () {
                                        var id = $(this).attr('value');
                                        var name = $(this).attr('rel');
                                        var chname = $(this).attr('rel2');
                                        var category = $(this).attr('rel3');
                                        var parent = $(this).attr('rel4');
                                        var maincategory = $(this).attr('rel5');
                                         var buname = $(this).attr('burm');
                                        $('#id1edit').val(id);
                                        $('#subcat1edit').val(name);
                                        $('#ch_lang_name1edit').val(chname);
                                        $('#subcat_nameedit').html(maincategory);
                                        $('#bm_name_edit').val(buname);
                                        $('#form_modal2edit').modal({
                                            keyboard: false,
                                            show: true,
                                            backdrop: 'static'
                                        });
                                    });
                                    //Graph script ends here

                                });
    </script>

</body>

</html>
