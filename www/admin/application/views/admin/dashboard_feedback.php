<?php require_once('includes/head.php') ?>



<body>



    <div id="wrapper">



        <?php require_once('includes/nav.php') ?>

        <?php //print_r($tbldata);?>

 <div id="form_modal1" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
               
                <!-- Form inside modal -->
                <div class="modal-body with-padding">


                    <div class="form-group"> 
                        Please contact to this mobile number
                       <input type="text" class="mobstyl" value="" id="mobno" readonly="readonly">
                    </div>         



                </div>            
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning closebtn" data-dismiss="modal">Close</button>
                   
                </div>
            </div>
        </div>
    </div>

        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h2 class="page-header"><i class="fa fa-codepen" id="sidemenuicon"></i> <?php echo $lang_feedback; ?></h2>

                    <?php if ($this->session->flashdata('message')) { ?>
                        <div class="alert alert-success"> 
                            <button type="button" class="close" data-dismiss="alert">Ã—</button>		
                            <?php echo $this->session->flashdata('message') ?>
                        </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger fade in block-inner"> 
                            <button type="button" class="close" data-dismiss="alert">Ã—</button>		
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

                        <div class="panel-heading table-responsive topbarheader">

                            <!--<?php //echo $lang_menu_promocode . " List"; ?>-->

<!--                            <div style="float:right;"><a role="button"  class="align-left" title="Add Promocode"><button type="button"  data1="builder_0" class="model_form1 btn smile-primary animated bounceIn">Add <?php echo $lang_menu_promocode; ?> <i class="fa fa-plus" style="color:#FFF;"></i></button></a></div>-->

                        </div>



                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>                                        
                                    <th>ID</th>
                                    <th>Username</th>
                                      <th>Mobile</th>
                                    <th>Feedback / Query</th>
                                    <th>Created On</th> 
                                    <th>Contacts</th> 
                                    </thead>

                                    <?php foreach ($feedback as $feed) {
                                        ?>
                                        <tr>
                                            <td><?php echo $feed->id; ?></td>
                                            <td><?php echo $feed->username; ?></td>
                                            <td><?php echo $feed->phone; ?></td>
                                            <td><?php echo $feed->feedback; ?></td> 
                                            <td><?php echo $feed->created_on; ?></td>
                                            <td><?php if(!empty($feed->email)){ ?>
                                            <a href="#" title="Email"  value="<?php echo $feed->email;?>" id="email_reply" class="tip"><i class="fa fa-envelope fa-fw" title="View"></i></a>
                                            <?php } 
                                            else { ?>
                                                <button type="button"  class="model_form1" rel="<?php echo $feed->phone; ?>"><i class="fa fa-mobile"></i></button>
                                          <?php  }?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                              



                                </table>

                                <form id="form-id" method="post" action="<?php echo base_url('index.php/admin/Dashboard_send_mail/index');?>">
                            <input type="hidden" name="email" id="emailrep" value="">
                            </form>          

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
        
          $(document).on('click', '#email_reply', function () { 
            var email = $(this).attr('value');  
            
            $("#emailrep").val(email);
            $('#form-id').submit();

   
        });
        
                $(document).on('click', '.model_form1', function () {
                      var mobile = $(this).attr('rel');  
            
            $("#mobno").val(mobile);
                                                                                                                                                                                                        $('#form_modal1').modal({
                                                                                                                                                                                                        keyboard: false,
                                                                                                                                                                                                        show: true,
                                                                                                                                                                                                        backdrop: 'static'
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

<?php?>