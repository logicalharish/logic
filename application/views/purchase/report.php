<div id="headerbar">
    <h1 class="headerbar-title">Purchase Report</h1>
    <div class="headerbar-item pull-right">
        
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h4 class="col-sm-6">Search Criteria </h4>
    </div>
    <div class="panel-body">
    <div class="btn-group btn-group-justified">
    <form id="userDateFrm" method="post" action="<?php echo site_url().$controller.'/report'; ?>">
        <div class="col-md-12 btn-group btn-group-justified" >
            <div class="md-form form-md col-sm-2" >
            <label for="user_name">Customer List  </label>
            <select name="customerId" id="customerId"  class="form-control simple-select">
                    <option value="99999999">Select Customer</option>
                    <?php
                    foreach ($memberData as $member) {
                        $sel = "";
                        if ($member['id'] == $customerId) {
                            $sel = "selected";
                        };
                        echo '<option value=' . $member['id'] . ' ' . $sel . '>' . $member['firstname'] .' '. $member['lastname'] . '</option>';
                    }
                    ?>
                </select> 
            </div>
            <div class="md-form form-md col-sm-2" >
                    <label for="user_name"> Start Date  </label>
                    <input type="text" class="form-control" name="startdate" id="startdate" value="<?php echo $startDate;?>">
            </div>
            <div class="md-form form-md col-sm-2" >
                    <label for="user_name"> End Date  </label>
                    <input type="text" class="form-control" name="enddate" id="enddate" value="<?php echo $endDate;?>">
            </div>
            <div class="md-form form-md col-sm-2" >
                    <label for="user_name"> Start Purchase Number  </label>
                    <input type="text" class="form-control" name="startNumber" id="startNumber" value="<?php echo $startNumber;?>">
            </div>
            <div class="md-form form-md col-sm-2" >
                    <label for="user_name"> End Purchase Number  </label>
                    <input type="text" class="form-control" name="endNumber" id="endNumber" value="<?php echo $endNumber;?>">
            </div>
            <div class="md-form form-md col-sm-2" >
                    <button  class="btn btn-success ajax-loader" type="submit" style="margin-top: 24px;"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>
        
    </form>
    </div>
    </div>
</div>
<div id="content" class="table-responsive">
    <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="manageTbls">
        <thead>
                <tr>    
                        <th>Srno</th>
                        <th>Purchase Number</th>
                        <th>Purchase date</th>
                        <th>Customer Name</th>
                        <th>Pan Number</th>
                        <th>TIN Number</th>
                        <th>Total</th>
                </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($arrData as $key => $value) { 
                    $key++;
                    echo '<tr>    
                        <td>'.$key.'</td>
                        <td>'.$value['invoice_number'].'</td>    
                        <td>'.$value['invoice_date'].'</td>
                        <td>'.$value['customer'].'</td>
                        <td>'.$value['pan'].'</td>
                        <td>'.$value['tin_no'].'</td>
                        <td>'.$value['total'].'</td>
                    </tr>';

               } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" align="right" >Grand Total</td>
                <td><?php echo number_format($grandTotal,2); ?></td>
            </tr>
                
        </tfoot>
            
    </table>
</div>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
var site_url = "<?php echo site_url(); ?>";
var controller = "<?php echo $controller; ?>";
    
    
$(document).ready(function () { 
    $( "#startdate, #enddate ").datepicker({ dateFormat: "yy-mm-dd" });
});
</script>

