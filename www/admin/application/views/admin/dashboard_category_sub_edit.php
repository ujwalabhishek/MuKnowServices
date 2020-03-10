 <!-- Form modal -->
    <div id="form_modal2edit" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header smile-primary" style="border-radius:0px !important;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">&times;</button>
                    <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Edit sub-sub Topic </span> </h4>
                </div>
                <!-- Form inside modal -->
                <?php echo form_open_multipart(site_url() . '/admin/dashbord_category/add_edit', 'method="post" id="cat_form21edit" class=".validate"'); ?>
                <div class="modal-body with-padding">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Sub Topic name:</label>    
                                <p id="subcat_nameedit">fdsf</p>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Sub-sub Topic name:</label>
                                <input type="text" id="subcat1edit" name="name" class="form-control required" maxlength="50" value="">
                            </div>
                        </div>
                    </div> 
<!--                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Name(In Chinese language):</label>
                                <input type="text" id="ch_lang_name1edit" name="ch_lang_name" class="form-control required" maxlength="100" value="">
                            </div>
                        </div>
                    </div> -->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Name(In Burmese language):</label>
                                                    <input type="text" id="bm_name_edit" name="bm_lang_name" class="form-control required" maxlength="100" value="">
                                                </div>
                                            </div>
                                        </div> 


                </div>            
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning closebtn" data-dismiss="modal">Close</button>
                    <span id="add">
                        <input type="hidden" name="id" value="" id="id1edit">
                        <input type="hidden" name="curl" value="<?php echo site_url(uri_string()); ?>" id="id">
                        <input type="hidden" name="maincat" value="<?php echo $this->uri->segment(4) ?>" >
                       <!-- <button type="button" class="btn btn-primary" id="add_subcat1">Submit</button>-->
                         <input type="submit" class="btn btn-primary subbtn" id="add_subcatedit" value="Submit">

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
                                                                                   
                                                                                    
    <div id="form_modal3edit" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header smile-primary" style="border-radius:0px !important;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Edit sub-sub-sub Topic </span> </h4>
                </div>
                <!-- Form inside modal -->
                <?php echo form_open_multipart(site_url() . '/admin/dashbord_category/add_edit', 'id="cat_form3edit" class=".validate"'); ?>
                <div class="modal-body with-padding">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Sub-sub Topic name:</label>    
                                <p id="subcat_name2edit">fdsf</p>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Sub-sub-sub Topic name:</label>
                                <input type="text" id="subcat2edit" name="name" class="form-control required" maxlength="50" value="">
                            </div>
                        </div>
                    </div> 
<!--                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Name(In Chinese language):</label>
                                <input type="text" id="ch_lang_name2edit" name="ch_lang_name" class="form-control required" maxlength="100" value="">
                            </div>
                        </div>
                    </div> -->
                                       <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Name(In Burmese language):</label>
                                                    <input type="text" id="bm_s3_edit" name="bm_lang_name" class="form-control required" maxlength="100" value="">
                                                </div>
                                            </div>
                                        </div>

                </div>            
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning closebtn" data-dismiss="modal">Close</button>
                    <span id="add">
                        <input type="hidden" name="id" value="" id="id2edit">
                        <input type="hidden" name="curl" value="<?php echo site_url(uri_string()); ?>" id="id">
                        <input type="hidden" name="maincat" value="<?php echo $this->uri->segment(4) ?>" >
                      <!--  <button type="button" class="btn btn-primary" id="add_subcat2">Submit</button>-->
                        <input type="submit" class="btn btn-primary subbtn" id="add_subcat2edit" value="Submit">
                    </span><!-- 
                    <span id="edit">

                      <button type="submit" class="btn btn-primary" id="update_city" >Update Categories</button>
                    </span> -->
                </div>
                </form>
            </div>
        </div>
    </div>