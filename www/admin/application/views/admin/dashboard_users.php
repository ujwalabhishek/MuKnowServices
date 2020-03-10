<?php require_once('includes/head.php') ?>


<body>

    <div id="wrapper">

        <?php require_once('includes/nav.php') ?>
           
          <div id="form_modal1" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header smile-primary" style="border-radius:0px !important;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">&times;</button>
                    <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Coupon </span> Details </h4>
                </div>
                <!-- Form inside modal -->
                <div class="modal-body with-padding">

                    <table width="80%" cellspacing="2" cellpadding="10" class="table table-striped table-bordered table-hover" >
                        <tr>
                            <th>Coupon </th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                                                              <tbody>  
                                                                  <tr>
                                                                        
                                                                        <td >English</td>
                                                                        <td >tstngs</td>
                                                                    </tr>
                                                                    
                                                                                                                            </tbody></table>
                    



                </div>            
              
               
            </div>
        </div>
    </div>

        <div id="page-wrapper">
             
            
            <div class="row">
                <div class="col-lg-12"> 
                    <?php if($this->uri->segment(4)=='facilitator'){?>
       <h2 class="page-header"><i class="fa fa-user fa-fw" id="sidemenuicon"></i> <?php echo 'Trainer'; ?> registered users (Approve and View <?php echo 'Trainer'; ?> Details) </h2>
  
                    <?php } else {?>
                    <h2 class="page-header"><i class="fa fa-user fa-fw" id="sidemenuicon"></i> <?php echo str_replace('_',' ',ucfirst($this->uri->segment(4))); ?> registered users (Approve and View <?php echo str_replace('_',' ',ucfirst($this->uri->segment(4))); ?> Details) </h2>
                    <?php } ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
             <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success fade in block-inner">            
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <i class="icon-checkmark-circle"></i> <?php echo $this->session->flashdata('success') ?> </div>
                        <?php } ?>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading sectionhead">
                            <?php //echo ucfirst($this->uri->segment(4)); ?> 
                            <?php //$abuilder = array('id' => '', 'name' => ''); ?>
<!--                            <script>var builder_0 = <?php //echo json_encode($abuilder) ?></script>-->
                            
                            <?php if ($this->uri->segment(4) == 'subscriber'): ?>
                            <?php echo ucfirst($this->uri->segment(4))?> Details
