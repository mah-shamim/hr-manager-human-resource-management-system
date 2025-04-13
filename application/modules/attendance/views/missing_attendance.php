<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/attendance.css" />
<div class="row">
  <?php 

  $date     = (!empty($_POST['date'])?$_POST['date']:'');
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
                          <label for="date" class="col-sm-2 col-form-label"><?php echo display('date')?>*</label>
                          <div class="col-sm-3">
                            <input type="text" name="date" id="date" class="form-control datepicker" placeholder="Select Date" value="<?php echo (!empty($date)?$date:'');?>">
                          </div>
                           <div class="col-sm-2 text-center">
                            <button type="submit"  class="btn btn-success w-md m-b-5"><?php echo display('search') ?></button>
                        </div>

                        </div>
                         
                         
                   </form>
                           
 </div>

                   

                </div>  
            </div>
        </div>


<?php  if(!empty($_POST['date'])){?>
        <div class="row">
         <div class="col-sm-12 col-md-12">
            <div class="panel ">
                <div class="panel-heading" >
                    <div class="panel-title">
                        <h4><?php echo display('missing_attendance') ?></h4>
                    </div>
                </div>
                <div class="panel-body">
                  <table class="table table-responsive table-hover">
                    <thead class="tableheads">
                      <tr>
                        <th class="text-center">sl</th>
                        <th class="text-center"><input type="checkbox" id="checkAllmissattendance" onclick="checkallmissattendance()" name="">All</th>
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
          <?php echo  form_open('attendance/Home/missing_attendance_add') ?>
<?php
$date = $_POST['date'];
$checkweekend = $this->Attendance_model->find_weekend($date);
  if($checkweekend == 0){?>
    <?php 
$attend = $this->db->select('*')
                   ->from('attendance_history')
                   ->where('DATE(time)',$date)
                   ->group_by('uid')
                   ->get()
                   ->result_array();

                   $present[] = '0';
            foreach($attend as $row) {
                $present[] = $row['uid'];
            }
              
$leave = $this->db->select('*')
                    ->from('leave_apply')
                    ->where('leave_aprv_strt_date <=',$date)
                    ->where('leave_aprv_end_date >=',$date)
                    ->get()
                    ->result_array();                   
                   

                   $levemp[] = '0';
                   foreach ($leave as $lvemp) {
                     $levemp[] = $lvemp['employee_id'];
                   }
                   
                  
        $this->db->select('a.*,b.position_name');
        $this->db->from('employee_history a');
        $this->db->join('position b','b.pos_id = a.pos_id','left');
        $this->db->where_not_in('a.employee_id', $present);
        $this->db->where_not_in('a.employee_id', $levemp);
        $det = $this->db->get()->result_array();
                   if(!empty($det)){
                    $details = $det;
                   }else{
                    $details = [];
                   }
            $sl = 1;
          
            foreach ($details as $detail) {
               $status = 0;
            ?>
                      <tr>
                        <td class="text-center"><?php echo $sl?></td>
                        <td class="text-center"><input type="checkbox" id="check_id_<?php echo $sl;?>" onclick="checkboxcheckmisattendance(<?php echo $sl;?>)" class="checkboxitem" name="checkItem[]" value="2"></td>
                        <td class="text-center"><input type="hidden"  id="employee_id_<?php echo $sl;?>" value="<?php echo $detail['employee_id'];?>" class="empid"><?php echo $detail['employee_id'];?></td>
                        <td class="text-center"><?php echo $detail['first_name'].' '.$detail['last_name'];?></td>
                        <td class="text-center"><?php echo $detail['position_name'];?></td>
                        <td class="text-center"><input type="hidden" name="mdate" value="<?php echo $_POST['date']?>"><?php echo $_POST['date']?></td>
                        <td class="text-center"><input type="text"  id="intime_<?php echo $sl;?>" class="intimes form-control timePicker" value=""></td>
                        <td class="text-center"><input type="text" class="outtimes form-control timePicker"  id="outtime_<?php echo $sl;?>" value=""></td>
                        <td class="text-center"><input type="hidden" class="status"  id="status_<?php echo $sl;?>" value="<?php echo $status;?>"><?php echo 'Absent';?></td>
                      </tr>
                      <?php $sl++;}}else{?>
                        <tr><td colspan="7" class="text-center"><b>To Day Is Weekend Please Select Another .</b></td></tr>
                      <?php }?>
                      
                    </tbody>
                    <tfoot class="tableheads">
                      <tr>
                        <th colspan="4" class="text-center">Total Record  <?php echo count($details);?></th>
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
        
       