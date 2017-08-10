<link rel="stylesheet" href="<?php echo base_url();?>assets/core/css/jquery.autocomplete.css">
<style>
    input[type="text"], .table>thead>tr>th,.table>thead>tr>th, .table>thead>tr>td, .table>tbody>tr>th, .table>tbody>tr>td, .table>tfoot>tr>th, .table>tfoot>tr>td{
        padding: 0px 2px;
    }
    .rate,.uom{
        width: 30px;
    }

    table .form-control{
        border-radius: 0;
		 text-transform: uppercase;
    }
    
    .form-inline .form-control {
    display: inline-block;
    vertical-align: middle;
    width: 100%;
	  text-transform: uppercase;
}
.pricing_detail .form-inline .form-control {
    padding: 10px;
    margin-bottom: 10px;
}
</style>
<form id="form_validation" method="POST" action="<?php echo base_url() . $controller . '/save' ?>" >

    <div id="headerbar">
        <h1 class="headerbar-title"><?php echo $title; ?></h1>
        <div class="headerbar-item pull-right">
			<div class="btn-group btn-group-sm">
			<?php if($arrData->id)
			{?>
            
                <button  class="btn btn-primary ajax-loader" type="button">
					
					<a href="<?php echo site_url() ."invoices/printInvoice/$arrData->id"  ?>" target="_blank" style="text-decoration: none; color: #FFF"><i class="fa fa-print"></i> Print </a></button>
			<?php }?>
                <button  class="btn btn-success ajax-loader" type="submit">
					
                    <i class="fa fa-check"></i> Save </button>
                <a class="btn btn-danger backPage">
                    <i class="fa fa-times"></i> Cancel </a>
            </div>
        </div>
    </div>

    <div id="content">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div id="userInfo">
                    <input type="hidden" name="id" value="<?php echo (isset($arrData->id) ? $arrData->id : ''); ?>" id="id"/>
                    <input type="hidden" name="formmode" value="<?php echo (isset($formMode) ? $formMode : ''); ?>" id="formmode"/>


                    <div class="form-group col-xs-12 col-md-5">
                        <div class="panel panel-default">
                            <div class="panel-heading">Account Information</div>
                            <div class="panel-body">

                                <div class="form-group col-md-6">
                                    <label for="user_name"> Customer Name  </label>
                                    <select class="form-control simple-select" name="customers" id="customers">
                                        <option value="">Select Customer</option>
                                        <?php
                                        foreach ($customerData as $value) {
                                            $sel = '';
                                            if ($customerData[0]['firstname'] == $value['firstname']) {
                                                $sel = 'selected';
                                            }
                                            echo '<option value="' . $value['id'] . '" ' . $sel . '>' . $value['firstname'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="user_company"> Address </label>
                                    <input type="text" name="address" id="address" class="form-control" value="<?php echo (isset($customerData[0]['address']) ? $customerData[0]['address'] : ''); ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="user_company"> State </label>
                                    <input type="text" name="state" id="state" class="form-control" value="<?php echo (isset($customerData[0]['state']) ? $customerData[0]['state'] : ''); ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="user_email"> State Code </label>
                                    <input type="text" name="pincode" id="pincode" class="form-control"  value="<?php echo (isset($customerData[0]['pincode']) ? $customerData[0]['pincode'] : ''); ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="user_site"> GSTIN Number </label>
                                    <input type="text" name="gstn" id="gstn" class="form-control"  value="<?php echo (isset($customerData[0]['gstn']) ? $customerData[0]['gstn'] : ''); ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="user_site"> PAN Number </label>
                                    <input type="text" name="pan" id="pan" class="form-control"  value="<?php echo (isset($customerData[0]['pan']) ? $customerData[0]['pan'] : ''); ?>">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Invoice Information</div>

                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="form-group col-md-4">
                                        <label for="user_company"> Bill Book</label>
                                        <input type="text" name="bill_book" id="bill_book" class="form-control " value="<?php echo (isset($arrData->bill_book) ? $arrData->bill_book : ''); ?>" required="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="user_company"> Invoice No </label>
                                        <input type="text" name="invoice_number" id="invoice_number" class="form-control " value="<?php echo (isset($arrData->invoice_number) ? $arrData->invoice_number : ''); ?>" required="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="user_company"> Invoice Date </label>
                                        <input type="text" name="invoice_date" id="invoice_date" class="form-control datepicker" value="<?php echo (isset($arrData->invoice_date) ? $arrData->invoice_date : date('m/d/Y')); ?>" required="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group col-md-6">
                                        <label for="user_company"> Chalan No</label>
                                        <input type="text" name="chalan_no" id="chalan_no" class="form-control" value="<?php echo (isset($arrData->chalan_no) ? $arrData->chalan_no : ''); ?>" required="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="user_company"> Chalan Date </label>
                                        <input type="text" name="chalan_date" id="chalan_date" class="form-control datepicker" value="<?php echo (isset($arrData->chalan_date) ? $arrData->chalan_date : date('m/d/Y')); ?>" required="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group col-md-6">
                                        <label for="user_company"> PO Number </label>
                                        <input type="text" name="po_number" id="po_number" class="form-control" value="<?php echo (isset($arrData->po_number) ? $arrData->po_number : ''); ?>" required="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="user_company"> PO Date </label>
                                        <input type="text" name="po_date" id="po_date" class="form-control datepicker" value="<?php echo (isset($arrData->po_date) ? $arrData->po_date : date('m/d/Y')); ?>" required="">
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">Transport Information</div>

                            <div class="panel-body">

                                <div class="form-group col-md-6">
                                    <label for="user_company">Transport</label>
                                    <input type="text" name="transport" id="transport" class="form-control " value="<?php echo (isset($arrData->transport) ? $arrData->transport : ''); ?>" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="user_company"> Vehical No </label>
                                    <input type="text" name="vehical_number" id="vehical_number" class="form-control " value="<?php echo (isset($arrData->vehical_number) ? $arrData->vehical_number : ''); ?>" required="">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="user_company">Date & Time of Supply</label>
                                    <input type="text" name="date_suply" id="date_suply" class="form-control datepicker " value="<?php echo (isset($arrData->date_suply) ? $arrData->date_suply : date('m/d/Y')); ?>" required="">
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="user_company"> Place of Supply</label>
                                    <input type="text" name="place_suply" id="place_suply" class="form-control " value="<?php echo (isset($arrData->place_suply) ? $arrData->place_suply : ''); ?>" required="">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Product Details</div>

                            <div class="panel-body">
                                <div id="product">
                                    <div class="form-group col-xs-12 col-md-12 table-responsive">
                                        <table class="table table-bordered table-hover" id="tab_logic">
                                            <thead>
                                                <tr >
                                                    <th class="text-center" style="width:250px">
                                                        Description Of Goods
                                                    </th>
                                                    <th class="text-center">
                                                        HSN Code (GST)
                                                    </th>
						    <th class="text-center uom">
                                                        UOM 
                                                    </th>
                                                    <th class="text-center" style="width:80px">
                                                        Qty
                                                    </th>
                                                    <th class="text-center" style="width:80px">
                                                        Weight
                                                    </th>
                                                    
                                                    <th class="text-center" style="width:50px">
                                                        Rate 
                                                    </th>
                                                    <th class="text-center">
                                                        Total
                                                    </th>
                                                    <th class="text-center" style="width:50px">
                                                        Discount
                                                    </th>
                                                    <th class="text-center">
                                                        Taxable value
                                                    </th>
                                                    <th class="text-center rate">
                                                        GST rate
                                                    </th>
                                                    <th class="text-center">
                                                        GST
                                                    </th>
                                                   
                                                    <th class="text-center rate">
                                                        IGST rate
                                                    </th>
                                                    <th class="text-center">
                                                        IGST
                                                    </th>
                                                    <th class="text-center">
                                                        Amount
                                                    </th>
                                                    <th class="text-center">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $tblCnt =  0;
                                                $productTotal = 0;
                                                $array = [];
                                                if ($arrSubData) {
                                                    $array = $arrSubData;
                                                }
                                                foreach ($array as $key => $value) {
                                                    $productTotal += $value->final_amount;
                                                    echo "<tr id='product" . $tblCnt++ . "'>
                                                        <td>
                                                        <input type='text' value='" . $value->product_code . "' name='description[" . $key . "]' srno='" . $key . "' class='form-control prod_desc'/>
                                                        <input type='hidden' value='" . $value->product_code . "' id='product_code_" . $key . "' name='product_code[" . $key . "]' class='form-control'/>
                                                        </td>
                                                        <td>
                                                        <input type='text' name='hsn_code[" . $key . "]' id='hsn_code_" . $key . "' class='form-control' value='" . $value->hsn_code . "'/>
                                                        </td>
							<td>
                                                      		<select  name='uom[" . $key . "]' id='uom_" . $key . "'   class='form-control'><option></option><option value='KG'>KG </option><option value='PC'>PC </option></select>
                                                        </td>
                                                        <td>
                                                        <input type='text' value='" . $value->qty . "' id='qty_" . $key . "' onBlur='focusRate(" . $key . ")'    name='qty[" . $key . "]' class='form-control'/>
                                                        </td>
                                                        <td>
                                                        <input type='text' value='" . isset($value->weight) . "' id='weight_" . $key . "' onBlur='focusRate(" . $key . ")'    name='weight[" . $key . "]' class='form-control'/>
                                                        </td>
                                                        
                                                        <td>
                                                        <input type='text' value='" . $value->rate . "' id='rate_" . $key . "' onBlur='calRate(" . $key . ")' name='rate[" . $key . "]' class='form-control'/>
                                                        </td>
                                                        <td>
                                                        <input type='text' value='" . $value->total . "' id='total_" . $key . "' name='total[" . $key . "]' class='form-control'/>
                                                        </td>
                                                        <td>
                                                        <input type='text' name='discount[" . $key . "]' id='discount_" . $key . "' onBlur='taxValue(" . $key . ")'  class='form-control' value='" . $value->discount . "'/>
                                                        </td>
                                                        <td>
                                                        <input type='text' value='" . $value->taxable_value . "' id='taxable_" . $key . "'  onBlur='callCGST(" . $key . ")' name='taxable_value[" . $key . "]' class='form-control'/>
                                                        </td>
                                                        <td>
                                                        <input type='text' value='" . $value->CGST_rate . "' id='cgst_rate_" . $key . "' onBlur='callCGST(" . $key . ")' name='CGST_rate[" . $key . "]' class='form-control'/>
                                                        </td>
                                                        <td>
                                                        <input type='text' name='CGST_amount[" . $key . "]' id='cgst_amount_" . $key . "'  class='form-control' value='" . $value->CGST_amount . "'/>
                                                        
                                                        <input type='hidden' value='" . $value->SGST_rate . "' id='sgst_rate_" . $key . "'   name='SGST_rate[" . $key . "]' class='form-control'/>
                                                        
                                                        <input type='hidden' value='" . $value->SGST_amount . "' id='sgst_amount_" . $key . "'  name='SGST_amount[" . $key . "]' class='form-control'/>
                                                        </td>
                                                        <td>
                                                        <input type='text' value='" . $value->IGST_rate . "' id='igst_rate_" . $key . "' onBlur='callIGST(" . $key . ")' name='IGST_rate[" . $key . "]' class='form-control'/>
                                                        </td>
                                                        <td>
                                                        <input type='text' value='" . $value->IGST_amount . "' id='igst_amount_" . $key . "'  name='IGST_amount[" . $key . "]' class='form-control'/>
                                                        </td>
                                                        <td>
                                                        <input type='text' value='" . $value->final_amount . "' id='final_" . $key . "'  onBlur='callTAX(" . $key . ")'  name='final_amount[" . $key . "]' class='form-control'/>
                                                        </td>
                                                        <td>
                                                        <button class='btn btn-danger btn-xs delID' type='button' data-title='Delete' type='button' srno='" . $key . "' invoicelineid='" . $value->id . "'  value='Delete' name='id[]'>
                                                            <i class='material-icons'>delete_forever</i>
                                                        </button>
                                                        
                                                        </td>
                                                </tr>";
                                                }
                                                ?>
                                                <tr id='product<?php echo ($tblCnt > 0) ? $tblCnt : 1; ?>'></tr>
                                            </tbody>
                                        </table>
                                        <a id="add_row" class="btn btn-default pull-left">Add Product</a>
                                    </div>
                                </div>
                            </div>
                            <hr>

                        </div>
                    </div>

                    <div class="form-group col-xs-6 col-md-6 form-inline pricing_detail" >
                        <div class="panel panel-default">
                            <div class="panel-heading">Pricing Details</div>
                        
                        <div class="panel-body">
                            <div class="form-group col-xs-12 col-md-12">
                                <label for="inputEmail3" class="col-md-3 col-sm-6 control-label">Total in words</label>
                                <div class="col-md-9">
                                  <input type="text" name="total_words" id="total_words" class="form-control" value="<?php echo (isset($arrData->total_words) ? $arrData->total_words : ''); ?>" required="">
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="form-group col-xs-6 col-md-6  pricing_detail">
                        <div class="panel panel-default">
                            <div class="panel-heading">Pricing Details</div>

                            <div class="panel-body">
                                <div class="form-group col-xs-12 col-md-12">
                                    <label for="inputEmail3" class="col-md-3 col-sm-6 control-label">Product total</label>
                                    <div class="col-md-9">
                                        <div class="input-group  col-md-12">
                                            
                                            <input type="text" name="product_total" id="product_total" class="form-control" value="<?php echo (isset($productTotal) ? $productTotal : '0'); ?>" required="">
                                        </div>
                                    </div>
                                </div>
				<div class="form-group col-xs-12 col-md-12">
                                    <label for="inputEmail3" class="col-md-3 col-sm-6 control-label">GST total</label>
                                    <div class="col-md-9">
                                        <div class="input-group  col-md-12">
                                            
                                            <input type="text" readonly="readonly" name="gst_total" id="gst_total" class="form-control" value="<?php echo (isset($productTotal) ? $productTotal : '0'); ?>" required="">
                                        </div>
                                    </div>
                                </div>
				<div class="form-group col-xs-12 col-md-12">
                                    <label for="inputEmail3" class="col-md-3 col-sm-6 control-label">IGST total</label>
                                    <div class="col-md-9">
                                        <div class="input-group  col-md-12">
                                            
                                            <input type="text" name="igst_total" id="igst_total" readonly="readonly" class="form-control" value="<?php echo (isset($productTotal) ? $productTotal : '0'); ?>" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-12">
                                        <label for="user_company" class="col-md-3 col-sm-6 control-label"> Freight charges </label>
                                        <div class="col-md-9">
                                        <input type="text" name="freight_charges" id="freight_charges" class="form-control" value="<?php echo (isset($arrData->freight_charges) ? $arrData->freight_charges : '0'); ?>" required="">
                                        </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-12">    
                                        <label for="user_company" class="col-md-3 col-sm-6 control-label"> Loading packeges charges </label>
                                        <div class="col-md-9">
                                            <input type="text" name="loading_packeges_charges" id="loading_packeges_charges" class="form-control" value="<?php echo (isset($arrData->loading_packeges_charges) ? $arrData->loading_packeges_charges : '0'); ?>" required="">
                                        </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-12">   
                                        <label for="user_company" class="col-md-3 col-sm-6 control-label"> Insurance charges </label>
                                        <div class="col-md-9">
                                            <input type="text" name="insurance_charges" id="insurance_charges" class="form-control" value="<?php echo (isset($arrData->insurance_charges) ? $arrData->insurance_charges : '0'); ?>" required="">
                                        </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-12">
                                        <label for="user_company" class="col-md-3 col-sm-6 control-label"> Other charges</label>
                                        <div class="col-md-9">
                                            <input type="text" name="other_charges" id="other_charges" class="form-control" value="<?php echo (isset($arrData->other_charges) ? $arrData->other_charges : '0'); ?>" required="">
                                        </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-12">
                                        <label for="user_company" class="col-md-3 col-sm-6 control-label"> Invoice total </label>
                                        <div class="col-md-9">
                                            <input type="text" name="invoice_total" id="invoice_total" class="form-control" value="<?php echo (isset($arrData->invoice_total) ? $arrData->invoice_total : '0'); ?>" required="">
                                        </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-12 hidden">
                                        <label for="user_company" class="col-md-3 col-sm-6 control-label"> Electronic Reference Number </label>
                                        <div class="col-md-9">
                                            <input type="text" name="ERF" id="ERF" class="form-control" value="<?php echo (isset($arrData->ERF) ? $arrData->ERF : '0'); ?>">
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
    var site_url = "<?php echo site_url(); ?>";
    var controller = "<?php echo $controller; ?>";
    
    $(document).ready(function () {
        
        finalTotal();
        autoComplete();
        
        $(document).on("click", ".backPage", function () {
            window.location.href = '<?php echo base_url() . $controller; ?>';
        });

        $(document).on("change", "#customers", function () {
            var custID = $(this).val();
            if (custID)
            {
                $.ajax({
                    url: site_url + 'customers/getCustomerInformation/',
                    type: 'POST',
                    data: {custID: custID},
                    success: function (data) {
                        var res = JSON.parse(data);
                        $('#address').val(res[0].address + ', ' + res[0].city);
                        $('#state').val(res[0].state);
                        $('#pincode').val(res[0].pincode);
                        $('#gstn').val(res[0].gstn);
                        $('#pan').val(res[0].pan);
                    }
                });
            } else {
                $('#address').val('');
                $('#state').val('');
                $('#pincode').val('');
                $('#gstn').val('');
                $('#pan').val('');
            }
        });

        
        var i = <?php echo ($tblCnt > 0) ? $tblCnt : 1; ?>;
        $(document).on("click", "#add_row", function () {
            $('#product' + i).html("<td><input type='text' name='description[" + i + "]' srno='" + i + "' class='form-control prod_desc'/><input type='hidden' id='product_code_" + i + "' name='product_code[" + i + "]' class='form-control'/>\n\
                    <td><input id='hsn_code_" + i + "' name='hsn_code[" + i + "]' type='text' class='form-control input-md'></td>\n\
		    <td><select  id='uom_" + i + "' name='uom[" + i + "]'  onChange='calRate(" + i + ")' ><option></option><option value='KG'>KG</option><option value='PC' selected='selected'>PC</option></select></td>\n\
                    <td><input  name='qty[" + i + "]' type='text' id='qty_" + i + "'  value='0'   class='form-control input-md'></td>\n\
                    <td><input  name='weight[" + i + "]' type='text' id='weight_" + i + "'  class='form-control input-md' value='0'></td>\n\
                    <td><input  name='rate[" + i + "]' type='text' id='rate_" + i + "' onBlur='calRate(" + i + ")' class='form-control input-md'></td>\n\
                    <td><input  name='total[" + i + "]' type='text' id='total_" + i + "'  class='form-control input-md'></td>\n\
                    <td><input  name='discount[" + i + "]' type='text' id='discount_" + i + "' value='0' onBlur='taxValue(" + i + ")' class='form-control input-md'></td>\n\
                    <td><input  name='taxable_value[" + i + "]' id='taxable_" + i + "'  onBlur='callCGST(" + i + ")' type='text' class='form-control input-md'></td>\n\
                    <td><input  name='CGST_rate[" + i + "]' id='cgst_rate_" + i + "' type='text' onBlur='callCGST(" + i + ")' value='0' class='form-control input-md'></td>\n\
                    <td><input  name='CGST_amount[" + i + "]'id='cgst_amount_" + i + "' type='text' value='0' class='form-control input-md'>\n\
				<input  name='SGST_rate[" + i + "]'id='sgst_rate_" + i + "' type='hidden' value='0' class='form-control input-md'><input  name='SGST_amount[" + i + "]' id='sgst_amount_" + i + "' type='hidden' value='0' class='form-control input-md'></td>\n\
                    <td><input  name='IGST_rate[" + i + "]' id='igst_rate_" + i + "' type='text'  onBlur='callIGST(" + i + ")' value='0' class='form-control input-md'></td>\n\
                    <td><input  name='IGST_amount[" + i + "]' id='igst_amount_" + i + "' type='text' value='0' class='form-control input-md'></td>\n\
                    <td><input  name='final_amount[" + i + "]' id='final_" + i + "' type='text'  onBlur='callTAX(" + i + ")' value='0' class='form-control input-md'></td>\n\
                    <td><button type='button' class='btn btn-danger btn-xs' data-title='Delete' onClick='deleteRow(" + i + ")' ><i class='material-icons'>delete_forever</i></button></td>\n\
                    ");
            $('#tab_logic').append('<tr id="product' + (i + 1) + '"></tr>');
            i++;
            autoComplete(i);
        });

        $(".delID").click(function () {
            var id = $(this).attr('invoicelineid');
            var srno = $(this).attr('srno');
            $.ajax({
                url: site_url + controller + '/deleteInvoiceDetails/' + id,
                success: function (data) {
                    $("#product" + srno).remove();
                    finalTotal();
                }
            });
        });
    });
        
    function calRate(no)
    {

        var rate = $('#rate_' + no).val();
        var qty = $('#qty_' + no).val();
        var weight = $('#weight_' + no).val();
        var uom = $('#uom_' + no).val();
	if(uom=='KG')
	{
		var total = rate * weight;
	}
	else
	{
		var total = qty * rate;
	}
	$('#total_' + no).val(total);
        taxValue(no);
    }

    function focusRate(no)
    {
        $('#rate_' + no).focus();
    }
    function taxValue(no)
    {
        var total = $('#total_' + no).val();
        var discount = $('#discount_' + no).val();
        var total = parseFloat(total) - parseFloat(discount);
        $('#taxable_' + no).val(total);
        callCGST(no);
        callSGST(no);
        callIGST(no);

    }

    function callCGST(no)
    {
        var cgstrate = $('#cgst_rate_' + no).val();
        var taxable = $('#taxable_' + no).val();
        if (cgstrate > 0)
        {
	  var sgstrate = cgstrate/2;
		
		 $('#sgst_rate_' + no).val(sgstrate);
            var total = ((parseFloat(taxable) * parseFloat(cgstrate))) / 100;

            $('#cgst_amount_' + no).val(total);
	    callSGST(no);
        } else
        {
            $('#cgst_amount_' + no).val(0);
        }
    }

    function callSGST(no)
    {
        var sgstrate = $('#sgst_rate_' + no).val();
        var taxable = $('#taxable_' + no).val();
        if (sgstrate > 0)
        {
            var total = ((parseFloat(taxable) * parseFloat(sgstrate))) / 100;

            $('#sgst_amount_' + no).val(total);
        } else
        {
            $('#sgst_amount_' + no).val(0);
        }
    }
    function callIGST(no)
    {
        var igstrate = $('#igst_rate_' + no).val();
        var taxable = $('#taxable_' + no).val();
        if (igstrate > 0)
        {
            var total = ((parseFloat(taxable) * parseFloat(igstrate))) / 100;

            $('#igst_amount_' + no).val(total);
        } else
        {
            $('#igst_amount_' + no).val(0);
        }
    }

    function callTAX(no)
    {

        var finalAmount = 0;
        var taxable = $('#taxable_' + no).val();
        var cgst = $('#cgst_amount_' + no).val();
        var sgst = $('#sgst_amount_' + no).val();
        var igst = $('#igst_amount_' + no).val();

        finalAmount = parseFloat(taxable) + parseFloat(cgst) + parseFloat(sgst) + parseFloat(igst);

        $('#final_' + no).val(finalAmount);
        
//        var exampleInputAmount = $("#exampleInputAmount").val();
//        var total = parseFloat(finalAmount) + parseFloat(exampleInputAmount);
//        $("#exampleInputAmount").val(total);
        
        
        finalTotal();
    }

    function deleteRow(no)
    {
        $('#product' + no).remove();
        finalTotal();
    }
    
    function calcTotal()
    {
        
        var product_val = $("#product_total").val();
        var Freight_val = $("#freight_charges").val();
        var loading_val = $("#loading_packeges_charges").val();
        var insurance_val = $("#insurance_charges").val();
        var other_val = $("#other_charges").val();
        var invoiceTotal = 0;

        invoiceTotal = parseFloat(product_val) + parseFloat(Freight_val) + parseFloat(loading_val) + parseFloat(insurance_val) + parseFloat(other_val);
        $("#invoice_total").val(invoiceTotal);
        $("#total_words").val(convertNumberToWords(invoiceTotal));
            }
           
    function finalTotal()
    {
        
        var tableLength = $("#tab_logic tbody tr").length;
        
        var total = 0;
        var IGSTtotal = 0;
        var GSTtotal	 = 0;
        for(i=0; i<= tableLength; i++)
            {
            if ("undefined" === typeof $('#final_' + i).val()) {
                console.log("variable is undefined");
            }else{
                total += parseFloat($('#final_' + i).val());
                GSTtotal += parseFloat($('#cgst_amount_' + i).val());
                IGSTtotal += parseFloat($('#igst_amount_' + i).val());
				
            }
        }
           
        $("#product_total").val(parseFloat(total));
        $("#igst_total").val(parseFloat(IGSTtotal));
        $("#gst_total").val(parseFloat(GSTtotal));

        calcTotal();
        
        $(document).on("blur", "#product_total", function () {
            calcTotal();
        });
        
        $(document).on("blur", "#freight_charges", function () {
            calcTotal();
        });
           
        $(document).on("blur", "#loading_packeges_charges", function () {
            calcTotal();
        });
        
        $(document).on("blur", "#insurance_charges", function () {
            calcTotal();
        });
           
        $(document).on("blur", "#other_charges", function () {
//            var val = $(this).val();
//            var totalAmount =  $("#invoice_total").val();
//            var total = parseFloat(val) +parseFloat(totalAmount);
//            if (total > 0)
//            {
//                $("#invoice_total").val(total);            
//                $("#total_words").val(toWords(total));
//            }
            calcTotal();
        });
    }
    
    function autoComplete(srno) {
        var sr = srno - 1;

        $(".prod_desc").autocomplete({
            source: site_url + 'product/searchProduct',
            select: function (event, ui) {
                $("#hsn_code_"+sr).val(ui.item.code);
            }
        });
    }
</script>

<script type="text/javascript">
function convertNumberToWords(amount) {
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninety';
    amount = amount.toString();
    var atemp = amount.split(".");
    var number = atemp[0].split(",").join("");
    var n_length = number.length;
    var words_string = "";
    if (n_length <= 9) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = "";
        for (var i = 0; i < 9; i++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                value = n_array[i] * 10;
            } else {
                value = n_array[i];
            }
            if (value != 0) {
                words_string += words[value] + " ";
            }
            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Crores ";
            }
            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Lakhs ";
            }
            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Thousand ";
            }
            if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                words_string += "Hundred and ";
            } else if (i == 6 && value != 0) {
                words_string += "Hundred ";
            }
        }
        words_string = words_string.split("  ").join(" ");
    }
    return words_string+' Only';
}
    </script>
 