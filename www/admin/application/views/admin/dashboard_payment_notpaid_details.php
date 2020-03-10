<?php require_once('includes/head.php')?>



<body>



    <div id="wrapper">

        

    <?php require_once('includes/nav.php')?>

<?php //print_r($tbldata);?>



        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header"><?php echo "Order No. : ".$paymentdata->order_uniq_id; ?></h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            <?php echo "Details of Order No. : ".$paymentdata->order_uniq_id; ?>

                            <div style="float:right; margin-top:-7px;"><button type="button" onclick="location.href='<?php echo base_url();?>admin/dashboard_payment/notpaid'" class="btn btn-primary">Back</button></div>

                        </div>

                        

                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>Seller Name : </th><td><?php echo $paymentdata->seller_name; ?></td>

                                        </tr>

                                        <tr>

                                            <th>Buyer Name : </th><td><?php echo $paymentdata->buyer_name; ?></td>

                                        </tr>

                                        <tr>

                                            <th>Email : </th><td><?php echo $paymentdata->email; ?></td>

                                        </tr>

                                        <tr>

                                            <th>Gender : </th><td><?php echo $paymentdata->gender; ?></td>

                                        </tr>

                                        <tr>

                                            <th>Paypal Email : </th><td><?php if($paymentdata->paypal_email == ''){?> <button type="button" class="btn btn-primary disabled">N/A</button> <?php } else {echo $paymentdata->paypal_email; }?></td>

                                        </tr>

                                        <tr>

                                            <th>NRIC No. : </th><td><?php if($paymentdata->nric_num == ''){?> <button type="button" class="btn btn-primary disabled">N/A</button> <?php } else {echo $paymentdata->nric_num; }?></td>

                                        </tr>

                                        <tr>

                                            <th>Mobile No. : </th><td><?php echo $paymentdata->mobile_no; ?></td>

                                        </tr>

                                        <tr>

                                            <th>Country : </th><td><?php if($paymentdata->country == ''){?> <button type="button" class="btn btn-primary disabled">N/A</button> <?php } else {echo $paymentdata->country; }?></td>

                                        </tr>

                                        <tr>

                                            <th>A/C No. : </th><td><?php if($paymentdata->account_number == ''){?> <button type="button" class="btn btn-primary disabled">N/A</button> <?php } else {echo $paymentdata->account_number; }?></td>

                                        </tr>

                                        <tr>

                                            <th>A/C Type : </th><td><?php if($paymentdata->account_type == ''){?> <button type="button" class="btn btn-primary disabled">N/A</button> <?php } else {echo $paymentdata->account_type; }?></td>

                                        </tr>

                                        <tr>

                                            <th>Bank Name : </th><td><?php if($paymentdata->bank_name == ''){?> <button type="button" class="btn btn-primary disabled">N/A</button> <?php } else {echo $paymentdata->bank_name; }?></td>

                                        </tr>

                                        <tr>

                                            <th>A/C Holder Name : </th><td><?php if($paymentdata->account_name == ''){?> <button type="button" class="btn btn-primary disabled">N/A</button> <?php } else {echo $paymentdata->account_name; }?></td>

                                        </tr>

                                        <tr>

                                            <th>Total Price : </th><td><?php echo $paymentdata->total_price; ?></td>

                                        </tr>

                                        <tr>

                                            <th>Product Type : </th><td><?php echo $paymentdata->product_type; ?></td>

                                        </tr>

                                        <tr>

                                            <th>Delivery Type : </th><td><?php if($paymentdata->delivery_type == 'self_collect'){ echo "Self Collect"; } else {echo $paymentdata->delivery_type; }?></td>

                                        </tr>

					<tr>

                                            <th>Order Status : </th><td><?php if($paymentdata->delivery_status == 'payment_success'){ echo 'Payment Success';} elseif($paymentdata->delivery_status == 'delivery_fail'){ echo 'Delivery Fail';} else { echo ucfirst($paymentdata->delivery_status); } ?></td>

                                        </tr>

                                        <tr>

                                            <th>Delivery Time : </th><td><?php echo $paymentdata->delivery_datetime; ?></td>

                                        </tr>

                                        <tr>

                                            <th>Delivery Fail Reason : </th><td><?php if($paymentdata->deliveryfail_reason == ''){?> <button type="button" class="btn btn-primary disabled">N/A</button> <?php } else {echo $paymentdata->deliveryfail_reason; }?></td>

                                        </tr>

                                        <tr>

                                            <th>Reject Reason : </th><td><?php if($paymentdata->reject_reason == ''){?> <button type="button" class="btn btn-primary disabled">N/A</button> <?php } else {echo $paymentdata->reject_reason; }?></td>

                                        </tr>

                                        <tr>

                                            <th>Created At : </th><td><?php echo $paymentdata->created_at; ?></td>

                                        </tr>

                                        

                                        

                                    </thead>

                                    

                                      

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

 <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>



    <!-- Bootstrap Core JavaScript -->

    <script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>



    <!-- Metis Menu Plugin JavaScript -->

    <script src="<?php echo base_url();?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>



    <!-- DataTables JavaScript -->

    <script src="<?php echo base_url();?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo base_url();?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <script src="<?php echo base_url();?>assets/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>

    

    <!-- Custom Theme JavaScript -->

    <script src="<?php echo base_url();?>assets/dist/js/sb-admin-2.js"></script>



   

    

</body>



</html>

