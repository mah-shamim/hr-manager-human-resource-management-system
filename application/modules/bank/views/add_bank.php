  <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                       <h4>
                        <?php echo display('add_bank')?>
                      </h4>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo  form_open('bank/Bank/create_bank'); ?>
                   <?php echo form_hidden('id', (!empty($bankinfo->id)?$bankinfo->id:null)) ?>
                       <div class="form-group row">
                           
                            <label for="bank_name" class="col-sm-3 col-form-label">
                            <?php echo display('bank_name') ?></label>
                            <div class="col-sm-6">
                           <input type="text" name="bank_name" class="form-control" value="<?php echo (!empty($bankinfo->bank_name)?$bankinfo->bank_name:null) ?>" placeholder="<?php echo display('bank_name') ?>">
                            <input type="hidden" name="oldname" class=" form-control" value="<?php echo (!empty($bankinfo->bank_name)?$bankinfo->bank_name:null) ?>" placeholder="<?php echo display('bank_name') ?>">
                               
                            </div>
                           
                        </div>
                              <div class="form-group row">
                           
                            <label for="account_name" class="col-sm-3 col-form-label">
                            <?php echo display('account_name') ?></label>
                            <div class="col-sm-6">
                           <input type="text" name="account_name" class=" form-control" value="<?php echo (!empty($bankinfo->account_name)?$bankinfo->account_name:null) ?>" placeholder="<?php echo display('account_name') ?>">                           
                               
                            </div>
                           
                        </div>
                         <div class="form-group row">
                           
                            <label for="account_number" class="col-sm-3 col-form-label">
                            <?php echo display('account_number') ?></label>
                            <div class="col-sm-6">
                           <input type="text" name="account_number" class=" form-control" value="<?php echo (!empty($bankinfo->account_number)?$bankinfo->account_number:null) ?>" placeholder="<?php echo display('account_number') ?>">
                               
                            </div>
                           
                        </div>
                         <div class="form-group row">
                           
                            <label for="branch_name" class="col-sm-3 col-form-label">
                            <?php echo display('branch_name') ?></label>
                            <div class="col-sm-6">
                           <input type="text" name="branch_name" class=" form-control" value="<?php echo (!empty($bankinfo->branch_name)?$bankinfo->branch_name:null) ?>" placeholder="<?php echo display('branch_name') ?>">
                               
                            </div>
                           
                        </div>
                       
                        
                        <div class="form-group text-center">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo (!empty($bankinfo->branch_name)?display('update'):display('save')) ?></button>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>