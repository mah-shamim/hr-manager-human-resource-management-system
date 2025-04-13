
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                     <?php echo display('contra_voucher')?>
                    </h4>
                </div>
            </div>
            <div class="panel-body">
               
                         <?php echo  form_open_multipart('accounts/store_contra_voucher') ?>
                     <div class="form-group row">
                        <label for="vo_no" class="col-sm-2 col-form-label"> <?php echo display('voucher_type')?></label>
                        <div class="col-sm-4">
                              <input type="text" name="txtVNo" id="txtVNo" value="Contra" class="form-control" readonly />
                        </div>
                    </div> 
                     <div class="form-group row">
                        <label for="ac" class="col-sm-2 col-form-label"><?php echo display('reverse_account_head')?></label>
                        <div class="col-sm-4">
                          <select name="cmbDebit" id="cmbDebit" class="form-control">
                            <?php foreach ($acc as $cracc) { ?>
                            <option value="<?php echo $cracc->HeadCode?>"><?php echo $cracc->HeadName?></option>
                           <?php  } ?>

                          </select>
                        </div>
                    </div> 
                     <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label"> <?php echo display('date')?></label>
                        <div class="col-sm-4">
                             <input type="text" name="dtpDate" id="dtpDate" class="form-control datepicker" value="<?php echo  date('Y-m-d')?>">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="txtRemarks" class="col-sm-2 col-form-label"> <?php echo display('remark')?></label>
                        <div class="col-sm-4">
                          <textarea  name="txtRemarks" id="txtRemarks" class="form-control"></textarea>
                        </div>
                    </div> 
                       <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="debtAccVoucher"> 
                                <thead>
                                    <tr>
                                        <th width="20%" class="text-center"> <?php echo display('account_name')?></th>
                                         <th width="30%" class="text-center"><?php echo display('ledger_comment')?></th>
                                          <th width="25%" class="text-center"> <?php echo display('debit')?></th>
                                          <th width="25%" class="text-center"> <?php echo display('credit')?></th>
                                           
                                    </tr>
                                </thead>
                        <tbody id="debitvoucher">
                           <tr>
                               <td class="expenseincometd">  
                                   <select name="cmbCode[]" id="cmbCode_1" class="form-control">
                                          <option value="">Please select One</option>
                                          <?php foreach ($acc as $acc1) {?>
                                          <option value="<?php echo $acc1->HeadCode;?>"><?php echo $acc1->HeadName;?></option>
                                          <?php }?>
                                    </select>

                                </td>
                               <td><input type="text" name="txtComment[]" step=".01" value="" class="form-control "  id="txtComment_1" />
                                </td>
                              <td><input type="number" name="txtAmount[]"  step=".01" value="" placeholder="0.00" class="form-control total_price text-right"  id="txtAmount_1" onkeyup="calculationcontra(1)" >
                                 </td>
                                <td ><input type="number" name="txtAmountcr[]" value="" placeholder="0.00" class="form-control total_price1 text-right"  id="txtAmount1_1" onkeyup="calculationcontra(1)" >
                                </td>
                               
                            </tr>                              
                    </tbody>                               
                    <tfoot>
                                    
                                </tfoot>
                            </table>
                        </div>
                        <div class="form-group form-group-margin row">
                           
                            <div class="col-sm-12 text-right">

                                <input type="submit" id="add_receive" class="btn btn-success btn-large" name="save" value="<?php echo display('save') ?>" tabindex="9"/>
                                <input type="hidden" name="" id="base_url" value="<?php echo base_url();?>">
                                <input type="hidden" name="" id="headoption" value="<option value=''> Please select</option><?php foreach ($acc as $acc2) {?><option value='<?php echo $acc2->HeadCode;?>'><?php echo $acc2->HeadName;?></option><?php }?>">
                            </div>
                        </div>
                  <?php echo form_close() ?>
            </div>  
        </div>

    </div>
</div>

<script src="<?php echo base_url() ?>assets/js/dist/jstree.min.js" ></script>
<script src="<?php echo base_url('assets/js/account.js') ?>" type="text/javascript"></script>

