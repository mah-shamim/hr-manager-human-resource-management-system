<link href="<?php echo MOD_URL.'accounts/assets/css/custom.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">             
            <div class="panel-heading" >
                <div class="panel-title">
                    <h4><?php echo display('bank_reconciliation') ?></h4>
                </div>                
            </div>
            <div class="panel-body bank_reconciliation">
                      
              <?php echo  form_open_multipart('accounts/bank_reconciliation',array('class' => 'form-inline','method'=>'post')) ?>
                <div class="row" >
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <label for="dtpFromDate" class="col-sm-4 col-form-label"><?php echo display('from_date') ?></label>
                            <div class="col-sm-8">
                                <input type="text" name="dtpFromDate" value="<?php echo   isset($dtpFromDate)? $dtpFromDate : date('Y-m-d',strtotime('first day of this month')); ?>" placeholder="<?php echo display('date') ?>" class="datepicker form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <label for="dtpToDate" class="col-sm-4 col-form-label"><?php echo display('to_date') ?></label>
                            <div class="col-sm-8">
                                <input type="text"  name="dtpToDate" value="<?php echo  isset($dtpToDate)? $dtpToDate : date('Y-m-d'); ?>" placeholder="<?php echo display('date') ?>" class="datepicker form-control">
                            </div>
                        </div>
                    </div><div class="col-sm-3">
                        <div class="form-group row">
                            <label for="dtpToDate" class="col-sm-5 col-form-label"><?php echo display('bank_name') ?></label>
                            <div class="col-sm-7">
                                <select class="form-control" name="bankCode" id="bankCode">
                                    <option value=""> Select Bank</option>
                                    <?php foreach($banks as $bank){  ?>
                                        <option value="<?php echo $bank->HeadCode;?>" <?php  if(isset($bankCode)) { echo  $bank->HeadCode == $bankCode  ? 'selected' : '' ; } ?> ><?php echo $bank->HeadName;?></option>
                                        <?php  }  ?>
                                </select>
                            </div>
                        </div>
                    </div>
                                         
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <div class="col-sm-8">
                            <button type="submit" name="btnSave" class="btn btn-success w-md m-b-5"><?php echo display('find') ?></button>
                           </div>
                        </div>
                    </div>
                </div>
               <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php echo  form_open_multipart('accounts/bank_reconciliation_approve', array('onsubmit'=>'return checkValue();')) ?>
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">                
                <div class="panel-title">
                    <h3><?php echo display('bank_reconciliation');?> </h3> 
                    <?php if($this->permission->check_label('bank_reconciliation')->update()->access()) { ?>
                      <h3> <input type="submit" name="bulkapproved" id="bulkapproved" value="Reconciliation" class="btn btn-success" ></h3>
                    <?php } ?>                     
                                       
                </div>
            </div>
            <div class="panel-body"> 
                <div class="table-responsive">
                    <?php if($vauchers) { ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" value="1" name="selectAll" id="selectAll"  data-property="<?php echo count($vauchers);?>" onclick="checkAll(this)"/> &nbsp; <?php echo display('sl_no') ?></th>
                                <th><?php echo display('voucher_no') ?></th>
                                <th><?php echo display('voucher_type') ?></th>
                                <th><?php echo display('particulars') ?></th>
                                <th><?php echo display('check_no') ?></th>                                
                                <th><?php echo display('check_date') ?></th>                                
                                <th><?php echo display('remark') ?></th>
                                <th><?php echo display('amount') ?></th>                                 
                            </tr>
                        </thead>
                        <tbody> 
                            <?php $sl = 1; $sum = 0;
                            $active_color = 'style="background-color:#151B8D !important; color: #fff !important;"';

                            foreach($vauchers as $appr) {  $sum += $appr->Debit;
                                if($appr->isHonour == 1) {?> <tr id="t-<?php echo $sl;?>" <?php echo  $active_color;?>> <?php } else { ?><tr id="t-<?php echo $sl;?>" > <?php } ?>
                                <td><input type="checkbox" class="approvalCheckbox" data-property="t-<?php echo $sl;?>" value="<?php echo $appr->VNo;?>" name="vapprove[]" <?php if($appr->isHonour == 1) {?>  checked="checked" <?php } ?>/> &nbsp; <?php echo $sl; ?></td>
                                <td><?php echo $appr->VNo; ?></td>
                                <td><?php echo $appr->Vtype; ?></td>
                                <td><?php echo $appr->accountName; ?></td>
                                <td><?php echo $appr->chequeno; ?></td>                                
                                <td><?php echo $appr->chequeDate; ?></td>                                
                                <td><?php echo $appr->Narration; ?></td>  
                                <td><?php echo $appr->Debit; ?></td>  
                             </tr>
                           <?php $sl++;}?>
                           <tr>
                                <td class="selectall"> <input type="checkbox" value="1" name="selectAll" id="selectAll2"  data-property="<?php echo count($vauchers);?>" onclick="checkAll(this)"/> &nbsp; Select All</td>
                                <td class="total" colspan="6" align="right"> <strong><?php echo display('total');?> </strong></td>
                                <td class="summation"><strong><?php echo $sum; ?></strong></td>
                           </tr>
                        </tbody>
                    </table>
                 <?php } else { ?>
                   <h3> <?php echo display('no_data_found');?> </h3>
                 <?php } ?>
                </div>
            </div> 
        </div>
       
    </div>
     <?php echo form_close()?>
</div>

<script src="<?php echo MOD_URL.'accounts/assets/js/bank_reconciliation.js'; ?>" type="text/javascript"></script>