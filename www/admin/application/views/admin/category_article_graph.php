<!-- Form modal view -->
<div id="form_modal_graph" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="panel panel-default modal-content">
            <div class=" modal-header btn-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Based on Topic, Total No. of Article</span> Graph Representation  </h4>
            </div>
            <!-- Form inside modal -->
            <?php //echo form_open_multipart(site_url() . '/admin/dashbord_category/add_edit', 'id="cat_form" class=".validate"'); ?>
            <div class="modal-body with-padding" style="overflow:visible !important;">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                
                               <div id="chartContainer" style="height: 380px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>  

                    <!-- /.table-responsive -->

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning " data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    <!-- /form modal view -->