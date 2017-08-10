<div id="headerbar">
    <h1 class="headerbar-title">Ledger Statement</h1>
    <div class="headerbar-item pull-right">
        <div class="btn-group btn-group-sm">
            <a href="<?php echo site_url() . $controller . "/add"; ?>" ><button id="btn-submit" name="btn_submit" class="btn btn-success ajax-loader" value="1">
                    <i class="fa fa-check"></i>Add</button></a>
        </div>
    </div>
</div>
<div id="content" class="table-responsive">
    <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="manageTbls">
        <thead>
                <tr>    
                        <th>Mode</th>
                        <th>User</th>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Transactional Type</th>
                        <th>Cheque / NEFT</th>
                        <th>Journal Name</th>
                        <th>Amount</th>
                        <th>Balance</th>
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

    var site_url = "<?php echo site_url(); ?>";
    var controller = "<?php echo $controller; ?>";
    var ajax_table = [];
    $(document).ready(function () {
        $('#btnSearch').click(function () {
            ajax_table.fnDraw();
        });
        getData();
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
                {"width": "18%", "name": "id", "targets": 1},
                {"width": "8%", "name": "user_id", "targets": 3, "orderable": false},
                {"width": "1%", "name": "order_id", "targets": 4, "orderable": false},
                {"width": "1%", "name": "date", "targets": 4, "orderable": false},
                {"width": "1%", "name": "type", "targets": 4, "orderable": false},
                {"width": "8%", "name": "check_neft", "targets": 3, "orderable": false},
                {"width": "1%", "name": "journal", "targets": 4, "orderable": false},
                {"width": "1%", "name": "amount", "targets": 4, "orderable": false},
                {"width": "1%", "name": "balance", "targets": 4, "orderable": false},
                {"width": "1%", "name": "status", "targets": 4, "orderable": false}
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
                return 'Showing ' + iStart + ' to ' + iEnd + ' of ' + iTotal + ' entries';
            }
        });
    };
</script>
    