<style type="text/css">

     table{font-size: 13px;}

     table.payrollDatatableReport {       
        border-collapse: collapse;
        border: 0;
        text-align: left !important;
    }
    table.payrollDatatableReport td, table.payrollDatatableReport th {
        padding: 6px 15px;
    }
    table.payrollDatatableReport td, table.payrollDatatableReport th {
        border: 1px solid #ededed;
        border-collapse: collapse;
    }
    table.payrollDatatableReport td.noborder {
        border: none;
        padding-top: 40px;
    }
    table.payrollDatatableReport tbody tr td {
        font-size: 10px;
        padding-left: 5px;
    }

    table.payrollDatatableReport thead tr th {
        font-size: 11px;
        padding-left: 5px;
    }
</style>


<div class="row">
 <div class="col-sm-12 col-md-12">
    <div class="panel">

        <div class="panel-body">

          <div class="row mb-10">
              <table style="width: 1200px!important;">
                  <thead>
                      <tr>
                            <?php
                                $path = base_url((!empty($setting->logo)?$setting->logo:'assets/img/icons/mini-logo.png'));
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $data = file_get_contents($path);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            ?>

                            <td align="center" class="text-center" style="border:none;text-align: center;padding-bottom: 10px;">
                                <img src="<?php echo  $base64; ?>" alt="logo">

                            </td>
                      </tr>
                      <tr>
                          <th align="center" class="text-center fs-20" style="border:none;text-align: center;padding-bottom: 20px;"><?php echo $setting->title; ?></th>
                      </tr>
                      <tr>
                          <td align="center" class="text-center fs-20" style="border:none;text-align: center;padding-bottom: 20px;">Lateness and Early closing report for <b><?php echo $employee_info->first_name.' '.$employee_info->last_name; ?></b></td>
                      </tr>
                  </thead>
              </table>
          </div>

          <table style="width: 1200px!important;" class="payrollDatatableReport table table-striped table-bordered table-hover">
            <thead style="background-color: #E7E0EE;">

              <tr>
                <th class="text-center" width="10%">Sl</th>
                <th class="text-center" width="10%">Date</th>
                <th class="text-center" width="10%">In Time</th>
                <th class="text-center" width="20%">Attendance Setup(In Time)</th>
                <th class="text-center" width="10%">Late Time</th>
                <th class="text-center" width="10%">Out Time</th>
                <th class="text-center" width="20%">Attendance Setup(Out Time)</th>
                <th class="text-center" width="10%">Early Closing</th>
              </tr>

            </thead>

            <tbody class="attendancbody">

              <?php 

              $i = 1;

              foreach ($late_early_closings as $key => $data) {
                
                $atten_data = $data[0];

                $date = date('Y-m-d',strtotime($atten_data->intime));
                $in_time = date('H:i',strtotime($atten_data->intime));
                $out_time = date('H:i',strtotime($atten_data->outtime));

                $attendence_setup_in_time = strtotime($attendence_rule_info->start_time);
                $attendence_setup_end_time = strtotime($attendence_rule_info->end_time);

                // Evaluate late in time
                $in_time_diff = '';

                if($attendence_setup_in_time < strtotime($in_time)){

                  $in_t_diff = strtotime($in_time) - $attendence_setup_in_time;
                  $in_time_diff = gmdate('H:i',$in_t_diff);

                }else{

                  $in_time_diff = '00:00';
                }

                // Evaluate out time

                $show_out_time = '00:00';

                if($in_time != $out_time){
                   $show_out_time = $out_time;
                }

                // Evaluate late out time

                $out_time_diff = '';

                if($attendence_setup_end_time > strtotime($out_time) && $in_time != $out_time){

                  $out_t_diff =  $attendence_setup_end_time - strtotime($out_time);
                  $out_time_diff = gmdate('H:i',$out_t_diff);

                }else{

                  $out_time_diff = '00:00';
                }

              ?>

              <tr>
                <td class="text-center" width="10%"><?php echo $i;?></td>
                <td class="text-center" width="10%"><?php echo $date;?></td>
                <td class="text-center" width="10%"><?php echo $in_time;?></td>
                <td class="text-center" width="20%"><?php echo $attendence_rule_info->start_time;?></td>
                <td class="text-center" width="10%"><?php echo $in_time_diff;?></td>
                <td class="text-center" width="10%"><?php echo $show_out_time;?></td>
                <td class="text-center" width="20%"><?php echo $attendence_rule_info->end_time;?></td>
                <td class="text-center" width="10%"><?php echo $out_time_diff;?></td>
              </tr>

              <?php

              $i++;

              }

              ?>
              
            </tbody>

             <tfoot>
                   <tr >
                    <td colspan="13" class="noborder">
                        <table border="0" width="100%" style="padding-top: 20px;border: none !important;">                                                
                        <tr>
                            <td align="left" class="noborder" width="30%">
                                <div class="border-top"><?php echo display('prepared_by')?>: <b><?php echo $user_info['fullname'];?></b></div>
                            </td>
                            <td align="left"  class="noborder" width="30%"> <div class="border-top"><?php echo display('checked_by')?></div>
                            </td>  
                             <td align="left"  class="noborder" width="20%">
                                <div class="border-top"><?php echo display('authorised_by')?></div>
                            </td>
                        </tr>  
                     </table>  
                    </td>                    
                 </tr> 
              </tfoot>

          </table>
       </div>
    </div>
   </div>
</div>