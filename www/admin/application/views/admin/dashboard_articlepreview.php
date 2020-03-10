<?php
require_once('includes/head.php')
?>

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url() ?>assets/global/plugins/jquery-nestable/jquery.nestable.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<!--<link href="<?php echo base_url() ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />-->

<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="<?php echo base_url() ?>assets/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="<?php echo base_url() ?>assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME LAYOUT STYLES -->
<link rel="shortcut icon" href="favicon.ico" />
<style>
    .dd-handle{
        height:35px !important;
        background-color: #fff ;

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


        
        <!-- /.row -->
        <?php if ($mode == 'preview'): ?>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h1 class="page-header"><?php echo $lang_articlesdetails; ?>: </h1>
                                                </div>
                                                <!-- /.col-lg-12 -->
                                            </div>
                                            <div class="row" style="margin-left: 0px;margin-right: 0px;">
                                                <div class="panel-heading">
                                                    <?php echo $lang_articlesdetails; ?>
                                                    <a style="margin-top: -6px;float: right;" href="<?php echo site_url() ?>admin/<?php echo $this->uri->segment(2);?>/index"> <button type="button" class="btn smile-primary btn-info" style="border:none;">Back</button></a>
                                                </div>
                                                <!-- /.panel-heading -->
                                                <div class="panel-body" style="background-color:#fff;">
                                                    <div class="dataTable_wrapper" style="overflow-x:scroll;">
                                                        <table width="80%" cellspacing="2" cellpadding="10" class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                                                            <?php
                                                            if (isset($view_article) && count($view_article)):

                                                                foreach ($view_article as $row) {
                                                                    ?>
                                                                    <tr>
                                                                        <th><?php echo $lang_slectedlang; ?></th>
                                                                        <td colspan="5"><?php echo $row->language_key; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th><?php echo $lang_articletitle; ?></th>
                                                                        <td colspan="5"><?php echo $row->title; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                    $cat_del = $this->Category_model->get($row->cat_id);

                                                                    if ($cat_del->deleted == '0'):
                                                                        ?>
                                                                        <tr>
                                                                            <th>Root Categories</th>
                                                                            <td colspan="5"><?php echo $cat ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th><?php echo $lang_subcategiryname?> </th>
                                                                            <td colspan="5"><?php echo $row->category_name ?></td>
                                                                        </tr>
                                                                    <?php else: ?>
                                                                        <tr>
                                                                            <th><?php echo $lang_subcategiryname?></th>
                                                                            <td colspan="5">N/A</td>
                                                                        </tr>
                                                                    <?php endif; ?>
                                                                    <tr>
                                                                        <th><?php echo $lang_username; ?></th>
                                                                        <td colspan="5"><?php echo $row->username ?></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <th>Tag name</th>
                                                                        <?php if (!empty($article_tag)): ?>
                                                                            <?php foreach ($article_tag as $article_tag_row) { ?>
                                                                                <td><?php echo ucfirst($article_tag_row->tag_name); ?></td>

                                                                            <?php } ?>
                                                                        <?php else: ?>
                                                                            <td>Tags not found</td>
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
                                                                            <th><?php echo $lang_image; ?>/<?php echo $lang_video; ?>/Youtube <?php echo $lang_link; ?></th>
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
                                                                        <th><?php echo $lang_description; ?></th>
                                                                        <td colspan="5"><div style="width:800px; max-height:200px; overflow-Y:auto"><?php echo $row->description ?></div></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th><?php echo $lang_shortdescription; ?></th>
                                                                        <td colspan="5"><?php echo $row->short_description ?></td>
                                                                    </tr>
                                                                    <?php
                                                                    if (!empty($article_microlearning)):
                                                                        ?>
                                                                        <tr><td><h2>Micro learning:</h2><td></tr>
                                                                        <tr>
                                                                            <td style="width:30%;font-weight: bold;"><?php echo $lang_question; ?></td>
                                                                            <td><div style="width:800px; max-height:200px; overflow-Y:auto"><?php echo $article_microlearning->question; ?></div></td>
                                                                        </tr>
                                                                        <tr>
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
                                                                            <td style="width:30%;font-weight: bold;"><?php echo $lang_answer; ?></td>
                                                                            <td><div style="width:800px; max-height:200px; overflow-Y:auto"><?php echo $article_microlearning->answer_key; ?></div></td>
                                                                        </tr>
                                                                        <?php
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
                </div> 
                <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>

                <!-- Bootstrap Core JavaScript -->
                <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

                <!-- Metis Menu Plugin JavaScript -->


                <script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
                <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


                <!-- END CORE PLUGINS -->
                <!-- BEGIN PAGE LEVEL PLUGINS reorder -->
                <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-nestable/jquery.nestable.js" type="text/javascript"></script>


                <!-- END PAGE LEVEL PLUGINS reorder-->

                <!-- BEGIN PAGE LEVEL SCRIPTS -->
                <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
                <script src="<?php echo base_url(); ?>assets/pages/scripts/ui-nestable.min.js" type="text/javascript"></script>

