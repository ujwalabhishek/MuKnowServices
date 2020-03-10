<div id="confirm_myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
			 <?php echo form_open_multipart(site_url('admin/Dashbord_category/add_subcat_ajax') , 'id="cat_ajax_confirm_form" class=".validate"'); ?>
            <div class="modal-body">
                <p>Do you want to create the subtopic? The parent topic already having some article,if you want to create subtopic under this parent, all article related to this parent topic will be automatically moved to this newly creating topic.</p>
                <p class="text-warning"><small>If you don't want to create, click No button.</small></p>
				<input type="hidden" id="maincat_confirm_name" name="maincat" class="form-control required" value="<?php  echo $this->uri->segment(4);?>">
				<input type="hidden" id="subcat_confirm_name" name="name" class="form-control required" value="">
				<input type="hidden" id="curl" name="curl" class="form-control required" value="<?php echo uri_string();?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="add_subcat_confirm">Yes</button>
            </div>
			<?php echo form_close();?>
        </div>
    </div>
</div>