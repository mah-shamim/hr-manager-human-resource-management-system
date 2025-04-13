
 <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd lobidrag">

                <div class="panel-heading">
                  <div class="panel-title">
                      <h4>
                        <?php echo display('assign_asset')?>
                      </h4>
                  </div>
                </div>

                <div class="panel-body">
                  <div class="col-sm-6 col-md-5">
                      <center><h1><?php echo display('assign_asset') ?></h1></center>
                 <?php echo  form_open_multipart('asset/equipment_maping/maping_form','id="asset_form"') ?>
                    <div class="row">
                           <label for="type" class="col-sm-3 col-form-label"><?php echo display('employee') ?>*</label>
                        <div class="col-sm-6">
                             <?php echo form_dropdown('employee_id',$employee,null,'class="form-control" required') ?>
                        </div>
                               
                              </div>
                              <br>
                              

                          <div class="row">
                                 <div class="col-sm-12">
                            
                                    <table class="table table-bordered table-hover"  id="equipment_table">
                              <thead>
                                  <tr>
                                     <th><?php echo display('equipment')?></th> 
                                     <th><?php echo display('date')?></th> 
                                     <th><?php echo display('action')?></th> 
                                  </tr>
                              </thead>
                                <tbody id="equipmnet_info">
                                    <tr>
                                       
                                        <td>
                                         <input type="text" name="equipment[]" class="form-control equipment" required="" onkeypress="asset_autocomplete(1);" id="equipment_id_1"/><input type="hidden" class="autocomplete_hidden_value" name="equipment_id[]" id="Hiddenid"/>
                                          <input type="hidden" class="sl" value="1">
                                        </td>
                                        <td>  
                                         
                                          <input type="text" name="dates[]" class="form-control datepicker" value="<?php echo date('Y-m-d')?>">
                                      
                                        </td>
                                        <td>  
                                          <button type="button"name="sdfsd"  class="btn btn-info"  onclick="addasset('equipmnet_info');" ><i class="fa fa-plus"></i></button>
                                     
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                                </div>
                                
                            </div>
                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>
                   
    <?php echo form_close() ?>
                </div>
                <div class="col-sm-6 col-md-7">
                  <center><h1><?php echo display('assign_list'); ?></h1></center>
                    <table width="100%" id="datatable1" class="table table-striped table-bordered table-hover">

                    <thead>
                        <tr>
                           <th><?php echo display('cid') ?></th>
                           <th><?php echo display('employee_name') ?></th>
                            <th><?php echo display('equipment_name') ?></th>
                           <th><?php echo display('action') ?></th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($mappinglist)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($mappinglist as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php 
                                      $employee =$this->db->select('first_name,last_name')->from('employee_history')->where('employee_id',$row->employee_id)->get()->row();
                                      echo $employee->first_name.' '.$employee->last_name;
                                     ?></td> 
                                   <td><?php
                             $eqments =$this->db->select('a.*,b.equipment_name')->from('employee_equipment a')->join('equipment b','b.equipment_id=a.equipment_id','left')->where('a.employee_id',$row->employee_id)->where('a.return_date','0000-00-00')->get()->result_array();
                              $eqnamess= '';
                              foreach ($eqments as $eq) {
                               $eqnamess .= $eq['equipment_name'].',';
                              }
                                     if($eqnamess !=''){
                                    echo $eqnamess;}else{
                                      echo 'Returned All Equipments';
                                    } ?></td>              
                                   <td class="center">
                                    <?php if($eqnamess !=''){?>
                                    <?php if($this->permission->check_label('asset_assignment')->update()->access()): ?>
                                        <a href="<?php echo base_url("asset/Equipment_maping/maping_update/$row->employee_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <?php endif; ?>
                                    
                                     <?php if($this->permission->check_label('asset_assignment')->delete()->access()): ?>
                                        <a href="<?php echo base_url("asset/Equipment_maping/delete_maping/$row->employee_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-close"></i></a>
                                         <?php endif; ?> 
                                       <?php }?>
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                <input type="hidden" name="" id="base_url" value="<?php echo base_url();?>">
                </div>  
            </div>
          </div>
        </div>
    </div>

<script src="<?php echo base_url('assets/js/companyassets.js') ?>" type="text/javascript"></script>