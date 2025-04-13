<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/attendance.css" />
<div class="row">
  <?php 
  $employee = (!empty($_POST['employee_id'])?$_POST['employee_id']:'');
  $year     = (!empty($_POST['year'])?$_POST['year']:'');
  $month    = (!empty($_POST['month'])?$_POST['month']:'');
  $In       = (!empty($_POST['intime'])?$_POST['intime']:'');
  $Out      = (!empty($_POST['out_time'])?$_POST['out_time']:'');
  ?>
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">
                <div class="panel-heading" >
                    <div class="panel-title">
                        <h4><?php echo display('attendance') ?></h4>
                        <span id="almsg"></span>
                    </div>
                </div>
                <div class="panel-body">
    
                    <?php echo  form_open('','id="form"') ?>
                                <div class="form-group row">
                          <input type="hidden" name="attendanc_id" value="<?php echo (!empty($editdata)?$editdata->atten_his_id:'')?>">
                            <label for="employee_id" class="col-sm-3 col-form-label"><?php echo display('emp_id') ?> *</label>
                            <div class="col-sm-4">
                       <?php  if($this->session->userdata('isAdmin')==1 || $this->session->userdata('supervisor')==1){?> 
                              <?php echo form_dropdown('employee_id',$dropdownatn,null,'class="form-control codeigniterselect select2" id="employee_id" ') ?>
                              <?php }else{?> 
                                <input type="text" name="employee_name" class="form-control" value="<?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name');?>" readonly>
                                 <input type="hidden" name="employee_id" id="employee_id" class="form-control" value="<?php echo $this->session->userdata('employee_id');?>">
                               <?php }?>
                               
                            </div>
                        </div> 

                         <div class="form-group row">
                          <label for="year" class="col-sm-3 col-form-label"><?php echo display('year')?>*</label>
                          <div class="col-sm-4">
                            <select name="year" class="form-control select2" id="year">
                              <option value="">Select Year</option>
                              <option value="2019" <?php if($year == '2019'){echo 'selected';}?>>2019</option>
                              <option value="2020" <?php if($year == '2020'){echo 'selected';}?>>2020</option>
                              <option value="2021" <?php if($year == '2021'){echo 'selected';}?>>2021</option>
                              <option value="2022" <?php if($year == '2022'){echo 'selected';}?>>2022</option>
                              <option value="2023" <?php if($year == '2023'){echo 'selected';}?>>2023</option>
                              <option value="2024" <?php if($year == '2024'){echo 'selected';}?>>2024</option>
                              <option value="2025" <?php if($year == '2025'){echo 'selected';}?>>2025</option>
                              <option value="2026" <?php if($year == '2026'){echo 'selected';}?>>2026</option>
                              <option value="2027" <?php if($year == '2027'){echo 'selected';}?>>2027</option>
                              <option value="2028" <?php if($year == '2028'){echo 'selected';}?>>2028</option>
                              <option value="2029" <?php if($year == '2029'){echo 'selected';}?>>2029</option>
                              <option value="2030" <?php if($year == '2030'){echo 'selected';}?>>2030</option>
                            </select>
                          </div>

                        </div>

                         <div class="form-group row">
                          <label for="month" class="col-sm-3 col-form-label"><?php echo display('month')?>*</label>
                          <div class="col-sm-4">
                            <select name="month" class="form-control select2" id="month">
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

                        <div class="form-group row">
                          <label for="intime" class="col-sm-3 col-form-label"><?php echo display('in_time')?>*</label>
                          <div class="col-sm-4">
                            <input type="text" name="intime" id="intime" class="form-control timePicker" placeholder="--:--" value="<?php echo (!empty($In)?$In:'');?>">
                          </div>

                        </div>
                         <div class="form-group row">
                          <label for="out_time" class="col-sm-3 col-form-label"><?php echo display('out_time')?>*</label>
                          <div class="col-sm-4">
                            <input type="text" name="out_time" id="out_time" class="form-control timePicker" placeholder="--:--" value="<?php echo (!empty($Out)?$Out:'');?>">
                          </div>

                        </div>
                          <div class="form-group text-center">
                            <button type="button" onclick="checkfieldsmonthlyattn()" class="btn btn-success w-md m-b-5"><?php echo display('details') ?></button>
                        </div>
                   </form>
                           
 </div>

                   

                </div>  
            </div>
        </div>

