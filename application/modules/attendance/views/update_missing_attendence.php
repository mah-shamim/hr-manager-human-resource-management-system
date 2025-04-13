
<?php  $timezone = $this->db->select('timezone')->from('setting')->get()->row();
                               date_default_timezone_set($timezone->timezone); ?>
          
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">

                <div class="panel-heading panel-aligner" >
                    <div class="panel-title">
                        <h4><?php echo "Update Missing Attendence" ?></h4>
                    </div>

                </div>

                <div class="panel-body">


                    <?php echo  form_open('attendance/Home/update_attendence') ?>

                        <div class="form-group row">

                            <label for="emp_id" class="col-sm-3 col-form-label"><?php echo display('emp_id') ?> *</label>

                            <div class="col-sm-4">

                            <?php  if($this->session->userdata('isAdmin')==1 || $this->session->userdata('supervisor')==1){?> 

                              <?php echo form_dropdown('emp_id',$dropdownatn,'','class="form-control codeigniterselect" id="emp_id"') ?>

                              <?php }else{?> 

                                 <input type="text" name="employee_name" class="form-control" value="<?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name');?>" readonly>
                                 <input type="hidden" name="emp_id" id="emp_id" class="form-control" value="<?php echo $this->session->userdata('employee_id');?>">

                               <?php }?>
                               
                            </div>
                        </div> 

                        <div class="form-group row">

                          <label for="date" class="col-sm-3 col-form-label"><?php echo display('date')?>*</label>

                          <div class="col-sm-4">
                            <input type="text" name="date" id="" placeholder="<?php echo date("Y-m-d")?>" class="form-control datepicker" value="<?php echo date('Y-m-d');?>">
                          </div>

                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"></label>
                          <div class="col-sm-4 text-right">
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                          </div>

                        </div>
                        
                    <?php echo form_close() ?>
                          
                </div>  

              </div>  
        </div>
</div>

 