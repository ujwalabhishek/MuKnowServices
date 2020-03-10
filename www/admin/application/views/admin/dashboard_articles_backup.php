<?php require_once('includes/head.php') ?>

<body>

    <div id="wrapper">

        <?php require_once('includes/nav.php') ?>


        <div id="page-wrapper">
            <?php if ($mode == 'add'): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Enter below article details</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Article details
                                <a style="margin-top: -6px;float: right;" href="<?php echo site_url() ?>admin/Dashboard_articles/index/<?php echo $this->ion_auth->user()->row()->id; ?>"> <button type="button" class="btn btn-info">Back</button></a>
                            </div>
                            <?php //echo form_open_multipart(site_url() . '/admin/Dashboard_articles/add_edit_article', 'id="cat_form" class=".validate"'); ?>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-9 validate" >
                                        <form role="form" id="add_edit_form" >
                                            <div class="form-group">
                                                <label>Article title</label>
                                                <input class="form-control required" name="title">
    <!--                                                <p class="help-block">Article title here.</p>-->
                                            </div>
                                            <div class="form-group">
                                                <label>Selects Main Category</label>
                                                <?php
                                                $main_category [''] = 'Choose category';
                                                $options = 'data-placeholder="Choose a category..." class="form-control category_id select-full required" tabindex="2"';
                                                echo form_dropdown('sp_id', $main_category, @$main_category->id, $options);
                                                ?>

                                            </div>
                                            <div class="form-group">
                                                <label>Select Sub Category</label>
                                                <select id="subcategory_id" name="cat_id" data-placeholder="Choose a Subcategory..." class="form-control select-full required" tabindex="2">
                                                    <option value="">Choose a sub category</option>
                                                </select>

                                            </div>
                                            <div class="form-group">
                                                <label>Type Of file To Upload:</label>

                                                <select id="type" name="type" class="form-control type_file required">
                                                    <option value="">Please select upload file type</option>
                                                    <option value="3">Image</option>
                                                    <option value="4">Video</option>
                                                </select>
                                            </div>
                                            <div class="image_rows">
                                                <div class="form-group">
                                                    <label>Image to upload:</label>
                                                    <span class="help-block">Accepted formats: jpg, png, gif.(450X250)  </span>
                                                    <input id="imageupload" type="file" class="imageupload f2 styled form-control required" id="files4" name="image_files" ><br>

                                                    <input id="imageupload1" type="file" class="imageupload f2 styled form-control " id="files4" name="image_files1" ><br>

                                                    <input id="imageupload2" type="file" class="imageupload f2 styled form-control " id="files4" name="image_files2" >
                                                    <div class="row">
                                                        <div id="preview-image"></div>
                                                        <div id="preview-image1"></div>
                                                        <div id="preview-image2"></div>
                                                    </div>

                                                    <span class="help-block old_image4"></span>
    <!--                                                    <input type="hidden" name="adv_id" id="id" value="">-->
                                                </div>
                                            </div>
                                            <div class="video_row">
                                                <div class="form-group">

                                                    <label>video:</label>
                                                    <input type="file" class="fl styled form-control required" id="fl" name="file_name">
                                                    <span class="help-block">Accepted formats: mov,mpeg,avi,mp4.  </span>
                                                    <span class="help-block old_image4"></span>
                                                    <input type="hidden" name="adv_id" id="id" value="">

                                                    <video width="100" hieght="100" controls width="500px" id="vid" ></video>  
                                                </div>
                                            </div>
                                            </br>
                                            </br>

                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea  class="ckeditor form-control "  id="decription" name="description"  ></textarea>

                                                                                                                                                                                                                                                                            <!--                                                <textarea class="ckeditor form-control" rows="3"></textarea>-->
                                            </div>
                                            <div class="form-group">
                                                <label>Short description</label>

                                                <textarea class="form-control required" rows="3" name="short_description" maxlength="200"></textarea>
                                            </div>
                                            <!--                                            <div class="form-group">
                                            <?php $abuilder = array('id' => '', 'name' => ''); ?>
                                                                                            <script>var builder_0 = <?php echo json_encode($abuilder) ?></script>
                                                                                            <label>Micro learning section:</label>
                                                                                            <a class="model_form" data1="builder_0"><button type="button" class="btn btn-primary">Add quiz</button></a>
                                                                                        </div>-->
                                            <br>
                                            <br>
                                            <button type="button" id="b1" class="add_edit_button btn smile-primary btn">Submit</button>
                                            <button style="float:right" type="reset" class="btn btn btn-warning">Cancel</button>

                                    </div>
                                    </form>
                                    <?php //echo form_close(); ?>
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
        <?php endif;
        ?>
        <?php if ($mode == 'quiz_add'): ?>
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Enter below quiz details</h1>
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
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Quiz details
    <!--                            <a style="margin-top: -6px;float: right;" href="<?php echo site_url() ?>admin/Dashboard_articles/index/<?php echo $this->ion_auth->user()->row()->id; ?>"> <button type="button" class="btn btn-info">Back</button></a>-->
                        </div>
                        <?php //echo form_open_multipart(site_url() . '/admin/Dashboard_articles/add_edit_article', 'id="cat_form" class=".validate"'); ?>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-9 validate" >
                                    <form role="form" id="quiz_add_edit_form" class="validate" method="post" action="<?php echo site_url() ?>admin/Dashboard_quiz/add_edit">
                                        <div class=" form-group">
                                            <label>Question:</label>
                                            <textarea class="form-control required" rows="3" name="question"  id="question" maxlength="200"></textarea>

                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>option 1:</label>
                                                    <input type="text" id="option1" name="option1" class="form-control required" value="">
                                                </div>

                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>option 2:</label>
                                                    <input type="text" id="option2" name="option2" class="form-control required" value="">
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>option 3:</label>
                                                    <input type="text" id="option3" name="option3" class="form-control required" value="">
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>option 4:</label>
                                                    <input type="text" id="option4" name="option4" class="form-control required" value="">
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Answer:</label>
                                                    <select class="form-control" id="answer_key" name="answer_key">
                                                        <option value="option1">
                                                            option 1
                                                        </option>
                                                        <option value="option2">
                                                            option 2
                                                        </option>
                                                        <option value="option3">
                                                            option 3
                                                        </option>
                                                        <option value="option4">
                                                            option 4
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> 


                                        <br>
                                        <br>
                                        <input type="hidden" name="article_id" value="<?php echo $this->uri->segment('4') ?>"/>
                                        <input type="hidden" name="quiz_id" value="" ">
                                        <button type="button"  class="quiz_add_button btn smile-primary btn">Submit</button>
                                        <button style="float:right" type="reset" class="btn btn btn-warning">Cancel</button>

                                </div>
                                </form>
                                <?php //echo form_close(); ?>
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
    <?php endif;
    ?>
    <?php if ($mode == 'quiz_edit'): ?>
        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Enter below quiz details</h1>
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
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Quiz details
                        <a style="margin-top: -6px;float: right;" href="<?php echo site_url() ?>admin/Dashboard_articles/index/<?php echo $this->ion_auth->user()->row()->id; ?>"> <button type="button" class="btn btn-info">Back</button></a>
                    </div>
                    <?php //echo form_open_multipart(site_url() . '/admin/Dashboard_articles/add_edit_article', 'id="cat_form" class=".validate"'); ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-9 validate" >
                                <form role="form" id="add_edit_form" method="post" action="<?php echo site_url() ?>admin/Dashboard_quiz/add_edit">
                                    <div class=" form-group">
                                        <label>Question:</label>
                                        <textarea class="form-control required" rows="3" name="question"  id="question" maxlength="200"><?php ucfirst($quiz_row->question); ?></textarea>

                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>option 1:</label>
                                                <input type="text" id="option1" name="option1" class="form-control required" value="<?php ucfirst($quiz_row->option1); ?>">
                                            </div>

                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>option 2:</label>
                                                <input type="text" id="option2" name="option2" class="form-control required" value="<?php ucfirst($quiz_row->option2); ?>">
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>option 3:</label>
                                                <input type="text" id="option3" name="option3" class="form-control required" value="<?php ucfirst($quiz_row->question3); ?>">
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>option 4:</label>
                                                <input type="text" id="option4" name="option4" class="form-control required" value="<?php ucfirst($quiz_row->question4); ?>">
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Answer:</label>
                                                <select class="form-control" id="answer_key" name="answer_key">
                                                    <option value="option1">
                                                        option 1
                                                    </option>
                                                    <option value="option2">
                                                        option 2
                                                    </option>
                                                    <option value="option3">
                                                        option 3
                                                    </option>
                                                    <option value="option4">
                                                        option 4
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> 


                                    <br>
                                    <br>
                                    <input type="hidden" name="quiz_id" value="<?php ucfirst($quiz_row->id); ?>"/>
                                    <button type="button" id="b1" class="add_edit_button btn smile-primary btn">Submit</button>
                                    <button style="float:right" type="reset" class="btn btn btn-warning">Cancel</button>

                            </div>
                            </form>
                            <?php //echo form_close(); ?>
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
    <?php
