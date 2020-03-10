<?php require_once('includes/head.php') ?>



<body>



    <div id="wrapper">



        <?php require_once('includes/nav.php') ?>

        <?php //print_r($tbldata);?>



        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h2 class="page-header"><i class="fa fa-credit-card" id="sidemenuicon"></i> <?php echo project_name . ' ' . $lang_menu_scratch_card; ?></h2>

                    <?php if ($this->session->flashdata('message')) { ?>
                        <div class="alert alert-success"> 
                            <button type="button" class="close" data-dismiss="alert">X</button>		
                            <?php echo $this->session->flashdata('message') ?>
                        </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger fade in block-inner"> 
                            <button type="button" class="close" data-dismiss="alert">X</button>		
                            <?php echo $this->session->flashdata('error') ?>
                        </div>
                    <?php } ?>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default table-responsive">

                        <div class="panel-heading table-responsive">

                            <!--<?php echo $lang_menu_scratch_card . " List"; ?>-->

                            <div style="float:right;"><a role="button"  class="align-left" title="Add Subscription"><button type="button"  data1="builder_0" class="model_form1 btn smile-primary animated bounceIn">Add <?php echo $lang_menu_scratch_card; ?> <i class="fa fa-plus" style="color:#FFF;"></i></button></a></div>

                        </div>



                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>                                        
                                    <!--<th>ID</th> -->
                                    <th>Batch No.</th>
                                    <!--<th>Scratch Card</th>
                                    <th>Price</th>
                                    <th>Validity</th> -->
                                    <th>Created On</th>
									<th>Comments</th>
									<!--<th>Status</th>-->
									<th>View</th>
									</thead>

                                    <?php foreach ($scratchcard as $scratch) {
										?>
                                        <tr>
                                             <!--<td><?php echo $scratch->id; ?></td> -->
                                            <td><?php echo $scratch->batch; ?></td>
                                            <!--<td><?php echo $scratch->name; ?></td>
                                            <td><?php echo $scratch->price; ?></td>
                                            <td><?php echo $scratch->validity; ?></td>-->
                                            <td><?php echo $scratch->created_on; ?></td>
											<td><?php echo $scratch->comments; ?></td>
											<!--<td><?php echo $scratch->status; ?></td>-->
											<td><a  href="<?php echo site_url() ?>admin/Dashboard_scratchcard/view_scratchcard/<?php echo $scratch->batch; ?>" method = "post" title="View" class="tip"><i imagedata="image_dataclass<?php echo $scratch->batch; ?>" data="<?php echo $scratch->batch; ?>" class="model_form2 fa fa-eye tip" title="View"></i></a></td>
                                        </tr>
                                        <?php
									}
                                    ?>





                                </table>



                            </div>

                            <!-- /.table-responsive -->



                        </div>

                        <!-- /.panel-body -->

                    </div>

                    <!-- /.panel -->

                </div>

            </div>



        </div>

        <!-- /#page-wrapper -->



    </div>

    <!-- /#wrapper -->

    <!-- Form modal -->
    <div id="form_modal1" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header smile-primary" style="border-radius:0px !important;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">&times;</button>
                    <h4 class="modal-title"><i class="icon-paragraph-justify2"></i>Add <?php echo $lang_menu_scratch_card; ?> </h4>
                </div>
                <!-- Form inside modal -->
                <?php echo form_open_multipart(site_url() . 'admin/Dashboard_scratchcard/add_scratchcard', 'id="cat_form1"  enctype="multipart/form-data"  onsubmit="return myFunction()"'); ?>
                <div class="modal-body with-padding">
				
					<div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>* Batch Number :</label>
                                <input type="text" id="batch" name="batch" class="form-control required" maxlength="100" value="">
                            </div>
                        </div>
                    </div> 
                    <p id="err_batch" style="color:red; margin-top:-10px;"></p>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>* Quantity :</label>
                                    <input type="text" id="quantity" name="quantity" class="form-control required" maxlength="50" value="" onkeypress="return isNumberKey(event)">
                            </div>
                        </div>
                    </div> 
                    <p id="err_quantity" style="color:red; margin-top:-10px;"></p>
                    <!--                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Name(In Chinese language):</label>
                                                    <input type="text" id="ch_lang_name" name="ch_lang_name" class="form-control required" maxlength="100" value="">
                                                </div>
                                            </div>
                                        </div> -->

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>* Price :</label><span style="color:#194c83"><i>(Only MMK)</i></span>
                                <input type="text" id="price" name="price" class="form-control required" maxlength="50" value="" onkeypress="return isNumberKey(event)">
                            </div>
                        </div>
                    </div> 
                    <p id="err_price" style="color:red; margin-top:-10px;"></p>
					
					<div class="form-group">
                        <div class="row">
                            <div class="">
                                <div class="col-md-12"><label>* Validity :</label><span style="color:#194c83"><i> ( Note:- 1 month = 28 days ) </i></span></div>

                                <div class="col-md-6">
                                    <select name="duration" id="duration" class="form-control required" onChange="changecat(this.value);">
                                        <!--<option value="">--- Please Select ---</option>
                                        <option value="days">Days</option>
                                        <option value="week">Week</option>-->
                                        <option value="month">Month</option>
                                        <!--<option value="year">Year</option>-->
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <select name="total" id="total" class="form-control required">
										<option value="1">1</option>
                                        <option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										
									</select>
                                </div>

                            </div>
                        </div>
                    </div> 
                    <p id="err_validity" style="color:red; margin-top:-10px;"></p>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>* Comments :</label>
                                <input type="text" id="comments" name="comments" class="form-control required" maxlength="200" value="">
                            </div>
                        </div>
                    </div> 
                    <p id="err_comments" style="color:red; margin-top:-10px;"></p>

                    



                </div>            
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning closebtn" data-dismiss="modal">Close</button>
                    <span id="add">
                        <button type="submit" class="btn btn-primary subbtn" id="add_city">Submit</button>
                    </span><!-- 
                    <span id="edit">

                      <button type="submit" class="btn btn-primary" id="update_city" >Update Categories</button>
                    </span> -->
                </div>
                </form>
            </div>
        </div>
    </div>
	
	

    <!-- jQuery -->

    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>



    <!-- Bootstrap Core JavaScript -->

    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>



    <!-- Metis Menu Plugin JavaScript -->

    <script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>



    <!-- DataTables JavaScript -->

    <script src="<?php echo base_url(); ?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>



    <!-- Custom Theme JavaScript -->

    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>



    <!-- For Editor -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/bower_components/editor/nicEdit-latest.js">"></script>

    <script type="text/javascript">

