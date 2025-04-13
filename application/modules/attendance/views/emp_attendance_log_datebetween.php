
<div class="row">
     <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="panel-title">
                       
                    </div>
                </div>
        <div class="panel">
                    <div class="panel-body"> 
                        <?php echo form_open('attendance/Home/emp_datebetween_attendance',array('class' => 'form-inline','method'=>'get'))?>

                         <input type="hidden" class="form-control" name="employee_id" value="<?php echo $employee_id; ?>"  />

                            <div class="form-group form-group-new">
                                <label for="start_date"><?php echo display('start_date')?> :</label>
                                <input type="text" name="start_date"  value="<?php echo (!empty($start)?$start:date('Y-m-01'))  ?>" class="datepicker form-control" />
                            </div> 
                          <div class="form-group form-group-new">
                                <label for="end_date"><?php echo display('end_date')?> :</label>
                                <input type="text" class="datepicker form-control" name="end_date" value="<?php echo (!empty($end)?$end:date('Y-m-20')) ?>"  />
                            </div> 
                            <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                          
                       <?php echo form_close()?>
                    </div>
                
            </div>
              </div>
             </div>
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 
            <div class="panel-body">
                   <div class="text-right" id="print">
               <button type="button" class="btn btn-warning" id="btnPrint" onclick="printDiv();"><i class="fa fa-print"></i></button>
                <a href="<?php echo base_url($pdf)?>"download>
                    <button type="button" class="btn btn-success" id="btnPdf">pdf</button>
                </a>
                
            </div>
              <div id="printArea">
                  <center><img src="<?php echo base_url().$company->logo;?>"></center>
           <h2><center>  <?php
           echo $user->first_name.' '.$user->last_name;?></center></h2>
               <table width="100%" class="table table-striped table-bordered table-hover">
            <tr>
                <th colspan="7" class="text-center">Attendance History <?php echo '( From '.$start.' To '.$end.' )';?> </th>
            </tr>
            <tr>
                <th><?php echo display('sl')?></th>
                <th><?php echo display('date')?></th>
                <th><?php echo display('in_time')?></th>
                <th><?php echo display('out_time')?></th>
                <th><?php echo display('worked_hours')?></th>
                <th><?php echo display('wasteg_hour')?></th>
                <th><?php echo display('net_hour')?></th>
            </tr>
           <?php
            $idx=1;
            $totalhour=[];
            $totalwasthour = [];
            $totalnetworkhour = [];
           foreach ($atten_in as $attendancedata) {
            ?>
            <tr>
                <td><?php echo $idx ?></td>
                <td><?php echo date( "F d, Y", strtotime($attendancedata[0]->time));?></td>
                <td><?php echo date( "H:i:s", strtotime($attendancedata[0]->intime)) ?></td>
                <td><?php echo date( "H:i:s", strtotime($attendancedata[0]->outtime)) ?></td>
                <td><?php 
                $date_a = new DateTime($attendancedata[0]->outtime);
                $date_b = new DateTime($attendancedata[0]->intime);
                $interval = date_diff($date_a,$date_b);

            echo $totalwhour = $interval->format('%h:%i:%s');
              $totalhour[$idx] = $totalwhour;
            ?></td>
            <td> <?php

 $att_dates = date( "Y-m-d", strtotime($attendancedata[0]->time));            
$att_in = $this->db->select('a.*,b.first_name,b.last_name')
->from('attendance_history a')
->join('employee_history b','a.uid = b.employee_id','left')
->like('a.time',$att_dates,'after')
->where('a.uid',$attendancedata[0]->uid)
->order_by('a.time','ASC')
->get()
->result();
 $ix=1;
             $in_data = [];
             $out_data = [];
           foreach ($att_in as $attendancedata) {

            if($ix % 2){
       $status = "IN";
       $in_data[$ix] = $attendancedata->time;

    }else{
        $status = "OUT";
        $out_data[$ix] = $attendancedata->time;
    }
     $ix++;
}


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
           echo  $totalwastage = $hours.":".$minutes.":".$seconds;
            $totalwasthour[$idx] = $totalwastage;
  
            ?></td>
            <td><?php 
               $date_a = new DateTime($totalwhour);
                $date_b = new DateTime($totalwastage);
                $networkhours = date_diff($date_a,$date_b);

            echo $ntworkh = $networkhours->format('%h:%i:%s');
            $totalnetworkhour[$idx] = $ntworkh;

             ?></td>
            </tr>
            <?php
         $idx++; }
        
            ?>
            <tr><td colspan="4" class="text-center"><b>Working Hours Summary</b></td><td><b>
                <?php 

$seconds = 0;
foreach($totalhour as $t)
{
$timeArr = array_reverse(explode(":", $t));

foreach ($timeArr as $key => $value)
{
    if ($key > 2) break;
    $seconds += pow(60, $key) * $value;
}

}

$hours = floor($seconds / 3600);
$mins = floor(($seconds - ($hours*3600)) / 60);
$secs = floor($seconds % 60);

echo $hours.':'.$mins.':'.$secs;

                ?></b>
            </td>
            <td><b>
                <?php 

$wastsecond = 0;
foreach($totalwasthour as $wastagetime)
{
$wastimearray = array_reverse(explode(":", $wastagetime));

foreach ($wastimearray as $key => $value)
{
    if ($key > 2) break;
    $wastsecond += pow(60, $key) * $value;
}

}

$wasthours = floor($wastsecond / 3600);
$wastmin = floor(($wastsecond - ($wasthours*3600)) / 60);
$wastsc = floor($wastsecond % 60);

echo $wasthours.':'.$wastmin.':'.$wastsc;

                ?></b>
            </td>
             <td><b>
               <?php 

$netsecond = 0;
foreach($totalnetworkhour as $nettime)
{
$nettimearray = array_reverse(explode(":", $nettime));

foreach ($nettimearray as $key => $value)
{
    if ($key > 2) break;
    $netsecond += pow(60, $key) * $value;
}

}

$nettlehour = floor($netsecond / 3600);
$netmin = floor(($netsecond - ($nettlehour*3600)) / 60);
$ntsec = floor($netsecond % 60);

echo $nettlehour.':'.$netmin.':'.$ntsec;

                ?>  </b> 
             </td>
        </tr>
        </table>
</div>
        
            </div>
        </div>
    </div>
</div>
 
 