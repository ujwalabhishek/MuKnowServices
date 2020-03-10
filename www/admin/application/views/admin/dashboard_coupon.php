<?php require_once('includes/head.php') ?>



<body>



    <div id="wrapper">



        <?php require_once('includes/nav.php') ?>

        <?php //print_r($tbldata);?>



        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h2 class="page-header"><i class="fa fa-codepen" id="sidemenuicon"></i> <?php echo project_name . ' ' . $lang_menu_promocode; ?></h2>

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

                            <!--<?php echo $lang_menu_promocode . " List"; ?>-->

                            <div style="float:right;"><a role="button"  class="align-left" title="Add Promocode"><button type="button"  data1="builder_0" class="model_form1 btn smile-primary animated bounceIn">Add <?php echo $lang_menu_promocode; ?> <i class="fa fa-plus" style="color:#FFF;"></i></button></a></div>

                        </div>



                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>                                        
                                    <!--<th>ID</th>-->
                                    <th>Promocode</th>
                                    <th>Start Date</th>
                                    <th>Expiry Date</th>
                                    <th>Created On</th> 
                                    </thead>

                                    <?php foreach ($coupon as $coup) {
                                        ?>
                                        <tr>
                                           <!-- <td><?php echo $coup->id; ?></td>-->
                                            <td><?php echo $coup->name; ?></td>
                                            <td><?php echo $coup->start_date; ?></td>
                                            <td><?php echo $coup->end_date; ?></td>
                                            <td><?php echo $coup->created_on; ?></td>
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
                    <h4 class="modal-title"><i class="icon-paragraph-justify2"></i>Add <?php echo $lang_menu_promocode; ?> </h4>
                </div>
                <!-- Form inside modal -->
                <?php echo form_open_multipart(site_url() . 'admin/Dashboard_coupon/add_coupon', 'id="cat_form1"  enctype="multipart/form-data"  onsubmit="return myFunction()"'); ?>
                <div class="modal-body with-padding">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>* Promo Code :</label>
                                <input type="text" id="code" name="code" class="form-control required" maxlength="50" value="">
                            </div>
                        </div>
                    </div> 
                    <p id="err_code" style="color:red; margin-top:-10px;"></p>
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
                                <label>* Start Date:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control required" maxlength="100" value="" onkeydown="return false">
                            </div>
                        </div>
                    </div> 
                    <p id="err_start_date" style="color:red; margin-top:-10px;"></p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>* Expiry Date: <span style="color:#194c83; font-size:11px;">(Note :- 5 Days After Start Date)</span></label>
                                <input type="date" id="expiry_date" name="expiry_date" class="form-control required" maxlength="100" value="" onkeydown="return false">
                            </div>
                        </div>
                    </div>
                    <p id="err_expiry_date" style="color:red; margin-top:-10px;"></p>



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
				'aaSorting': [[3, 'desc']]
            });
        });

        $(document).on('click', '.model_form1', function () {
            $('#form_modal1').modal({
                keyboard: false,
                show: true,
                backdrop: 'static'
            });
        });

        $(function () {
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            //alert(maxDate);
            $('#start_date').attr('min', maxDate);
            $('#expiry_date').attr('min', maxDate);
        });

    </script>

    <script>

        function myFunction() {
            var code, start_date, expiry_date, err_code, err_start_date, err_expiry_date;

            // Get the value of the input field with id="numb"
            code = document.getElementById("code").value;
            start_date = document.getElementById("start_date").value;
            expiry_date = document.getElementById("expiry_date").value;
			
			var dtToday = new Date(start_date);
            dtToday.setDate(dtToday.getDate() + 4);

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var check_date = year + '-' + month + '-' + day;

            if (code === '') {
                err_code = "Please Enter Promocode";
                document.getElementById("err_code").innerHTML = err_code;
                document.getElementById("code").focus();
                document.getElementById("err_start_date").innerHTML = '';
                document.getElementById("err_expiry_date").innerHTML = '';
                return false;
            }
            if (code.length < 5 || code.length > 10) {
                err_code = "Please Enter Promocode between 5 to 10 Characters";
                document.getElementById("err_code").innerHTML = err_code;
                document.getElementById("code").focus();
                document.getElementById("err_start_date").innerHTML = '';
                document.getElementById("err_expiry_date").innerHTML = '';
                return false;
            }
            if (start_date === '') {
                err_start_date = "Please Select Promocode Start Date";
                document.getElementById("err_start_date").innerHTML = err_start_date;
                document.getElementById("start_date").focus();
                document.getElementById("err_code").innerHTML = '';
                document.getElementById("err_expiry_date").innerHTML = '';
                return false;
            }
            if (expiry_date === '') {
                err_expiry_date = "Please Enter Promocode Expiry Date";
                document.getElementById("err_expiry_date").innerHTML = err_expiry_date;
                document.getElementById("expiry_date").focus();
                document.getElementById("err_code").innerHTML = '';
                document.getElementById("err_start_date").innerHTML = '';
                return false;
            }
            if (expiry_date <= start_date) {
                err_expiry_date = "Please Enter Promocode Expiry Date After Start Date";
                document.getElementById("err_expiry_date").innerHTML = err_expiry_date;
                document.getElementById("expiry_date").focus();
                document.getElementById("err_code").innerHTML = '';
                document.getElementById("err_start_date").innerHTML = '';
                return false;
            }
			if (expiry_date <= check_date) {
                err_expiry_date = "Please Enter Promocode Expiry Date 5 Days After Start Date";
                document.getElementById("err_expiry_date").innerHTML = err_expiry_date;
                document.getElementById("expiry_date").focus();
                document.getElementById("err_code").innerHTML = '';
                document.getElementById("err_start_date").innerHTML = '';
                return false;
            }

            return true;



        }
    </script>


</body>



</html>