<!--                                <a href="<?php //echo site_url()?>/admin/auth/create_contributor" role="button"   title=""><button type="button" style="float:right;margin-top:-5px !important;" class="btn smile-primary">Create contributor <i class="fa fa-plus" style="color:#fff;"></i></button></a>-->
                            <?php endif; ?>
                                
                                <?php if ($this->uri->segment(4) == 'facilitator'): ?>
                                 <?php echo 'Trainer Details'; ?>
                                <a href="<?php echo site_url()?>/admin/auth/create_user" role="button"   title=""><button type="button" style="float:right;margin-top:-5px !important;" class="btn smile-primary">Create Trainer <i class="fa fa-plus" style="color:#fff;"></i></button></a>
                            <?php endif; ?>
                                <?php if ($this->uri->segment(4) == 'unsubscriber'): ?>
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
                                            <th>Name</th>
                                            <th>Mobile No / Email</th>
                                            
                                            <th>User Type</th>
                                             <?php if ($this->uri->segment(4) != 'facilitator') {?>
                                            <th>Coupon Expiry Date</th>
                                            <?php } ?>
                                            <th>Mobile verify</th>
                                            <th>Email verify</th>
                                            <th>Status</th>
                                            <th>Created On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if (isset($register_user) && count($register_user)):
                                            //echo '<pre>'; print_r($register_user); exit;
                                            foreach ($register_user as $row) {
                                            $coupon = $this->Register_user_model->get_coupon($row->id); 
                                            //echo '<pre>'; print_r($coupon); exit;
                                            ?>

                                                <tr class="odd gradeX">
                                                    <td><?php echo ucfirst($row->username); ?></td>
                                                    <td><?php if($row->login_type=='fb_login'){echo $row->email;}else {echo $row->telcode . $row->phone; } ?></td>

                                                    <td><?php echo str_replace('_',' ',ucfirst($row->user_type));  ?>
<!--                                                        <select class="form-control status_change_user_type" data="<?php echo $row->id; ?>">
                                                            <option value="subscriber" <?php echo ($row->user_type == 'subscriber') ? "selected=selected" : ""; ?>>Subscriber</option>
                                                            <option value="contributor" <?php echo ($row->user_type == 'contributor') ? "selected=selected" : ""; ?>>Contributor</option>                                                                          
                                                            <option value="facilitator" <?php echo ($row->user_type == 'facilitator') ? "selected=selected" : ""; ?>>Facilitator</option>

                                                        </select>-->
                                                    </td>
                                                         <?php if ($this->uri->segment(4) != 'facilitator') {  
                                                             
                                                             $coupons = $this->Register_user_model->get_coupon_result($row->id); 
                                                             $scratch = $this->Register_user_model->get_scratchcard_result($row->id);
                                                             $subscription_coupon = $this->Register_user_model->get_subscription_result($row->id);
                                                             $coupon_count = count($coupons); 
                                                             $scratch_count = count($scratch); 
                                                             $subscription_count = count($subscription_coupon); 
                                                            // echo '<pre>'; print_r($coupon_count); exit;
                                                             ?>
                                                <td class="text-center">
                                                    <p><?php if(!empty($coupon->end_date)) {echo $coupon->end_date; }?></p>
<!--                                                <button type="button" class="btn btn-xs btn-outline btn-primary model_form1" value="<?php echo $row->id ?>">Coupon view</button>--> 
                                                    <?php if($coupon_count >  '0' || $scratch_count > '0' || $subscription_count > '0') {?>
                                                <a  href="<?php echo site_url(); ?>admin/Dashboard_users/<?php echo $this->uri->segment(4); ?>/view_coupon/<?php echo $row->id; ?>" title="View" class="tip"><button type="button" class="btn btn-xs btn-outline btn-primary model_form1" value="<?php echo $row->id ?>">Coupon view</button></a>
                                                    <?php } else { ?> 
                                                <button type="button" class="btn btn-xs btn-outline btn-primary " value="">No Coupon code applied</button>
                                                    <?php }?>
                                                </td>
                                                     <?php } ?>
                                                    <td class="center">  
                                                        <?php if ($row->mobile_verify == 'YES'): ?>
                                                            <i style="color:#398439" class="fa fa-check-circle"> Verified</i>
                                                        <?php else : ?>
                                                            <i style="color:#d43f3a" class="fa fa-times-circle"> Not verified</i>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="center">  
                                                        <?php if ($row->email_verify == 'YES'): ?>
                                                            <i style="color:#398439" class="fa fa-check-circle"> Verified</i>
                                                        <?php else : ?>
                                                            <i style="color:#d43f3a" class="fa fa-times-circle"> Not verified</i>
                                                        <?php endif; ?></td>
                                                    <td>
                                                        <?php if ($row->active == 1): ?>
                                                            <button type="button" class="btn btn-xs btn-success  disabled">Activated</button>

                                                        <?php else: ?>
                                                            <button type="button" class="btn btn-xs btn-outline btn-primary approve_status" value="<?php echo $row->id ?>">In Active</button>
                                                        <?php endif;
                                                        ?>
                                                    </td>

                                                    <td><?php echo ucfirst($row->created_on) ?></td>
                                                    <td class="text-center">
                                                        <script>var builder_<?php echo $row->id; ?> = <?php echo json_encode($row); ?></script>
                                                         <?php if ($this->uri->segment(4) == 'facilitator'){ ?>
                                                        <a  href="<?php echo base_url('index.php/admin/auth/edit_trainer/'.$row->id); ?>"><i  imagedata="image_dataclass<?php echo $row->id; ?>" data1="<?php echo 'builder_' . $row->id; ?>"class="model_form fa fa-pencil" title="Edit"></i></a>
                                                         <?php } ?>

                                                        <a  href="#" title="View" class="tip"><i imagedata="image_dataclass<?php echo $row->id; ?>" data="<?php echo 'builder_' . $row->id; ?>" class="model_form_view fa fa-eye tip" title="View"></i></a>


                                                                <!--                                                                                <a  href="#"><i   data="<?php echo $row->id ?>" class="status_check fa fa-remove" title="Delete"></i></a></td>-->
																</td>
                                                </tr>
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
    <!-- Form modal view -->
    <div id="form_modal_view" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="panel panel-default modal-content">
                <div class=" modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>View</span> User Details </h4>
                </div>
                <!-- Form inside modal -->
                <?php echo form_open_multipart(site_url() . '/admin/dashbord_category/add_edit', 'id="cat_form" class=".validate"'); ?>
                <div class="modal-body with-padding popupprofile">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">

                                <p class="text-center">
                                    <span class="append_img1"><img  style="display: inline-block;width: 100px;height: 100px;" class="thumbnail " src="<?php echo base_url(); ?>assets/upoads/profile_image/noimage.jpg">  </span>
                                <hr>
                            </div>
                        </div>

                    </div> 
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <p > <label >Full name:</label>
                                    <span id="view_username"> </span>
                                </p>

                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <p > <label >Phone:</label>
                                    <span id="view_phone"> </span>
                                </p>

                                <hr>
                            </div>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12  ">
                                <p> <label >Company:</label>
                                    <span id="view_company"></span>
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12  ">
                                <p> <label >Department:</label>
                                    <span id="view_department"></span>
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12  ">
                                <p > <label >Email:</label>
                                    <span id="view_email"> </span>
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12  ">
                                <p > <label >Learner  ID:</label>
                                    <span id="view_empid"> </span>
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div>-->
 <?php if($this->uri->segment(4)=='facilitator'){ ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12  ">
                                <p > <label >About Trainer:</label>
                                    <span id="view_about"> </span>
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div>
                     <?php } ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning closebtn" data-dismiss="modal">Close</button>
                    <span id="add">


                    </span>
                    <!-- /form modal view -->

                    <!-- jQuery -->
                    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>

                    <!-- Bootstrap Core JavaScript -->
                    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

                    <!-- Metis Menu Plugin JavaScript -->

                    <script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
                    <script src="<?php echo base_url(); ?>assets/js/jquery.form-validator.min.js"></script>
                    <script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>


                    <!-- DataTables JavaScript -->
                    <script src="<?php echo base_url(); ?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
                    <script src="<?php echo base_url(); ?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
                    <script src="<?php echo base_url(); ?>assets/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>

                    <!-- Custom Theme JavaScript -->
                    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>

                    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
                    <script>$(document).on('click', '.model_form1', function () {
                                                                                                                                                                                                        $('#form_modal1').modal({
                                                                                                                                                                                                        keyboard: false,
                                                                                                                                                                                                        show: true,
                                                                                                                                                                                                        backdrop: 'static'
                                                                                                                                                                                                        });
                                                                                                                                                                                                        });
                                                    $(document).ready(function () { 
                                                        
                                                        
                                                        
                                                        $(document).on('change', '.status_change_user_type', function () {
                                                            if (confirm("Are you sure want to change user type ?")) {
                                                                var id = $(this).attr('data');
                                                                var user_type = $(this).val();
                                                                //alert(id); alert(user_type); 
                                                                url = "<?php echo site_url() ?>/admin/Dashboard_createuser/user_type";
                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: url,
                                                                    data: {id: id, user_type: user_type},
                                                                    success: function (data)
                                                                    {
                                                                        if (data) {
                                                                            alert("Updated Successfully.")
                                                                            location.reload();
                                                                        }


                                                                        //SSxlocation.reload();
                                                                        //if (status)
                                                                        // $(current_element).addClass('fa-check-circle').removeClass('fa-times-circle');
                                                                        // else
                                                                        //$(current_element).removeClass('fa-check-circle').addClass('fa-times-circle');
                                                                    }
                                                                });
                                                            }

                                                        });
                                                        $('#dataTables-example').DataTable({
                                                            responsive: true,
                                                            'columnDefs': [{'orderable': false, 'targets': 7}], // hide sort icon on this column
                                                            'aaSorting': [[6, 'desc']] // start to sort data on this column
                                                        });

                                                        $(document).on('click', '.model_form', function () {
                                                            $('#form_modal').modal({
                                                                keyboard: false,
                                                                show: true,
                                                                backdrop: 'static'
                                                            });
                                                            //CKEDITOR.instances['posting_comment1'].insertHtml('');
                                                            //CKEDITOR.instances['reply_comment1'].insertHtml('');
                                                            $('label.error').hide();
                                                            var data = eval($(this).attr('data1'));
                                                            var posting_viewer_access = data.posting_viewer_access;
                                                           // alert(posting_viewer_access);
                                                            var status = data.status;
                                                            var category_id = data.category_id;
                                                            var reply_viewer_access = data.reply_viewer_access;
                                                            var posting_comment = data.posting_comment;
                                                            var reply_comment = data.reply_comment;
                                                            // $('#id1').html(data.id);
                                                            //alert(status);
                                                            $('#id1').val(data.id);
                                                            $('#short_comment1').val(data.short_comment);
                                                            $('#posting_title1').val(data.posting_title);

                                                            $("#status1 > [value=" + status + "]").attr("selected", "true");

                                                            $("#category_id1 > [value=" + category_id + "]").attr("selected", "true");
                                                            CKEDITOR.instances['posting_comment1'].setData(posting_comment);
                                                            CKEDITOR.instances['reply_comment1'].setData(reply_comment);
                                                            //alert(instance);
                                                            //if (instance) { CKEDITOR.destroy(instance); } 
                                                            //CKEDITOR.instances['posting_comment1'].insertText(posting_comment);
                                                            //$('textarea#posting_comment1').ckeditor().insertHtml('<a href="#">text</a>');
                                                            //alert($("#posting_comment1").data('wysihtml5').editor);
                                                            // CKEDITOR.instances['posting_comment'].setData('ffdsf')
                                                            //alert(data.reply_comment);
                                                            //editor.setValue(data.reply_comment);
                                                            // CKEDITOR.replace( 'reply_comment1' );
                                                            //$('#reply_comment1').html(data.reply_comment);
                                                            //$('#c_id').html(data.category_id);
                                                            if (posting_viewer_access != '')
                                                            {
                                                                $("#posting_viewer_access1 > [value=" + posting_viewer_access + "]").attr("selected", "true");

                                                            }
                                                            if (reply_viewer_access != '')
                                                            {
                                                                $("#reply_viewer_access1 > [value=" + reply_viewer_access + "]").attr("selected", "true");

                                                            }

                                                            // alert(data.id);

                                                            $('#name1').val(data.name);
                                                            $('#id').val(data.id);

                                                        });
                                                        $(document).on('click', '.model_form_view', function () {
                                                            $('#image_view').hide();
                                                            $('#form_modal_view').modal({
                                                                keyboard: false,
                                                                show: true,
                                                                backdrop: 'static'
                                                            });
                                                            var data = eval($(this).attr('data'));
                                                            
                                                            var id = data.id;
                                                            var uploadpath = 'assets/uploads/profile_image';

                                                            $('#view_username').html(data.username.charAt(0).toUpperCase() + data.username.substr(1).toLowerCase());
                                                            //$('#view_email').html(data.email);
                                                            $('#view_company').html(data.company_name);
                                                            $('#view_department').html(data.department_name);
                                                            //$('#view_empid').html(data.empid);
                                                            $('#view_phone').html(data.telcode + data.phone);
                                                            $('#view_about').html(data.about);
                                                            $('#id').val(data.id);
                                                            var email = data.email
                                                            var empid = data.empid

                                                            var not_available = "<button type='button' class='btn btn-info'>N/A</button>";
                                                            var raw_name1 = data.raw_name;
                                                            // console.log(raw_name1);
                                                            console.log(data);   
                                                            if (email == '')
                                                            {
                                                                $('#view_email').html(not_available);

                                                            }
                                                            else
                                                            {

                                                                $('#view_email').html(data.email);
                                                            }
                                                            if (empid == '')
                                                            {
                                                                $('#view_empid').html(not_available);

                                                            }
                                                            else
                                                            {

                                                                $('#view_empid').html(data.empid);
                                                            }
                                                            if (raw_name1 !== "null")
                                                            {

                                                                // var image = uploadpath + "/" + "noimage.jpg";
                                                                // htmlimage = "<img  style='display: inline-block;width: 140px;height: 150px;' class='thumbnail' src=" + "'<?php echo base_url(); ?>" + image + "'" + ">";
                                                                var raw_name = data.raw_name;
                                                                var login_type = data.login_type; 
                                                                if(login_type=='fb_login')
                                                                {
                                                                   if (raw_name !== null)
                                                                {
                                                                    var image = raw_name;
                                                                   
                                                                }
                                                                else
                                                                {
                                                                    var image = uploadpath + "/" + "noimage.png";

                                                                }
                                                                 htmlimage = "<img  style='display: inline-block;width: 150px;height: 150px;' class='thumbnail' src=" + image + ">";
                                                                }  
                                                                else {
                                                                var file_ext = data.file_ext;
                                                                if (raw_name !== null)
                                                                {
                                                                    var image = uploadpath + "/" + raw_name + file_ext;

                                                                }
                                                                else
                                                                {
                                                                    var image = uploadpath + "/" + "noimage.png";

                                                                }
                                                                 htmlimage = "<img  style='display: inline-block;width: 150px;height: 150px;' class='thumbnail' src=" + "'<?php echo base_url(); ?>" + image + "'" + ">";
                                                            }
                                                                //var image = uploadpath + "/" + "noimage.png";
                                                               

                                                                $('.append_img1').html(htmlimage);
                                                            }



                                                        });
                                                        $(document).on('click', '.status_check', function () {
                                                            if (confirm("Do you want to delete ?")) {
                                                                var current_element = $(this);

                                                                url = "<?php echo site_url() ?>/admin/dashboard_postdetails/delete";

                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: url,
                                                                    data: {post_id: $(current_element).attr('data')},
                                                                    success: function (data)
                                                                    {

                                                                        //alert("Successfully Deleted");
                                                                        location.reload();

                                                                    }
                                                                });
                                                            }

                                                        });
                                                        $(document).on('click', '.approve_status', function () {
                                                            if (confirm("Are you sure want to approve ?")) {
                                                                var current_element = $(this).val();
                                                                //alert(current_element);
                                                                if ($(this).hasClass("btn-primary"))
                                                                    var status = 1;
                                                                else
                                                                    var status = 0;
                                                                url = "<?php echo site_url() ?>/admin/Dashboard_users/approve_status";
                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: url,
                                                                    data: {user_id: current_element, status: status},
                                                                    success: function (data)
                                                                    {
                                                                        location.reload();
                                                                        //SSxlocation.reload();
                                                                        //if (status)
                                                                        // $(current_element).addClass('fa-check-circle').removeClass('fa-times-circle');
                                                                        // else
                                                                        //$(current_element).removeClass('fa-check-circle').addClass('fa-times-circle');
                                                                    }
                                                                });
                                                            }

                                                        });
                                                        $(document).on('click', '.view_imagepopup', function () {
                                                            var imagedata = eval($(this).attr('image_data'));
                                                            var titledata = $(this).attr('title_data');
                                                            var htmlimage1 = '';
                                                            var imagedataArray = imagedata;
                                                            // alert(imagedataArray[0].type);
                                                            var arrayLength = imagedataArray.length;
                                                            //alert(arrayLength);
                                                            for (var i = 0; i < arrayLength; i++) {
                                                                if (imagedataArray[i].type == '2')
                                                                    var uploadpath = 'assets/uploads/posting_videos';
                                                                else
                                                                    var uploadpath = 'assets/uploads/posting_image';

                                                                var image = uploadpath + "/" + imagedataArray[i].raw_name + imagedataArray[i].file_ext;
                                                                if (imagedataArray[i].type == '2')
                                                                {
                                                                    htmlimage = "<video width='80%'  controls ><source  src=" + "'<?php echo base_url(); ?>" + image + "'" + "type='video/mp4'></video>"
                                                                    //htmlimage= "<iframe width='70%' height='350' src="+"'<?php echo base_url(); ?>"+image+"'"+ "</iframe>";
                                                                }
                                                                else
                                                                {
                                                                    htmlimage = "<img  style='display: inline-block;width: 200px;height: 200px;' class='thumbnail' src=" + "'<?php echo base_url(); ?>" + image + "'" + ">";
                                                                }
                                                                //alert(htmlimage);
                                                                var htmlimage1 = htmlimage1 + htmlimage;
                                                            }
                                                            $('.img1').html(htmlimage1);
                                                            $('.tit').html(titledata);
                                                            $('#image_form').modal({
                                                                keyboard: false,
                                                                show: true,
                                                                backdrop: 'static'
                                                            });

                                                        });
                                                        $('#user').addClass('active');

                                                    });


                    </script>

                    </body>

                    </html>
