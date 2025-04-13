
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                      <?php echo display('payment_type')?>   
                    </h4>
                </div>
            </div>
            <div class="panel-body">
              
                <?php echo  form_open_multipart('accounts/accounts/add_paymenttype') ?>
                     <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label"><?php echo display('type_name')?></label>
                        <div class="col-sm-4">
                             <input type="text" name="typename" id="typename" class="form-control" value="">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="parent_type" class="col-sm-2 col-form-label"><?php echo display('parent_type')?></label>
                        <div class="col-sm-4">
                         <select name="parent_type" class="form-control">
                          <option value=""><?php echo display('select_type')?></option>
                          <?php foreach($paytype as $ptypes){?>
                          <option value="<?php echo $ptypes->HeadName?>"><?php echo $ptypes->HeadName?></option>
                           <?php }?>
                         </select>
                        </div>
                    </div> 
                      
                   
                        <div class="form-group row">
                           
                            <div class="col-sm-4 text-right">

                                <input type="submit" id="add_receive" class="btn btn-success btn-large" name="save" value="<?php echo display('save') ?>" tabindex="9"/>
                               
                            </div>
                        </div>
                  <?php echo form_close() ?>
            </div>  
        </div>
    </div>
</div>

