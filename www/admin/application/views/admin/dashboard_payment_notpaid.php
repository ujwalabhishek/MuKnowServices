<?php require_once('includes/head.php')?>



<body>



    <div id="wrapper">

        

    <?php require_once('includes/nav.php')?>

<?php //print_r($paymentdata);?>



        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header"><?php echo $page_title; ?></h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default  table-responsive">

                        <div class="panel-heading  table-responsive">

                            <?php echo "List of ".$page_title; ?>

                                <table style="float:right; margin-top:-4px;">

                                    <tr><td>From : &nbsp;&nbsp;</td><td> <input type="date" id="fromDate" class="form-control input-sm"></td>

                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;To : &nbsp;&nbsp;</td><td> <input type="date" id="toDate" class="form-control input-sm"></td></tr>

                                </table>

                        </div>

                       

                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>SI No.</th>

                                            <th>Order No.</th>

                                            <th>Transaction ID</th>

                                            <th>Seller Name</th>

                                            <th>Buyer Name</th>

                                            <th>Total Price</th>

                                            <th>Order Date</th>
							
					    <th>Order Status</th>

                                            <th>Update</th>

                                            <th>Order Details</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php 

                                        $counter = 0;

                                        if( !empty($paymentdata) ) {

                                        foreach ($paymentdata as $payment) {

                                         

                                            ?>

                                        <tr class="odd gradeX">

                                            <td><?php echo ++$counter;?></td>

                                            <td><?php echo $payment['order_uniq_id'];?></td>

                                            <td><?php echo $payment['transaction_id']; ?></td>

                                            <td><?php echo $payment['seller_name']; ?></td>

                                            <td><?php echo $payment['buyer_name']; ?></td>

                                            <td class="center"><?php echo $payment['total_price']; ?></td>

                                            <td class="center"><?php echo $payment['created_at']; ?></td>

					    <td><?php if($payment['order_status'] == 'payment_success') { echo 'Payment Success'; } elseif($payment['order_status'] == 'delivery_fail') { echo 'Delivery Fail'; }else { echo ucfirst($payment['order_status']); } ?></td>

                                            <td class="center"><button type="button" onclick="location.href='<?php echo base_url();?>admin/Dashboard_payment/update_paid/<?php echo $payment['order_id']; ?>'"class="btn btn-outline btn-success btn-xs">Pay Now</button></td>

                                            <td class="center"><button type="button" onclick="location.href='<?php echo base_url();?>admin/Dashboard_payment/notpaid_details/<?php echo $payment['order_id']; ?>'" class="btn btn-primary btn-xs">Order Details</button></td>

                                        </tr>

                                        <?php

                                        }}

                                        ?>

                                        

                                    </tbody>

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



    <script>

    $(document).ready(function(){

        $('#dataTables-example').dataTable();

    });

    

    </script>

        

    <script>

             $.fn.dataTableExt.afnFiltering.push(

                function( oSettings, aData, iDataIndex ) 

            {

               

               

                var fromDateG = document.getElementById('fromDate').value;

                var toDateG = document.getElementById('toDate').value;

                

                fromDateG=fromDateG.substring(6,10) + fromDateG.substring(3,5)+ fromDateG.substring(0,2);

                toDateG=toDateG.substring(6,10) + toDateG.substring(3,5)+ toDateG.substring(0,2);

 

		var datoffromDateG=aData[6].substring(6,10) + aData[6].substring(3,5)+ aData[6].substring(0,2);

                var datoftoDateG=aData[6].substring(6,10) + aData[6].substring(3,5)+ aData[6].substring(0,2);

            

         

                if ( fromDateG === "" && toDateG === "" )

                {

                    return true;

                }

                else if ( fromDateG <= datoftoDateG && toDateG === "")

                {

                    return true;

                }

                else if ( toDateG >= datoftoDateG && fromDateG === "")

                {

                    return true;

                }

                else if (fromDateG <= datoffromDateG && toDateG >= datoftoDateG)

                {

                    return true;

                }

                return false;

            }

            );



            var table = $('#dataTables-example').DataTable();

            // Add event listeners to the two range filtering inputs

            $('#fromDate').change( function() { table.draw(); } );

            $('#toDate').change( function() { table.draw(); } );

    

    </script>

    

</body>



</html>

