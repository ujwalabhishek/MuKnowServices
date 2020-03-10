
<?php require_once('includes/head.php') ?>
<?php require_once('includes/loader.php') ?>
<body>
    <div class="modal modal_load" style="display: none">
        <div class="center">
            <div class="loader"></div>
<!--            <img alt="" src="<?php base_url(); ?>/assets/loader.gif" />-->
        </div>
    </div>
    <!--    <div id="wrapper">-->

    <?php require_once('includes/nav.php') ?>




    <!-- Form bordered -->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"><i class="fa fa-plus-circle" id="sidemenuicon"></i> Create <?php
                    
                        echo "Trainer"
                        ?></h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading sectionhead">
                        <p><?php echo lang('create_user_subheading'); ?><button onclick="goBack()" style="float: right; margin-top:-4px;" type="button" class="btn btn-info closebtn"  align="right">Back</button></p> 

                    </div>
                    <div class="panel-body">
                        <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success fade in block-inner">            
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <i class="icon-checkmark-circle"></i> <?php echo $this->session->flashdata('success') ?> </div>
                        <?php } ?>
                        <h6 style="color:red"><?php echo $message; ?></h6>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <?php echo form_open("admin/auth/create_user", 'class="validate"'); ?>
                                <div class="row">
								<div class="col-md-6 form-group">
                                    <label>Full Name:*</label>
                                    <?php echo form_input($username); ?>
<!--                                            <p class="help-block">Example block-level help text here.</p>-->
                                </div>
								
                                <div class="col-md-6 form-group">

                                    <div class="form-group">
                                        <label>Select the user type</label>
                                        <!--                                        <label>Selects Categories</label>-->

                                        <select name="user_type" class="form-control">
   
                                            <option value="Facilitator"> Trainer </option>
                                            
                          
                                        </select>


                                    </div>
                                </div>
								</div>

                                 <div class="row">

                                 
                                    <div class="col-md-3">
                                        <label><?php echo lang('create_user_phone_label', 'phone'); ?>*</label>

                                        <?php if (isset($tele_code) && count($tele_code)): ?>
                                        <select name="telcode" class="form-control">
                                            <?php foreach ($tele_code as $row) { 
                                                if($row->code == '+95'){?>
                                                <option value="<?php echo $row->code ?>" <?php echo (set_value('telcode')==$row->code)?" selected=' selected'":""?>><?php echo $row->code." ";echo ucfirst($row->name) ?></option>

                                                <?php } } ?>
                                        </select>
                                    <?php endif; ?>
                                    </div>
                                    <div class="col-md-3">

                                        <?php echo form_input($phone); ?>
                                    </div>
									
									<div class="col-md-6">
									  <div class="form-group">
                                    <label><?php echo lang('create_user_email_label', 'email'); ?></label>
                                    <?php echo form_input($email); ?>
                                </div>

									</div>

                                </div> 
                                <br>
<!--                              <div class="row">
                                <div class="col-md-6 form-group">
                                    <label><?php echo lang('create_user_company_label', 'company'); ?>*</label>
                                    <?php
                                    //$options = array('-1' => 'SELECT COMPANY', '1' => 'Small Shirt', 'med' =>
                                    //'Medium Shirt', 'large' => 'Large Shirt', 'xlarge' => 'Extra Large Shirt',);
                                    //echo form_dropdown('company',$company,'', 'class="form-control" id="my_id"');
                                    //form_dropdown('name', $array, '', 'class="my_class" id="my_id"')
                                    ?>
                                    <?php if (isset($company) && count($company)): ?>
                                        <select name="company" class="company form-control">
                                            <option value="">Choose a company</option>
                                            <?php foreach ($company as $row) { ?>
                                                <option value="<?php echo $row->id ?>"><?php echo ucfirst($row->name) ?></option>

                                            <?php } ?>
                                        </select>
                                    <?php endif; ?>
                                                                            <label><?php ///echo lang('create_user_company_label', 'company');      ?></label>
                                    <?php // echo form_input($company);   ?>
                                </div>
                                <div class="col-md-6 form-group">

                                    <div class="form-group">
                                        <label>Select a Department:*</label>
                                                                                <label>Selects Categories</label>
                                        <select id="department" name="department" data-placeholder="Choose a department..." class="form-control select-full required" tabindex="2">
                                            <option value="">Choose a department</option>
                                        </select>

                                    </div>
                                </div>
								</div>-->
								<div class="row">
