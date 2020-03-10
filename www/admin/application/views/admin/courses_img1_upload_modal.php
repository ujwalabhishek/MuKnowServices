<div class="modal fade c-content-login-form" id="upload-logo-form" role="dialog">
                                                    <div class="modal-dialog" style="max-width:400px">
                                                        <div class="modal-content c-square" style="padding:15px">
                                                            <div class="modal-header c-no-border" style="font-size:24px;"><?php echo 'upload image';?>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">x</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="login-content upfrma"> 
                                                                    <?php //echo form_open_multipart('admin/dashboard_courses/add_picture', array('class' => 'single', 'id' => 'upload-logo-form-control')) . "\r\n"; ?>
                                                                    <form action="javascript:;" class="single" id="upload-logo-form-control" rel="<?php echo site_url('admin/dashboard_courses/add_picture');?>" >
                                                                    <div class="">
                                                                        <span id="mailme-alert" style="color: #ec5e00"></span>
                                                                        <div class="form-group form-md-line-input has-success form-md-floating-label">
                                                                            <div class="input-icon right">
                                                                                <input type="file" name="picture_file" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="submit" class="btn smile-primary btn" value="<?php echo 'Upload';?>" />
                                                                    <?php echo form_close() . "\r\n"; ?>
                                                                </div>
                                                            </div>
                                                            <div style="padding:15px;border-top:1px solid #e5e5e5">
                                                                <div class=row>
                                                                    <small><?php echo $lang_notes;?></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>