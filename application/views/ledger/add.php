<form id="form_validation" method="POST" action="<?php echo base_url() . $controller . '/save' ?>">

    <div id="headerbar">
        <h1 class="headerbar-title"><?php echo $title; ?></h1>
        <div class="headerbar-item pull-right">
            <div class="btn-group btn-group-sm">
                <button  class="btn btn-success ajax-loader" type="submit">
                    <i class="fa fa-check"></i> Save </button>
                <a href="<?php echo site_url() . $controller; ?>" class="btn btn-danger ajax-loader" >
                <i class="fa fa-times"></i>Cancel</a>
            </div>
        </div>
    </div>

    <div id="content">
        <div class="row">
            <div class="col-xs-12 col-sm-12">


                <div id="userInfo">
                    <input type="hidden" name="id" value="<?php echo (isset($arrData->id) ? $arrData->id : ''); ?>" id="id"/>
                    <input type="hidden" name="formmode" value="<?php echo (isset($formMode) ? $formMode : ''); ?>" id="formmode"/>

                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <h4 class="col-sm-6">Ledger Information </h4>
                        </div>

                        <div class="panel-body row">

                            <div class="form-group col-md-4 col-sm-6">
                                <label for="user_name"> Ledger Action  </label>
                                <select name="action" id="action"  class="form-control simple-select">
                                    <option value="Credit">Credit</option>
                                    <option value="Debit">Debit</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4 col-sm-6">
                                <label for="user_name"> Member Info  </label>
                                <select name="user_id" id="user_id"  class="form-control simple-select" required="">
                                    <option value="">Select Type</option>
                                    <?php
                                    foreach ($memberData as $member) {
                                        $sel = "";
                                        if ($member['id'] == $customerData[0]['id']) {
                                            $sel = "selected";
                                        };
                                        echo '<option value=' . $member['id'] . ' ' . $sel . '>' . $member['firstname'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4 col-sm-6">
                                <label for="user_name"> Transactional Type <span class="text-danger">*</span>  </label>
                                <input type="text" name="type" id="type" class="form-control"  value="<?php echo (isset($arrData->type) ? $arrData->type : ''); ?>" required="">
                            </div>

                            <div class="form-group col-md-4 col-sm-6">
                                <label for="user_name"> Cheque / NEFT  <span class="text-danger">*</span></label>
                                <input type="text" name="check_neft" id="check_neft" class="form-control"  value="<?php echo (isset($arrData->check_neft) ? $arrData->check_neft : ''); ?>">
                            </div>

                            <div class="form-group col-sm-8">
                                <label for="user_site"> Journal <span class="text-danger">*</span></label>
                                <textarea name="journal" id="journal" class="form-control"><?php echo (isset($arrData->journal) ? $arrData->journal : ''); ?></textarea>
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label for="user_email"> Amount  <span class="text-danger">*</span></label>
                                <input type="text" name="amount" id="amount" class="form-control"  value="<?php echo (isset($arrData->amount) ? $arrData->amount : '0'); ?>" required="">
                            </div>


                            <div class="form-group col-md-4 col-sm-6">
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