<!--                                <div class="col-md-4 form-group">
                                    <label>Learner Id:</label>
                                    <?php echo form_input($empid); ?>
                                </div>-->

                                <div class="col-md-3 form-group">
                                    <label><?php echo lang('create_user_password_label', 'password'); ?>*</label>
                                    <?php echo form_input($password); ?>
                                </div>
								<div class="col-md-3 form-group">
                                    <label><?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?>*</label>
                                    <?php echo form_input($password_confirm); ?>
                                </div>
								</div>
<div class="row">
                                                                <div class="col-md-6 form-group">
                                                                                                    <label><?php echo $lang_imageto_upload; ?>: <?php echo $lang_accepted_fromat; ?>: jpeg, jpg, png, gif.(400X200)</label>
                                                                                                    <span class="help-block"></span>
                                                                                                    <a class="btn smile-primary btn" href="#" id="imageupload_focus" data-toggle="modal" data-target="#upload-logo-form"><?php echo $lang_upload; ?></a><span id="img_name" style="font-weight: bold;margin-left: 5px;"></span>
                                                                                                    <?php $this->load->view('admin/facilitator_img1_crop_modal'); ?>
                                                                                                    <input id="imageupload" type="hidden" class="required" name="image_files" >
                                                                                                    <h5><p style="display:none;" class="error" id="imageupload_label" >Please upload a image.</p></h5>
                                                                                                    <br>
<!--                                                                                                    <label><?php echo $lang_caption_image; ?>:</label>
                                                                                                    <input class="form-control" name="caption_image1" maxlength="20">-->

<!--                                                                                                    <a class="btn smile-primary btn" href="javascript;" data-toggle="modal" data-target="#upload-logo-form1"><?php echo $lang_upload; ?></a><span id="img_name1" style="font-weight: bold;margin-left: 5px;"><b></span>
                                                                                                    <?php //$this->load->view('admin/article_img1_crop_modal1'); ?>
                                                                                                    <input id="imageupload1" type="hidden" name="image_files1" ><br>
                                                                                                    <label><?php //echo $lang_caption_image; ?>:</label>
                                                                                                    <input class="form-control" name="caption_image2" maxlength="20"><br>

                                                                                                    <a class="btn smile-primary btn" href="javascript;" data-toggle="modal" data-target="#upload-logo-form2"><?php echo $lang_upload; ?></a><span id="img_name2" style="font-weight: bold;margin-left: 5px;"><b><b></span>
                                                                                                                <?php //$this->load->view('admin/article_img1_crop_modal2'); ?>
                                                                                                                <input id="imageupload2" type="hidden" name="image_files2" ><br>
                                                                                                                <label> <?php //echo //$lang_caption_image; ?>:</label>
                                                                                                                <input class="form-control" name="caption_image3" maxlength="20">-->
                                                                                                                <!--                                                                <div class="row">
                                                                                                                                                                                    <div id="preview-image"></div>
                                                                                                                                                                                    <div id="preview-image1"></div>
                                                                                                                                                                                    <div id="preview-image2"></div>
                                                                                                                                                                                </div>-->

                                                                                                                <span class="help-block old_image4"></span>
                                                                <!--                                                    <input type="hidden" name="adv_id" id="id" value="">-->
                                                                                                                </div>
    </div>

                                                    <div class="">
                                                                <div class="form-group">
                                                                                                                    <label>* <?php echo 'About Trainer'; ?></label>
