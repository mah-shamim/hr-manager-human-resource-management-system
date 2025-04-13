<style type="text/css">
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
    border: 1px solid #000;
}
td, th {
    padding: 0;
    margin:0;
}
.table{
    width: 100%;
}
td{
  text-align:center;
}
  
</style>
<div class="row">
    
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 
            <div class="panel-body">
            
                  <center> <img src="<?php echo $company->logo; ?>" class="img-responsive" alt="">
                   </center>
           <h2><center>  <?php
           echo $user->first_name.' '.$user->last_name;?></center></h2>
               <table class="table table-bordered">
            <tr>
                <th colspan="7" class="text-center"><?php echo display('attendance_history')?> <?php echo '( From '.$start.' To '.$end.' )';?> </th>
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
->order_by('a.atten_his_id','ASC')
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
        if($count_out == 2){
        $n_out = $count_out;
        }else{
         $n_out = $count_out-1;   
        }
        for($i=0;$i < $n_out; $i++) {

                $date_a = new DateTime($result_in[$i+1]);
                $date_b = new DateTime($result_out[$i]);
                $interval = date_diff($date_a,$date_b);

            $total[$i] =  $interval->format('%h:%i:%s');
        }
        // echo '<pre>';
        // print_r($total);
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
        // echo '<pre>';
        // print_r($total);
    
            ?></td>
            <td  style="border:1px solid #000;"><?php 
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
         <!--  <?= $links ?> -->
            </div>
        </div>
    </div>

 