endif;
if ($mode == 'edit'):
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Enter below article details</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Article details
                    <a style="margin-top: -6px;float: right;" href="<?php echo site_url() ?>admin/Dashboard_articles/index/<?php echo $this->ion_auth->user()->row()->id; ?>"> <button type="button" class="btn btn-info">Back</button></a>
                </div>
                <?php //echo form_open_multipart(site_url() . '/admin/Dashboard_articles/edit_article', 'id="cat_form" class=".validate"');  ?>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-9 validate" >
                            <form role="form"  method="post" action="<?php echo site_url() ?>/admin/Dashboard_articles/edit_article/<?php echo $this->uri->segment(5); ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Article title</label>
                                    <input class="form-control required" name="title" value="<?php echo $article->title ?>">
                                    <p class="help-block">Article title here.</p>
                                </div>
                                <?php
                                if (!empty($imagefiles_type)):
                                    if ($imagefiles_type->type == '2'):
                                        ?>
                                        <div class="form-group">
                                            <label>Image to upload:</label>
                                            <span class="help-block old_image4"></span>

                                            <input id="imageupload" type="file" class="imageupload f2 styled form-control required" id="files4" name="image_files" >

                                            <?php if (!empty($image_files[0])): ?>
                                                <div class="form-group"><image src="<?php echo base_url() ?>assets/uploads/articles_image/<?php echo $image_files[0]->raw_name . $image_files[0]->file_ext ?>" height="80px" width="100px"/></div>
                                                <input type="hidden" name="image1_id" value="<?php echo $image_files[0]->id; ?>">
                                            <?php endif;
                                            ?>


                                            <input id="imageupload1" type="file" class="imageupload f2 styled form-control required" id="files4" name="image_files1" >
                                            <?php if (!empty($image_files[1])): ?>
                                                <div class="form-group"><image src="<?php echo base_url() ?>assets/uploads/articles_image/<?php echo $image_files[1]->raw_name . $image_files[1]->file_ext ?>" height="80px" width="100px"/></div>
                                                <input type="hidden" name="image2_id" value="<?php echo $image_files[1]->id; ?>">
                                            <?php endif;
                                            ?>
                                            <input id="imageupload2" type="file" class="imageupload f2 styled form-control required" id="files4" name="image_files2" >
                                            <?php if (!empty($image_files[2])): ?>
                                                <div class="form-group"><image src="<?php echo base_url() ?>assets/uploads/articles_image/<?php echo $image_files[2]->raw_name . $image_files[2]->file_ext ?>" height="80px" width="100px"/></div>
                                                <input type="hidden" name="image3_id" value="<?php echo $image_files[2]->id; ?>">
                                            <?php endif;
                                            ?>
                                            <div class="row">
                                                <div id="preview-image"></div>
                                                <div id="preview-image1"></div>
                                                <div id="preview-image2"></div>
                                            </div>
            <!--                                                    <input type="hidden" name="adv_id" id="id" value="">-->
                                        </div> 
                                    <?php else: ?>
                                        <div class="form-group">

                                            <label>video:</label></br>
                                            <?php if (!empty($image_files)): ?>
                                                <video width="100" hieght="100" controls width="500px" src="<?php echo base_url() ?>assets/uploads/articles_videos/<?php echo $image_files[0]->raw_name . $image_files[0]->file_ext ?>" ></video>  
                                                <input type="hidden" name="image1_id" value="<?php echo $image_files[0]->id; ?>">
                                            <?php endif; ?>
                                            <input type="file" class="fl styled form-control required" id="fl" name="file_name">
                                            <span class="help-block">Accepted formats: mov,mpeg,avi,mp4.  </span>

                                            <span class="help-block old_image4"></span>
                                            <input type="hidden" name="adv_id" id="id" value="">

                                            <video width="100" hieght="100" controls width="500px" id="vid" ></video>  
                                        </div>
                                    <?php endif;
                                    ?>


                                    </br>


                                    <input type="hidden" name="type" value="<?php echo $imagefiles_type->type ?>"/>
                                <?php endif;
                                ?>
                                <?php
