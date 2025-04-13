<div class="row">
     <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">

                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('attendance_log') ?></h4>
                        </div>
                    </div>

                    <div class="panel-body"> 
                        <?php echo form_open('attendance/Home/datebetween_attendance',array('class' => 'form-inline','method'=>'get'))?>
                        <div class="form-group form-group-margin">
                                <label for="employeelist"><?php echo display('employee')?>:</label>
                              
                            </div> 
                         <div class="form-group form-group-new empdropdown">
                               
                                <?php echo form_dropdown('employee_id',$userlist,null,'class="form-control" id="employee_id" required') ?>
                            </div> 
                            <div class="form-group form-group-new">
                                <label for="start_date"><?php echo display('start_date')?> :</label>
                                <input type="text" name="start_date"  value="<?php echo date('Y-m-d') ?>" class="datepicker form-control" />
                            </div> 
                          <div class="form-group form-group-new">
                                <label for="end_date"><?php echo display('end_date')?> :</label>
                                <input type="text" class="datepicker form-control" name="end_date" value="<?php echo date('Y-m-d') ?>"  />
                            </div> 
                            <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                          
                       <?php echo form_close()?>
                    </div>
                
        
              </div>
             </div>
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 
            <div class="panel-body">
                <div class="table-responsive">
                 <?php
foreach ($queryd as $attendance) {?>
               <table width="100%" class="table table-striped table-bordered table-hover">
            <tr>
                <th colspan="7" class="text-center">Attendance History of <?php echo date( "F d, Y", strtotime($attendance->mydate));?></th>
            </tr>
            <tr>
                <th><?php echo display('sl')?></th>
                <th><?php echo display('employee_name')?></th>
                <th title="First in time for today."><?php echo display('in_time')?></th>
                <th title="Last in time for today."><?php echo "Last In Time";?></th>
                <th title="Last out time for today."><?php echo "Last Out Time";?></th>
                <th><?php echo display('worked_hour')?></th>
                <th><?php echo display('action')?></th>
            </tr>
           <?php
                $att_in = $this->db->select('MIN(a.time) as intime,MAX(a.time) as outtime,a.uid,b.first_name,b.last_name')
                ->from('attendance_history a')
                ->join('employee_history b','a.uid = b.employee_id','left')
                ->like('a.time',date( "Y-m-d", strtotime($attendance->mydate)),'after')
                ->group_by('a.uid')
                ->order_by('a.uid','ASC')
                ->get()
                ->result();
            $idx=1;
           foreach ($att_in as $attendancedata) {

            $attn_recs = $this->db->select('*')
                ->from('attendance_history')
                ->like('time',date( "Y-m-d", strtotime($attendancedata->intime)),'after')
                ->where('uid',$attendancedata->uid)
                ->order_by('time','DESC')
                ->get()
                ->result();

            $last_in_time = "";
            $last_out_time = "-- : -- : --";
            if(count($attn_recs) == 1){
                $last_in_time = date( "H:i:s", strtotime($attn_recs[0]->time));
            }else{
                if(count($attn_recs) % 2 == 0){
                    $last_out_time = date( "H:i:s", strtotime($attn_recs[0]->time));
                    $last_in_time = date( "H:i:s", strtotime($attn_recs[1]->time));
                }else{
                    $last_in_time = date( "H:i:s", strtotime($attn_recs[0]->time));
                    $last_out_time = date( "H:i:s", strtotime($attn_recs[1]->time));
                }
            }

            ?>
            <tr>
                <td><?php echo $idx ?></td>
                <td><a href="<?php echo base_url('attendance/home/user_attendanc_details/'.$attendancedata->uid)?>"><?php echo $attendancedata->first_name.' '.$attendancedata->last_name ?></a></td>
                <td><?php echo date( "H:i:s", strtotime($attendancedata->intime)) ?></td>
                <td><?php echo $last_in_time; ?></td>
                <td><?php echo $last_out_time; ?></td>
                <td><?php 
                $date_a = new DateTime($attendancedata->outtime);
                $date_b = new DateTime($attendancedata->intime);
                $interval = date_diff($date_a,$date_b);

            echo $interval->format('%h:%i:%s');?></td>
            <td><a class="btn btn-info" href="<?php echo base_url('attendance/home/user_attendanc_details/'.$attendancedata->uid)?>"><i class="fa fa-eye"></i>Details</a></td>
            </tr>
            <?php
         $idx++; }
        
            ?>
        </table>
    <?php } ?>
           <?php echo  $links ?> 
           </div>
            </div>
        </div>
    </div>
</div>