//<![CDATA[

                bkLib.onDomLoaded(function () {
                    nicEditors.allTextAreas()
                });

        //]]>

        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                "pagingType": "full_numbers",
				'aaSorting': [[1, 'desc']],
				'columnDefs': [{'orderable': false, 'targets': -1}]
            });
        });


        $(document).on('click', '.model_form1', function () {
            $('#form_modal1').modal({
                keyboard: false,
                show: true,
                backdrop: 'static'
            });
        });
		
		

    </script>

    <script type="text/javascript">
        function myFunction() {
            var batch, quantity, price, total, duration, comments, err_batch, err_quantity, err_price, err_validity, err_comments;

            // Get the value of the input field with id="numb"
            batch = document.getElementById("batch").value;
			quantity = document.getElementById("quantity").value;
            price = document.getElementById("price").value;
            total = document.getElementById("total").value;
            duration = document.getElementById("duration").value;
			comments = document.getElementById("comments").value;
            
			
			if (batch === '') {
                err_batch = "Please Enter Batch Number.";
                document.getElementById("err_batch").innerHTML = err_batch;
                document.getElementById("batch").focus();
                document.getElementById("err_quantity").innerHTML = '';
                document.getElementById("err_price").innerHTML = '';
                document.getElementById("err_validity").innerHTML = '';
				document.getElementById("err_comments").innerHTML = '';
                return false;
            }
			
			
            if (batch.length < 5 || batch.length > 20) {
                err_batch = "Please Enter Batch Number Between 5 to 20 Character.";
                document.getElementById("err_batch").innerHTML = err_batch;
                document.getElementById("batch").focus();
                document.getElementById("err_quantity").innerHTML = '';
                document.getElementById("err_price").innerHTML = '';
                document.getElementById("err_validity").innerHTML = '';
				document.getElementById("err_comments").innerHTML = '';
                return false;
            }
			
			if (quantity === '') {
                err_quantity = "Please Enter Quantity.";
                document.getElementById("err_quantity").innerHTML = err_quantity;
				document.getElementById("quantity").focus();
                document.getElementById("err_batch").innerHTML = '';
                document.getElementById("err_price").innerHTML = '';
                document.getElementById("err_validity").innerHTML = '';
				document.getElementById("err_comments").innerHTML = '';
                return false;
            }

            if (price === '') {
                err_price = "Please Enter Price.";
				document.getElementById("err_price").innerHTML = err_price;
				document.getElementById("price").focus();                
                document.getElementById("err_quantity").innerHTML = '';
				document.getElementById("err_batch").innerHTML = '';
                document.getElementById("err_validity").innerHTML = '';
				document.getElementById("err_comments").innerHTML = '';
                return false;
            }
			
			if (total === '' || duration === '') {
                err_validity = "Please Enter Validity for Subscription.";
                document.getElementById("err_validity").innerHTML = err_validity;
                if (total === '') {
                    document.getElementById("total").focus();
                } else {
                    document.getElementById("duration").focus();
                }
                document.getElementById("err_quantity").innerHTML = '';
				document.getElementById("err_batch").innerHTML = '';
                document.getElementById("err_price").innerHTML = '';
				document.getElementById("err_comments").innerHTML = '';
                return false;
            }

            if (comments === '') {
                err_comments = "Please Enter Comments.";
                document.getElementById("err_quantity").innerHTML = '';
				document.getElementById("err_batch").innerHTML = '';
                document.getElementById("err_price").innerHTML = '';
				document.getElementById("err_validity").innerHTML = '';
				document.getElementById("err_comments").innerHTML = err_comments;
				document.getElementById("comments").focus();                
                
                return false;
            }

            
            return true;
        }

        function isNumberKey(evt)
        {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31
                    && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
		
		var mealsByCategory = {
			days: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27],
			week: [1,2,3],
			month:[1,2,3,4,5,6,7,8,9,10,11],
			year: [1,2,3,4,5]
		}

			function changecat(value) {
				if (value.length == 0) document.getElementById("total").innerHTML = "<option></option>";
				else {
					var catOptions = "";
					for (categoryId in mealsByCategory[value]) {
						catOptions += "<option>" + mealsByCategory[value][categoryId] + "</option>";
					}
					document.getElementById("total").innerHTML = catOptions;
				}
			}
		
    </script>


</body>



</html>