//                                        if (!empty($image_files)):
//                                            $i = 1;
//                                            foreach ($image_files as $image_row) {
//
//                                                if ($image_row->type == '2'):
                                ?>
                                <!--                                                    <div class="form-group">
                                                                                        <label>Image to upload:</label>
                                                                                        <input id="imageupload" type="file" class="imageupload f2 styled form-control required" id="files4" name="image_files" >
                                                                                        <input id="imageupload1" type="file" class="imageupload f2 styled form-control required" id="files4" name="image_files1" >
                                
                                                                                        <input id="imageupload2" type="file" class="imageupload f2 styled form-control required" id="files4" name="image_files2" >
                                
                                                                                        <div ><image src="<?php echo base_url() ?>assets/upload/articles_image/<?php echo $image_row->raw_name . $image_row->file_ext ?>" height="50px" width="50px"/></div>
                                                                                        <div id="preview-image"></div>
                                                                                        <div id="preview-image1"></div>
                                                                                        <div id="preview-image2"></div>
                                
                                                                                        <span class="help-block">Accepted formats: jpg, png, gif.  </span>
                                                                                        <span class="help-block old_image4"></span>
                                                                                                    <input type="hidden" name="adv_id" id="id" value="">
                                                                                    </div>-->
                                <?php //else:
                                ?>
                                <!--                                                    <div class="form-group">
                                                                                        <label>Video to upload:</label>
                                                                                        <input id="imageupload1" type="file" class="imageupload f2 styled form-control required" id="files4" name="image_files1" >
                                                                                    </div>-->
                                <?php
                                //endif;
                                //$i++;
                                //}
                                ?>


                                <?php // endif;
                                ?>



                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea  class="ckeditor form-control "  id="decription" name="description"  ><?php echo $article->description; ?></textarea>

                                                                                                                                                                                                                                                                        <!--                                                <textarea class="ckeditor form-control" rows="3"></textarea>-->
                                </div>
                                <div class="form-group">
                                    <label>Short description</label>

                                    <textarea class="form-control required" rows="3" name="short_description" maxlength="200"><?php echo $article->short_description; ?></textarea>
                                </div>
                                <br>
                                <br>
                                <?php if (!empty($quiz_row)): ?>

                                    <h4><strong><u>Micro Learning section:</u> </strong></h4><br>
                                    <div class=" form-group">


                                        <label>Question:</label>
                                        <textarea class="form-control required" rows="3" name="question"  id="question" maxlength="200"><?php echo ucfirst($quiz_row->question); ?></textarea>

                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>option 1:</label>
                                                <input type="text" id="option1" name="option1" class="form-control required" value="<?php echo ucfirst($quiz_row->option1); ?>">
                                            </div>

                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>option 2:</label>
                                                <input type="text" id="option2" name="option2" class="form-control required" value="<?php echo ucfirst($quiz_row->option2); ?>">
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>option 3:</label>
                                                <input type="text" id="option3" name="option3" class="form-control required" value="<?php echo ucfirst($quiz_row->option3); ?>">
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>option 4:</label>
                                                <input type="text" id="option4" name="option4" class="form-control required" value="<?php echo ucfirst($quiz_row->option4); ?>">
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Answer:</label>
                                                <select class="form-control" id="answer_key" name="answer_key">
                                                    <option <?php echo ($quiz_row->answer_key == 'option1') ? ' selected="selected"' : ''; ?> value="option1">
                                                        option 1
                                                    </option>
                                                    <option <?php echo ($quiz_row->answer_key == 'option2') ? ' selected="selected"' : ''; ?> value="option2">
                                                        option 2
                                                    </option>
                                                    <option <?php echo ($quiz_row->answer_key == 'option3') ? ' selected="selected"' : ''; ?> value="option3">
                                                        option 3
                                                    </option>
                                                    <option <?php echo ($quiz_row->answer_key == 'option4') ? ' selected="selected"' : ''; ?> value="option4">
                                                        option 4
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> 
                                    <input type="hidden" name="quiz_id" value="<?php echo $quiz_row->id ?>"/>
                                <?php endif; ?>

                                <br>
                                <br>
                                <input type="hidden" name="id" value="<?php echo $article->id ?>"/>
                                <button type="submit" class=" btn smile-primary btn">Submit</button>
                                <button style="float:right" type="reset" class="btn btn btn-warning">Cancel</button>

                        </div>
                        </form>
                        <?php echo form_close(); ?>
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
    <?php
