<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

            <div class="panel-heading panel-aligner">
                <div class="panel-title">
                  <h4>
                    <?php echo display('tax_setup')?>
                  </h4>
                </div>
            </div>

            <div class="panel-body">

                <?php echo form_open_multipart("tax/Tax/tax_setup/") ?>  
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <table id="levelItem" border="0" width="100%">
                                <tr>
                                    <td class="text-center"><?php echo display('no') ?><strong><i class="text-danger">*</i></strong></td>
                                    <td class="text-center"><?php echo display('start_amount') ?><strong><i class="text-danger">*</i></strong></td>
                                    <td class="text-center"><?php echo display('end_amount') ?><strong><i class="text-danger">*</i></strong></td>
                                    <td class="text-center"><?php echo display('tax_percent') ?><strong><i class="text-danger">*</i></strong></td>
                                    <td class="text-center"><?php echo display('add_amount') ?><strong></td>
                                </tr>
                                <?php if(!empty($taxs)){
                                    foreach ($taxs as $row) {
                                ?>
                                    <tr>
                                        <td class="paddin3ps"><input type="text" class="form-control valid_number" id="level_name" name="level_name[]" readonly value="<?php echo $row->tax_sl;?>" /></td>
                                        <td class="paddin3ps"><input type="number" class="form-control valid_number" id="start_range_<?php echo $row->tax_sl;?>" name="start_range[]" onchange="edit_start_range(<?php echo $row->tax_sl;?>)" required value="<?php echo $row->min;?>"/></td>
                                        <td class="paddin3ps"><input type="number" class="form-control valid_number" id="end_range_<?php echo $row->tax_sl;?>" name="end_range[]" onchange="edit_end_range(<?php echo $row->tax_sl;?>)" required value="<?php echo $row->max;?>"/></td>
                                        <td class="paddin3ps"><input type="number" class="form-control valid_number" id="tax_percent_<?php echo $row->tax_sl;?>" name="tax_percent[]" required value="<?php echo $row->tax_percent;?>"/></td>
                                        <td class="paddin3ps"><input type="number" class="form-control valid_number" id="add_smount_<?php echo $row->tax_sl;?>" name="add_smount[]" required value="<?php echo $row->add_smount;?>"/></td>
                                    </tr>
                                <?php 
                                    }
                                 }else{ ?>
                                    <tr>
                                        <td class="paddin3ps"><input type="text" class="form-control valid_number" id="level_name" name="level_name[]" readonly value="1" /></td>
                                        <td class="paddin3ps"><input type="number" class="form-control valid_number" id="start_range_1" name="start_range[]" onchange="edit_start_range(1)" required/></td>
                                        <td class="paddin3ps"><input type="number" class="form-control valid_number" id="end_range_1" name="end_range[]" onchange="edit_end_range(1)" required/></td>
                                        <td class="paddin3ps"><input type="number" class="form-control valid_number" id="tax_percent_1" name="tax_percent[]" required/></td>
                                        <td class="paddin3ps"><input type="number" class="form-control valid_number" id="add_smount_1" name="add_smount[]" required/></td>
                                    </tr>  
                                <?php }?>
                            </table>

                            <br>

                            <div class="form-group text-center lebel-buttons">
                                <?php if($this->permission->method('tax','create')->access()){?>
                                <span class="btn btn-primary w-md m-b-5" onclick="addLevel('levelItem')"><?php echo display('ad') ?></span>
                                <?php } ?>
                                <?php if($this->permission->method('tax','delete')->access()){?>
                                <span class="btn btn-danger w-md m-b-5" onclick="deleteTableRow('levelItem')"><?php echo display('remove') ?></span>
                                 <?php } ?>
                                <?php if($this->permission->method('tax','create')->access() || $this->permission->method('tax','update')->access()){?>
                                <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                                <?php } ?>
                            </div> 
                        </div>
                    </div>
                    <input type="hidden" id="base_url_rax" value="<?php echo base_url();?>">                
                               
              <?php echo form_close()?>

            </div>
        </div>
    </div>
</div>

<script src="<?php echo MOD_URL.'tax/assetsss/js/tax_setupform.js'; ?>" type="text/javascript"></script>


