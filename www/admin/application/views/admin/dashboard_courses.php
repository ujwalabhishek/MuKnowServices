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
   <div id="form_modal1" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header smile-primary" style="border-radius:0px !important;">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">&times;</button>
               <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Select</span> Trainer </h4>
            </div>
            <!-- Form inside modal -->
            <?php echo form_open_multipart(site_url() . '/admin/Dashboard_courses/add_edit_courses', 'id="cat_form1" class=".validate" enctype="multipart/form-data"'); ?>
            <div class="modal-body with-padding">
               <div class="form-group">
                  <label>* <?php echo 'Trainer'; ?></label>
                  <select style="height:40px !important;" id="author_edit" name="author" class=" author_edit form-control required">
                     <option value=""><?php echo 'Please select Trainer'; ?></option>
                     <?php foreach ($authors as $author) { ?>
                     <option value="<?php echo $author->id; ?>" <?php if (!empty($article->author_id) && $article->author_id == $author->id) echo 'selected'; ?>><?php if (!empty($author->username)) echo $author->username; ?></option>
                     <?php } ?>
                  </select>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-warning closebtn" data-dismiss="modal">Close</button>
               <span id="add">
               <button type="submit" class="btn btn-primary subbtn" id="add_city">Submit</button>
               </span><!-- 
                  <span id="edit">
                  
                    <button type="submit" class="btn btn-primary" id="update_city" >Update Categories</button>
                  </span> -->
            </div>
            <?php echo form_close(); ?>
         </div>
      </div>
   </div>
   <div id="page-wrapper">
   <?php if ($mode == 'add'): ?>
   <div class="row">
      <div class="col-lg-12">
         <h2 class="page-header"><i class="fa fa-plus-circle fa-fw" id="sidemenuicon"></i> Create Courses</h2>
         <a href="<?php echo site_url() ?>admin/Dashboard_courses/index" role="button"   class="pull-left"  style="margin-left: 94%;margin-top: -60px;" title=""><button type="submit"    class="btn btn-primary closebtn">Back </button></a>
      </div>
      <!-- /.col-lg-12 -->
   </div>
   <!-- /.row -->
   <div class="row">
   <div class="col-lg-12">
   <div class="panel panel-default">
      <div class="panel-heading" style="height: 55px;">
          </div>
	<form role="form" id="addcourses_form" method="post" enctype ="multipart/form-data"  action="<?php echo site_url(); ?>admin/Dashboard_courses/confirm_page">
     
      <?php //echo form_open_multipart(site_url() . '/admin/Dashboard_articles/add_edit_article', 'id="cat_form" class=".validate"'); ?>
      <div class="panel-body">
      <button type="button" class="add_courses white btn btn-primary">Next</button>
      <button style="float:right" type="reset" class="btn btn btn-warning closebtn">Reset</button>
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
	  
	  <?php 
	  if($this->session->userdata('courses')){
	   $coursess =  $this->session->userdata('courses');
	  //echo '<pre>';print_r($coursess);exit();
	  }
	   ?>
      <div class="row">
      <div class="panel-body">
	   <div class="form-group">
	  
	  <?php if(!$course_id){ ?>
	  
	  <div class="form-group">
     
	  <h4><strong>Course title *</strong><h4>
      <input type="text"  name="course_title" id="course_title" class="form-control required" />
      </div>
	  
      <label><?php echo 'Course Overview'; ?> *</label>
      <textarea  class=" form-control "  id="overview" name="overview"  rows="3"></textarea>
      <p id="sho_val_err" class="error" style="font-weight: bold;"></p>
      <h5><p style="display:none;" class="error" id="overview_label" >Please enter the Overview.</p></h5>
      <h5><p style="display:none;" class="error" id="overview_length" >Overview should be minimum of 200 characters.</p></h5>
     
	 
     
      <label>Course <?php echo $lang_imageto_upload; ?>:* <?php echo $lang_accepted_fromat; ?>: jpeg, jpg, png.(400X200)</label>
      <span class="help-block"></span>
      <a class="btn smile-primary btn" href="javascript;" id="imageupload_focus" data-toggle="modal" data-target="#upload-logo-form"><?php echo $lang_select_image; ?></a><span id="img_name" style="font-weight: bold;margin-left: 5px;"></span>
      <?php $this->load->view('admin/courses_img1_crop_modal'); ?>
      <input id="imageupload" type="hidden" class="required" name="image_files" >
      <h5><p style="display:none;" class="error" id="imageupload_label" >Please upload a image.</p></h5>
		
	  <br>
     
	 
	  <label><?php echo 'Course description file'; ?>:* <?php echo $lang_accepted_fromat; ?>:  pdf or word</label>
      <span class="help-block"></span>
	  <span id="pdf_name" style="font-weight: bold;margin-left: 5px;"></span>
      <input id="pdfupload" type="file" class="required" name="pdfupload" >
      <h5><p style="display:none;" class="error" id="pdfupload_label" >Please upload a file.</p></h5>
     
	
	<br>

	  <?php }else{  ?>
	  <input type="hidden" id="course_id" name="course_id" value="<?php echo $course_id; ?>" />
	  <input type="hidden" id="author" name="author" value="<?php echo $author; ?>" />
       <input type="hidden" id="author" name="author" value="<?php echo $author_ids; ?>" />
	  <input id="course_title" type="hidden" name="course_title" value="1" />
	  <input type="hidden" id="overview" name="overview" value="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop" />
      <input id="imageupload" type="hidden" name="image_files" value="1" />
      <input id="pdfupload" type="hidden" name="pdfupload" value="1" />
	  <input id="chapter_upload" type="hidden" name="chapter_upload" value="1" />
	  
	  <?php } ?>
      <div class="form-group">
     
	  <h4><strong>Chapter <?php echo $chapter; ?>*</strong><h4>
      <input type="text"  name="title" id="title" class="form-control required" />
      <h5><p style="display:none;" class="error" id="title_label" >Please enter the chapter.</p></h5>
      <input type="hidden" name="curl" value="<?php echo site_url(uri_string()); ?>" />
	  <input type="hidden" id="chapter" name="chapter" value="<?php echo $chapter; ?>" />
      </div>
	  
	  <label><?php echo 'Chapter file'; ?>:* <?php echo $lang_accepted_fromat; ?>:  image,pdf,word</label>
      <span class="help-block"></span>
	  <span id="chapter_name" style="font-weight: bold;margin-left: 5px;"></span>
      <input id="chapter_upload" type="file" class="" name="chapter_upload" >
      <h5><p style="display:none;" class="error" id="chapter_upload_label" >Please upload a file.</p></h5>
					
	 <br>
     
	 
      <div id="artid">                                             
      <h4><strong>Select any Articles question *</strong><h4>
      <h5><p style="display:none;" class="error" id="article_label" >Please select the any article.</p></h5>
      <!-- /.row (nested) -->
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
      <div class="panel-body">
      <div class="dataTable_wrapper">
      <table width="100%" class="table table-striped table-bordered table-hover dataTables-example " id="table-style">
      <thead>
      <tr>
      <th>Select</th>
      <th>Article Title</th>
      <th>Question</th>
      <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php
         $k = 1;
         foreach ($article as $article_row) {
             if ($category_row->id == $article_row->cat_id):
                 ?>
      <tr class="odd gradeX">
      <td><input type="checkbox" name="select_article[]" class="select_art" value="<?php echo $article_row->id ?>" rel="<?php echo $article_row->article_id; ?>"/></td>
      <td><?php echo ucfirst($article_row->title) ?></td>
      <td>
      <?php echo ucfirst($article_row->question) ?>
      </td>  
      <td>
      <a  href="<?php echo site_url(); ?>admin/Dashboard_courses/preview_article/<?php echo $article_row->article_id; ?>"  target="_blank"  title="View" class="tip">Preview</a>
      </td>   </tr>
      <?php
         endif;
         $k++;
         }
         
         else:
         echo "<tr>" . "No article found" . "</tr>";
         
         
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
	  <?php if(!$course_id){ ?>
      <div class="form-group" >
   	  <input type="hidden" name="author" value="<?php if (!empty($authorid)) echo $authorid; ?>">      
      </div> 
	  <?php } ?>
      <button type="button" class="add_courses btn btn-primary">Next</button>
      <button style="float:right" type="reset" class="btn btn btn-warning closebtn">Reset</button>
      </div>   
      </form> 
      <!-- /.panel-body -->
      </div>
	  </div>
      <!-- /.panel -->
      <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
   </div>
   <?php endif;
      ?>
   <?php if ($mode == 'view_det'): ?>
   <div class="row">
      <div class="col-lg-12">
         <h2 class="page-header" style="color: #414042; border-bottom: 1px solid #adadad !important;">View Courses</h2>
      </div>
      <!-- /.col-lg-12 -->
   </div>
   <!-- /.row -->
   <div class="row">
      <div class="col-lg-12">
         <div class="panel panel-default">
            <div class="panel-heading" style="font-size:17px;">
               Course Details
               <a style="margin-top: -6px;float: right;" href="<?php echo site_url() ?>admin/Dashboard_courses/index/"> <button type="button" class="btn btn-info closebtn">Back</button></a>
            </div>
            <?php //echo form_open_multipart(site_url() . '/admin/Dashboard_articles/add_edit_article', 'id="cat_form" class=".validate"'); ?>
            <div class="panel-body">
               <?php if ($this->session->flashdata('message')) { ?>
               <div class="alert alert-success fade in block-inner">            
                  <button type="button" class="close" data-dismiss="alert">X</button>
                  <i class="icon-checkmark-circle"></i> <?php echo $this->session->flashdata('message') ?> 
               </div>
               <?php } ?>
               <?php if ($this->session->flashdata('error')) { ?>
               <div class="alert alert-danger fade in block-inner">
                  <button type="button" class="close" data-dismiss="alert">X</button>
                  <i class="icon-checkmark-circle"></i> <?php echo $this->session->flashdata('error') ?> 
               </div>
               <?php } ?>
               <div class="row">
                  <div class="col-lg-1"></div>
                  <div class="col-lg-10 space validate" >
                     <form role="form" id="add_form" method="post" action="<?php echo site_url() ?>admin/Dashboard_courses/add_edit_data">
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-4">
                                 <h4>
                                 <strong><span>Title:</span></strong>
                                 <h4>
                              </div>
                              <div class="col-md-8">
                                 <h5><?php echo ucfirst($courses_view->title); ?></h5>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-4">
                                 <h4>
                                 <strong><span>Overview:</span></strong>
                                 <h4>
                              </div>
                              <div class="col-md-8">
                                 <h5><?php echo ucfirst($courses_view->overview); ?></h5>
                              </div>
                           </div>
                        </div>
						<?php if (!empty($courses_description->raw_name)) { ?>
                        <!-- /.row (nested) -->
                        <div class="row">
                           <div class="col-md-4">
                              <h4><strong><span>Description: </span></strong></h4>
                           </div>
						   <div class="col-md-8">
                                 <a target="_blank" href="<?php echo base_url("assets/uploads/courses_image/" . $courses_description->raw_name . $courses_description->file_ext); ?>" >View Description</a>
								 
                              </div>
						   
						
                        </div>
						 <?php } ?>
                        <br>
						 <?php if (!empty($courses_image->raw_name)) { ?>
                        <div class="row">
                           <div class="col-md-4">
                              <h4 >
                              <span><strong>Image</strong>:</span>
                              <h4>
                           </div>
                           <div class="col-md-8">
                              <img height="200" width="500" src="<?php echo base_url("assets/uploads/courses_image/" . $courses_image->raw_name . $courses_image->file_ext); ?>" />
                           </div>
                        </div>
						<?php } ?>
                        <?php if (!empty($courses_image->caption)) { ?>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-4">
                                 <h4>
                                 <span>caption:</span>
                                 <h4>
                              </div>
                              <div class="col-md-8">
                                 <h5><?php echo ucfirst($courses_image->caption); ?></h5>
                              </div>
                           </div>
                        </div>
                        <?php } ?>
						
                        <?php
                           if (!empty($courses_det)):
                           $valuess = array();
                               foreach ($courses_det as $key => $courses_det_row) {
								   $chapter_description = $this->Courses_model->get_chapter_image($courses_det_row->courses_id,$courses_det_row->chapter_id, 6);
						?>
						
                         <div class="row">
						 
                           <div class="col-lg-6">
                           <h4><strong>Chapter-<?php echo $courses_det_row->chapter_id; ?></strong>: <?php echo ucfirst($courses_det_row->title); ?></h4>
                           </div>
						   </div>
						  <div class="row">	
						
						<?php if (!empty($chapter_description->raw_name)) { ?>
								<div class="col-lg-4">
								<h4><strong>Description</strong>: <h4>
							   </div>
							    <div class="col-md-8">
                                 <a target="_blank" href="<?php echo base_url("assets/uploads/courses_image/" . $chapter_description->raw_name . $chapter_description->file_ext); ?>" >View Details</a>
                              </div>
							   
						    <?php } ?>
							
						 </div>
                        <?php
                           if (!empty($article_quiz)):
                               $i = 1;
                               ?>
                        <?php
						 $courses_dete = explode("," ,$courses_det_row->article_quiz_id);
						 foreach($courses_dete as $chapter_article_quiz){
                             foreach ($article_quiz as $article_quiz_row) {
                               if ($article_quiz_row->id == $chapter_article_quiz):
							   
                                   ?>
                      <!--  <div class="row" style="border:none;"> -->
                           <div class="col-lg-10">
                              <div class="panel panel-info" style="margin-top:0px;margin-bottom:0px;">
                                 <div class="panel-heading" style="background-color:#fff !important;">
                                    <span class="certificatetitle">Article Title :</span> <?php echo ucfirst($article_quiz_row->article_title) ?>
                                 </div>
                                 <div class="panel-body" style="height:100px">
                                    <p><span class="certificatetitle">Article Question :</span> <?php echo ucfirst($article_quiz_row->question); ?></p>
                                 </div>
                              </div>
                           </div></br>
                        <!-- </div> -->
                        <?php
                           $i++;
                           
                           endif;
                           }
						 }
                           ?>
                        <?php
                           //else:
                           // echo "No article found";
                           endif;
                           ?>
						  
						   
                        <?php
                           }
                           //else:
                           //echo "Sorry! There is no article question is present to select." . "<br>";
                           endif;
                           ?>
						 
                        <br>
                     </form>
                     <!-- /.panel-body -->
                  </div>
                  <div class="col-lg-1"></div>
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
               <h1 class="page-header sectionhead">Edit Chapters</h1>
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     Course Details
                  </div>
                  <?php echo form_open_multipart(site_url() . '/admin/Dashboard_courses/add_edit_data', 'id="edit_form" class=".validate"');       ?>
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
					  
					  <?php if($chapter_id == 1){ ?>
					  
					  <div class="form-group">
					 
					  <h4><strong>Course title *</strong><h4>
					  <input type="text"  name="course_title" id="course_title" class="form-control" value="<?php echo $courses->title; ?>" />
					  </div>
					  
					  <label><?php echo 'Course Overview'; ?> *</label>
					  <textarea  class=" form-control "  id="overview" name="overview"  rows="3"><?php echo $courses->overview; ?></textarea>
					  <p id="sho_val_err" class="error" style="font-weight: bold;"></p>
					  <h5><p style="display:none;" class="error" id="overview_label" >Please enter the Overview.</p></h5>
					  <h5><p style="display:none;" class="error" id="overview_length" >Overview should be minimum of 200 characters.</p></h5>
					 
					 
					 
					  <label>Course upload:* Accepted file: jpeg, jpg, png.(400X200)</label>
					  <span class="help-block"></span>
					  <a class="btn smile-primary btn" href="javascript;" id="imageupload_focus" data-toggle="modal" data-target="#upload-logo-form">Select</a><span id="img_name" style="font-weight: bold;margin-left: 5px;"></span>
					  <?php $this->load->view('admin/courses_img1_crop_modal'); ?>
					  <input id="imageupload" type="hidden" class="required" name="image_files" >
					  <h5><p style="display:none;" class="error" id="imageupload_label" >Please upload a image.</p></h5>
					 <?php if (!empty($courses_image->raw_name)) { ?>
             <img height="50" width="50" src="<?php echo base_url("assets/uploads/courses_image/" . $courses_image->raw_name . $courses_image->file_ext); ?>" />
		<?php } ?>
		
					 <br>
					 
					  <label><?php echo 'Course description file'; ?>:* <?php echo $lang_accepted_fromat; ?>:  pdf or word</label>
					  <span class="help-block"></span>
					  <span id="pdf_name" style="font-weight: bold;margin-left: 5px;"></span>
					  <input id="pdfupload" type="file" class="required" name="pdfupload" >
					  <h5><p style="display:none;" class="error" id="pdfupload_label" >Please upload a file.</p></h5>
					  <?php if (!empty($courses_description->raw_name)) { ?>
            <a target="_blank" href="<?php echo base_url("assets/uploads/courses_image/" . $courses_description->raw_name . $courses_description->file_ext); ?>" >View Description</a>
	<?php } ?>
					  <br>
					<?php } ?>
					  <input type="hidden" id="course_id" name="course_id" value="<?php echo $course_id; ?>" />
					  <input type="hidden" id="author" name="author" value="<?php echo $author; ?>" />
					   <input type="hidden" id="edit" name="edit" value="<?php echo 'edit'; ?>" />

					  <div class="form-group">
					   <div class="panel-heading">
                     <h3> <b>Chapter Details </b></h3>
                  </div>
					  <h4><strong>Chapter <?php echo $chapter; ?>*</strong><h4>
					  <input type="text"  name="title" id="title" class="form-control" value="<?php echo $courses_det[0]->title; ?>" />
					  <h5><p style="display:none;" class="error" id="title_label" >Please enter the chapter.</p></h5>
					  <input type="hidden" name="curl" value="<?php echo site_url(uri_string()); ?>" />
					  <input type="hidden" id="chapter" name="chapter" value="<?php echo $chapter; ?>" />
					  </div>
					  
					  <label><?php echo 'Chapter file'; ?>:* <?php echo $lang_accepted_fromat; ?>:  image,pdf,word</label>
					  <span class="help-block"></span>
					  <span id="chapter_name" style="font-weight: bold;margin-left: 5px;"></span>
					  <input id="chapter_upload" type="file" class="" name="chapter_upload" >
					  <h5><p style="display:none;" class="error" id="chapter_upload_label" >Please upload a file.</p></h5>
					  <?php 
							$chapter_description = $this->Courses_model->get_chapter_image($course_id,$chapter_id, 6);
							if (!empty($chapter_description->raw_name)) { ?>
								
                                 <a target="_blank" href="<?php echo base_url("assets/uploads/courses_image/" . $chapter_description->raw_name . $chapter_description->file_ext); ?>" >View Description</a>
						    <?php } ?>
					  <br>
					 
					 
					  <div id="artid">                                             
					  <h4><strong>Select any Articles question *</strong><h4>
					  <h5><p style="display:none;" class="error" id="article_label" >Please select the any article.</p></h5>
					  <!-- /.row (nested) -->
					  <?php
						 if (!empty($category)):
						 
							 foreach ($category as $category_row) {
								 $check = 0;
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
					  <div class="panel-body">
					  <div class="dataTable_wrapper">
					  <table width="100%" class="table table-striped table-bordered table-hover dataTables-example " id="table-style">
					  <thead>
					  <tr>
					  <th>Select</th>
					  <th>Article Title</th>
					  <th>Question</th>
					  <th>Action</th>
					  </tr>
					  </thead>
					  <tbody>
					  <?php
						 $k = 1;
						 foreach ($article as  $article_row) {
							 if ($category_row->id == $article_row->cat_id):
								  $selatrticls = '';
								 // echo '<pre>'; print_r($courses_det); exit; 
								  for ($i = 0; $i < count($courses_det); $i++) {
									  
								    $article_quiz_result = $this->Quiz_article_model->get(array('id' => $courses_det[$i]->article_quiz_id));
								 //echo '<pre>'; print_r($article_quiz_result);
								// echo '<pre>'; print_r($article_row->id); exit;
									  if ($article_quiz_result->id == $article_row->id):
										 $selatrticls = "checked";
									  endif;
								  }
								 ?>
					  <tr class="odd gradeX">
					  <td><input type="checkbox" name="select_article[]" class="select_art sel_check" value="<?php echo $article_row->id ?>" rel="<?php echo $article_row->article_id; ?>"  <?php echo $selatrticls; ?>/></td>
					  <td><?php echo ucfirst($article_row->title) ?></td>
					  <td>
					  <?php echo ucfirst($article_row->question) ?>
					  </td>  
					  <td>
					  <a  href="<?php echo site_url(); ?>admin/Dashboard_courses/preview_article/<?php echo $article_row->article_id; ?>"  target="_blank"  title="View" class="tip">Preview</a>
					  </td>   </tr>
					  <?php
						 endif;
						 $k++;
						 }
						 
						 else:
						 echo "<tr>" . "No article found" . "</tr>";
						 
						 
						 endif;
						 ?>
					  </tbody>
					  </table>
					  </div>
					  <!-- /.table-responsive -->
					  </div>
					  <?php
						$check ++; }
						 else:
						 echo "Sorry! There is no article question is present to select." . "<br>";
						 endif;
						 ?>
					  <br> 
					  <?php if(!$course_id){ ?>
					  <div class="form-group" >
					  <input type="hidden" name="author" value="<?php if (!empty($authorid)) echo $authorid; ?>">      
					  </div> 
					  <?php } ?>
					  </div>  
					 
					 
                     <br>
                     <input type="hidden" name="course_id"  value="<?php echo $this->uri->segment(4); ?>"/>
                     <input type="hidden" name="chapter_id"  value="<?php echo $this->uri->segment(5); ?>"/>
					 <button type="button" class="edit_courses btn smile-primary btn">Submit</button>
                     </div>

					</form> 
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
               <h2 class="page-header">View Courses</h2>
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading sectionhead">
                     Courses Details
                     <a style="margin-top: -6px;float: right;" href="<?php echo site_url() ?>admin/Dashboard_courses/index/"> <button type="button" class="btn btn-info">Back</button></a>
                  </div>
                  <?php echo form_open_multipart(site_url() . '/admin/Dashboard_articles/add_edit_article', 'id="cat_form" class=".validate"');         ?>
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-lg-9 validate" >
                           <form role="form" id="edit_form" method="post" action="<?php echo site_url() ?>admin/Dashboard_courses/add_edit_data">
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
                        //echo "no courses found";
                        // endif;
                        //}
                        ?>
                     <?php
                        //endif;
                        ?>
                     <?php
                        }
                        else:
                        echo "No courses found";
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
               <h2 class="page-header"><i class="fa fa-database fa-fw" id="sidemenuicon"></i> Courses Details </h2>
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <?php if ($this->session->flashdata('message')) { ?>
         <div class="alert alert-success fade in block-inner">            
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="icon-checkmark-circle"></i> <?php echo $this->session->flashdata('message') ?> 
         </div>
         <?php } ?>
         <?php if ($this->session->flashdata('error')) { ?>
         <div class="alert alert-danger fade in block-inner">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="icon-checkmark-circle"></i> <?php echo $this->session->flashdata('error') ?> 
         </div>
         <?php } ?>
         <?php if ($this->session->flashdata('warning')) { ?>
         <div class="alert alert-info fade in block-inner">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="icon-checkmark-circle"></i> <?php echo $this->session->flashdata('warning') ?> 
         </div>
         <?php } ?>
         <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading sectionhead">
                     Courses Details
                     <?php //echo site_url('admin/Dashboard_courses/add_edit')   ?>                    <?php if (!empty($courses_list)): ?>
                     <a href = "<?php echo site_url('admin/Dashboard_courses/reorder_courses_page'); ?>"role = "button" class = "" title = "Add sub Topics"><button type = "button"style = "margin-top: -6px;" data1 = "builder_0" class = "btn smile-primary">Click here to Reorder  Courses
                     </button></a>
                     <input type="hidden" name="cat_type" value=""/>
                     <?php endif;
                        ?>
                     <a role="button"   title=""><button type="button" style="float:right;margin-top:-5px !important;" class="btn smile-primary model_form1">Create Courses <i class="fa fa-plus fa-fw"></i></button></a>
                  </div>
                  <!-- /.panel-heading -->
                  <div class="panel-body">
                     <div class="dataTable_wrapper">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
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
                                 if (isset($courses_list) && count($courses_list)):
                                     $i = 1;
                                     foreach ($courses_list as $row) {
                                         ?>
                              <tr class="odd gradeX">
                                 <td><?php echo $i; ?></td>
                                 <td><?php 
								 
								 echo ucfirst($row->title);  ?></td>
                                 <td>
                                    <select class="form-control status_check_active" data="<?php echo $row->id; ?>">
                                       <option value="Active" <?php echo ($row->status == 'Active') ? "selected=selected" : ""; ?>>Active</option>
                                       <option value="Inactive" <?php echo ($row->status == 'Inactive') ? "selected=selected" : ""; ?>>Inactive</option>
                                    </select>
                                 </td>
                                 <td><?php echo $row->created_on; ?></td>
                                 <td>
                                    <a  href="<?php echo site_url(); ?>admin/Dashboard_courses/view_detail/<?php echo $row->id; ?>" title="View" class="tip"><i  class="fa fa-eye" title="View"></i></a>
                                    <a  href="#"><i   data="<?php echo $row->id ?>" class="status_check fa fa-remove"></i></a>
                                 </td>
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
   <?php $this->load->view('admin/courses_img1_upload_modal.php'); ?>
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
   <script src="<?php echo base_url() ?>assets/js/jquery.Jcrop.js"></script>
   <!-- Page-Level Demo Scripts - Tables - Use for reference -->
   <script>
$(document).ready(function () {
  $('#cat_form1').validate();
      var url = "<?php echo site_url() ?>admin/Dashboard_courses/destory_selectearticle"
      $.ajax({
      type: "POST",
      url: url,
      //data: {select_article: values},
      success: function (data)
      {
      //alert(data);
      // $(".modal").hide();
      //alert("Successfully Deleted");
      //location.reload();
      
      }
      });
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
      
$(document).on('click', '.model_form1', function () {
      $('#form_modal1').modal({
      keyboard: false,
      show: true,
      backdrop: 'static'
      });
      });
                                                                                                                                                   
      var jcrop_api;
      $("#upload-logo-form-control").show();
      $("#upload-logo-form-control").submit(function (e)
      {
      var postData = new FormData($(this)[0]);
      $("#upload-logo-form-control").hide();
      $(".upfrma").addClass('loader');
      var formURL = $(this).attr("rel");
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
      
      if (obj.type == 'alert')
      {
      $("#upload-logo-form-control").show();
      $("#mailme-alert").html(obj.msg);
      $("#mailme-alert").show();
      } else if (obj.type == 'success') {
      $("#upload-logo-form-control").hide();
      $("#mailme-alert").hide();
      $("#imageupload").val(data);
      $("#image-uploader").val(obj.msg.orig_name);
      $("#img_name").html(obj.msg.orig_name);
      $("#image-uploader-label").html(obj.msg.orig_name);
      initJcrop1('/Dedaabox_dev/assets/uploads/courses_image/' + obj.msg.file_name);
      $("#upload-logo-form").modal('hide');
      $("#crop-logo-form").modal('show');
      var ims = $('#dem81').attr('src');
      //alert(ims);
      //alert(ims);
      $(".jcrop-keymgr").css("display", "none");
      } else {
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
      $('.jcrop-holder').remove(); // old image removing.
      $('#dem81').attr("src", img);
      $('#dem81').attr("width", "500px"); //first time height and width settings.
      $('#dem81').attr("height", "500px");
      $('#dem81').attr("visibility", "visible");
      
      jcrop_api = $.Jcrop('#dem81');
      // alert(jcrop_api);
      jcrop_api.setImage(img);
      //console.log(jcrop_api);
      //jcrop_api.animateTo([150, 150, 400, 200]);
      jcrop_api.setOptions({bgOpacity: .6, bgColor: 'white', setSelect: [150, 150, 50, 50],
      aspectRatio: 400 / 150,
      onSelect: updateCoords1});
      
      return false;
      }
      ;
      //                                                                                                                
      function updateCoords1(c)
      {
      $('#crop1_x').val(c.x);
      $('#crop1_y').val(c.y);
      $('#crop1_w').val(c.w);
      $('#crop1_h').val(c.h);
      }
      ;
      //                                                                                                                
$('#upload-logo-form').on('shown.bs.modal', function () {
      $('.upfrma').removeClass('loader');
      $("#upload-logo-form-control").show();
      $('#upload-logo-form-control').find("input[type=file]").val("");
      $("#mailme-alert").hide();
      $("#mailme-alert").html('');
      //jcrop_api.destroy();
      return (false);
      });
      //                                                                                                               
      
$('#crplogo').on('click', function () {
      
      $("#upload-logo-form").modal('hide');
      if (parseInt($('#crop1_w').val()))
      $("#crop-logo-form").modal('hide');
      else
      alert('Please select a crop region then press submit.');
      return false;
      
      });
      //                                                                                                               
      $('.crop_close').on('click', function () {
      
      $("#imageupload").val('');
      $("#img_name").html('');
      });
    
$("#pdfupload").on('change', function () {
      
      var countFiles = $(this)[0].files.length;
      var imgPath = $(this)[0].value;
      var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
      
      if (extn == "pdf" || extn == "doc" || extn == "docx") {
      if (typeof (FileReader) != "undefined") {
      if (countFiles > 3)
      {
      alert("please upload maximum 3 files");
      } else
      {
      for (var i = 0; i < countFiles; i++) {
      reader.readAsDataURL($(this)[0].files[i]);
      }
      }
      
      
      } else {
      alert("It doesn't supports");
      $("#pdfupload").val("");
      }
      } else {
      alert("Select Only PDF or Word files");
      $("#pdfupload").val("");
      }
      });
	  
      
$("#imageupload").on('change', function () {
      
      var countFiles = $(this)[0].files.length;
      var imgPath = $(this)[0].value;
      var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
      var image_holder = $("#preview-image");
      image_holder.empty();
      if (extn == "jpg" || extn == "png" || extn == "jpeg") {
      if (typeof (FileReader) != "undefined") {
      if (countFiles > 3)
      {
      alert("please upload maximum 3 files");
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
      alert("Select Only image files");
      $("#imageupload").val("");
      }
      });
      
      
$(document).on('click', '.status_check', function () {
      if (confirm("Are you sure to delete data")) {
      var current_element = $(this);
      // alert ($(current_element).attr('data'))
      url = "<?php echo site_url() ?>admin/Dashboard_courses/delete";
      
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
      url = "<?php echo site_url() ?>/admin/Dashboard_courses/active";
      
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
      
 $('.select_art').click(function (e) { 
          e.stopPropagation();
          //alert('hi');
      var url = "<?php echo site_url() ?>admin/Dashboard_courses/set_article"
      //alert(url);
      $.ajax({
      type: "POST",
      url: url,
      async: true,
      data: {select_article_question: $(this).val() + '_' + $(this).attr('rel') + ','},
      success: function (data)
      {
         //alert(data);
      
      }
      });
      
      });

      $('.add_courses').click(function () {
      $("#addcourses_form").valid();
      $('#title_label').hide();
      $('#group_label').hide();
      $(".modal").show();
    
      var tit = $('#title').val();
      var imge = $('#imageupload').val();
      
	   if ($('#title').val() == '') {
      $("#title").focus();
      $('#title_label').show();
      } 
	  
     
      if ($('#pdfupload').val() == '') {
      $("#pdfupload_focus").focus();
      $('#pdfupload_label').show();
      }else
      {
          $('#pdfupload_label').hide();
      }
      
      if ($('#imageupload').val() == '') {
      $("#imageupload_focus").focus();
      $('#imageupload_label').show();
      }else
      {
          $('#imageupload_label').hide();
      }
      
      if ($('#overview').val() == '') {
      $("#overview").focus();
      $('#overview_label').show();
      }
      else if ($('#overview').val()) {
      var ovrval = $('#overview').val();
      var ovrlength = ovrval.length;
      //alert(ovrlength);
		if (ovrlength < 20) {
		  $("#overview").focus();
		  $('#overview_length').show();
		  }
      }
      
      if ($('.select_art').is(':checked')) {
      if (ovrlength > 20) {
      $('#overview_length').hide();
      $('#overview_label').hide();
      $(".modal").hide();
       if($('#title').val() != '' && $('#imageupload').val() != '' && $('.select_art').is(':checked')) {
              $('#addcourses_form').submit();
          }
      }
          
      $('#article_label').hide()																																																		
     } else {
      if (ovrlength > 20) {
      $('#overview_length').hide();
      $('#overview_label').hide();
      $(".modal").hide();
       if($('#title').val() != '' && $('#imageupload').val() != '' && $('.select_art').is(':checked')) {
              $('#addcourses_form').submit();
          }
      }
      $(".modal").hide();
      $("#article_label").focus();
      $('#article_label').show();
      }
      $(".modal").hide();
      });
      $('.edit_courses').click(function () {
      //$("#edit_form").valid();
      
      //event.preventDefault();
      
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