endif;
?>
<?php if ($mode == 'view'): ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">View article details</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row" style="margin-left: 0px;margin-right: 0px;">
        <div class="panel-heading" style="margin:0px 15px 0px 15px;">
            Article Details
            <a style="margin-top: -6px;float: right;" href="<?php echo site_url() ?>admin/Dashboard_articles/index/<?php echo $this->ion_auth->user()->row()->id; ?>"> <button type="button" class="btn btn-info">Back</button></a>

        </div>
        <!--                                    <div class="col-sm-6">
                                                ...tab1, col1 information...
                                            </div>
                                            <div class="col-sm-6">
                                                ...tab1, col2 information...
                                            </div>-->
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="dataTable_wrapper">

                <table width="80%" cellspacing="2" cellpadding="10" class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                    <?php
                    //print_r($view_article);
                    //exit();
                    if (isset($view_article) && count($view_article)):

                        foreach ($view_article as $row) {
                            ?>
                            <tr>
                                <td style="width:20%;font-weight: bold;">Title</td>
                                <td><?php echo $row->title ?></td>
                            </tr>
                            <tr>
                                <td style="width:30%;font-weight: bold;">Category name</td>
                                <td><?php echo $row->category_name ?></td>
                            </tr>
                            <tr>
                                <td style="width:30%;font-weight: bold;">Username</td>
                                <td><?php echo $row->username ?></td>
                            </tr>
                            <tr>
                                <td style="width:30%;font-weight: bold;">Image</td>
                                <td>
                                    <?php if (!empty($image_files)): ?>
                                        <div class="row">



                                <!--                                        <table>
                                                                            <tr>-->
                                            <?php foreach ($image_files as $image_files_row) { ?>
                                                <div class="col-sm-4">
                                                    <image class="img-rounded" src="<?php echo base_url() ?>assets/uploads/articles_image/<?php echo $image_files_row->raw_name . $image_files_row->file_ext ?>" height="100px;" width="200px;";>
                                                </div>
                    <!--                                                    <td><image class="img-rounded" src="<?php echo base_url() ?>assets/uploads/articles_image/<?php echo $image_files_row->raw_name . $image_files_row->file_ext ?>" height="100px;" width="100px;";></td>-->

                                            <?php } ?>
                                        </div>
                                        <!--                                            </tr>
                                        
                                                                                </table>-->
                                    <?php endif;
                                    ?>
                                </td>
                                <td><image src="" width:80px height:80px></td>
                            </tr>
                            <tr>
                                <td style="width:30%;font-weight: bold;">Short description</td>
                                <td><?php echo $row->short_description ?></td>
                            </tr>
                            <tr>
                                <td style="width:30%;font-weight: bold;">Description</td>
                                <td><div style="width:800px; max-height:200px; overflow-Y:auto"><?php echo $row->description ?></div></td>
                            </tr>


                            <?php
                        }
                    endif;
                    ?>

                </table>
            </div>
            <!-- /.table-responsive -->

        </div>
        <!-- /.panel-body -->
    </div>
