<link href="<?php echo MOD_URL.'attendance/assets/css/lateness_report.css'; ?>" rel="stylesheet" type="text/css"/>  

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

                                <?php echo form_dropdown('employee_id',$dropdownatn,$employee_info->employee_id,'class="form-control codeigniterselect select2" id="employee_id" required') ?>

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

                        <div class="form-group row text-center">
                            <div class="col-sm-5 search-button">
                                <button type="submit" onclick="check_emp_mnth_yr()" class="btn btn-success w-md m-b-5"><?php echo display('details') ?></button>
                            </div>
                            
                        </div>

                   </form>
                           
                </div>

            </div>  
        </div>
</div>

<div class="row">
 <div class="col-sm-12 col-md-12">
    <div class="panel ">

        <div class="panel-body lateness-report">

          <div align="right" id="print">

               <?php echo form_open_multipart('attendance/Home/export_late_attn',array('class' => '', 'id' => 'lateness_early_closing','name' => 'export_late_attn'))?>

                <input type="hidden" name="expt_employee_id" value="<?php echo $employee;?>">
                <input type="hidden" name="expt_year" value="<?php echo $year;?>">
                <input type="hidden" name="expt_month" value="<?php echo $month;?>">

                <button title="Export Lateness Attendance Data" type="submit" name="submit" value="Download" class="btn btn-primary mt-20"><i class="fa fa-file-excel-o"></i></button>

                <a href="<?php echo base_url($pdf)?>" target="_blank" title="download pdf">
                  <button type="button" class="btn btn-success btn-md mt-20" name="btnPdf" id="btnPdf" ><i class="fa-file-pdf-o"></i> PDF</button>
                </a>

              <?php echo form_close()?> 
              
          </div>

          <br><br>

          <div class="row mb-10">
              <table class="table" width="99%">
                  <thead>
                      <tr>
                          <td align="center" class="text-center logo-image">
                              <img src="<?php echo base_url('/').$setting->logo;?>">
                          </td>
                      </tr>
                      <tr>
                          <th align="center" class="text-center fs-20 action-title"><?php echo $setting->title; ?></th>
                      </tr>
                  </thead>
              </table>
          </div>

          <table width="99%" class="payrollDatatableReportLaeClosing table table-striped table-bordered table-hover">
            <thead bgcolor="#E7E0EE">

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

            <tbody class="">

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
                        <table class="footer-section" border="0" width="100%">                                                
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

<script src="<?php echo MOD_URL.'attendance/assets/js/script.js'; ?>" type="text/javascript"></script>