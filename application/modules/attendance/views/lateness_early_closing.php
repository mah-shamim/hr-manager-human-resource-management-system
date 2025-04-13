<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/attendance.css" />
<div class="row">
  <?php 
  $employee = (!empty($_POST['employee_id'])?$_POST['employee_id']:'');
  $year     = (!empty($_POST['year'])?$_POST['year']:'');
  $month    = (!empty($_POST['month'])?$_POST['month']:'');
  ?> 
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">
                <div class="panel-heading" >
                    <div class="panel-title">
                        <h4><?php echo $title; ?></h4>
                        <span id="almsg"></span>
                    </div>
                </div>
                <div class="panel-body">
    
                    <?php echo  form_open('attendance/Home/lateness_early_closing_report','id="lateness_early_closing"') ?>

                        <div class="form-group row">

                            <input type="hidden" name="attendanc_id" value="<?php echo (!empty($editdata)?$editdata->atten_his_id:'')?>">
                            <label for="employee_id" class="col-sm-2 col-form-label"><?php echo display('emp_id') ?> *</label>
                            <div class="col-sm-3">

                              <?php  if($this->session->userdata('isAdmin')==1 || $this->session->userdata('supervisor')==1){?> 

                                <?php echo form_dropdown('employee_id',$dropdownatn,null,'class="form-control codeigniterselect select2" id="employee_id" required') ?>

                              <?php }else{?> 

                                 <input type="text" name="employee_name" class="form-control" value="<?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name');?>" readonly>
                                 <input type="hidden" name="employee_id" id="employee_id" class="form-control" value="<?php echo $this->session->userdata('employee_id');?>">

                              <?php }?>
                               
                            </div>

                        </div> 

                         <div class="form-group row">
                          <label for="year" class="col-sm-2 col-form-label"><?php echo display('year')?>*</label>
                          <div class="col-sm-3">
                            <select name="year" class="form-control select2" id="year" required>
                              <option value="">Select Year</option>
                              <option value="2022" <?php if($year == '2022'){echo 'selected';}?>>2022</option>
                              <option value="2023" <?php if($year == '2023'){echo 'selected';}?>>2023</option>
                              <option value="2024" <?php if($year == '2024'){echo 'selected';}?>>2024</option>
                              <option value="2025" <?php if($year == '2025'){echo 'selected';}?>>2025</option>
                              <option value="2026" <?php if($year == '2026'){echo 'selected';}?>>2026</option>
                              <option value="2027" <?php if($year == '2027'){echo 'selected';}?>>2027</option>
                              <option value="2028" <?php if($year == '2028'){echo 'selected';}?>>2028</option>
                              <option value="2029" <?php if($year == '2029'){echo 'selected';}?>>2029</option>
                              <option value="2030" <?php if($year == '2030'){echo 'selected';}?>>2030</option>
                              <option value="2019" <?php if($year == '2019'){echo 'selected';}?>>2031</option>
                              <option value="2020" <?php if($year == '2020'){echo 'selected';}?>>2032</option>
                              <option value="2021" <?php if($year == '2021'){echo 'selected';}?>>2033</option>
                              <option value="2021" <?php if($year == '2021'){echo 'selected';}?>>2034</option>
                              <option value="2021" <?php if($year == '2021'){echo 'selected';}?>>2035</option>
                            </select>
                          </div>

                        </div>

                         <div class="form-group row">
                          <label for="month" class="col-sm-2 col-form-label"><?php echo display('month')?>*</label>
                          <div class="col-sm-3">
                            <select name="month" class="form-control select2" id="month" required>
                              <option value="">Select Month</option>
                              <option value="01" <?php if($month == '01'){echo 'selected';}?>>January</option>
                              <option value="02" <?php if($month == '02'){echo 'selected';}?>>February</option>
                              <option value="03" <?php if($month == '03'){echo 'selected';}?>>March</option>
                              <option value="04" <?php if($month == '04'){echo 'selected';}?>>April</option>
                              <option value="05" <?php if($month == '05'){echo 'selected';}?>>May</option>
                              <option value="06" <?php if($month == '06'){echo 'selected';}?>>June</option>
                              <option value="07" <?php if($month == '07'){echo 'selected';}?>>July</option>
                              <option value="08" <?php if($month == '08'){echo 'selected';}?>>August</option>
                              <option value="09" <?php if($month == '09'){echo 'selected';}?>>September</option>
                              <option value="10" <?php if($month == '10'){echo 'selected';}?>>October</option>
                              <option value="11" <?php if($month == '11'){echo 'selected';}?>>November</option>
                              <option value="12" <?php if($month == '12'){echo 'selected';}?>>December</option>
                            </select>
                          </div>

                        </div>

                        <div class="form-group row text-center details-bottom">
                            <div class="col-sm-5 details-button">
                                <button type="submit" onclick="check_emp_mnth_yr()" class="btn btn-success w-md m-b-5"><?php echo display('details') ?></button>
                            </div>
                            
                        </div>

                   </form>
                           
                </div>

            </div>  
        </div>
</div>

<script src="<?php echo MOD_URL.'attendance/assets/js/script.js'; ?>" type="text/javascript"></script>
       
       
      