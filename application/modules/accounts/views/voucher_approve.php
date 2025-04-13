<div class="row">
    <?php echo  form_open_multipart('accounts/bulk_voucher_approve', array('onsubmit'=>'return checkValue();')) ?>
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                        <?php if($this->permission->check_label('voucher_approval')->update()->access()) {?>
                           <input type="submit" name="bulkapproved" id="bulkapproved" value="Approve All" class="btn btn-success" >

                        <?php } ?>
                      
                    </h4>
                </div>
            </div>
            <div class="panel-body">
 
                <div class="table-responsive">
                    <table class="datatableReport table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" value="1" name="selectAll" id="selectAll" onclick="checkAll(this)"/> &nbsp; <?php echo display('sl_no') ?></th>
                                <th><?php echo display('voucher_no') ?></th>
                                <th><?php echo display('account') ?></th>
                                <th><?php echo display('remark') ?></th>
                                <th><?php echo display('debit') ?></th>
                                <th><?php echo display('credit') ?></th>
                                <th><?php echo display('action') ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                         
                            
                            <?php $sl = 1; 
                            foreach($aprroves as $appr) {
                             ?>
                             <tr>
                                <td><input type="checkbox" class="approvalCheckbox" value="<?php echo $appr->VNo;?>" name="vapprove[]"/> &nbsp; <?php echo $sl; ?></td>
                                <td><?php echo $appr->VNo; ?></td>
                                <td><?php echo $appr->HeadName; ?></td>
                                <td><?php echo $appr->Narration; ?></td>
                                <td><?php echo $setting->currency_symbol. ' '. $appr->Debit; ?></td>
                                <td><?php echo $setting->currency_symbol. ' '. $appr->Credit; ?></td>
                                <td> 
                                    <?php if($this->permission->check_label('voucher_approval')->update()->access()) { ?>
                                <a href="<?php echo base_url("accounts/isactive/$appr->VNo/active") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="right" title="Approve"><?php echo display('approved')?></a>
                                 <a href="<?php echo base_url("accounts/edit_voucher/$appr->id") ?>" class="btn btn-info btn-sm" title="Update"><i class="fa fa-edit"></i></a>
                             <?php } ?>
                            </td>    
                             </tr>
                         
                           <?php $sl++;}?>
                        </tbody>
                    </table>
                 
                </div>
            </div> 
        </div>
       
    </div>
     <?php echo form_close()?>
</div>

<script src="<?php echo MOD_URL.'accounts/assets/js/voucher_approve.js'; ?>" type="text/javascript"></script>