
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
                        <div class="panel-heading">Account Information</div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="user_name"> product_code  </label>
                                <input type="text" name="product_code" id="product_code" class="form-control"  value="<?php echo (isset($arrData->product_code) ? $arrData->product_code : ''); ?>" required="">
                                <div class="pcode"></div>
                            </div>

                            <div class="form-group">
                                <label for="user_company"> description </label>
                                <input type="text" name="description" id="description" class="form-control" value="<?php echo (isset($arrData->description) ? $arrData->description : ''); ?>" required="">
                            </div>

                            <div class="form-group">
                                <label for="user_company"> unit </label>
                                <!--<input type="text" name="unit" id="unit" class="form-control" value="<?php echo (isset($arrData->unit) ? $arrData->unit : ''); ?>" required="">-->
                                <select name="unit" id="unit"  class="form-control simple-select">
                                    <option value="">Select Unit</option>
                                    <?php
                                    foreach ($units as $unit) {
                                        $sel = "";
                                        if ($unit == $arrData->unit) {
                                            $sel = "selected";
                                        }
                                        echo '<option value=' . $unit . ' ' . $sel . '>' . $unit . '</option>';
                                    }
                                    ?>
                                </select>
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

        $(document).on("blur", "#product_code", function () {
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