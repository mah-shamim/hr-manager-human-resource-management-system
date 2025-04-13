
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                      <?php echo display('bank_adjustment')?>   
                    </h4>
                </div>
            </div>
            <div class="panel-body">
              
                         <?php echo  form_open_multipart('accounts/accounts/create_bank_adjustment') ?>
                     <div class="form-group row">
                        <label for="vo_no" class="col-sm-2 col-form-label"><?php echo display('voucher_no')?></label>
                        <div class="col-sm-4">
                             <input type="text" name="txtVNo" id="txtVNo" value="<?php if(!empty($voucher_no->voucher)){
                               $vn = substr($voucher_no->voucher,4)+1;
                              echo $voucher_n = 'BAD-'.$vn;
                             }else{
                               echo $voucher_n = 'BAD-1';
                             } ?>" class="form-control" readonly>
                        </div>
                    </div> 
                     <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label"><?php echo display('date')?></label>
                        <div class="col-sm-4">
                             <input type="text" name="dtpDate" id="dtpDate" class="form-control datepicker" value="<?php  echo date('Y-m-d');?>">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label"><?php echo display('adjustment_type')?> *</label>
                        <div class="col-sm-4">
                         <select name="type" class="form-control">
                          <option value=""><?php echo display('adjustment_type')?></option>
                           <option value="1"><?php echo display('debit')?></option>
                           <option value="2"><?php echo display('credit')?></option>
                         </select>
                        </div>
                    </div> 
                       <div class="form-group row">
                        <label for="txtRemarks" class="col-sm-2 col-form-label"><?php echo display('remark')?></label>
                        <div class="col-sm-4">
                          <textarea  name="txtRemarks" id="txtRemarks" class="form-control"></textarea>
                        </div>
                    </div> 
                     <div class="form-group row">
                        <label for="bank_name" class="col-sm-2 col-form-label"><?php echo display('bank_name')?> *</label>
                        <div class="col-sm-4">
                           <select name="bank_name" class="form-control">
                                           <option value=""></option>
                                           <?php foreach($banks as $bank){?>
                                            <option value="<?php echo $bank['bank_name']?>"><?php echo $bank['bank_name']?></option>
                                           <?php }?>
                                       </select>
                        </div>
                    </div> 
                     <div class="form-group row">
                        <label for="amount" class="col-sm-2 col-form-label"><?php echo display('amount')?> *</label>
                        <div class="col-sm-4">
                             <input type="number" name="txtAmount" value="" class="form-control total_price text-right"  id="txtAmount_1" required>
                        </div>
                    </div> 
                   
                        <div class="form-group row">
                           
                            <div class="col-sm-6 text-right">

                                <input type="submit" id="add_receive" class="btn btn-success btn-large" name="save" value="<?php echo display('save') ?>" tabindex="9"/>
                               
                            </div>
                        </div>
                  <?php echo form_close() ?>
            </div>  
        </div>
    </div>
</div>

