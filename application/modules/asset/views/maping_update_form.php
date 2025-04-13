<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                        <a href="<?php echo base_url('asset/equipment_maping/maping_list') ?>" class="btn btn-sm btn-success" title="List"> <i class="fa fa-list"></i> <?php echo display('list') ?></a> 

                        <a href="<?php echo base_url('asset/equipment_maping/maping_form') ?>" class="btn btn-sm btn-info" title="Add"><i class="fa fa-plus"></i> <?php echo display('assign_asset') ?></a> 
                    </h4>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open_multipart('asset/equipment_maping/maping_update') ?>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label"><?php echo display('employee') ?>*</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="old_emp_id" value="<?php echo $empselect->employee_id;?>">
                             <?php echo form_dropdown('employee_id',$employee,$empselect->employee_id,'class="form-control" required') ?>

                        </div>
                        
                    </div> 
                     <div class="form-group row">
                        <div class="col-sm-10">
                              <table class="table table-bordered table-hover"  id="equipment_table">
                               <thead>
                                  <tr>
                                     <th>Equipment</th> 
                                     <th>Date</th> 
                                     <th>Action</th> 
                                  </tr>
                              </thead>
                                <tbody id="equipmnet_info">
                                    <?php
                                    $sl=1;
                                     foreach($maping_info as $map){?>
                                    <tr class="">
                                      <td>
                                               <input type="text" name="equipment[]" class="form-control equipment" value="<?php echo $map->equipment_name; ?>" required="" onkeypress="asset_autocomplete(<?php echo $sl;?>);" id="equipment_id_<?php echo $sl;?>"/><input type="hidden" class="autocomplete_hidden_value" name="equipment_id[]" id="Hiddenid" value="<?php echo $map->equipment_id;?>" />
                                          <input type="hidden" class="sl" value="<?php echo $sl;?>">

                                        </td>
                                        <td> <input type="text" name="dates[]" class="form-control datepicker" value="<?php echo $map->issue_date;?>"></td>
                                        <td> <button class="btn btn-danger red" type="button" value="<?php echo display("delete")?>" onclick="deleteRow(this)"><i class="fa fa-close"></i></button> <input type="button"name="sdfsd" id="add_invoice_item" class="btn btn-info"  onclick="assignasset('equipmnet_info');" value="add"  />
                                        </td>
                                    </tr>
                                <?php $sl++;} ?>
                                </tbody>
                            </table>
                             <input type="hidden" name="" id="base_url" value="<?php echo base_url();?>">
                        </div>
                    </div> 
                     
                    <div class="form-group form-group-margin text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                    </div>
                <?php echo form_close() ?>

            </div>  
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/companyassets.js') ?>" type="text/javascript"></script>


