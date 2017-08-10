
<form id="form_validation" method="POST" action="<?php echo base_url() . $controller . '/save' ?>">

    <div id="headerbar">
        <h1 class="headerbar-title"><?php echo $title;?></h1>
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
            <div class="col-xs-12 col-md-12">


                <div id="userInfo">
                    <input type="hidden" name="id" value="<?php echo (isset($arrData->id) ? $arrData->id : ''); ?>" id="id"/>
                    <input type="hidden" name="formmode" value="<?php echo (isset($formMode) ? $formMode : ''); ?>" id="formmode"/>
                    <div id="administrator_fields">
                        <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <h4 class="col-sm-6">Member Information </h4>
<!--                            <div class="col-sm-6 clearfix">
                                    <label for="user_site" class="col-sm-4"> <strong>Balance</strong> </label>
                                    <input type="text" name="price" id="price" class="col-sm-8 balance"  value="<?php echo (isset($arrData->price) ? $arrData->price : ''); ?>" required="">
                            </div>-->
                        </div>

                        <div class="panel-body">
                            <div class="form-group col-md-4 col-sm-6">
                                <label for="user_name"> Type  </label>
                                <select name="type" id="type"  class="form-control simple-select">
                                    <option value="">Select Type</option>
                                    <?php
                                    foreach ($userType as $type) {
                                        $sel = "";
                                        if ($type == $arrData->type) {
                                            $sel = "selected";
                                        }
                                        echo '<option value=' . $type . ' ' . $sel . '>' . $type . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="form-group col-md-4 col-sm-6">
                                <label for="user_name"> First Name <span class="text-danger">*</span>  </label>
                                <input type="text" name="firstname" id="firstname" class="form-control"  value="<?php echo (isset($arrData->firstname) ? $arrData->firstname : ''); ?>" required="">
                            </div>

                            <div class="form-group col-md-4 col-sm-6">
                                <label for="user_name"> Last Name  <span class="text-danger">*</span></label>
                                <input type="text" name="lastname" id="lastname" class="form-control"  value="<?php echo (isset($arrData->lastname) ? $arrData->lastname : ''); ?>" required="">
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label for="user_email"> Email Address  <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control"  value="<?php echo (isset($arrData->email) ? $arrData->email : ''); ?>" required="">
                            </div>
                            
                            <div class="form-group col-md-4 col-sm-6">
                                <label for="user_company"> Primary Contact <span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="phone" class="form-control" value="<?php echo (isset($arrData->phone) ? $arrData->phone : ''); ?>" required="">
                            </div>
                            
                            <div class="form-group col-md-4 col-sm-6">
                                <label for="user_company"> Secondary Contact </label>
                                <input type="text" name="phone2" id="phone2" class="form-control" value="<?php echo (isset($arrData->phone2) ? $arrData->phone2 : ''); ?>">
                            </div>
                            
                            <div class="form-group col-md-4 col-sm-6">
                                <label for="user_company"> Website </label>
                                <input type="text" name="website" id="website" class="form-control" value="<?php echo (isset($arrData->website) ? $arrData->website : ''); ?>">
                            </div>
                            
                            <div class="form-group col-md-4 col-sm-6">
                                <label class="form-label">status</label>
                                <?php echo $strStatusCombo; ?>
                            </div>
                            
<!--                            <div class="form-group col-md-4 col-sm-6">
                                <label for="user_company"> Balance Limit(Unlimited) </label><br>
                                <input type="radio" name="limit" id="limit" value="1" <?php echo isset($arrData->limit) ? ($arrData->limit == '1') ? 'checked' : '' : ''; ?>>Yes 
                                <input type="radio" name="limit" id="limit" value="0" <?php echo isset($arrData->limit) ? ($arrData->limit == '0') ? 'checked' : '' : 'checked'; ?> >No 
                            </div>-->
                            
                        </div>

                    </div>

                    <div id="administrator_fields">
                        

                        <div class="panel panel-default">

                            <div class="panel-heading"><h4>Address Information</h4></div>

                            <div class="panel-body clearfix">
                                
                                <div class="form-group col-sm-12">
                                    <label for="user_site"> Address <span class="text-danger">*</span></label>
                                    <textarea name="address" id="address" class="form-control" required=""><?php echo (isset($arrData->address) ? $arrData->address : ''); ?></textarea>
                                </div>

                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="user_site"> City <span class="text-danger">*</span></label>
                                    <input type="text" name="city" id="city" class="form-control"  value="<?php echo (isset($arrData->city) ? $arrData->city : ''); ?>" required="">
                                </div>

                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="user_site"> State <span class="text-danger">*</span></label>
                                    <input type="text" name="state" id="state" class="form-control"  value="<?php echo (isset($arrData->state) ? $arrData->state : ''); ?>" required="">
                                </div>

                                <div class="form-group col-md-4 col-sm-4">
                                    <label for="user_site"> Pin Code <span class="text-danger">*</span></label>
                                    <input type="text" name="pincode" id="pincode" class="form-control"  value="<?php echo (isset($arrData->pincode) ? $arrData->pincode : ''); ?>" required="">
                                </div>
                            </div>

                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading"><h4>Taxes Information</h4></div>

                                <div class="panel-body clearfix">
                                    <!-- <div class="form-group">
                                        <label for="user_site"> Balance </label>
                                        <input type="text" name="price" id="price" class="form-control"  value="<?php echo (isset($arrData->price) ? $arrData->price : ''); ?>" required="">
                                    </div> -->
                                    
                                    <div class="form-group col-md-4 col-sm-6">
                                        <label for="user_site"> TIN Number  </label>
                                        <input type="text" name="tin_no" id="tin_no" class="form-control"  value="<?php echo (isset($arrData->tin_no) ? $arrData->tin_no : ''); ?>"  >
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6">
                                        <label for="user_site"> GSTN ID </label>
                                        <input type="text" name="gstn" id="gstn" class="form-control"  value="<?php echo (isset($arrData->gstn) ? $arrData->gstn : ''); ?>">
                                    </div>
                                    
                                    <div class="form-group col-md-4 col-sm-6">
                                        <label for="user_site"> PAN </label>
                                        <input type="text" name="pan" id="pan" class="form-control"  value="<?php echo (isset($arrData->pan) ? $arrData->pan : ''); ?>">
                                    </div>
                                    
                                    <div class="form-group col-md-4 col-sm-6">
                                        <label for="user_site"> VAT TIN </label>
                                        <input type="text" name="vat_tin" id="vat_tin" class="form-control"  value="<?php echo (isset($arrData->vat_tin) ? $arrData->vat_tin : ''); ?>">
                                    </div>
                                    
                                    <div class="form-group col-md-4 col-sm-6">
                                        <label for="user_site"> CST Registration No. </label>
                                        <input type="text" name="cst" id="cst" class="form-control"  value="<?php echo (isset($arrData->cst) ? $arrData->cst : ''); ?>">
                                    </div>
                                    
                                    <div class="form-group col-md-4 col-sm-6">
                                        <label for="user_site"> CIN </label>
                                        <input type="text" name="cin" id="cin" class="form-control"  value="<?php echo (isset($arrData->cin) ? $arrData->cin : ''); ?>" >
                                    </div>
                                    
                                    <div class="form-group col-md-4 col-sm-6">
                                        <label for="user_site"> Excise Registration No. </label>
                                        <input type="text" name="excise_number" id="excise_number" class="form-control"  value="<?php echo (isset($arrData->excise_number) ? $arrData->excise_number : ''); ?>">
                                    </div>
                                    
                                    <div class="form-group col-md-4 col-sm-6">
                                        <label for="user_site"> Service Tax Registration No. </label>
                                        <input type="text" name="service_tax_number" id="service_tax_number" class="form-control"  value="<?php echo (isset($arrData->service_tax_number) ? $arrData->service_tax_number : ''); ?>" >
                                    </div>
                                    
                                    <div class="form-group hidden col-md-4 col-sm-6">
                                        <label for="user_site"> LBT Registration No. </label>
                                        <input type="text" name="lbt_number" id="lbt_number" class="form-control"  value="<?php echo (isset($arrData->lbt_number) ? $arrData->lbt_number : ''); ?>">
                                    </div>
                                </div>
                        </div>

                    </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

</form>


<script type="text/javascript">
$(document).ready(function() {    
    $(document).on("click", ".backPage", function () {
        window.location.href = '<?php echo base_url() . $controller;?>';
    });
});
</script>