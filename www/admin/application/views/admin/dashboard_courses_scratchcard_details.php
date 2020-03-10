<?php require_once('includes/head.php') ?>

<body>



    <div id="wrapper">



        <?php require_once('includes/nav.php') ?>

        <?php //print_r($tbldata);?>



        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h2 class="page-header"><i class="fa fa-credit-card" id="sidemenuicon"></i> <?php echo $batch . ' Courses Scratch Card'; ?></h2>

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

                            <?php echo $batch . ' Scratch Card List'; ?>

                            <div style="float:right;"><a style="margin-top: -7px;float: right;" href="<?php echo site_url() ?>admin/dashboard_courses_scratchcard"> <button type="button" class="btn btn-info closebtn">Back</button></a></div>

                        </div>



                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>                                        
                                     <th>Courses</th>
                                    <th>Batch No.</th>
                                    <th>Scratch Card</th>
                                    <th>Price (MMK)</th>
                                    <th>Validity</th> 
                                    <th>Created On</th>
									<th>Comments</th>
									<th>Status</th>
									</thead>

                                    <?php foreach ($scratchcard_details as $scratch) {
										
										$vals = $this->Courses_model->get(array('id' => $scratch->courses_id, 'status' => 'Active', 'deleted' => '0'));
                                        ?>
                                        <tr>
                                             <td><?php echo ucwords($vals->title); ?></td>
                                            <td><?php echo $scratch->batch; ?></td>
                                            <td><?php echo $scratch->name; ?></td>
                                            <td><?php echo $scratch->price; ?></td>
                                            <td><?php echo $scratch->validity; ?></td>
                                            <td><?php echo $scratch->created_on; ?></td>
											<td><?php echo $scratch->comments; ?></td>
											<td><?php echo $scratch->status; ?></td>
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
				'aaSorting': [[4, 'desc']]
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

