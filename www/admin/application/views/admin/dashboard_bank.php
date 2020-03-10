<?php require_once('includes/head.php') ?>



<body>



    <div id="wrapper">



        <?php require_once('includes/nav.php') ?>

        <?php //print_r($tbldata);?>



        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h2 class="page-header"><i class="fa fa-codepen" id="sidemenuicon"></i> <?php echo project_name . ' ' . 'Bank Details'; ?></h2>

                    <?php if ($this->session->flashdata('message')) { ?>
                        <div class="alert alert-success"> 
                            <button type="button" class="close" data-dismiss="alert">×</button>		
                            <?php echo $this->session->flashdata('message') ?>
                        </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger fade in block-inner"> 
                            <button type="button" class="close" data-dismiss="alert">×</button>		
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

<!--                        <div class="panel-heading table-responsive">

                            <?php echo " List"; ?>

                            <div style="float:right;"><a role="button"  class="align-left" title="Add Promocode"><button type="button"  data1="builder_0" class="model_form1 btn smile-primary animated bounceIn">Add <?php echo $lang_menu_promocode; ?> <i class="fa fa-plus" style="color:#FFF;"></i></button></a></div>

                        </div>-->



                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>                                        
                                    <th>ID</th>
                                    <th>Bank1</th>
                                    <th>Bank2</th>
                                    <th>Bank3</th>
                                    <th>Created On</th> 
                                    <th><?php echo $lang_action; ?></th>
                                    </thead>

                                    <?php foreach ($coupon as $coup) {
                                        ?>
                                        <tr>
                                            <td><?php echo $coup->id; ?></td>
                                            <td><?php echo $coup->bank1; ?></td>
                                            <td><?php echo $coup->bank2; ?></td>
                                            <td><?php echo $coup->bank3; ?></td>
                                            <td><?php echo $coup->created_on; ?></td>
                                            <td><a   title="View" class="tip model_form1"><i  class="fa fa-pencil" title="Edit"></i></a></td>
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
                <?php echo form_open_multipart(site_url() . 'admin/Dashboard_bank/edit_coupon', 'id="cat_form1"  enctype="multipart/form-data"  '); ?>
                <div class="modal-body with-padding">

                  
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>* Account Holder Name :</label>
                                <input type="text" id="account_holder_name" name="account_holder_name" class="form-control required"  value="<?php if(!empty($bank->account_holder_name)) echo $bank->account_holder_name;?>">
                            </div>
                        </div>
                    </div> 
                    <p id="err_account" style="color:red; margin-top:-10px;"></p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>* Bank1 :</label>
                                <input type="text" id="bank1" name="bank1" class="form-control required"  value="<?php if(!empty($bank->bank1)) echo $bank->bank1;?>">
                            </div>
                        </div>
                    </div> 
                    <p id="err_bank1" style="color:red; margin-top:-10px;"></p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>* Bank2 :</label>
                                <input type="text" id="bank2" name="bank2" class="form-control required"  value="<?php if(!empty($bank->bank2)) echo $bank->bank2;?>">
                            </div>
                        </div>
                    </div> 
                    <p id="err_bank2" style="color:red; margin-top:-10px;"></p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>* Bank3 :</label>
                                <input type="text" id="bank3" name="bank3" class="form-control required"  value="<?php if(!empty($bank->bank3)) echo $bank->bank3;?>">
                            </div>
                        </div>
                    </div> 
                    <p id="err_bank3" style="color:red; margin-top:-10px;"></p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>* Account1 :</label>
                                <input type="text" id="account1" name="account1" class="form-control required"  value="<?php if(!empty($bank->account1)) echo $bank->account1;?>">
                            </div>
                        </div>
                    </div> 
                    <p id="err_account1" style="color:red; margin-top:-10px;"></p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>* Account2 :</label>
                                <input type="text" id="account2" name="account2" class="form-control required"  value="<?php if(!empty($bank->account2)) echo $bank->account2;?>">
                            </div>
                        </div>
                    </div> 
                    <p id="err_account2" style="color:red; margin-top:-10px;"></p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>* Account3 :</label>
                                <input type="text" id="account3" name="account3" class="form-control required"  value="<?php if(!empty($bank->account3)) echo $bank->account3;?>">
                            </div>
                        </div>
                    </div> 
                    <p id="err_account3" style="color:red; margin-top:-10px;"></p>
                     <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>* Helpline :</label>
                                <input type="text" id="helpline" name="helpline" class="form-control required"  value="<?php if(!empty($bank->helpline)) echo $bank->helpline;?>">
                            </div>
                        </div>
                    </div> 
                    <p id="err_helpline" style="color:red; margin-top:-10px;"></p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>* Amount :</label>
                                <input type="text" id="amount" name="amount" class="form-control required"  value="<?php if(!empty($bank->amount)) echo $bank->amount;?>">
                            </div>
                        </div>
                    </div> 
                    <p id="err_amount" style="color:red; margin-top:-10px;"></p>
                   



                </div>   
                 </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning closebtn" data-dismiss="modal">Close</button>
                    <span id="add">
                        <button type="submit" class="btn btn-primary subbtn" id="add_submit">Submit</button>
                    </span><!-- 
                    <span id="edit">

                      <button type="submit" class="btn btn-primary" id="update_city" >Update Categories</button>
                    </span> -->
                </div>
               
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
                "pagingType": "full_numbers"
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

          $(document).on('click', '#add_submit', function () {
            var account_holder_name, bank1, bank2, bank3,account1,account2,account3,helpline,amount, err_account, err_bank1,err_bank2,err_bank3,err_account1,err_account2,err_account3,err_helpline,err_amount;

            // Get the value of the input field with id="numb"
            account_holder_name = document.getElementById("account_holder_name").value;
            bank1 = document.getElementById("bank1").value;
            bank2 = document.getElementById("bank2").value;
            bank3 = document.getElementById("bank3").value;
            account1 = document.getElementById("account1").value;
            account2 = document.getElementById("account2").value;
            account3 = document.getElementById("account3").value;
            helpline = document.getElementById("helpline").value;
            amount = document.getElementById("amount").value;
			
		

            if (account_holder_name === '') {
                err_code = "Please Enter Account Holder Name";
                document.getElementById("err_account").innerHTML = err_code;
                document.getElementById("account_holder_name").focus();
                document.getElementById("err_start_date").innerHTML = '';
                document.getElementById("err_expiry_date").innerHTML = '';
                return false;
            }
            
            if (bank1 === '') {
                err_bank1 = "Please Enter Bank1";
                document.getElementById("err_bank1").innerHTML = err_bank1;
                document.getElementById("bank1").focus();
                document.getElementById("err_code").innerHTML = '';
                document.getElementById("err_expiry_date").innerHTML = '';
                return false;
            }
            if (bank2 === '') {
                err_expiry_date = "Please Enter Bank2";
                document.getElementById("err_bank2").innerHTML = err_bank2;
                document.getElementById("bank2").focus();
                document.getElementById("err_code").innerHTML = '';
                document.getElementById("err_start_date").innerHTML = '';
                return false;
            }
            if (bank3 === '') {
                err_expiry_date = "Please Enter Bank3";
                document.getElementById("err_bank3").innerHTML = err_bank3;
                document.getElementById("bank3").focus();
                document.getElementById("err_code").innerHTML = '';
                document.getElementById("err_start_date").innerHTML = '';
                return false;
            }
            if (account1 === '') {
                err_expiry_date = "Please Enter Account1";
                document.getElementById("err_account1").innerHTML = err_account1;
                document.getElementById("account1").focus();
                document.getElementById("err_code").innerHTML = '';
                document.getElementById("err_start_date").innerHTML = '';
                return false;
            }
            if (account2 === '') {
                err_expiry_date = "Please Enter Account1";
                document.getElementById("err_account2").innerHTML = err_account2;
                document.getElementById("account2").focus();
                document.getElementById("err_code").innerHTML = '';
                document.getElementById("err_start_date").innerHTML = '';
                return false;
            }
             if (account3 === '') {
                err_expiry_date = "Please Enter Account3";
                document.getElementById("err_account3").innerHTML = err_account3;
                document.getElementById("account3").focus();
                document.getElementById("err_code").innerHTML = '';
                document.getElementById("err_start_date").innerHTML = '';
                return false;
            }
              if (helpline === '') {
                err_expiry_date = "Please Enter Helpline";
                document.getElementById("err_helpline").innerHTML = err_helpline;
                document.getElementById("helpline").focus();
                document.getElementById("err_code").innerHTML = '';
                document.getElementById("err_start_date").innerHTML = '';
                return false;
            }
            if (amount === '') {
                err_expiry_date = "Please Enter Amount";
                document.getElementById("err_amount").innerHTML = err_amount;
                document.getElementById("amount").focus();
                document.getElementById("err_code").innerHTML = '';
                document.getElementById("err_start_date").innerHTML = '';
                return false;
            }
            else {    
                 $("#cat_form1").submit();
            }
            

            return true;



       });
    </script>


</body>



</html>

