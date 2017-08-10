<style>
    .form-inline .form-control {
        display: inline-block;
        vertical-align: middle;
        width: 100%;
    }
</style>


<div id="headerbar">
    <h1 class="headerbar-title">Products Info</h1>
    <div class="headerbar-item pull-right">
        <div class="btn-group btn-group-sm">
            <button  class="btn btn-success addID">
                <i class="fa fa-check"></i> Add </button>
        </div>
    </div>
</div>
<div id="content" class="table-responsive">
    <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="manageTbls">
        <thead>
                <tr>    
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Product HSN Code</th>
                        <th>UOM</th>
                        <th>Product Qty</th>
                        <th>Product Weight(Grams)</th>
                        <th>Product Status</th>
                        <th>Action</th>
                </tr>
        </thead>
        <tbody>
                <?php 
                foreach ($productList as $product) { ?>
                    <tr id="<?php echo 'srno_'.$product['id'];?>">
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['code']; ?></td>
                        <td><?php echo $product['hsn_code']; ?></td>
                        <td><?php echo $product['uom']; ?></td>
                        <td><?php echo $product['qty']; ?></td>
                        <td><?php echo $product['weight']; ?></td>
                        <td><?php echo $product['status']; ?></td>
                        <td> <a href="javascript:void(0);" class="editID" srno ="<?php echo $product['id'];?>" > <i class="material-icons">mode_edit</i> </a> 
                            <a href="javascript:void(0);"  srno="<?php echo $product['id'];?>" class="delID" /><i class="material-icons">delete_forever</i> </a>
                    </tr>
                <?php } ?>
        </tbody>
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

$('#manageTbls').dataTable({});
$('#manageTbls').css("clear", "both");

var site_url = "<?php echo site_url(); ?>";
var controller = "<?php echo $controller; ?>";
    
    
$(document).ready(function () {    
    
    
    $(document).on("click",".editID",function(){
        var srno = $(this).attr('srno');
        $.ajax({
            url: site_url + controller + '/editProduct/'+srno,
            type: 'POST',
            async: false,
            cache: false,
            success: function (data) {
                $('#defaultModal').modal('show');
                $('#defaultModal .modal-content').html(data);
                productAdd();
            }
        });
    });
    
    $(document).on("click",".addID",function(){
        $.ajax({
            url: site_url + controller + '/editProduct/',
            type: 'POST',
            async: false,
            cache: false,
            success: function (data) {
                $('#defaultModal').modal('show');
                $('#defaultModal .modal-content').html(data);
                var value = $("#uom option:selected").val();
                if(value == ''){
                    $("#weight").prop('disabled',true);
                    $("#qty").prop('disabled',true);
                }
                productAdd();
            }
        });
    });
    
    $(document).on("click",".delID",function(){
        $('#fullpage-loader').show();
        var srno = $(this).attr('srno');
        $.ajax({
            url: site_url +controller+'/delete/'+  srno,
            success: function (data) {
                $("#srno_"+srno).remove();
                $('#fullpage-loader').hide();
            }
        });
    });
    
    $(document).on("blur", "#code", function () {
        var code = $(this).val();
        $.ajax({
            url: site_url + controller + "/checkProductCode",
            type: 'POST',
            data: {code: code},
            success: function (data) {
                var res = JSON.parse(data);
                if (res.action == '1')
                {
                    $(".pcode").addClass('alert alert-danger').html('Duplicate Product Code');
                    $("#code").val('');
                } else {
                    $(".pcode").removeClass('alert alert-danger').html('');
                }
            }
        });

    });
    
    
    
    $(document).on("change","#uom",function(){
        var value = $("#uom option:selected").val();
        if(value == ''){
            $("#weight").prop('disabled',true);
            $("#qty").prop('disabled',true);
        }
        if(value == 'PC'){
            $("#weight").prop('disabled',true);
            $("#qty").prop('disabled',false);
        }
        if(value == 'KG'){
            $("#weight").prop('disabled',false);
            $("#qty").prop('disabled',true);
        }
    });
    
    
});    


function productAdd(){
    
    $("form#productAdd").submit(function () {
        var formData = $("#productAdd").serialize();
        $('#fullpage-loader').show();
        $.ajax({
            url: site_url + controller + '/save',
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                $('#fullpage-loader').hide();
                $('#defaultModal').modal('hide');
                
                window.location.href = site_url + controller ;
            }
        });

        return false;
    });
}
</script>
