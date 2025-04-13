
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 
            <div class="panel-body">
                 <div class="text-right" id="print">
               <button type="button" class="btn btn-warning" id="btnPrint" onclick="printDiv();"><i class="fa fa-print"></i></button>
                
            </div>
                <div id="printArea">
                   <center><img src="<?php echo base_url().$company->logo;?>"></center>
                <h2><center>  <?php
           echo $user->first_name.' '.$user->last_name;?></center></h2>
                 <?php
foreach ($queryd as $attendance) {?>
               <table class="table table-striped table-bordered table-hover">
                <caption><?php echo display('att_history_of')?> <?php echo date( "F d, Y", strtotime($attendance->mydate));?></caption>
    
            <thead>
            <tr>
                <th><?php echo display('sl')?></th>
                <th><?php echo display('time')?></th>
                <th><?php echo display('status')?></th>
                <th><?php echo display('action')?></th>  
            </tr>
            </thead>
            <tbody>
           <?php
$att_in = $this->db->select('a.*,b.first_name,b.last_name')
->from('attendance_history a')
->join('employee_history b','a.uid = b.employee_id','left')
->like('a.time',date( "Y-m-d", strtotime($attendance->mydate)),'after')
->where('a.uid',$id)
->order_by('a.time','ASC')
->get()
->result();
            $idx=1;
             $in_data = [];
             $out_data = [];
           foreach ($att_in as $attendancedata) {

            if($idx % 2){
       $status = "IN";
       $in_data[$idx] = $attendancedata->time;

    }else{
        $status = "OUT";
        $out_data[$idx] = $attendancedata->time;
    }

            ?>
            <tr>
                <td><?php echo $idx ?></td>
                <td><?php echo date( "H:i:s", strtotime($attendancedata->time)) ?></td>
                <td><?php echo $status ?></td>
                <td>
                     <?php if($this->permission->method('atn_log_datewise','delete')->access()): ?>
                    <a href="<?php echo base_url("attendance/home/delete_attendance/$attendancedata->atten_his_id/$attendancedata->uid") ?>" onclick="return confirm('Are You Sure To Want to Delete?')" class="btn btn-danger"><i class="fa fa-close"></i></a>
               <?php endif; ?>
               <?php if($this->permission->method('atn_log_datewise','update')->access()): ?>
                    <a href="<?php echo base_url("attendance/home/index/$attendancedata->atten_his_id") ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
               <?php endif; ?>
                </td>
            </tr>
                
            <?php
         $idx++; }
        $result_in = array_values($in_data);
        $result_out = array_values($out_data);
        $total = [];
        $count_out = count($result_out);
        if($count_out >= 2){
        $n_out = $count_out-1;
        }else{
         $n_out = 0;   
        }
        for($i=0;$i < $n_out; $i++) {

                $date_a = new DateTime($result_in[$i+1]);
                $date_b = new DateTime($result_out[$i]);
                $interval = date_diff($date_a,$date_b);

            $total[$i] =  $interval->format('%h:%i:%s');
        }
     $hou = 0;
     $min = 0;
     $sec = 0;
     $totaltime = '00:00:00';
    $length = sizeof($total);

            for($x=0; $x <= $length; $x++){
                    $split = explode(":", @$total[$x]); 
                    $hou += @$split[0];
                    $min += @$split[1];
                    $sec += @$split[2];
            }
            $seconds = $sec % 60;
            $minutes = $sec / 60;
            $minutes = (integer)$minutes;
            $minutes += $min;
            $hours = $minutes / 60;
            $minutes = $minutes % 60;
            $hours = (integer)$hours;
            $hours += $hou % 24;
            $totaltime = $hours.":".$minutes.":".$seconds;
            ?>
            </tbody>
            <tfoot>
                <tr><td colspan="4"><b><?php echo display('n_b_spendtime')?> <?php echo $totaltime;?> <?php echo display('hours_out_of_workinghour')?></b></td></tr>
            </tfoot>
        </table>
    <?php } ?>
    </div>
           <?php echo  $links ?> 
            </div>

        </div>
    </div>
</div>
 
