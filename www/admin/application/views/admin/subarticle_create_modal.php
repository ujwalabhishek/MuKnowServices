<!-- Form modal view -->
<div id="subarticle_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="panel panel-default modal-content">
            <div class=" modal-header btn-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Create</span> Sub Article </h4>
            </div>
            <!-- Form inside modal -->
            <?php echo form_open_multipart(site_url() . '/admin/Dashboard_subarticles/add_subarticles', 'id="subarticle_form" class=".validate"'); ?>
            <div class="modal-body with-padding">
                <div class="panel-body">
                      <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Title:</label>
                                <input type="text" id="title" name="title" class="form-control required" maxlength="200"  minlength="3" value="">
                            </div>
                        </div>
                    </div> 
                      <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Description:</label>
                                <textarea class="form-control required" name="description" rows="3" name="short_description" maxlength="500" minlength="5"></textarea>
                            </div>
                        </div>
                    </div> 

                </div>


            </div>
            <input type="hidden" name="article_id" value="" id="article_id"/>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-warning " data-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-primary" id="add_subcat1">Submit</button>
            </div>
        </div>
    </div>
    <!-- /form modal view -->