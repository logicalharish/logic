
<form id="form_validation" method="POST" action="<?php echo base_url() . $controller . '/save' ?>">

    <div id="headerbar">
        <h1 class="headerbar-title"><?php echo $title; ?></h1>
        <div class="headerbar-item pull-right">
            <div class="btn-group btn-group-sm">
                <button  class="btn btn-success ajax-loader" type="submit">
                    <i class="fa fa-check"></i> Save </button>
                <button class="btn btn-danger backPage">
                    <i class="fa fa-times"></i> Cancel </button>
            </div>
        </div>
    </div>

    <div id="content">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">


                <div id="userInfo">
                    <input type="hidden" name="id" value="<?php echo (isset($arrData->id) ? $arrData->id : ''); ?>" id="id"/>
                    <input type="hidden" name="formmode" value="<?php echo (isset($formMode) ? $formMode : ''); ?>" id="formmode"/>

                    <div class="panel panel-default">
                        <div class="panel-heading">Product Information</div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="user_name"> product Name  </label>
                                <input type="text" name="name" id="name" class="form-control"  value="<?php echo (isset($arrData->name) ? $arrData->name : ''); ?>" required="">
                                <div class="pcode"></div>
                            </div>

                            <div class="form-group">
                                <label for="user_company"> Product Price </label>
                                <input type="text" name="price" id="price" class="form-control" value="<?php echo (isset($arrData->price) ? $arrData->price : ''); ?>" required="">
                            </div>

                            <div class="form-group">
                                <label class="form-label">status</label>
                                <?php echo $strStatusCombo; ?>
                            </div>

                        </div>

                    </div>



                </div>

            </div>
        </div>
    </div>

</form>


<script type="text/javascript">
    $(document).ready(function () {
        var site_url = "<?php echo base_url(); ?>";
        var controller = "<?php echo $controller; ?>";


        $(document).on("click", ".backPage", function () {
            window.location.href = '<?php echo base_url() . $controller; ?>';
        });

        $(document).on("blur", "#name", function () {
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
                        $("#product_code").val('');
                    } else {
                        $(".pcode").removeClass('alert alert-danger').html('');
                    }
                }
            });

        });
    });
</script>