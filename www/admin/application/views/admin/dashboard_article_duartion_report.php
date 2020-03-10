<?php require_once('includes/croppage_header.php') ?>
<?php require_once('includes/loader.php') ?>
<link href="<?php echo base_url() ?>assets/bower_components/graph/test/jquery-ui.structure.min.css" rel="stylesheet" />
<body>
    <div class="modal modal_load" style="display: none">
        <div class="center">
            <div class="loader"></div>

        </div>
    </div>

    <div id="wrapper">

        <?php require_once('includes/nav.php') ?>

        <div id="page-wrapper">



            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-sitemap fa-fw" id="sidemenuicon"></i> Time spend on Article Report </h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <?php if ($this->session->flashdata('message')) { ?>
                <div class="alert alert-success fade in block-inner">            
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="icon-checkmark-circle"></i> <?php echo $this->session->flashdata('message') ?> 
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger fade in block-inner">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="icon-checkmark-circle"></i> <?php echo $this->session->flashdata('error') ?> 
                </div>
            <?php } ?>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <?php $tab = (isset($_GET['tab'])) ? $_GET['tab'] : null; ?> 
                    <?php if (!empty($_GET['tab'])): ?>
                        <ul class="nav nav-tabs">
                            <?php if (!$this->ion_auth->is_contributor()): ?>
                                <li class="<?php echo ($tab == 'tab1') ? 'active' : ''; ?>"><a data-toggle="tab" href="#tab1"> <?php echo $lang_pendingarticles; ?></a>
                                </li>
                            <?php endif; ?>
    <!--                                <li class="<?php echo ($tab == 'tab2') ? 'active' : ''; ?>"><a data-toggle="tab" href="#tab2" ><?php echo $lang_approvedarticles; ?></a>
            </li>
            <li class="<?php echo ($tab == 'tab3') ? 'active' : ''; ?>"><a data-toggle="tab" href="#tab3" ><?php echo $lang_createarticle; ?></a>
            </li>-->
                        </ul>
                    <?php else: ?>
                        <ul class="nav nav-tabs" id="articlenav">

                            <li class="active"><a data-toggle="tab" href="#tab1"> Time spend Report</a>
                            </li>

                            <!--                                <li class=""><a data-toggle="tab" href="#tab2" >Article Report</a>
                                                            </li>
                                                            <li class=""><a data-toggle="tab" href="#tab3" >Article Report</a>
                                                            </li>-->
                        </ul>
                    <?php endif; ?>

                    <div class="panel panel-default">
                        <div id="tab-content" class="tab-content">
                            <div id="tab1" class="tab-pane fade in active"><!-- tab1 start-->

                                <div id="resizable" style="height: 500px;">
                                    <div id="chartContainer1" style="height: 100%; width: 100%;"></div>
                                </div>

                                <div id="chartContainer" style="height: 500px; width: 100%;">
                                </div>
                                <!-- /.row -->

                                <div class="col-lg-12">
                                    <h2 class="page-header">Detailed time Spend  Report </h2>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="font-weight:bold;font-size:17px;">
                                                Users Details
                                            </div>
                                            <!-- /.panel-heading -->
                                            <div class="panel-body">
                                                <div class="dataTable_wrapper">
                                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                        <thead>
                                                            <tr>
                                                                <th>Sl.No.</th>
                                                                <th>Name</th>
                                                                <th>Mobile No.</th>
                                                                <th>User Type</th>
                                                                <th>Time Spend</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            //echo "<pre>";
                                                            ///  print_r($register_user);exit();
                                                            if (isset($register_user) && count($register_user)):
                                                                $i = 1;
                                                                foreach ($register_user as $row) {
                                                                    //  print_r($row);exit();
                                                                    ?>

                                                                    <tr class="odd gradeX">
                                                                        <td><?php echo $i; ?></td>
                                                                        <td><?php echo ucfirst($row['username']) ?></td>
                                                                        <td><?php echo $row['telcode'] . $row['phone'] ?></td>
                                                                        <td><?php echo ucfirst($row['user_type']) ?></td>

                                                                        <td class="center">  

                                                                            <i style="color:#398439" > <strong><?php echo date('H:i:s', mktime(0, 0, $row['y'])) . ''; ?></strong></i>


                                                                        </td>
                                                                        <td>                                                                                                        
                                                                                 <a  href="<?php echo site_url(); ?>admin/Dashboard_articleview_report/indvidualuser_articleview/<?php echo $row['id']; ?>" title="View" class="tip"><i  class="fa fa-eye" title="View"></i></a>

                                                                        </td>




                                                                    </tr>
                                                                    <?php
                                                                    $i++;
                                                                }
                                                            endif;
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
                                    <!-- /.col-lg-12 -->
                                </div>
                                <!-- /.row -->

                            </div><!--tab1 ends-->

                            <div id="tab2" class="tab-pane fade">
                                <h1>ggdgdfgf<h1>
                                        </div>

                                        <div id="tab3" class="tab-pane fade">
                                        </div>




                                        </div>
                                        </div>
                                        </div>
                                        </div> <!-- /.row -->



                                        </div> <!-- /#page-wrapper -->
                                        </div> <!-- /#wrapper -->

                                        <!-- jQuery -->
                                        <script type="text/javascript" src="<?php echo base_url() ?>assets/bower_components/graph/test/jquery-1.11.1.js"></script>
                                        <script type="text/javascript" src="<?php echo base_url() ?>assets/bower_components/graph/test/jquery-ui.min.js"></script>
                                        <script type="text/javascript" src="<?php echo base_url() ?>assets/bower_components/graph/jquery.canvasjs.min.js"></script>
                                        <script type="text/javascript" src="<?php echo base_url() ?>assets/bower_components/graph/canvasjs.min.js"></script>
                                <!--        <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>-->
                                        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>

                                        <!-- Bootstrap Core JavaScript -->
                                        <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

                                        <!-- Metis Menu Plugin JavaScript -->

                                        <script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

                                        <script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>


                                        <!-- DataTables JavaScript -->
                                        <script src="<?php echo base_url(); ?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
                                        <script src="<?php echo base_url(); ?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
                                        <script src="<?php echo base_url(); ?>assets/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>

                                        <!-- Custom Theme JavaScript -->
                                        <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>

                                        <!-- Page-Level Demo Scripts - Tables - Use for reference -->

                                        <!-- tags related script start here-->

                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular.min.js"></script>
                                        <script src="<?php echo base_url(); ?>assets/dist/bootstrap-tagsinput.min.js"></script>
                                        <script src="<?php echo base_url(); ?>assets/dist/bootstrap-tagsinput-angular.min.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/rainbow.min.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/generic.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/html.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/javascript.js"></script>
                                        <script src="<?php echo base_url(); ?>assets/tags/app.js"></script>
                                        <script src="<?php echo base_url(); ?>assets/tags/app_bs3.js"></script>
                                        <!-- Tags related script ends here -->
                                        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/ckeditor/ckeditor.js"></script>
                                        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/forms/wysihtml5/wysihtml5.min.js"></script>
                                        <script src="<?php echo site_url() ?>assets/js/jquery.Jcrop.js"></script>



                                        <script>
                                            $(document).ready(function () {
                                                $('#dataTables-example').DataTable({
                                                    responsive: true,
                                                    //'columnDefs': [{'orderable': false, 'targets': 6}], // hide sort icon on this column
                                                    //  'aaSorting': [[3, 'desc']] // start to sort data on this column
                                                });
                                                window.onload = function () {


                                                    //Better to construct options first and then pass it as a parameter
                                                    var arrayOfPHPData = <?php echo $invidual_user_report_json ?>;
                                                    var options1 = {
                                                        title: {
                                                            text: "Total Time Spend By the Individual User Report."
                                                        },
                                                        axisX: {
                                                            title: "Users",
                                                            interval: 1,
                                                        },
                                                        axisY: {
                                                            title: "Seconds Spend.",
                                                            interval: <?php echo $interval ?>,
                                                        },
                                                        animationEnabled: true,
                                                        data: [
                                                            {
                                                                type: "column", //change it to line, area, bar, pie, etc

                                                                name: "Proven Oil Reserves (bn)",
                                                                dataPoints: arrayOfPHPData
                                                            }
                                                        ]
                                                    };

                                                    $("#resizable").resizable({
                                                        create: function (event, ui) {
                                                            //Create chart.
                                                            $("#chartContainer1").CanvasJSChart(options1);
                                                        },
                                                        resize: function (event, ui) {
                                                            //Update chart size according to its container's size.
                                                            $("#chartContainer1").CanvasJSChart().render();
                                                        }
                                                    });
                                                    var chart = new CanvasJS.Chart("chartContainer",
                                                            {
                                                                title: {
                                                                    text: "Total Time Spend By the Individual User Report."
                                                                },
                                                                animationEnabled: true,
                                                                axisX: {
                                                                    title: "Users",
                                                                    titleFontColor: "rgb(0,75,141)",
                                                                    //valueFormatString: "DD-MMM" ,
                                                                    interval: 1,
                                                                    //intervalType: "day",
                                                                    labelAngle: -50,
                                                                    labelFontColor: "rgb(0,75,141)",
                                                                    minimum: 0
                                                                },
                                                                axisY: {
                                                                    title: "Seconds Spend.",
                                                                    interlacedColor: "#F0FFFF",
                                                                    tickColor: "azure",
                                                                    titleFontColor: "rgb(0,75,141)",
                                                                    valueFormatString: "",
                                                                    interval: <?php echo $interval ?>,
                                                                },
                                                                data: [
                                                                    {
                                                                        indexLabelFontColor: "darkSlateGray",
                                                                        name: 'views',
                                                                        type: "area",
                                                                        color: "rgba(0,75,141,0.7)",
                                                                        markerSize: 10,
                                                                        dataPoints: arrayOfPHPData

                                                                    }

                                                                ]
                                                            });

                                                    chart.render();
                                                }


                                               

                                            });
                                        </script>

                                      <?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