<?php if((!empty($_POST['employee_id'])) && (!empty($_POST['year'])) && (!empty($_POST['month'])) && (!empty($_POST['intime'])) && (!empty($_POST['out_time']))){?>
        <div class="row">
         <div class="col-sm-12 col-md-12">
            <div class="panel ">
                <div class="panel-heading" >
                    <div class="panel-title">
                        <h4><?php echo display('attendance') ?></h4>
                    </div>
                </div>
                <div class="panel-body">
                  <table class="table table-responsive table-hover">
                    <thead class="tableheads">
                      <tr>
                        <th class="text-center">sl</th>
                        <th class="text-center"><input type="checkbox" id="checkAllmonthlyattn" onclick="checkallmonthlyattn()" name="">All</th>
                        <th class="text-center">Employee Id</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Designation</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">In Time</th>
                        <th class="text-center">Out Time</th>
                        <th class="text-center">Status</th>

                      </tr>
                    </thead>
                    <tbody class="attendancbody">
          <?php echo  form_open('attendance/Home/monthly_attendance_add') ?>
<?php
$emp_info = $this->db->select('a.*,b.position_name')
                     ->from('employee_history a')
                     ->join('position b','b.pos_id = a.pos_id')
                     ->where('a.employee_id',$_POST['employee_id'])
                     ->get()
                     ->row();

             $dates=array();
            $month = $_POST['month'];
            $year = $_POST['year'];
            for($d=1; $d<=31; $d++)
            {
                $time=mktime(12, 0, 0, $month, $d, $year);          
                if (date('m', $time)==$month)       
                    $dates[]=date('Y-m-d', $time);
            }
            $sl = 1;
            foreach ($dates as $date) {
            $weekend = $this->Attendance_model->find_weekend($date); 
            $leave  = $this->Attendance_model->find_leave($_POST['employee_id'],$date);
           
            if($weekend > 0){
              $status = 1;
            }elseif ($leave > 0) {
              $status = 2;
            }else{
               $status = 0;
            }
           
?>
                      <tr>
                        <td class="text-center"><?php echo $sl?></td>
                        <td class="text-center"><input type="checkbox" id="check_id_<?php echo $sl;?>" onclick="checkboxcheckmonthlyatt(<?php echo $sl;?>)" class="checkboxitem" name="checkItem[]" value="2"></td>
                        <td class="text-center"><input type="hidden"  id="employee_id_<?php echo $sl;?>" value="<?php echo $_POST['employee_id'];?>" class="empid"><?php echo $_POST['employee_id'];?></td>
                        <td class="text-center"><?php echo $emp_info->first_name.' '.$emp_info->last_name;?></td>
                        <td class="text-center"><?php echo $emp_info->position_name;?></td>
                        <td class="text-center"><?php echo $date?></td>
                        <td class="text-center"><input type="hidden"  id="intime_<?php echo $sl;?>" class="intimes" value="<?php echo $date.' '.$_POST['intime'].':00';?>"><?php echo $_POST['intime'];?></td>
                        <td class="text-center"><input type="hidden" class="outtimes"  id="outtime_<?php echo $sl;?>" value="<?php echo $date.' '.$_POST['out_time'].':00';?>"><?php echo $_POST['out_time'];?></td>
                        <td class="text-center"><input type="hidden" class="status"  id="status_<?php echo $sl;?>" value="<?php echo $status;?>"><?php if($status==1){echo 'weekend';}elseif($status==2){
                          echo 'Leave';}else{echo 'Present';}?></td>
                      </tr>
                      <?php $sl++;}?>
                      
                    </tbody>
                    <tfoot class="tableheads">
                      <tr>
                        <th colspan="4" class="text-center">Total Record  <?php echo count($dates);?></th>
                      </tr>
                    </tfoot>
                  </table>
                   <div class="form-group text-center">
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                        </div>
                         <?php echo form_close() ?>
               </div>
            </div>
           </div>
        </div>
      <?php }?>
<script src="<?php echo base_url('assets/js/attendance.js') ?>" type="text/javascript"></script>
       
       
      