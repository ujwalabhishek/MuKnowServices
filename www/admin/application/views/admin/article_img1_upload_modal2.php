<div class="modal fade c-content-login-form" id="upload-logo-form2" role="dialog">
                                                    <div class="modal-dialog" style="max-width:400px">
                                                        <div class="modal-content c-square" style="padding:15px">
                                                            <div class="modal-header c-no-border" style="font-size:24px;"><?php echo $lang_upload_image;?>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">x</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="login-content upfrma"> 
                                                                    <?php echo form_open_multipart('admin/dashboard_articles/add_picture', array('class' => 'single', 'id' => 'upload-logo-form-control2')) . "\r\n"; ?>
                                                                    <div class="">
                                                                        <span id="mailme-alert2" style="color: #ec5e00"></span>
                                                                        <div class="form-group form-md-line-input has-success form-md-floating-label">
                                                                            <div class="input-icon right">
                                                                                <input type="file" name="picture_file" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="submit" class="btn smile-primary btn" value="<?php echo $lang_upload;?>" />
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