
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('receipt_payment') ?></h4>
                </div>
            </div>
            <div class="panel-body">
                <?php echo  form_open_multipart('accounts/receipt_payment_report') ?>
                <div class="row" id="">
                    <div class="col-sm-6">
     
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"><?php echo display('from_date') ?></label>
                            <div class="col-sm-8">
                                <input type="text" name="dtpFromDate" value="<?php echo date('Y-m-d',strtotime('first day of this month'));?>" placeholder="<?php echo display('from_date') ?>" class="datepicker form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"><?php echo display('to_date') ?></label>
                            <div class="col-sm-8">
                                <input type="text"  name="dtpToDate" value="<?php echo date('Y-m-d',strtotime('last day of this month'));?>" placeholder="<?php echo display('to_date') ?>" class="datepicker form-control">
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="reportType" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                                <input type="radio" id="reportType1" name="reportType" checked size="60" class="form-contro radio-inline" value="Accrual Basis" />&nbsp;&nbsp;&nbsp;<label for="reportType"><?php echo display('accrual_basis') ?></label> &nbsp;&nbsp'&nbsp;
                                <input type="radio" id="reportType2" name="reportType" size="60" class="radio-inline" value="Cash Basis" />&nbsp;&nbsp;&nbsp;<label for="reportType"><?php echo display('cash_basis') ?></label>
                            </div>
                        </div>
                        <div class="form-group form-group-margin text-right">
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('find') ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
