
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                     <?php echo display('journal_voucher')?>
                    </h4>
                </div>
            </div>
            <div class="panel-body">
                         <?php echo  form_open_multipart('accounts/store_journal_voucher') ?>
                     <div class="form-group row">
                        <label for="vo_no" class="col-sm-2 col-form-label"><?php echo display('voucher_type')?></label>
                        <div class="col-sm-4">
                             <input type="text" name="txtVNo" id="txtVNo" value="Journal" class="form-control" readonly />
                        </div>
                    </div> 
                    
                     <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-4">
                             <input type="text" name="dtpDate" id="dtpDate" class="form-control datepicker" value="<?php echo  date('Y-m-d')?>">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="txtRemarks" class="col-sm-2 col-form-label">Remark</label>
                        <div class="col-sm-4">
                          <textarea  name="txtRemarks" id="txtRemarks" class="form-control"></textarea>
                        </div>
                    </div> 
               <div class="table-responsive">
                   <table class="table table-bordered table-hover" id="debtAccVoucher"> 
                     <thead>
                        <tr>
                            <th width="18%" class="text-center"><?php echo display('account_name')?></th>
                             <th width="12%" class="text-center"><?php echo display('subtype')?></th>
                             <th width="20%" class="text-center"><?php echo display('ledger_comment')?></th>
                            <th width="10%" class="text-center"><?php echo display('debit')?></th>
                            <th width="10%" class="text-center"><?php echo display('credit')?></th>
                            <th width="17%" class="text-center"><?php echo display('reverse_account_head')?></th>
                             <th width="8%" class="text-center"><?php echo display('action')?></th>
                       </tr>
                 </thead>
               <tbody id="debitvoucher">
                  <tr>
                     <td class="expenseincometd"> 
                        <select name="cmbCode[]" id="cmbCode_1" class="form-control" onchange="load_subtypeOpen(this.value,1)">
                              <option value="">Please select One</option>
                              <?php foreach ($acc as $acc1) {?>
                              <option value="<?php echo $acc1->HeadCode;?>"><?php echo $acc1->HeadName;?></option>
                              <?php }?>
                        </select>
                    </td>
                    <td >  
                        <select name="subtype[]" id="subtype_1" class="form-control" ><option value="">Please select One</option></select>

                    </td>
                    <td><input type="hidden" name="isSubtype[]" id="isSubtype_1" value="1" />
                        <input type="text" name="txtComment[]" value="" class="form-control "  id="txtComment_1" >
                    </td>
                    <td><input type="number" name="txtAmount[]" value="" step=".01" placeholder="0.00" class="form-control total_price text-right"  id="txtAmount_1" onkeyup="calculationJournalv(1)" >
                       </td>
                     <td ><input type="number" name="txtAmountcr[]" value="" step=".01" placeholder="0.00" class="form-control total_price1 text-right"  id="txtAmount1_1" onkeyup="calculationJournalv(1)" >
                   </td>

                   <td> 
                    <select name="cmbDebit[]" id="cmbDebit_1" class="form-control">
                           <option value="">Please select One</option>
                            <?php foreach ($acc as $cracc) { ?>
                            <option value="<?php echo $cracc->HeadCode?>"><?php echo $cracc->HeadName?></option>
                           <?php  } ?>

                          </select>

                   </td>
                   <td>
                        <button  class="btn btn-danger red" type="button" value="<?php echo display('delete')?>" onclick="deleteRowJournalv(this)"><i class="fa fa-trash-o"></i></button>
                  </td>
               </tr>                              
               </tbody>                               
              <tfoot>
                    <tr>
                      <td >
                            <input type="button" id="add_more" class="btn btn-info" name="add_more"  onClick="addaccountJournalv('debitvoucher');" value="<?php echo display('add_more') ?>" />
                        </td>
                        <td colspan="2" class="text-right"><label  for="reason" class="  col-form-label"><?php echo display('total') ?></label>
                           </td>
                        <td class="text-right">
                            <input type="text" id="grandTotal" class="form-control text-right " name="grand_total" value="" readonly="readonly" value="0"/>
                        </td>
                         <td class="text-right">
                            <input type="text" id="grandTotal1" class="form-control text-right " name="grand_total1" value="" readonly="readonly" value="0"/>
                        </td>
                    </tr>
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