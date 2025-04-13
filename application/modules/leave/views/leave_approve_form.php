 <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">
                       
                    </div>
                </div>
                <div class="panel-body">

                      <?php echo  form_open_multipart('leave/Leave/approve_application_form/'. $data->leave_appl_id) ?>
                

                    <input name="leave_appl_id" type="hidden" value="<?php echo $data->leave_appl_id ?>">
                      
                        <div class="form-group row">
                            <label for="employee_id" class="col-sm-2 col-form-label">Select <?php echo display('employee_name') ?></label>
                            <div class="col-sm-4">
                         
                            <?php  if($this->session->userdata('isAdmin')==1 || $this->session->userdata('supervisor')==1){?> 

                            <?php  $value= $bb['employee_id'];
                             echo form_dropdown('employee_id',$dropdown,$value,'class="form-control" id="employee_id"') ?>
                              <?php }else{?> 
                                <input type="text" name="employee_name" class="form-control" value="<?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name');?>" readonly>
                                 <input type="hidden" name="employee_id" class="form-control" value="<?php echo $this->session->userdata('employee_id');?>">
                               <?php }?>
                               
                            </div> <label for="leave_type" class="col-sm-2 col-form-label">Select <?php echo display('leave_type') ?></label>
                            <div class="col-sm-4">
                            <?php echo form_dropdown('leave_type_id',$type,(!empty($data->leave_type_id)?$data->leave_type_id:null),'class="form-control"  onchange="leavetypechange(this.value)"') ?>
                            <span id="enjoy"></span><span id="checkleave"></span>
                            </div>
                           <input type="hidden" name="apply_date" class="form-control" id="f" value="<?php echo $data->apply_date ?>">
                        </div>
                          <div class="form-group row">
                            <!-- for leave leave type -->
                           
                             <label for="apply_strt_date" class="col-sm-2 col-form-label">
                            <?php echo display('apply_strt_date') ?> </label>
                            <div class="col-sm-4">
                           <input type="text" name="apply_strt_date" class="dp form-control apply_start" id="apply_start" placeholder="<?php echo display('apply_strt_date') ?>" value="<?php echo $data->apply_strt_date ?>">
                            </div>
                             <label for="apply_end_date" class="col-sm-2 col-form-label">
                            <?php echo display('apply_end_date') ?></label>
                            <div class="col-sm-4">
                           <input type="text" name="apply_end_date" class="dp form-control apply_end" id="apply_end" value="<?php echo $data->apply_end_date ?>" placeholder="<?php echo display('apply_end_date') ?>">
                               
                            </div>
                        </div>

                        <div class="form-group row">
                             <label for="apply_day" class="col-sm-2 col-form-label">
                            <?php echo display('apply_day') ?> </label>
                            <div class="col-sm-4">
                           <input type="text" name="apply_day" class="form-control apply_day" id="apply_day" value="<?php echo $data->apply_day ?>" placeholder="<?php echo display('apply_day') ?>" readonly>
                            </div>
                               <label for="apply_hard_copy" class="col-sm-2 col-form-label">
                            <?php echo display('apply_hard_copy') ?></label>
                            <div class="col-sm-4">
                           <input type="file" name="apply_hard_copy" class="form-control">
                             <input type="hidden" name="old_apply_hard_copy"  value="<?php echo $data->apply_hard_copy ?>" class="form-control">   
                            </div>
                        </div>
                         <?php  if($this->session->userdata('isAdmin')==1 || $this->session->userdata('supervisor')==1){?> 
                        <div class="form-group row">
                            <label for="leave_aprv_strt_date" class="col-sm-2 col-form-label">
                            <?php echo display('leave_aprv_strt_date') ?> *</label>
                            <div class="col-sm-4">
                           <input type="text" name="leave_aprv_strt_date" class="dp form-control leave_aprv_strt_date" value="<?php echo $data->leave_aprv_strt_date ?>" id="leave_aprv_strt_date" placeholder="<?php echo display('leave_aprv_strt_date') ?>">
                               
                            </div>
                             <label for="leave_aprv_end_date" class="col-sm-2 col-form-label">
                            <?php echo display('leave_aprv_end_date') ?> *</label>
                            <div class="col-sm-4">
                           <input type="text" name="leave_aprv_end_date" class="dp form-control leave_aprv_end_date" value="<?php echo $data->leave_aprv_end_date ?>" id="leave_aprv_end_date" placeholder="<?php echo display('leave_aprv_end_date') ?>">
                               
                            </div>
                             </div>
                        <div class="form-group row">
                            <label for="num_aprv_day" class="col-sm-2 col-form-label">
                            <?php echo display('num_aprv_day') ?></label>
                            <div class="col-sm-4">
                           <input type="text" name="num_aprv_day" class="form-control num_aprv_day" placeholder="<?php echo display('num_aprv_day') ?>" value="<?php echo $data->num_aprv_day ?>" readonly>
                               
                            </div>
                             <label for="approved_by" class="col-sm-2 col-form-label">
                            <?php echo display('approved_by') ?></label>
                            <div class="col-sm-4">
                                <select name="approved_by" class="form-control">
                                    <option value="">Select One</option>
                                    <?php foreach($supr as $supervisor){?>
                                    <option value="<?php echo $supervisor->employee_id;?>" <?php if($data->approved_by == $supervisor->employee_id){
                                        echo 'selected';
                                    }else{
                                        echo '';
                                    } ?>><?php echo $supervisor->first_name.' '.$supervisor->last_name;?></option>
                                    <?php } ?>
                                </select>
                               
                            </div>
                        </div>
                    <?php } ?>
                        <div class="form-group row">
                          
                            <label for="reason" class="col-sm-2 col-form-label"><?php echo display('reason') ?></label>
                            <div class="col-sm-4">
                                <textarea name="reason" class="form-control" placeholder="<?php echo display('reason') ?>"><?php echo $data->reason;?></textarea>
                            </div>
                            
                             <label for="status" class="col-sm-2 col-form-label">
                            <?php echo display('status') ?> *</label>
                            <div class="col-sm-4">
                                <select name="status" class="form-control">
                                    <option value="">Select One</option>
                                   
                                   <option value="1"><?php echo display('approve')?></option>
                                   <option value="0"><?php echo display('decline')?></option>
                                </select>
                               
                            </div>
                        </div>
                       <div class="form-group row">
                            <div class="col-sm-4">
                             <input type="hidden" name="approve_date" class="form-control"  value="<?php echo date('Y-m-d')?>" >
                            </div>
                        </div>
                        <div class="form-group form-group-margin text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('approve') ?></button>
                        </div>
                    <?php echo form_close() ?>

                </div>  
                <input type="hidden" name="" id="base_url" value="<?php echo base_url();?>">
            </div>
        </div>
    </div>


 <script src="<?php echo base_url('assets/js/leave.js') ?>" type="text/javascript"></script>