<!-- Form modal view -->
<div id="form_modal_view" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="panel panel-default modal-content">
            <div class=" modal-header btn-primary" style="background-color:#ed1c24;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> <span>Article</span> View Details </h4>
            </div>
            <!-- Form inside modal -->
            <?php echo form_open_multipart(site_url() . '/admin/dashbord_category/add_edit', 'id="cat_form" class=".validate"'); ?>
            <div class="modal-body with-padding">
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Sl.No.</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>                                                               
                                    <th>Total duration</th>
                                    <th>Date</th>
                                   
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                //echo "<pre>";
                                // print_r($article_view);exit();
                                if (isset($article_view) && count($article_view)):
                                    $i = 1;
                                    foreach ($article_view as $row) {
                                        //  print_r($row);exit();
                                        ?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo  $row->start_time;?></td>

                                            <td><?php echo $row->end_time; ?></td>

                                            <td class="center">  

                                                <i style="color:#398439" > <strong><?php echo $row->total_duration ; ?></strong></i>


                                            </td>
                                              <td><?php echo $row->created_on; ?></td>
                                           



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


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning closebtn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    <!-- /form modal view -->