<!--                                                                                                                    <textarea  class=" form-control required"  id="about" name="about" rows="3" value="<?php if(!empty($about)) echo $about;?>"></textarea>     -->
                                                                                                                   <?php echo form_input($about); ?>                                                                                                                                                                                                                                                                                                                                                                                       <!--                                                <textarea class="ckeditor form-control" rows="3"></textarea>-->
                                                                                                                </div>
                                                         </div>
                                
                                <div class="createclass" style="float:right;">
                                    <?php echo form_submit('submit', lang('create_user_submit_btn')); ?>
                                    
                                    
                                </div>


                                </form>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <?php $this->load->view('admin/facilitator_img1_upload_modal.php'); ?>
    <!-- /#page-wrapper -->
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 
  <script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.Jcrop.js"></script>
    <script>
          $(document).ready(function () { 
              
                                  
                                                                                                                var jcrop_api;
                                                                                                                $("#upload-logo-form-control").show();
                                                                                                                $("#upload-logo-form-control").submit(function (e)
                                                                                                                {
																													
																													//alert("ghfghgfh");
                                                                                                                    var postData = new FormData($(this)[0]);
                                                                                                                    $("#upload-logo-form-control").hide();
                                                                                                                    $(".upfrma").addClass('loader');
                                                                                                                    var formURL = $(this).attr("action");
                                                                                                                    $.ajax(
                                                                                                                            {
                                                                                                                                url: formURL,
                                                                                                                                type: "POST",
                                                                                                                                async: false,
                                                                                                                                cache: false,
                                                                                                                                contentType: false,
                                                                                                                                enctype: 'multipart/form-data',
                                                                                                                                processData: false,
                                                                                                                                data: postData,
                                                                                                                                success: function (data, textStatus, jqXHR)
                                                                                                                                {
                                                                                                                                    $('.upfrma').removeClass('loader');
                                                                                                                                    var obj = $.parseJSON(data);
                                                                                                                                    console.log(obj);
                                                                                                                                    if (obj.type == 'alert')
                                                                                                                                    {
                                                                                                                                        $("#upload-logo-form-control").show();
                                                                                                                                        $("#mailme-alert").html(obj.msg);
                                                                                                                                        $("#mailme-alert").show();
                                                                                                                                    }
                                                                                                                                    else if (obj.type == 'success') {
                                                                                                                                        $("#upload-logo-form-control").hide();
                                                                                                                                        $("#mailme-alert").hide();
                                                                                                                                        $("#imageupload").val(data);
                                                                                                                                        $("#image-uploader").val(obj.msg.orig_name);
                                                                                                                                        $("#img_name").html(obj.msg.orig_name);
                                                                                                                                        $("#image-uploader-label").html(obj.msg.orig_name);
                                                                                                                                        initJcrop1('/assets/uploads/profile_image/' + obj.msg.file_name);
                                                                                                                                        $("#upload-logo-form").modal('hide');
                                                                                                                                        $("#crop-logo-form").modal('show');
                                                                                                                                        var ims = $('#dem81').attr('src');
                                                                                                                                        //alert(ims);
                                                                                                                                        $(".jcrop-keymgr").css("display", "none");
                                                                                                                                    }
                                                                                                                                    else {
                                                                                                                                        $("#mailme-alert").hide();
                                                                                                                                        if (obj.url) {
                                                                                                                                            window.location.href = obj.url;
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                },
                                                                                                                                error: function (jqXHR, textStatus, errorThrown)
                                                                                                                                {
                                                                                                                                    //$("#upload-logo-form-control").show();
                                                                                                                                    $("#mailme-alert").html('There was some problem with the server. Please try again.<a href="" class="close">?</a>');
                                                                                                                                    $("#mailme-alert").show();
                                                                                                                                }
                                                                                                                            });
                                                                                                                    e.preventDefault(); //STOP default action
                                                                                                                });
                                                                                                                function initJcrop1(img)
                                                                                                                {
                                                                                                                    $('#dem81').attr("src", img);
                                                                                                                     $('#dem81').attr("width", "500px");
                                                                                                                      $('#dem81').attr("height", "500px");
                                                                                                                        $('#dem81').attr("visibility", "visible");
                                                                                                                    jcrop_api = $.Jcrop('#dem81');
                                                                                                                    jcrop_api.setImage(img);
                                                                                                                    console.log(jcrop_api);
                                                                                                                    //jcrop_api.animateTo([150, 150, 400, 200]);
                                                                                                                    jcrop_api.setOptions({bgOpacity: .6, bgColor: 'white', setSelect: [150, 150, 50, 50],
                                                                                                                        aspectRatio: 400 / 250,
                                                                                                                        onSelect: updateCoords1});

                                                                                                                    return false;
                                                                                                                }
                                                                                                                ;
                                                                                                               
                                                                                                                function updateCoords1(c)
                                                                                                                {
                                                                                                                    $('#crop1_x').val(c.x);
                                                                                                                    $('#crop1_y').val(c.y);
                                                                                                                    $('#crop1_w').val(c.w);
                                                                                                                    $('#crop1_h').val(c.h);
                                                                                                                }
                                                                                                                ;
                                                                                                                
                                                                                                                $('#upload-logo-form').on('shown.bs.modal', function () {
                                                                                                                    $('.upfrma').removeClass('loader');
                                                                                                                    $("#upload-logo-form-control").show();
                                                                                                                    $('#upload-logo-form-control').find("input[type=file]").val("");
                                                                                                                    $("#mailme-alert").hide();
                                                                                                                    $("#mailme-alert").html('');
                                                                                                                    jcrop_api.destroy();
                                                                                                                    return (false);
                                                                                                                });
                                                                                                                

                                                                                                                $('#crplogo').on('click', function () {

                                                                                                                    $("#upload-logo-form").modal('hide');
                                                                                                                    if (parseInt($('#crop1_w').val()))
                                                                                                                        $("#crop-logo-form").modal('hide');
                                                                                                                    else
                                                                                                                        alert('Please select a crop region then press submit.');
                                                                                                                    return false;

                                                                                                                });
                                                                                                               
                                                                                                                $('.crop_close').on('click', function () {

                                                                                                                    $("#imageupload").val('');
                                                                                                                    $("#img_name").html('');
                                                                                                                });
                                                                                                                
                                                                                                                            
                                                                                                                  $("#imageupload").on('change', function () {
                                                                                                                        
                                                                                                                    var countFiles = $(this)[0].files.length;
                                                                                                                    // alert(countFiles);
                                                                                                                    var imgPath = $(this)[0].value;
                                                                                                                    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                                                                                                                    var image_holder = $("#preview-image");
                                                                                                                    image_holder.empty();
                                                                                                                    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                                                                                                                        if (typeof (FileReader) != "undefined") {
                                                                                                                            if (countFiles > 13)
                                                                                                                            {
                                                                                                                                alert("please upload maximum 3 image");
                                                                                                                            }
                                                                                                                            else
                                                                                                                            {
                                                                                                                                for (var i = 0; i < countFiles; i++) {

                                                                                                                                    var reader = new FileReader();
                                                                                                                                    reader.onload = function (e) {
                                                                                                                                        $("<img />", {
                                                                                                                                            "src": e.target.result,
                                                                                                                                            "class": "thumbimage"
                                                                                                                                        }).appendTo(image_holder);
                                                                                                                                    }

                                                                                                                                    image_holder.show();
                                                                                                                                    reader.readAsDataURL($(this)[0].files[i]);
                                                                                                                                }
                                                                                                                            }


                                                                                                                        } else {
                                                                                                                            alert("It doesn't supports");
                                                                                                                            $("#imageupload").val("");
                                                                                                                        }
                                                                                                                    } else {
                                                                                                                        alert("Select Only images");
                                                                                                                        $("#imageupload").val("");
                                                                                                                    }
                                                                                                                });    
                                                                                                                
                                                                                                               
                                                                                                               
              
        $(document).on('change', '.company', function () {
             $(".modal").show();
            var value = $(this).val();
            var url = "<?php echo site_url() ?>admin/Dashboard_createuser/department/" + value;
            $.ajax({
                url: url,
                success: function (data)
                {
                    
                    if (data)
             
                        $('#department').html(data);
                     $(".modal").hide();
                }
            });
            $('#department').select("val", "");
        });
        $('#user').addClass('active');
         $('.number').keydown(function(event) {
                // Allow special chars + arrows 
                if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
                    || event.keyCode == 27 || event.keyCode == 13 
                    || (event.keyCode == 65 && event.ctrlKey === true) 
                    || (event.keyCode >= 35 && event.keyCode <= 39)){
                        return;
                }else {
                    // If it's not a number stop the keypress
                    if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                        event.preventDefault(); 
                    }   
                }
            });
         });
    </script>
	
	<script>
function goBack() {
    window.history.back();
}
</script>