<!-- /form modal edit -->                                                                 
<div id="form_modal_edit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header smile-primary" style="border-radius:0px !important;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">&times;</button>
                <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Edit</span> Sub Topic </h4>
            </div>
            <?php //echo '<pre>'; print_r($row); exit;?>                                                            
            <!-- Form inside modal -->
            <?php echo form_open_multipart(site_url('/admin/dashbord_category/add_edit'), 'id="cat_formedit" class=".validate"'); ?>
            <div class="modal-body with-padding">
                <div class="select_maincategory form-group">
                    <label>Selects Topic</label>
                    <input type="hidden"  id="maincatparent" name="maincat" class="form-control required" maxlength="50" value="">
                    <input type="text" disabled="disabled" id="maincatedit"  class="form-control required" maxlength="50" value="">    
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Name:</label>
                            <input type="text" id="subcatedit" name="name" class="form-control required" maxlength="50" value="">
                        </div>
                    </div>
                </div> 
                <!--                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Name(In Chinese language):</label>
                                                <input type="text" id="ch_lang_nameedt" name="ch_lang_name" class="form-control required" maxlength="100" value="">
                                            </div>
                                        </div>
                                    </div> -->
<!--                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Name(In Burmese language):</label>
                            <input type="text" id="bm_lang_nameedit" name="bm_lang_name" class="form-control required" maxlength="100" value="">
                        </div>
                    </div>
                </div> -->


            </div>            
            <div class="modal-footer">

                <span id="add">
                    <input type="hidden" name="id" value="" id="idedit">
                    <input type="hidden" name="curl" value="<?php echo site_url(uri_string()); ?>" id="id">
                    <input type="hidden" name="category_type" value="<?php echo $this->uri->segment(3) ?>" >
                    <div class="col-md-12">
                        <button type="button" class="btn closebtn" data-dismiss="modal" style="color:#fff;">Close</button>
                        <!--                            <a class="btn btn-large btn-danger" data-toggle="confirmation" data-placement="bottom">Click to toggle confirmation</a>-->
                        <!--<button type="submit" class="btn btn-large btn-primary" data-toggle="confirmation" id="add_subcat">submit</button>-->
                        <input type="submit" class="btn btn-large btn-primary subbtn" data-toggle="confirmation" id="add_subcat" value="Submit">
                    </div>
                </span><!-- 
                <span id="edit">

                  <button type="submit" class="btn btn-primary" id="update_city" >Update Categories</button>
                </span> -->
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /form modal edit -->   



<!-- Form modal -->
<div id="form_modal1edit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header smile-primary" style="border-radius:0px !important;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">&times;</button>
                <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Edit</span> Topic </h4>
            </div>
            <!-- Form inside modal -->
            <?php echo form_open_multipart(site_url() . '/admin/dashbord_category/edit_category', 'id="cat_form1edt" class=".validate" enctype="multipart/form-data"'); ?>
            <div class="modal-body with-padding">

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Name:</label>
                            <input type="text" id="name1edt" name="name" class="form-control required" maxlength="50" value="">
                        </div>
                    </div>
                </div> 
                <!--                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Name(In Chinese language):</label>
                                                <input type="text" id="ch_lang_nameedt" name="ch_lang_name" class="form-control required" maxlength="100" value="">
                                            </div>
                                        </div>
                                    </div> -->
<!--                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Name(In Burmese language):</label>
                            <input type="text" id="bm_lang_nameedit1" name="bm_lang_name" class="form-control required" maxlength="100" value="">
                        </div>
                    </div>
                </div> -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Image:</label>
                            <input type="file" name="image_file" class="form-control required" value="">
                            <span class="help-block">Accepted formats: jpg, png, gif.(450X150)  </span>
                        </div>
                    </div>
                </div> 


                <label><?php echo $lang_previousimage ?></label>
                <div class="form-group"><image id="imgedt" src="" height="80px" width="100px"/></div>
                <input type="hidden" name="image1_idedt" value="">

<!--                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Home Category :</label>
                            <input type="checkbox" name="home_front" id="home_front" class="" value="yes">

                        </div>
                    </div>
                </div> -->



            </div>            
            <div class="modal-footer">
                <button type="button" class="btn closebtn" data-dismiss="modal" style="color:#fff;">Close</button>
                <span id="add">
                    <input type="hidden" name="id" value="" id="idedt">
                    <input type="hidden" name="imgid" value="" id="imgidedt">
                    <input type="hidden" name="category_type" value="<?php echo $this->uri->segment(3) ?>" >

                    <!-- <button type="submit" class="btn btn-primary" id="add_city">Submit</button>-->
                    <input type="submit" class="btn btn-primary subbtn" data-toggle="confirmation" id="add_city11" value="Submit">
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