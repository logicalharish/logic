<div id="headerbar">
    <div class="headerbar-item">
        <div class="row">
            <div class="form-group col-xs-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Jobwork Information</div>
                    <div class="panel-body">
                        <form id="frm_jobwork" method="POST" action="<?php echo base_url() . $controller . '/save' ?>" >
                            <div class="form-group col-md-4">
                                <label for=""> Customer Name  </label>
                                <select class="form-control simple-select" name="customer" id="customer">
                                    <option value="">Select Customer</option>
                                    <?php
                                    foreach ($customerData as $value) {
                                        $sel = '';
                                        echo '<option value="' . $value['id'] . '" ' . $sel . '>' . $value['firstname'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""> Product Name  </label>
                                <select class="form-control simple-select" name="product" id="product">
                                    <option value="">Select Product</option>
                                    <?php
                                    foreach ($productData as $value) {
                                        $sel = '';
                                        echo '<option value="' . $value['id'] . '" ' . $sel . '>' . $value['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""> Job Details  </label>
                                <input type="text" name="job_desc" id="job_desc" class="form-control" value="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""> Unit  </label>
                                <input type="text" name="unit" id="unit" class="form-control" value="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""> Unit Type  </label>
                                <?php
                                    echo $strUnitTypeCombo;
                                ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""> Status  </label>
                                <?php
                                    echo $strStatusCombo;
                                ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""> Finished Product  </label>
                                <select class="form-control simple-select" name="finished_product" id="finished_product">
                                    <option value="">Select Finished Product</option>
                                    <?php
                                    foreach ($productData as $value) {
                                        $sel = '';
                                        echo '<option value="' . $value['id'] . '" ' . $sel . '>' . $value['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""> Finished_Unit  </label>
                                <input type="text" name="finished_unit" id="finished_unit" class="form-control" value="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""> Finished Unit Type  </label>
                                <?php
                                    echo $strFinishedUnitTypeCombo;
                                ?>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="btn-group btn-group-sm pull-right">
                                    <input type="hidden" name="form_action_id" id="form_action_id" value=""/>
                                    <button type="button" id="btn_actionJobWork" name="btn_actionJobWork" class="btn btn-success ajax-loader" value="1">
                                        <i class="fa fa-check"></i>Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h1 class="headerbar-title">Jobwork Info</h1>
    <!-- <div class="headerbar-item pull-right">
        <div class="btn-group btn-group-sm">
            <a href="<?php echo site_url() . $controller . "/add"; ?>" ><button id="btn-submit" name="btn_submit" class="btn btn-success ajax-loader" value="1">
                    <i class="fa fa-check"></i>Add</button></a>
        </div>
    </div> -->
</div>
<div id="content" class="">
    <table class="table table-bordered table-striped table-hover dataTable js-exportable table-responsive" id="manageTbls">
        <thead>
                <tr>    
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Jobwork Details</th>
                    <th>Unit</th>
                    <th>Unit Type</th>
                    <th>Finished Product</th>
                    <th>Finished Unit</th>
                    <th>Finished Unit Type</th>
                    <th>Jobwork date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
        </thead>
    </table>
</div>

<!-- dataTables js -->
<script src="assets/jquery-datatable/jquery.dataTables.js"></script>
<script src="assets/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="assets/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="assets/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="assets/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="assets/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="assets/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="assets/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="assets/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<script type="text/javascript">

    $('#manageTbls').css("clear", "both");
//Exportable table
//$('.js-exportable').DataTable({
//    dom: '<"top"fl>rt<"bottom"iBp><"clear">',
//    buttons: [
//        'csv', 'excel'
////        'copy', 'csv', 'excel', 'pdf', 'print'
//    ]
//});


    var site_url = "<?php echo site_url(); ?>";
    var controller = "<?php echo $controller; ?>";
    var ajax_table = [];
    $(document).ready(function () {
        $('#btnSearch').click(function () {
            ajax_table.fnDraw();
        });
        getData();
    
        $('#btn_actionJobWork').unbind('click').click(function(){
            $('#frm_jobwork').submit();
        });
    });
    function searchData()
    {

        ajax_table.fnDraw();
    }
    function getData() {

        ajax_table = $("#manageTbls").dataTable({
            "processing": true,
            "serverSide": true,
            "bFilter": true,
            "sAjaxSource": "view",
            "responsive": true,
            "fnServerData": function (sSource, aoData, fnCallback, oSettings) {
                //aoData.push({'name':'AdvertiserID','value':$('#AdvertiserID').val()},{'name':'EndDate','value':$("#EndDate").val()});
                aoData.push({'name': 'month', 'value': $('#current_month').val()});


                $.ajax({
                    "dataType": 'json',
                    "type": "POST",
                    "url": site_url + controller + "/view",
                    "data": aoData,
                    "headers": {'X-CSRF-TOKEN': ''},
                    "success": fnCallback
                });
            },
            "retrieve": true,
            "paging": true,
            "pageLength": 10,
            "ColumnDefs": [
                {"name": "Action", "targets": 2},
                {"width": "1%", "name": "product_id", "targets": 4, "orderable": false},
                {"width": "1%", "name": "customer_id", "targets": 4, "orderable": false},
                {"width": "1%", "name": "job_desc", "targets": 4, "orderable": false},
                {"width": "1%", "name": "unit", "targets": 4, "orderable": false},
                {"width": "1%", "name": "unit_type", "targets": 4, "orderable": false},
                {"width": "1%", "name": "finished_product_id", "targets": 4, "orderable": false},
                {"width": "1%", "name": "finished_unit", "targets": 4, "orderable": false},
                {"width": "1%", "name": "finished_unit_type", "targets": 4, "orderable": false},
                {"width": "1%", "name": "status", "targets": 4, "orderable": false},
                {"width": "1%", "name": "updated", "targets": 4, "orderable": false}
            ],
            "aoColumns": [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,                
                {"sClass": "edit-delet-action"}
            ],
            oLanguage: {
                sProcessing:$('.fullpage-loader').show()
            },
            "fnInfoCallback": function (oSettings, iStart, iEnd, iMax, iTotal, sPre) {
                $("#row_count").text(iTotal);


                if (iTotal == 0)
                {
                    iStart = 0;
                }

                $('.edit_row').unbind('click').click(function(){
                    var intId = $(this).data('rowid');
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: site_url + controller + '/getEditData/' + intId,
                        success: function (data) {
                            if(parseInt(data.id) > 0){
                                $('#form_action_id').val(data.id);

                                $('#customer').val(data.customer_id).trigger('change');
                                $('#product').val(data.product_id).trigger('change');
                                $('#job_desc').val(data.job_desc);
                                $('#unit').val(data.unit);
                                $('#unit_type').val(data.unit_type).trigger('change');
                                $('#finished_product').val(data.finished_product_id).trigger('change');
                                $('#finished_unit').val(data.finished_unit);
                                $('#finished_unit_type').val(data.finished_unit_type).trigger('change');
                                $('#status').val(data.status).trigger('change');
                                $('html, body').animate({ scrollTop: 0 }, 'fast');
                            }
                        },
                        error: function(xhr, textStatus, errorThrown){
                           alert('request failed');
                        }
                    });
                });
                $('.delete_row').unbind('click').click(function(){
                    var intId = $(this).data('rowid');
                    if(confirm('Are You Sure Delete Record!')){
                        window.location.href = site_url + controller + "/delete/" + intId;
                    }
                });
                $('.sel_row_status').change(function(){
                    var intId = $(this).data('rowid');
                    var selectedVal = $(this).find("option:selected").val();
                    if(selectedVal != ''){
                        if(confirm('Are You Sure Change Status!')){
                            window.location.href = site_url + controller + "/updateStatus/" + intId + "/"+selectedVal;
                        }
                    }
                });

                return 'Showing ' + iStart + ' to ' + iEnd + ' of ' + iTotal + ' entries';
            }


        });
    };
</script>
