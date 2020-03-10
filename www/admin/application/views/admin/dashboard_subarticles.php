<?php require_once('includes/croppage_header.php') ?>
<?php require_once('includes/loader.php') ?>
<link href="<?php echo base_url() ?>assets/bower_components/graph/test/jquery-ui.structure.min.css" rel="stylesheet" />
<body>
    <div class="modal modal_load" style="display: none">
        <div class="center">
            <div class="loader"></div>

        </div>
    </div>

    <div id="wrapper">

        <?php require_once('includes/nav.php') ?>

        <div id="page-wrapper">








            <?php if ($mode == 'all'): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header"><i class="fa fa-newspaper-o fa-fw" id="sidemenuicon"></i> Create Sub Articles<span>(Max can create 3 sub articles for each articles)</span> </h2>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading sectionhead">
                                Articles Details 
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body subarticleview">

                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                                        <thead>
                                            <tr>

                                                <th>Article Title</th>
                                                <th>Sub category name</th>
                                                <th>Username</th>
                                                <th>Short Description</th>
                                                <th>Sub article</th>
                                                <th>Total No. of Sub Article</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            if (isset($approved_articles) && count($approved_articles)):
                                                foreach ($approved_articles as $row) {
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php echo ucfirst($row->title) ?></td>
                                                        <td><?php echo $row->category_name ?></td>
                                                        <td><?php echo ucfirst($row->username) ?></td>
                                                        <td><?php echo ucfirst($row->short_description) ?></td>
                                                        <td>
                                                            <?php
                                                            $count_subarticle = $this->Sub_articles_model->count_all_results(array('article_id' => $row->id));
                                                            if ($count_subarticle >= 3):
                                                                ?>
                                                                <a role="button" class="btn btn-primary disabled" data="<?php echo $row->id; ?>" data_status="0">create Sub Article</a></td>


                                                        <?php else: ?>
                                                    <a role="button" class="btn btn-primary subarticle_form" data="<?php echo $row->id; ?>" data_status="0">create Sub Article</a></td>

                                                <?php endif; ?>

                                                <td><?php echo $count_subarticle; ?></td>
                                                <td>
                                                    <script>var builder_<?php echo $row->id; ?> = <?php echo json_encode($row); ?></script>
            <!--                                                                                <a  href="#"><i  imagedata="image_dataclass<?php echo $row->id; ?>" data1="<?php echo 'builder_' . $row->id; ?>"class="model_form fa fa-pencil" title="Edit"></i></a>-->
                                                    <?php
                                                    $count_subarticle = $this->Sub_articles_model->count_all_results(array('article_id' => $row->id));
                                                    if ($count_subarticle > 0):
                                                        ?>
                                                        <a  href="<?php echo site_url(); ?>admin/Dashboard_subarticles/edit_subarticle/<?php echo $row->id; ?>" title="Edit" class="tip"><i  class="fa fa-pencil" title="Edit"></i></a>
                                                    <?php else: ?>
                                                        <a  href="<?php echo site_url(); ?>admin/Dashboard_subarticles/edit_subarticle/<?php echo $row->id; ?>" title="Edit" class="tip"  style="pointer-events: none;cursor: default;"><i  class="fa fa-pencil disabled" title="Edit"></i></a>

                                                    <?php endif; ?>

                                                    <a  href="<?php echo site_url(); ?>admin/Dashboard_subarticles/view_article/<?php echo $row->id; ?>" title="View" class="tip"><i  class="fa fa-eye" title="View"></i></a>

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
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->



                </div>

            <?php endif; ?>
            <?php
            if ($mode == 'edit'):
                ?>

                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header"><i class="fa fa-pencil-square-o" id="sidemenuicon"></i> Edit Sub Articles :</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading sectionhead">
                                Edit Sub Article details
                                <a style="margin-top: -5px;float: right;" href="<?php echo site_url("admin/Dashboard_subarticles/index/" . $this->ion_auth->user()->row()->id) ?>/#<?php echo $this->uri->segment(5) ?>"> <button type="button" class="btn btn-info closebtn">Back</button></a>
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
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 validate" >
                                        <?php echo form_open_multipart(site_url("admin/Dashboard_subarticles/update_subarticle/" . $this->uri->segment(4)), 'id="subarticle_edit_form" class=".validate"'); ?>
                <!--                                    <form role="form"  id="artcle_edit_form" method="post" action="<?php //echo site_url("admin/Dashboard_articles/edit_article/" . $this->uri->segment(5))                                                         ?>" enctype="multipart/form-data">-->
                                        <div class="form-group">
                                            <label>Article title:</label>
                                            <?php echo ucfirst($article->title); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Sub category name:</label>
                                            <?php echo ucfirst($category->name); ?>

                                        </div>


                                        <h2>Sub articles:</h2>
                                        <hr>
                                        <?php
                                        if (!empty($sub_article)):
                                            $i = 1;

                                            foreach ($sub_article as $sub_article_row) {
                                                ?>
                                                <div class="form-group">
                                                    <label><?php echo $i; ?>.Sub article title</label>
                                                    <input class="form-control required" name="title<?php echo $i; ?>" value="<?php echo $sub_article_row->title ?>" maxlength="200">
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo $i; ?>.Description</label>
                                                    <textarea class="form-control required" name="description<?php echo $i; ?>" maxlength="500"><?php echo $sub_article_row->description ?> </textarea>
                                                </div>
                                                <input type="hidden" name="sub_article_id<?php echo $i; ?>" value="<?php echo $sub_article_row->id; ?>"/>
                                                <?php
                                                $i++;
                                            }
                                        endif;
                                        ?>

                                        <button type="submit" class="article_edit_button btn smile-primary btn subbtn">Submit</button>
                                        <a href="<?php echo site_url("admin/Dashboard_subarticles/index/" . $this->ion_auth->user()->row()->id) ?>/#<?php echo $this->uri->segment(5) ?>" class="btn btn btn-warning closebtn">Cancel</a>

                                    </div>
                                    <?php form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($mode == 'view'): ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header"><?php echo $lang_articlesdetails; ?>: </h2>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row" style="margin-left: 0px;margin-right: 0px;">
                        <div class="panel-heading" style="font-size: 17px;color: #fff;background-color: #0aa959 !important;">
                           Article Details
                            <a style="margin-top: -6px;float: right;" href="<?php echo site_url() ?>admin/Dashboard_subarticles/index/<?php echo $this->ion_auth->user()->row()->id; ?>"> <button type="button" class="btn btn-info closebtn">Back</button></a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body subarticleview">
                            <div class="dataTable_wrapper">
                                <table width="80%" cellspacing="2" cellpadding="10" class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                                    <?php
                                    if (isset($view_article) && count($view_article)):

                                        foreach ($view_article as $row) {
                                            ?>
                                            <tr>
                                                <th>Selected Language</th>
                                                <td colspan="5"><?php
                                                    if ($row->language_key == 'en')
                                                        echo "English";
                                                    if ($row->language_key == 'zh')
                                                        echo "Chinese";
                                                    if ($row->language_key == 'my')
                                                        echo "Burmese";
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Article Title</th>
                                                <td colspan="5"><?php echo $row->title; ?></td>
                                            </tr>
                                            <?php
                                            $cat_del = $this->Category_model->get($row->cat_id);

                                            if ($cat_del->deleted == '0'):
                                                ?>
                                                <tr>
                                                    <th>Root Categories Names</th>
                                                    <td colspan="5"><?php echo $cat ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Sub category name </th>
                                                    <td colspan="5"><?php
                                                        if ($language == 'en')
                                                            echo $row->category_name;
                                                        if ($language == 'zh')
                                                            echo $row->category_ch_lang_name;
                                                        if ($language == 'my')
                                                            echo $row->category_bm_lang_name;
                                                        ?></td>
                                                </tr>
                                            <?php else: ?>
                                                <tr>
                                                    <th>Sub category Name </th>
                                                    <td colspan="5">N/A</td>
                                                </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <th>Username</th>
                                                <td colspan="5"><?php echo $row->username ?></td>
                                            </tr>

                                            <tr>
                                                <th>Tag Names1</th>
                                                <?php 
												if (!empty($article_tag)):
												for ($i = 0; $i < count($article_tag); $i++) {
													$tags .= ucfirst($article_tag[$i]->tag_name . ', ');
													}
													?>
													<td colspan="2">
													<?php
													print $tags ? substr($tags, 0, -2) : '';
														?>                                           
                                                                            </td>
                                                                        <?php else: ?>
                                                                            <td colspan="2"><?php echo $lang_tagnotfound; ?></td>
                                                                        <?php endif; ?>        
                                                                    </tr>

                                            <tr>
                                                <?php if (!empty($row->url_link)): ?>
                                                    <th>Youtube <?php echo $lang_link; ?></th>
                                                    <td colspan="5">
                                                        <div class="col-sm-4">
                                                            <?php
                                                            $url = $row->url_link;

                                                            $pattern = '%^# Match any youtube URL
    (?:https?://)?  # Optional scheme. Either http or https
    (?:www\.)?      # Optional www subdomain
    (?:             # Group host alternatives
      youtu\.be/    # Either youtu.be,
    | youtube\.com  # or youtube.com
      (?:           # Group path alternatives
        /embed/     # Either /embed/
      | /v/         # or /v/
      | .*v=        # or /watch\?v=
      )             # End path alternatives.
    )               # End host alternatives.
    ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
    ($|&).*         # if additional parameters are also in query string after video id.
    $%x'
                                                            ;
                                                            $result = preg_match($pattern, $url, $matches);
                                                            if (false !== $result) {
                                                                @$text = $matches[1];
                                                            }
                                                            ?>
                                                            <iframe width="420" height="315"
                                                                    src="http://www.youtube.com/embed/<?php echo $text ?>">
                                                            </iframe>
                                                        </div>
                                                    </td>
                                                    <?php
                                                else:
                                                    ?>
                                                    <th>Image/Video/Youtube Link</th>
                                                    <td colspan="5">
                                                        <div class="col-md-12">
                                                            <?php if (!empty($image_files)): ?>
                                                                <?php foreach ($image_files as $image_files_row) { ?>
                                                                    <?php if ($image_files_row->type == '2'): ?>
                                                                        <div class="col-md-4">
                                                                            <image class="img-rounded" src="<?php echo base_url() ?>assets/uploads/articles_image/<?php echo $image_files_row->raw_name . $image_files_row->file_ext ?>"  width="100%">
                                                                            <?php if (!empty($image_files_row->caption)): ?>
                                                                                <figcaption style="border:2px solid black;background-color:#d2d2d2;border-radius:8px !important;padding:2px;margin-top:2px;"><?php echo ucfirst($image_files_row->caption); ?></figcaption>
                                                                            <?php else: ?>
                                                                                <figcaption style="border:2px solid black;background-color:#d2d2d2;border-radius:8px !important;padding:2px;margin-top:2px;">No Caption</figcaption>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <?php if ($image_files_row->type == '3'): ?>
                                <!--                                                                                                <script type="text/javascript" src="<?php echo base_url('assets/js/player.js') ?>"></script> <script class="splayer"> var params = {"playlist": [{"video": [{"url": "<?php echo base_url('assets/uploads/articles_videos/' . $image_files_row->raw_name . $image_files_row->file_ext) ?>"}], "duration": 0, "posterUrl": "<?php echo base_url('assets/uploads/articles_videos/' . $image_files_row->raw_name . "_thumb.jpg") ?>"}], "uiLanguage": "en", "width": "400", "height": "250"};
                                                                            player.embed(params);</script>-->
                                                                        <!--<video id="example_video_1" class="video-js vjs-default-skin"
                                                                          controls preload="auto" width="auto" height="250"
                                                                          poster="<?php echo base_url('assets/uploads/articles_videos/' . $image_files_row->raw_name . "_thumb.jpg") ?>"
                                                                          data-setup='{"example_option":true}'>
                                                                         <source src="<?php echo base_url('assets/uploads/articles_videos/' . $image_files_row->raw_name . $image_files_row->file_ext) ?>" type='video/mp4' />
                                                                         
                                                                        </video>-->
                                                                        <!--                                                                                                <video width="100%" height="20%" controls="" id="vid" src="<?php echo base_url() ?>assets/uploads/articles_videos/<?php echo $image_files_row->raw_name . $image_files_row->file_ext ?>"></video>                                                    -->
                                                                        <video id="example_video_1" class="video-js vjs-default-skin"
                                                                               controls preload="auto" height="300px" width="auto"
                                                                               poster="<?php echo base_url('assets/uploads/articles_videos/' . $image_files_row->raw_name . "_thumb.jpg") ?>"
                                                                               src="<?php echo base_url('assets/uploads/articles_videos/' . $image_files_row->raw_name . $image_files_row->file_ext) ?>" type='video/mp4' data-setup='{"example_option":true}'>
                                                                              <!--<source src="<?php echo base_url('assets/uploads/articles_videos/' . $image_files_row->raw_name . $image_files_row->file_ext) ?>" type='video/mp4' />-->

                                                                        </video>

                                                                    <?php endif; ?>
                                                                <?php } ?>
                                                            <?php endif;
                                                            ?>
                                                        </div>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>

                                            <tr>
                                                <th>Description</th>
                                                <td colspan="5"><div style="width:800px; max-height:200px; overflow-Y:auto"><?php echo $row->description ?></div></td>
                                            </tr>
                                            <tr>
                                                <th>Short Description</th>
                                                <td colspan="5"><?php echo $row->short_description ?></td>
                                            </tr>
                                            <?php
                                            if (!empty($sub_articles)):
                                                $i = 1;
                                                ?>
                                                <tr><td  colspan="6"><h2>Sub Articles:</h2></td></tr>
                                                <?php foreach ($sub_articles as $sub_articles_row) { ?>
                                                    <tr>
                                                        <td style="width:30%;font-weight: bold;"><?php echo $i . "." . $sub_articles_row->title; ?></td>
                                                        <td><div><?php echo $sub_articles_row->description; ?></div></td>
                                                        <td colspan="5"><a  href="#" data="<?php echo $sub_articles_row->id ?>" class="status_delete_subarticle"><i    class="fa fa-remove" title="Delete"></i></a></td>
                                                        </td>
                                                    </tr>
                        <!--                                            <tr>
                                                        <td style="width:30%;font-weight: bold;"><?php echo $lang_option1; ?></td>
                                                        <td><div style="width:800px; max-height:200px; overflow-Y:auto"><?php echo $article_microlearning->option1; ?></div></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%;font-weight: bold;"><?php echo $lang_option2; ?></td>
                                                        <td><div style="width:800px; max-height:200px; overflow-Y:auto"><?php echo $article_microlearning->option2; ?></div></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%;font-weight: bold;"><?php echo $lang_option3; ?></td>
                                                        <td><div style="width:800px; max-height:200px; overflow-Y:auto"><?php echo $article_microlearning->option3; ?></div></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%;font-weight: bold;"><?php echo $lang_option4; ?></td>
                                                        <td><div style="width:800px; max-height:200px; overflow-Y:auto"><?php echo $article_microlearning->option4; ?></div></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%;font-weight: bold;"><?php echo $lang_answer; ?>/td>
                                                        <td><div style="width:800px; max-height:200px; overflow-Y:auto"><?php echo $article_microlearning->answer_key; ?></div></td>
                                                    </tr>-->
                                                    <?php
                                                    $i++;
                                                }
                                            endif;
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

            </div> <!-- /#page-wrapper -->
        </div> <!-- /#wrapper -->
        <?php $this->load->view('admin/subarticle_create_modal'); ?>
        <!-- jQuery -->
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

        <!-- tags related script start here-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/bootstrap-tagsinput.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/bootstrap-tagsinput-angular.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/rainbow.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/generic.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/html.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/javascript.js"></script>
        <script src="<?php echo base_url(); ?>assets/tags/app.js"></script>
        <script src="<?php echo base_url(); ?>assets/tags/app_bs3.js"></script>
        <!-- Tags related script ends here -->
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/forms/wysihtml5/wysihtml5.min.js"></script>
        <script src="<?php echo site_url() ?>assets/js/jquery.Jcrop.js"></script>





        <script>
                                                        $(document).ready(function () {
                                                            $(document).on('click', '.status_delete_subarticle', function () {
                                                                if (confirm("Are you sure want to perform this operation ?")) {
                                                                    $(".modal_load").show();
                                                                    var id = $(this).attr('data');

                                                                    url = "<?php echo site_url() ?>/admin/Dashboard_subarticles/delete_subarticle";
                                                                    //alert(url);
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: url,
                                                                        data: {id: id},
                                                                        success: function (data)
                                                                        {

                                                                            //alert("Successfully Deleted");
                                                                            $(".modal_load").hide();
                                                                            location.reload();
                                                                        }
                                                                    });
                                                                }

                                                            });
                                                            $('#subarticle_form').validate();
                                                            $('#subarticle_edit_form').validate();

                                                            $('.dataTables-example').DataTable({
                                                                responsive: true,
                                                                'columnDefs': [{'orderable': false, 'targets': -1}], // hide sort icon on this column
                                                                'aaSorting': [[5, 'desc']] // start to sort data on this column
                                                            });
                                                            $(document).on('click', '.subarticle_form', function () {
                                                                $('#subarticle_modal').modal({
                                                                    keyboard: false,
                                                                    show: true,
                                                                    backdrop: 'static'
                                                                });
                                                                var article_id = $(this).attr('data');
                                                                //(article_id)
                                                                //document.getElementById("demo").innerHTML = "Paragraph changed!";
                                                                //$("#article_id").val(article_id.innerHTML);
                                                                $('#article_id').val(article_id)
                                                            });


                                                        });
        </script>



