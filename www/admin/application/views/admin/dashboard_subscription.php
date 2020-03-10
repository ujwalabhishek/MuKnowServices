<?php require_once('includes/head.php') ?>



<body>



    <div id="wrapper">



        <?php require_once('includes/nav.php') ?>

        <?php //print_r($tbldata);?>



        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h2 class="page-header"><i class="fa fa-money" id="sidemenuicon"></i> <?php echo project_name . ' ' . $lang_menu_addsubscription; ?></h2>

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

                            <!--<?php echo $lang_menu_addsubscription . " List"; ?>-->

                            <div style="float:right;"><a role="button"  class="align-left" title="Add Subscription"><button type="button"  data1="builder_0" class="model_form1 btn smile-primary animated bounceIn">Add <?php echo $lang_menu_addsubscription; ?> <i class="fa fa-plus" style="color:#FFF;"></i></button></a></div>

                        </div>



                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>                                        
                                    <!--<th>ID</th>-->
                                    <th>Subscription Name</th>
                                    <th>Description</th>
                                    <th>Price (MMK)</th>
                                    <th>Validity</th> 
                                    <th>Created On</th> 
                                    </thead>

                                    <?php foreach ($subscription as $subscript) {
                                        ?>
                                        <tr>
                                            <!--<td><?php echo $subscript->id; ?></td>-->
                                            <td><?php echo $subscript->name; ?></td>
                                            <td><?php echo $subscript->description; ?></td>
                                            <td><?php echo $subscript->price; ?></td>
                                            <td><?php echo $subscript->validity; ?></td>
                                            <td><?php echo $subscript->created_on; ?></td>
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
                    <h4 class="modal-title"><i class="icon-paragraph-justify2"></i>Add <?php echo $lang_menu_addsubscription; ?> </h4>
                </div>
                <!-- Form inside modal -->
                <?php echo form_open_multipart(site_url() . 'admin/Dashboard_subscription/add_subscription', 'id="cat_form1"  enctype="multipart/form-data"  onsubmit="return myFunction()"'); ?>
                <div class="modal-body with-padding">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>* Subscription Name :</label><span style="color:#194c83"><i>(For Example - WD@EC#ED)</i></span>
                                <input type="text" id="name" name="name" class="form-control required" maxlength="100" value="">
                            </div>
                        </div>
                    </div> 
                    <p id="err_name" style="color:red; margin-top:-10px;"></p>
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
                            <div class="col-sm-12">
                                <label>* Description :</label>
                                <input type="text" id="description" name="description" class="form-control required" maxlength="200" value="">
                            </div>
                        </div>
                    </div> 
                    <p id="err_description" style="color:red; margin-top:-10px;"></p>

                    <div class="form-group">
                        <div class="row">
                            <div class="">
                                <div class="col-md-12"><label>* Validity :</label></div>

                                <div class="col-md-6">
                                    <select name="duration" id="duration" class="form-control required" onChange="changecat(this.value);">
                                        <option value="">--- Please Select ---</option>
                                        <option value="days">Days</option>
                                        <option value="week">Week</option>
                                        <option value="month">Month</option>
                                        <option value="year">Year</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <select name="total" id="total" class="form-control required">
										<option value="" disabled selected>Select</option>
									</select>
                                </div>

                            </div>
                        </div>
                    </div> 
                    <p id="err_validity" style="color:red; margin-top:-10px;"></p>



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
				'aaSorting': [[4, 'desc']]
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
            var name, price, description, total, duration, err_name, err_price, err_description, err_validity;

            // Get the value of the input field with id="numb"
            name = document.getElementById("name").value;
            price = document.getElementById("price").value;
            description = document.getElementById("description").value;
            total = document.getElementById("total").value;
            duration = document.getElementById("duration").value;
			
			var pattern=/^([A-Z]{2})+[\W]([A-Z]{2})+[\W]([A-Z]{2})/;

            if (name === '') {
                err_name = "Please Enter Subscription Name.";
                document.getElementById("err_name").innerHTML = err_name;
                document.getElementById("name").focus();
                document.getElementById("err_price").innerHTML = '';
                document.getElementById("err_description").innerHTML = '';
                document.getElementById("err_validity").innerHTML = '';
                return false;
            }
			
			if(!pattern.test(name)){         
				err_name = "Please Enter Valid Subscription Name.";
                document.getElementById("err_name").innerHTML = err_name;
                document.getElementById("name").focus();
                document.getElementById("err_price").innerHTML = '';
                document.getElementById("err_description").innerHTML = '';
                document.getElementById("err_validity").innerHTML = '';
                return false;
			}
	
            if (name.length < 5 || name.length > 20) {
                err_name = "Please Enter Subscription Name Between 5 to 20 Character.";
                document.getElementById("err_name").innerHTML = err_name;
                document.getElementById("name").focus();
                document.getElementById("err_price").innerHTML = '';
                document.getElementById("err_description").innerHTML = '';
                document.getElementById("err_validity").innerHTML = '';
                return false;
            }

            if (price === '') {
                err_price = "Please Enter Price for Subscription.";
                document.getElementById("err_price").innerHTML = err_price;
                document.getElementById("price").focus();
                document.getElementById("err_name").innerHTML = '';
                document.getElementById("err_description").innerHTML = '';
                document.getElementById("err_validity").innerHTML = '';
                return false;
            }

            if (description === '') {
                err_description = "Please Enter Desscription.";
                document.getElementById("err_description").innerHTML = err_description;
                document.getElementById("description").focus();
                document.getElementById("err_name").innerHTML = '';
                document.getElementById("err_price").innerHTML = '';
                document.getElementById("err_validity").innerHTML = '';
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
                document.getElementById("err_name").innerHTML = '';
                document.getElementById("err_price").innerHTML = '';
                document.getElementById("err_description").innerHTML = '';
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

