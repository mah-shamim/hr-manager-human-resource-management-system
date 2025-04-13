
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                      <?php echo display('opening_balance')?>   
                    </h4>
                </div>
            </div>
            <div class="panel-body">
              
                         <?php echo  form_open_multipart('accounts/create_opening_balance') ?>
                     
                     <div class="form-group row">
                        <label for="ac" class="col-sm-2 col-form-label"><?php echo display('financial_year')?></label>
                        <div class="col-sm-4">
                          <select name="fyear" id="fyear" class="form-control">                           
                            <?php foreach ($oldyears as $oldyear) { ?>
                            <option value="<?php echo $oldyear->id?>"><?php echo $oldyear->yearName?></option>
                           <?php  } ?>

                          </select>
                        </div>
                    </div> 
                    
                     <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label"><?php echo display('date')?></label>
                        <div class="col-sm-4">
                             <input type="text" name="dtpDate" id="dtpDate" class="form-control datepicker" value="<?php  echo date('2022-01-01');?>">
                        </div>
                    </div> 
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="debtAccVoucher"> 
                            <thead>
                                <tr>
                                   <th width="25%" class="text-center"><?php echo display('account_name')?></th>
                                   <th width="25%" class="text-center"><?php echo display('subtype')?></th>
                                   <th width="20%" class="text-center"><?php echo display('debit')?></th>
                                   <th width="20%" class="text-center"><?php echo display('credit')?></th>
                                   <th width="10%" class="text-center"><?php echo display('action')?></th>  
                                </tr>
                           </thead>
                            <tbody id="debitvoucher">
                               <tr>
                                  <td >  
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

                                  <td><input type="number" name="txtDebit[]" value="" class="form-control total_dprice text-right"  id="txtDebit_1" onkeyup="calculationDebtOpen(1)" >
                                  </td>
                                   <td><input type="number" name="txtCredit[]" value="" class="form-control total_cprice text-right"  id="txtCredit_1" onkeyup="calculationCreditOpen(1)" >
                                    <input type="hidden" name="isSubtype[]" id="isSubtype_1" value="1" />
                                  </td>
                                  <td>
                                      <button  class="btn btn-danger red text-right" type="button" value="<?php echo display('delete')?>" onclick="deleteRowDebtOpen(this)"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                    </tr>                              
                              
                                </tbody>                               
                             <tfoot>
                                <tr>
                                   <td >
                                     <input type="button" id="add_more" class="btn btn-info" name="add_more"  onClick="addaccountOpen('debitvoucher');" value="<?php echo display('add_more') ?>" />
                                    </td>
                                    <td colspan="1" class="text-right"><label  for="reason" class="  col-form-label"><?php echo display('total') ?></label>
                                     </td>
                                      
                                     <td class="text-right">
                                            <input type="text" id="grandTotald" class="form-control text-right " name="grand_totald" value="" readonly="readonly" />
                                     </td>
                                      <td class="text-right">
                                            <input type="text" id="grandTotalc" class="form-control text-right " name="grand_totalc" value="" readonly="readonly" />
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
