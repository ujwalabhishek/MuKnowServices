<?php require_once('includes/croppage_header.php') ?>
<body>
    <div class="modal modal_load" style="display: none">
        <div class="center">
            <img alt="" src="<?php base_url(); ?>/assets/loader.gif" />
        </div>
    </div>
    <div id="wrapper">

        <?php require_once('includes/nav.php') ?>


        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Crop Image</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Crop Image
                        </div>

                        <div class="row">
                            <div class="col-md-12 responsive-1024">
                                <!-- This is the image we're attaching Jcrop to -->
                                <img src="<?php echo base_url("{$upload_path_cat_img}/{$upload_data['file_name']}"); ?>"  id="corpcrop" alt="[Jcrop Example]" />                                                   
                            </div>
                            <div class="col-md-3 col-sm-12 responsive-1024 margin-top-20">
                                <?php echo form_open_multipart(site_url() . "admin/Dashboard_create_group/cropped_categoryimage", array('id' => 'corpcrop_form')) . "\r\n"; ?>
                                <?php if (!empty($upload_data)) { ?>
                                    <?php foreach ($upload_data as $item => $value): ?>
                                        <input type="hidden" id="<?php echo $item; ?>" name="filedata[<?php echo $item; ?>]" value="<?php echo $value; ?>"/>

                                    <?php endforeach; ?>
                                    <input type="hidden" id="category_name" name="category_name" value="<?php echo $category_name ?>"/>
                                    <input type="hidden" id="ch_lang_name" name="ch_lang_name" value="<?php echo $ch_lang_name ?>"/>
                                    <input type="hidden" id="category_name" name="bm_lang_name" value="<?php echo $bm_lang_name ?>"/>
                                <?php } ?>

                                <input type="hidden" id="crop_x" name="crop[x]" />
                                <input type="hidden" id="crop_y" name="crop[y]" />
                                <input type="hidden" id="crop_w" name="crop[w]" />
                                <input type="hidden" id="crop_h" name="crop[h]" />

                                <input type="submit" value="Crop Image" class="btn primary" style="margin:20px" /> 
                                <?php echo form_close() . "\r\n"; ?>
                            </div>

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
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
</body>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var corpcrop = function () {
            $('#corpcrop').Jcrop({
                //setSelect:   [ 150, 150, 50, 50 ],
                aspectRatio: 400 / 150,
                onSelect: updateCoords
            }, function () {
                jcrop_api = this;
                jcrop_api.animateTo([150, 150, 50, 50]);
            });

            function updateCoords(c)
            {
                $('#crop_x').val(c.x);
                $('#crop_y').val(c.y);
                $('#crop_w').val(c.w);
                $('#crop_h').val(c.h);
            }
            ;

            $('#corpcrop_form').submit(function () {
                if (parseInt($('#crop_w').val()))
                    return true;
                alert('Please select a crop region then press submit.');
                return false;
            });

        }
        corpcrop();
    });

</script>
<script src="<?php echo base_url() ?>assets/js/jquery.Jcrop.js"></script>