<?php endif; ?>
<?php if ($mode == 'all'): ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Articles details </h1>
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
            <?php $tab = (isset($_GET['tab'])) ? $_GET['tab'] : null; ?> 
            <?php if (!empty($_GET['tab'])): ?>

                <ul class="nav nav-tabs">

                    <li class="<?php echo ($tab == 'tab1') ? 'active' : ''; ?>"><a data-toggle="tab" href="#tab1"> Pending Articles</a>
                    </li>
                    <li class="<?php echo ($tab == 'tab2') ? 'active' : ''; ?>"><a data-toggle="tab" href="#tab2" >Approved Articles</a>
                    </li>
                    <li class="<?php echo ($tab == 'tab3') ? 'active' : ''; ?>"><a data-toggle="tab" href="#tab3" >Create Articles</a>
                    </li>
                </ul>
            <?php else: ?>
                <ul class="nav nav-tabs">

                    <li class="active"><a data-toggle="tab" href="#tab1"> Pending Articles</a>
                    </li>
                    <li class=""><a data-toggle="tab" href="#tab2" >Approved Articles</a>
                    </li>
                    <li class=""><a data-toggle="tab" href="#tab3" >Create Articles</a>
                    </li>
                </ul>
            <?php endif; ?>
            <div class="panel panel-default">
                <!--                        <div class="panel-heading">
                                            Articles Details
                                        </div>-->
                <div id="tab-content" class="tab-content">
                    <div id="tab1" class="tab-pane fade in active">
                        <div class="row" style="margin-left: 0px;margin-right: 0px;">
                            <div class="panel-heading">
                                Articles Details
                            </div>
                            <!--                                    <div class="col-sm-6">
                                                                    ...tab1, col1 information...
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ...tab1, col2 information...
                                                                </div>-->
                            <!-- /.panel-heading -->
                            <div class="panel-body">

                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Article Title1</th>
                                                <th>Category name</th>
                                                <th>User Name</th>
                                                <th>short description</th>
                                                <th>Status</th>
                                                <th>Created on</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            //print_r($notapprove_articles);exit();
                                            if (isset($notapprove_articles) && count($notapprove_articles)):

                                                foreach ($notapprove_articles as $row) {
                                                    ?>

                                                    <tr class="odd gradeX">
                                                        <td><?php echo ucfirst($row->title) ?></td>
                                                        <td><?php echo $row->category_name ?></td>
                                                        <td><?php echo ucfirst($row->username) ?></td>
                                                        <td><?php echo ucfirst($row->short_description) ?></td>

                                                        <td>
                                                            <select class="form-control status_check_active" data="<?php echo $row->id; ?>">
                                                                <option value="1" <?php echo ($row->active == '1') ? "selected=selected" : ""; ?>>Active</option>
                                                                <option value="0" <?php echo ($row->active == '0') ? "selected=selected" : ""; ?>>Inactive</option>
                                                            </select></td>
                                                        <td><?php echo ucfirst($row->created_on) ?></td>
                                                        <td>
                                                            <script>var builder_<?php echo $row->id; ?> = <?php echo json_encode($row); ?></script>
            <!--                                                                                                                                            <a  href="#"><i  imagedata="image_dataclass<?php echo $row->id; ?>" data1="<?php echo 'builder_' . $row->id; ?>"class="model_form fa fa-pencil" title="Edit"></i></a>-->

                                                            <a  href="<?php echo site_url(); ?>admin/Dashboard_articles/add_edit_article/<?php echo $row->id; ?>/tab1" title="View" class="tip"><i  class="fa fa-pencil" title="Edit"></i></a>
                                                            <a  href="<?php echo site_url(); ?>admin/Dashboard_articles/view_article/<?php echo $row->id; ?>" title="View" class="tip"><i  class="fa fa-eye" title="View"></i></a>


                                                            <a  href="#"><i   data="<?php echo $row->id ?>" class="status_check fa fa-remove" title="Delete"></i></a></td>
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
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <div class="row" style="margin-left: 0px;margin-right: 0px;">
                            <div class="panel-heading" >
                                Articles Details
                            </div>
                            <!--                                    <div class="col-sm-6">
                                                                    ...tab2, col1 information...
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ...tab2, col2 information...
                                                                </div>-->
                            <!-- /.panel-heading -->
                            <div class="panel-body">

                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                                        <thead>
                                            <tr>

                                                <th>Article Title</th>
                                                <th>Category name</th>
                                                <th>User Name</th>
                                                <th>short description</th>

                                                <th>Created on</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            //print_r($notapprove_articles);exit();
                                            if (isset($approved_articles) && count($approved_articles)):

                                                foreach ($approved_articles as $row) {
                                                    ?>

                                                    <tr class="odd gradeX">
                                                        <td><?php echo ucfirst($row->title) ?></td>
                                                        <td><?php echo $row->category_name ?></td>
                                                        <td><?php echo ucfirst($row->username) ?></td>
                                                        <td><?php echo ucfirst($row->short_description) ?></td>


                                                        <td><?php echo ucfirst($row->created_on) ?></td>
                                                        <td>
                                                            <script>var builder_<?php echo $row->id; ?> = <?php echo json_encode($row); ?></script>
            <!--                                                                                <a  href="#"><i  imagedata="image_dataclass<?php echo $row->id; ?>" data1="<?php echo 'builder_' . $row->id; ?>"class="model_form fa fa-pencil" title="Edit"></i></a>-->

                                                            <a  href="<?php echo site_url(); ?>admin/Dashboard_articles/add_edit_article/<?php echo $row->id; ?>/tab2" title="View" class="tip"><i  class="fa fa-pencil" title="Edit"></i></a>

                                                            <a  href="<?php echo site_url(); ?>admin/Dashboard_articles/view_article/<?php echo $row->id; ?>" title="View" class="tip"><i  class="fa fa-eye" title="View"></i></a>

                                                            <a  href="#"><i   data="<?php echo $row->id ?>" class="status_check fa fa-remove" title="Delete"></i></a></td>
                                                                                                                                                                                                                    <!--                                                                                <a  href="#"><i   data="<?php echo $row->id ?>" class="status_check fa fa-remove" title="Delete"></i></a></td>-->
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
                    </div>
                    <div id="tab3" class="tab-pane fade">
                        <div class="row" style="margin-left: 0px;margin-right: 0px;">
                            <div class="panel-heading">
                                Articles Details
                                <a href="<?php echo site_url() ?>admin/Dashboard_articles/add_edit_article"><button type="button" style="margin-left: 80%;" class="btn smile-primary">Add article</button></a>
                            </div>
                            <!--                                    <div class="col-sm-6">
                                                                    ...tab2, col1 information...
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ...tab2, col2 information...
                                                                </div>-->
                            <!-- /.panel-heading -->
                            <div class="panel-body">

                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                                        <thead>
                                            <tr>

                                                <th>Article Title</th>
                                                <th>Category name</th>
                                                <th>User Name</th>
                                                <th>short description</th>

                                                <th>Created on</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //print_r($notapprove_articles);exit();
                                            if (isset($articles) && count($articles)):

                                                foreach ($articles as $row) {
                                                    ?>

                                                    <tr class="odd gradeX">
                                                        <td><?php echo ucfirst($row->title) ?></td>
                                                        <td><?php echo $row->category_name ?></td>
                                                        <td><?php echo ucfirst($row->username) ?></td>
                                                        <td><?php echo ucfirst($row->short_description) ?></td>


                                                        <td><?php echo ucfirst($row->created_on) ?></td>
                                                        <td>
                                                            <script>var builder_<?php echo $row->id; ?> = <?php echo json_encode($row); ?></script>
            <!--                                                                                <a  href="#"><i  imagedata="image_dataclass<?php echo $row->id; ?>" data1="<?php echo 'builder_' . $row->id; ?>"class="model_form fa fa-pencil" title="Edit"></i></a>-->

                                                            <a  href="<?php echo site_url(); ?>admin/Dashboard_articles/add_edit_article/<?php echo $row->id; ?>/tab3" title="View" class="tip"><i  class="fa fa-pencil" title="Edit"></i></a>

                                                            <a  href="<?php echo site_url(); ?>admin/Dashboard_articles/view_article/<?php echo $row->id; ?>" title="View" class="tip"><i  class="fa fa-eye" title="View"></i></a>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!--                                                                                <a  href="#"><i   data="<?php echo $row->id ?>" class="status_check fa fa-remove" title="Delete"></i></a></td>-->
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
                    </div>
                </div>


            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

<?php endif;
?>




</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<!-- Form modal -->
<div id="form_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header smile-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Add/Edit</span> Quiz section </h4>
            </div>
            <!-- Form inside modal -->
            <?php // echo form_open_multipart(site_url() . '/admin/dashbord_category/add_edit', 'id="quiz_form" class=".validate"');  ?>
            <form id="quiz_form" class=".validate">
                <div class="modal-body with-padding ">
                    <div class=" form-group">
                        <label>Question:</label>
                        <textarea class="form-control required" rows="3" name="question"  id="question" maxlength="200"></textarea>

                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>option 1:</label>
                                <input type="text" id="option1" name="option1" class="form-control required" value="">
                            </div>

                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>option 2:</label>
                                <input type="text" id="option2" name="option2" class="form-control required" value="">
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>option 3:</label>
                                <input type="text" id="option3" name="option3" class="form-control required" value="">
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>option 4:</label>
                                <input type="text" id="option4" name="option4" class="form-control required" value="">
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Answer:</label>
                                <select class="form-control" id="answer_key" name="answer_key">
                                    <option value="option1">
                                        option 1
                                    </option>
                                    <option value="option2">
                                        option 2
                                    </option>
                                    <option value="option3">
                                        option 3
                                    </option>
                                    <option value="option4">
                                        option 4
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div> 



                </div>            
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <span id="add">
                        <input type="hidden" name="art_id" value="" id="quiz_id">
                        <input type="hidden" name="category_type" value="<?php echo $this->uri->segment(3) ?>" >
                        <button type="button" class="btn btn-primary" id="add_quiz">Create quiz</button>
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
<!-- Form modal view -->
<div id="form_modal_view" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="panel panel-default modal-content">
            <div class=" modal-header btn-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>View</span> posting details </h4>
            </div>
            <!-- Form inside modal -->
            <?php echo form_open_multipart(site_url() . '/admin/dashbord_category/add_edit', 'id="cat_form" class=".validate"'); ?>
            <div class="modal-body with-padding">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12  ">

                            <p > <label >Profile Image:</label>
                                <span class="append_img1"><img  style="display: inline-block;width: 150px;height: 150px;" class="thumbnail " src="<?php echo base_url(); ?>assets/upoads/profile_image/noimage.jpg">  </span>
                            <hr>
                        </div>
                    </div>

                </div> 
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12  ">
                            <p > <label >Username:</label>
                                <span id="view_username"> </span>
                            </p>

                            <hr>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12  ">
                            <p > <label >Phone:</label>
                                <span id="view_phone"> </span>
                            </p>

                            <hr>
                        </div>
                    </div>
                </div>
                <div class="form-group">
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
                </div>
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
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12  ">
                            <p > <label >Employee id:</label>
                                <span id="view_empid"> </span>
                            </p>
                            <hr>
                        </div>
                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning " data-dismiss="modal">Close</button>
                <span id="add">


                </span>
                <!-- /form modal view -->

                <!-- jQuery -->
                <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
                <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>

                <!-- Bootstrap Core JavaScript -->
                <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

                <!-- Metis Menu Plugin JavaScript -->

                <script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

                <script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>


                <!-- DataTables JavaScript -->
                <script src="<?php echo base_url(); ?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>

                <!-- Custom Theme JavaScript -->
                <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>

                <!-- Page-Level Demo Scripts - Tables - Use for reference -->
                <script>
                                                    $(document).ready(function () {
                                                        $('#art_menu').addClass('active');
                                                        //$("form").valid()
                                                        $('.dataTables-example').DataTable({
                                                            responsive: true
                                                        });
                                                        $(".fl").change(function (e) {
                                                            var countFiles = $(this)[0].files.length;
                                                            var imgPath = $(this)[0].value;
                                                            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                                                            if (extn == "mov" || extn == "mpeg" || extn == "mp3" || extn == "avi" || extn == "mp4") {
                                                                var file = e.currentTarget.files[0];
                                                                objectUrl = URL.createObjectURL(file);
                                                                $("#vid").prop("src", objectUrl);
                                                            }
                                                            else
                                                            {
                                                                alert("Select Only video");
                                                            }

                                                        });
                                                        $("#imageupload").on('change', function () {

                                                            var countFiles = $(this)[0].files.length;
                                                            var imgPath = $(this)[0].value;

                                                            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                                                            var image_holder = $("#preview-image");
                                                            image_holder.empty();
                                                            if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                                                                if (typeof (FileReader) != "undefined") {
                                                                    if (countFiles > 3)
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
                                                        $("#imageupload1").on('change', function () {

                                                            var countFiles = $(this)[0].files.length;
                                                            var imgPath = $(this)[0].value;

                                                            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                                                            var image_holder = $("#preview-image1");
                                                            image_holder.empty();
                                                            if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                                                                if (typeof (FileReader) != "undefined") {
                                                                    if (countFiles > 3)
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
                                                                    $("#imageupload1").val("");
                                                                }
                                                            } else {
                                                                alert("Select Only images");
                                                                $("#imageupload1").val("");
                                                            }
                                                        });
                                                        $("#imageupload2").on('change', function () {

                                                            var countFiles = $(this)[0].files.length;
                                                            var imgPath = $(this)[0].value;

                                                            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                                                            var image_holder = $("#preview-image2");
                                                            image_holder.empty();
                                                            if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                                                                if (typeof (FileReader) != "undefined") {
                                                                    if (countFiles > 3)
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
                                                                    $("#imageupload2").val("");
                                                                }
                                                            } else {
                                                                alert("Select Only images");
                                                                $("#imageupload2").val("");
                                                            }
                                                        });
//                                                                                                            $("#b2").click(function (e) {
//                                                                                                                $("#add_edit_form").valid();
//                                                                                                                alert("hi");
//                                                                                                                var countFiles = $(this)[0].files.length;
//                                                                                                                var imgPath = $(this)[0].value;
//                                                                                                                var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
//                                                                                                                if (extn == "mov" || extn == "mpeg" || extn == "mp3" || extn == "avi" || extn == "mp4") {
//                                                                                                                    var seconds = $("#vid")[0].duration;
//                                                                                                                    //alert(seconds);
//                                                                                                                    if (seconds <= 180)
//                                                                                                                    {
//                                                                                                                        event.preventDefault();
//                                                                                                                        //var file_data = $("#imageupload").prop("files")[0];   // Getting the properties of file from file field
//
//                                                                                                                        for (instance in CKEDITOR.instances) {
//                                                                                                                            CKEDITOR.instances[instance].updateElement();
//                                                                                                                        }
//                                                                                                                        var data = new FormData($('#add_edit_form')[0]);
//
//                                                                                                                        url = "<?php echo site_url() ?>admin/Dashboard_articles/add_article";
//
//                                                                                                                        $.ajax({
//                                                                                                                            type: 'json',
//                                                                                                                            url: url,
//                                                                                                                            data: data,
//                                                                                                                            mimeType: "multipart/form-data",
//                                                                                                                            contentType: false,
//                                                                                                                            cache: false,
//                                                                                                                            processData: false,
//                                                                                                                            success: function (resp) {
//                                                                                                                                //window.location.href = "<?php echo site_url() ?>admin/Dashboard_articles/index/2";
//                                                                                                                                //$('#container').html(resp);
//                                                                                                                                console.log(resp)
//                                                                                                                                //alert(resp);
//                                                                                                                                // window.location.href = "<?php echo site_url() ?>admin/Dashboard_articles/index/<?php echo $this->ion_auth->user()->row()->id; ?>";
//                                                                                                                            },
//                                                                                                                            error: function (resp) {
//                                                                                                                                //alert(JSON.stringify(resp));
//                                                                                                                                console.log('Ajax request not recieved!');
//                                                                                                                            }
//                                                                                                                        });
//                                                                                                                        
//                                                                                                                    }
//                                                                                                                    else
//                                                                                                                    {
//                                                                                                                        alert('Video duration should not be more than 3 min');
//                                                                                                                    }
//                                                                                                                }
//                                                                                                                else
//                                                                                                                {
//                                                                                                                    alert("Select Only video");
//                                                                                                                }
//
//
//                                                                                                            });
                                                        //                                                                                        $('#decription').closest('form').submit(CKupdate);
                                                        //
                                                        //                                                                                        function CKupdate() {
                                                        //                                                                                            for (instance in CKEDITOR.instances)
                                                        //                                                                                                CKEDITOR.instances[instance].updateElement();
                                                        //                                                                                            return true;
                                                        //                                                                                        }
                                                        $('#b1').click(function () {
                                                            $("#add_edit_form").valid();
                                                            event.preventDefault();
                                                            //var file_data = $("#imageupload").prop("files")[0];   // Getting the properties of file from file field

                                                            for (instance in CKEDITOR.instances) {
                                                                CKEDITOR.instances[instance].updateElement();
                                                            }
                                                            var data = new FormData($('#add_edit_form')[0]);

                                                            url = "<?php echo site_url() ?>admin/Dashboard_articles/add_article";

                                                            $.ajax({
                                                                type: 'post',
                                                                url: url,
                                                                data: data,
                                                                mimeType: "multipart/form-data",
                                                                contentType: false,
                                                                cache: false,
                                                                processData: false,
                                                                success: function (resp) {

                                                                    if (resp == '0')
                                                                    {
                                                                        alert('Sorry your article not uploaded , try again.');
                                                                        window.location.href = "<?php echo site_url() ?>admin/Dashboard_articles/add_edit_article"

                                                                    } else if (resp == '00')
                                                                    {
                                                                        alert('Please enter manditory fields.');
                                                                        //window.location.href = "<?php echo site_url() ?>admin/Dashboard_articles/add_edit_article"
                                                                    }
                                                                    else
                                                                    {
                                                                        //alert(resp);
                                                                        alert('Article created successfully.')
                                                                        window.location.href = "<?php echo site_url() ?>admin/Dashboard_quiz/index/" + resp;
                                                                        s
                                                                    }

                                                                    //window.location.href = "<?php echo site_url() ?>admin/Dashboard_articles/index/2";
                                                                    //$('#container').html(resp);
//                                                                    if (resp)
//                                                                    {
//                                                                        $('#b1').attr('art_data', resp)
//                                                                        $('#b1').attr('art_data', resp)
//                                                                        alert(resp);
//
//                                                                        $('#form_modal').modal({
//                                                                            keyboard: false,
//                                                                            show: true,
//                                                                            backdrop: 'static'
//                                                                        });
//                                                                    }

                                                                    // console.log(resp)
                                                                    //alert(resp);
                                                                },
                                                                error: function (resp) {
                                                                    //alert(JSON.stringify(resp));
                                                                    console.log('Ajax request not recieved!');
                                                                }
                                                            });



                                                        });
                                                        $('#b2').click(function () {

                                                            $("#add_edit_form").valid();
                                                            event.preventDefault();
                                                            //var file_data = $("#imageupload").prop("files")[0];   // Getting the properties of file from file field

                                                            for (instance in CKEDITOR.instances) {
                                                                CKEDITOR.instances[instance].updateElement();
                                                            }
                                                            var data = new FormData($('#add_edit_form')[0]);

                                                            url = "<?php echo site_url() ?>admin/Dashboard_articles/add_article";

                                                            $.ajax({
                                                                type: 'post',
                                                                url: url,
                                                                data: data,
                                                                mimeType: "multipart/form-data",
                                                                contentType: false,
                                                                cache: false,
                                                                processData: false,
                                                                success: function (resp) {
                                                                    //window.location.href = "<?php echo site_url() ?>admin/Dashboard_articles/index/2";
                                                                    //$('#container').html(resp);
                                                                    //console.log(resp)
                                                                    if (resp)
                                                                    {
                                                                        alert(resp);
                                                                        window.location.href = "<?php echo site_url() ?>admin/Dashboard_quiz/index/" + resp;

                                                                    } else
                                                                    {
                                                                        alert('Sorry your article not uploaded , try again.');
                                                                        window.location.href = "<?php echo site_url() ?>admin/Dashboard_articles/add_edit_article"
                                                                    }
                                                                    //alert(resp);
                                                                    // window.location.href = "<?php echo site_url() ?>admin/Dashboard_articles/index/<?php echo $this->ion_auth->user()->row()->id; ?>";
                                                                },
                                                                error: function (resp) {
                                                                    //alert(JSON.stringify(resp));
                                                                    console.log('Ajax request not recieved!');
                                                                }
                                                            });



                                                        });
                                                        $('.image_rows').hide();
                                                        $('.video_row').hide();
                                                        $(document).on('change', '.type_file', function () {
                                                            var type = $('.type_file').val();
                                                            //alert(type);
                                                            if (type == '3')
                                                            {
                                                                $('.video_row').hide();
                                                                $('.image_rows').show();

                                                            }

                                                            else
                                                            {
                                                                $('.image_rows').hide();
                                                                $('.video_row').show();
                                                                $('.add_edit_button').attr('id', 'b2');

                                                            }


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
                                                                //$('.select_maincategory').show();
                                                            }
                                                            else
                                                            {
                                                                //$('.select_maincategory').hide();
                                                            }
                                                            $('#option1').val(data.option1);
                                                            $('#option2').val(data.option2);
                                                            $('#option3').val(data.option3);
                                                            $('#option4').val(data.option4);
                                                            $('#answer_key').val(data.answer_key);

                                                            $('#quiz_id').val(data.quiz_id);

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
                                                                //$('.select_maincategory').show();
                                                            }
                                                            else
                                                            {
                                                                //$('.select_maincategory').hide();
                                                            }
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
                                                            $('#view_username').html(data.username);
                                                            //$('#view_email').html(data.email);
                                                            $('#view_company').html(data.company);
                                                            $('#view_department').html(data.department);
                                                            //$('#view_empid').html(data.empid);
                                                            $('#view_phone').html(data.phone);
                                                            $('#id').val(data.id);
                                                            var email = data.email
                                                            var empid = data.empid

                                                            var not_available = "<button type='button' class='btn btn-info'>N/A</button>";
                                                            var raw_name1 = data.raw_name;
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
                                                                var file_ext = data.file_ext;
                                                                if (raw_name !== null)
                                                                {
                                                                    var image = uploadpath + "/" + raw_name + file_ext;
                                                                }
                                                                else
                                                                {
                                                                    var image = uploadpath + "/" + "noimage.png";
                                                                }

                                                                //var image = uploadpath + "/" + "noimage.png";
                                                                htmlimage = "<img  style='display: inline-block;width: 150px;height: 150px;' class='thumbnail' src=" + "'<?php echo base_url(); ?>" + image + "'" + ">";
                                                                $('.append_img1').html(htmlimage);
                                                            }



                                                        });
                                                        $(document).on('click', '.status_check', function () {
                                                            if (confirm("Are you sure to delete data")) {
                                                                var current_element = $(this);
                                                                url = "<?php echo site_url() ?>admin/Dashboard_articles/delete_article";

                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: url,
                                                                    data: {at_id: $(current_element).attr('data')},
                                                                    success: function (data)
                                                                    {
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
                                                                        alert(data);
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
                                                        $(document).on('change', '.category_id', function () {
                                                            var value = $(this).val();
                                                            var url = "<?php echo site_url() ?>admin/Dashboard_articles/subcategory/" + value;
                                                            $.ajax({
                                                                url: url,
                                                                success: function (data)
                                                                {
                                                                    if (data)
                                                                        $('#subcategory_id').html(data);
                                                                }
                                                            });
                                                            $('#subcategory_id').select("val", "");
                                                        });
                                                        $(document).on('click', '.approve_status', function () {
                                                            if (confirm("Are you sure to do this action")) {
                                                                var current_element = $(this).val();
                                                                //alert(current_element);
                                                                if ($(this).hasClass("btn-primary"))
                                                                    var status = 1;
                                                                else
                                                                    var status = 0;
                                                                url = "<?php echo site_url() ?>admin/Dashboard_users/approve_status";
                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: url,
                                                                    data: {user_id: current_element, status: status},
                                                                    success: function (data)
                                                                    {
                                                                        location.reload();
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
                                                        $('.quiz_add_button').click(function () {
                                                            $('#quiz_add_edit_form').validate();
                                                            $('#quiz_add_edit_form').submit();
                                                        });
                                                        $(document).on('change', '.status_check_active', function () {
                                                            if (confirm("Are you sure want to perform this operation ?")) {

                                                                var id = $(this).attr('data');
                                                                var status = $(this).val();
                                                                // alert ($(current_element).attr('data'))
                                                                url = "<?php echo site_url() ?>/admin/Dashboard_articles/active";

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
                                                    });
                </script>

                </body>

                </html>
