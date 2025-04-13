
<div class="row">
<div class="empform">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home"><?php echo display('basic_info')?></a></li>
      <li><a data-toggle="tab" href="#bankinfo" ><?php echo display('bank_info')?></a></li>
      <li><a data-toggle="tab" href="#salaryinfo" ><?php echo display('salary_info')?></a></li>
      <li><a data-toggle="tab" href="#menu1" ><?php echo display('positional_info')?></a></li>
      <li><a data-toggle="tab" href="#menu2" ><?php echo display('benefits')?></a></li>
      <li><a data-toggle="tab" href="#classmenu" ><?php echo "Grade Level";?></a></li>
      <li><a data-toggle="tab" href="#menu3" ><?php echo display('supervisor')?></a></li>
      <li><a data-toggle="tab" href="#menu4" ><?php echo display('biographical_info')?></a></li>
      <li><a data-toggle="tab" href="#menu5" ><?php echo display('additional_address')?></a></li>
      <li><a data-toggle="tab" href="#menu6" ><?php echo display('emerg_contct')?></a></li>
      <li><a data-toggle="tab" href="#menu7" ><?php echo display('custom')?></a></li>
      <li><a data-toggle="tab" href="#menu8" ><?php echo display('login_info')?></a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
    <div class="row">
        <div class="col-sm-12 col-md-12 employee-form">
            <div class="panel">
                
                <div class="panel-body">
              <?php echo  form_open_multipart('employee/Employees/update_employee_form/'. $data->employee_id,'id="emp_form"') ?>
                    <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="first_name"><?php echo display('first_name')?><sup class="color-red ">*</sup></label>
                                      
    <input id="first_name" name="first_name" type="text" class="form-control" placeholder="First Name" value="<?php echo $data->first_name;?>">
    <input type="hidden" name="oldfirstname" value="<?php echo $data->first_name;?>">
    <input type="hidden" name="employee_id" value="<?php echo $data->employee_id;?>">

                                    </div>
                                    
                                </div>
                                 
                                   <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="l_name"><?php echo display('middle_name')?> </label>
                                        <input type="text" class="form-control" id="middle_name"
                                        name="middle_name" placeholder="Your Middle Name" value="<?php echo $data->middle_name;?>">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="l_name"><?php echo display('last_name')?></label>
                                      
                                        <input type="text" class="form-control" id="last_name"
                                        name="last_name" placeholder="Your Last Name" value="<?php echo $data->last_name;?>">
                                         <input type="hidden" name="oldlastname" value="<?php echo $data->last_name;?>">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-group-margin">
                                        <label for="l_name"><?php echo display('maiden_name')?> </label>
                                        <input type="text" class="form-control" id="maiden_name"
                                        name="maiden_name" placeholder="Your Maiden Name" value="<?php echo $data->maiden_name;?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="email"><?php echo display('email')?> <sup class="color-red ">*</sup></label>
                                        <input type="email" class="form-control"
                                        name="email" id="email" placeholder="Your Email" oninput="setuseemail()" value="<?php echo $data->email;?>">
                                        <span id="email_v_message"></span>
                                       
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="phone"><?php echo display('phone')?>  <sup class="color-red ">*</sup></label>
                                        <input type="number" class="form-control" id="phone" name="phone" placeholder="Your Phone Number" value="<?php echo $data->phone;?>">
                                         
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <div class="form-group form-group-margin">
                                        <label for="phone"><?php echo display('alter_phone')?> <sup class="color-red "></sup></label>
                                        <input type="number" class="form-control" name="alter_phone" id="phone" value="<?php echo $data->alter_phone;?>" placeholder="Your Phone Number">
                                    </div>
                                </div>

                            </div>

                          <div class="row">
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="state"><?php echo display('state')?></label>
                                       <?php echo form_dropdown('state', $country_list, (!empty($data->state)?$data->state:"New York"), ' class="form-control"') ?> 
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="city"><?php echo display('city')?> </label>
                                        <input type="text" class="form-control" id="city"
                                        name="city" placeholder="City" value="<?php echo $data->city;?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-group-margin">
                                        <label for="zip_code"><?php echo display('zip_code')?></label>
                                        <input type="number" class="form-control" id="zip_code"
                                        name="zip_code" placeholder="Your Zip Code" value="<?php echo $data->zip;?>">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                              <div class="col-sm-4">
                                <div class="form-group">

                                    <label for="attendance_time"><?php echo display('attendance_time')?>  <sup class="color-red ">*</sup></label>

                                    <select name="attendance_time"  class="form-control" id="attendance_time">
                                      <option value="">Select time</option>
                                      <?php foreach ($atten_time_list as $time_list) {?>
                                        <option value="<?php echo $time_list->rule_id?>" <?php if($time_list->rule_id == $data->attendance_time){echo 'selected';}?>><?php echo $time_list->name.'('.$time_list->start_time.' - '.$time_list->end_time.')';?></option>
                                      <?php } ?>
                                    </select>

                                    <span id="attentime"></span>

                                </div>
                              </div>

                              <div class="col-sm-4">
                                <div class="form-group">

                                    <label for="employee_type"><?php echo display('employee_type')?>  <sup class="color-red ">*</sup></label>

                                    <select name="employee_type"  class="form-control" id="employee_type">
                                      <option value="">Select time</option>
                                      <?php foreach ($employee_types as $employee_type) {?>
                                        <option value="<?php echo $employee_type->id?>" <?php if($employee_type->id == $data->employee_type){echo 'selected';}?>><?php echo $employee_type->name;?></option>
                                      <?php } ?>
                                    </select>

                                    <span id="emptype"></span>

                                </div>
                              </div>

                            </div>
                       
                       

                        <div class="form-group form-group-margin text-right">
                           <input type="button" class="btn btn-primary btnNext" onclick="valid_inf()" value="NEXT">
                            
                        </div>
                   

                </div>  
            </div>
        </div>
    </div>
    </div>


    <div id="bankinfo" class="tab-pane fade">
      <div class="row">
         <div class="col-sm-12 col-md-12 employee-form">
                <div class="panel">
                  <div class="panel-body">

                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="acc_number"><?php echo display('account_number')?><!-- <sup class="color-red ">*</sup> --></label>
                            <input id="acc_number" name="acc_number" type="text" class="form-control" placeholder="Account Number" value="<?php echo $bank_info->acc_number;?>">
                        </div>
                        
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="bank_name"><?php echo display('bank_name')?></label>
                          <input type="text" class="form-control" id="bank_name"
                          name="bank_name" placeholder="Bank Name" value="<?php echo $bank_info->bank_name;?>">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="bban_num"><?php echo display('bban_num')?></label>
                          
                          <input type="text" class="form-control" id="bban_num"
                          name="bban_num" placeholder="BBAN Number" value="<?php echo $bank_info->bban_num;?>">
                          
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group form-group-margin">
                          <label for="branch_address"><?php echo display('branch_address')?></label>
                          <input type="text" class="form-control" id="branch_address"
                          name="branch_address" placeholder="Branch Address" value="<?php echo $bank_info->branch_address;?>">
                        </div>
                      </div>
                    </div>

                    <div class="form-group form-group-margin text-right">

                      <input type="button" class="btn btn-primary btnPrevious"  value="Previous">
                      <input type="button" class="btn btn-primary btnNext" onclick="valid_bank_inf()" value="NEXT">
                     
                    </div>

                  </div>
                </div>
          </div>
      </div>
    </div>

    <div id="salaryinfo" class="tab-pane fade">
      <div class="row">
         <div class="col-sm-12 col-md-12 employee-form">
                <div class="panel">
                  <div class="panel-body">

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label><h3 style="border-bottom: 1px dotted blue;">Salary Information</h3></label><br>
                        </div>
                      </div>
                    </div>

                    <div class="row">

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="basic"><?php echo display('basic')?><sup class="color-red ">*</sup></label>
                          <input type="number" class="form-control" id="basic"
                          name="basic" placeholder="<?php echo display('basic')?>" value="<?php echo $employee_file->basic?$employee_file->basic:"";?>">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="transport"><?php echo display('transport').' '.display('allowance')?></label>
                          
                          <input type="number" class="form-control" id="transport"
                          name="transport" placeholder="<?php echo display('transport')?>" value="<?php echo $employee_file->transport?$employee_file->transport:"";?>">
                          
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="gross_salary"><?php echo display('gross_salary')?><sup class="color-red ">*</sup></label>
                            <input id="gross_salary" name="gross_salary" type="number" class="form-control" placeholder="<?php echo display('gross_salary')?>" value="<?php echo $employee_file->gross_salary?$employee_file->gross_salary:"";?>">
                        </div>
                        
                      </div>


                    </div>

                    <br>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label><h3 style="border-bottom: 1px dotted blue;">Tax Information</h3></label><br>
                        </div>
                      </div>
                    </div>

                    <div class="row">



                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="tin_no"><?php echo display('tin_no')?><sup class="color-black ">*</sup></label>
                            <input id="tin_no" name="tin_no" type="number" class="form-control" placeholder="<?php echo display('tin_no')?>" value="<?php echo $employee_file->tin_no?$employee_file->tin_no:"";?>">
                        </div>
                        
                      </div>

                    </div>



                    <div class="form-group form-group-margin text-right">

                      <input type="button" class="btn btn-primary btnPrevious"  value="Previous">
                      <input type="button" class="btn btn-primary btnNext" onclick="valid_salary_inf()" value="NEXT">
                     
                    </div>

                  </div>
                </div>
          </div>
      </div>
    </div>


    <div id="menu1" class="tab-pane fade">
         <div class="row">
        <div class="col-sm-12 col-md-12 employee-form">
            <div class="panel">
                
                <div class="panel-body">
      <div class="row">
          <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="dept_id"><?php echo display('division');?> <sup class="color-red ">*</sup></label><br>
                                       <select name="division" id="division" class="form-control" >
                                        <option value=""> Select Division</option>
                    <?php

                    foreach ($dropdowndept as $division) {
                      if ($division_type == 0) {
                        if ($division_type == 0) {
                          echo '</optgroup>';
                        }
                        echo '<optgroup label="'.$division['department_name'].'">';
                      }
                     $vl = $this->db->select('*')->from('department')->where('parent_id',$division['dept_id'])->get()->result(); ?>

                    <?php   foreach ($vl as $dv) { ?>
                    <option value="<?php echo $dv->dept_id ?>" <?php if($data->dept_id ==$dv->dept_id){
                        echo 'selected';
                    } ?>><?php echo $dv->department_name ?></option>';
                   
                  <?php   }  $division_type = $division['parent_id'];    
                    }
                    if ($division_type == 0) {
                      echo '</optgroup>';
                    }
                    ?>
</select>
  <span id="divis"></span>

                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="designation"><?php echo display('designation');?> <sup class="color-red ">*</sup></label>
                                         
                                            <select name="pos_id" id="designation" class="form-control" >
                                              <option value="">select Designation</option>
                                                <?php foreach ($designation as $desig) {?>
                                                  <option value="<?php echo $desig->pos_id?>" <?php if($data->pos_id == $desig->pos_id){
                                                    echo 'selected';
                                                  }?>><?php echo $desig->position_name;?></option>
                                               <?php } ?>
                                         </select>
                                         <span id="desig"></span>
                                    </div>
                                </div>

                                 
                                 </div>
                                 <div class="row">
                                      
                                     <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="period"><?php echo display('duty_type')?></label><br>
                                        <select name="duty_type"  class="form-control" >
                                        <option value="1" <?php if($data->duty_type ==1){
                                         echo 'selected';
                                        }?>> Full Time</option>
                                        <option value="2"  <?php if($data->duty_type ==2){
                                         echo 'selected';
                                        }?>> Part Time</option>
                                        <option value="3"  <?php if($data->duty_type ==3){
                                         echo 'selected';
                                        }?>> Contructual</option>
                                        <option value="4"  <?php if($data->duty_type ==4){
                                         echo 'selected';
                                        }?>> Other</option>
                                    </select>
                                    </div>
                                </div>


                                 <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="work_hour"><?php echo display('hire_date')?> <sup class="color-red ">*</sup></label>
                                        <input type="text" class="form-control datepicker" 
                                        name="hiredate" id="hiredate"  placeholder="Hire date" value="<?php echo $data->hire_date ?>">
                                    </div>
                                </div>

                                <!-- Earlier it was ohiredate but later renamed as 'Original Hire date' for client -->
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="work_hour"><?php echo "Joining Date"?> <sup class="color-red ">*</sup></label>
                                 
                                        <input type="text" class="form-control datepicker" 
                                        name="ohiredate" id="ohiredate" placeholder="Original Hire date" value="<?php echo $data->original_hire_date ?>">
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="work_hour"><?php echo display('termination_date')?> </label>
                                        <input type="text" class="form-control datepicker" 
                                        name="terminatedate" id="tdate" placeholder="Termination date" value="<?php echo $data->termination_date ?>">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="work_hour"><?php echo display('termination_reason')?> </label>
                                        <textarea class="form-control" 
                                        name="termreason" id="treason" placeholder="Termination Reason"><?php echo $data->termination_reason ?></textarea> 
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="period"><?php echo display('voluntary_termination')?></label>
                                        <select name="volunt_termination"  class="form-control" >
                                          <option value=""><?php echo display('select')?></option>
                                        <option value="1" <?php if($data->voluntary_termination ==1){
                                            echo 'selected';
                                        } ?>> Yes</option>
                                        <option value="2" <?php if($data->voluntary_termination ==2){
                                            echo 'selected';
                                        } ?>>No</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="work_hour"><?php echo display('re_hire_date')?> </label>
                                        <input type="text" class="form-control datepicker" 
                                        name="rehiredate" id="rhdate" placeholder="Rehire date" value="<?php echo $data->rehire_date ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="period"><?php echo display('rate_type')?> <sup class="color-red ">*</sup></label>

                                        <select name="rate_type" id="rate_type"  class="form-control" >
                                        <option value="1" <?php if($data->rate_type ==1){
                                            echo 'selected';
                                        }?>>Hourly</option>
                                        <option value="2" <?php if($data->rate_type ==2){
                                            echo 'selected';
                                        }?>>Salary</option>
                                    </select>
                                   <span id="rat_tp"></span>
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="work_hour"><?php echo display('s_rate')?><sup class="color-red ">*</sup></label>
                                        <input type="number" class="form-control" 
                                        name="rate" id="rate" placeholder="<?php echo display('s_rate')?>" value="<?php echo $data->rate; ?>">
                                        
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                  <div class="form-group form-group-margin">
                                    <label for="monthly_work_hours"><?php echo display('monthly_work_hours')?> <sup class="color-red ">*</sup></label>
                                      <input type="number" class="form-control" 
                                      name="monthly_work_hours" id="monthly_work_hours" placeholder="<?php echo display('monthly_work_hours')?>" value="<?php echo $data->monthly_work_hours; ?>">
                                  </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="period"><?php echo display('pay_frequency')?> <sup class="color-red ">*</sup></label><br>
                                        <select name="pay_frequency" id="pay_frequency"  class="form-control" >
                                        <option value="">Select Frequency</option>
                                        <option value="1" <?php if($data->pay_frequency ==1){
                                            echo 'selected';
                                        }?>>Weekly</option>
                                        <option value="2" <?php if($data->pay_frequency ==2){
                                            echo 'selected';
                                        }?>>Biweekly</option>
                                         <option value="4" <?php if($data->pay_frequency ==4){
                                            echo 'selected';
                                        }?>>Monthly</option>
                                        <option value="3" <?php if($data->pay_frequency ==3){
                                            echo 'selected';
                                        }?>>Annual</option>

                                    </select>
                                    <span id="frequ"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="work_hour"><?php echo display('pay_frequency_txt')?></label>
                                        <input type="text" class="form-control" 
                                        name="pay_f_text" id="qfre_text" placeholder="Paym Frequency text" value="<?php echo $data->pay_frequency_txt; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="work_hour"><?php echo display('hourly_rate2')?></label>
                                        <input type="number" class="form-control" 
                                        name="h_rate2" id="rate2" placeholder="Hourly Rate" value="<?php echo $data->hourly_rate2; ?>">
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="work_hour"><?php echo display('hourly_rate3')?></label>
                                        <input type="number" class="form-control" 
                                        name="h_rate3" id="rate3" placeholder="Hourly Rate" value="<?php echo $data->hourly_rate3; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="work_hour"><?php echo display('home_department')?></label>
                                        <input type="text" class="form-control" 
                                        name="h_department" id="rate3" placeholder="Hourly Rate" value="<?php echo $data->home_department; ?>">
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="work_hour"><?php echo display('department_text')?></label>
                                        <input type="text" class="form-control" 
                                        name="h_dep_text" id="hdptext" placeholder="Hourly Rate" value="<?php echo $data->department_text; ?>">
                                    </div>
                                </div>
                                 </div>
                                  </div>
                                   <div class="form-group form-group-margin text-right">
        <input type="button" class="btn btn-primary btnPrevious"  value="Previous">
             <input type="button" class="btn btn-primary btnNext" onclick="valid_inf2()" value="NEXT">
            
                        </div>
                                   </div>
                                    </div>
      </div>
    </div>

    <div id="menu2" class="tab-pane fade">
      <div class="row">
        <div class="col-sm-12 col-md-12 employee-form">
          <div class="panel">

          <div class="panel-body">

              <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group form-group-margin">
                          <label for="dfs"><?php echo "Medical"?></label>
                          <input type="number" class="form-control" id="medical_benefit"
                          name="medical_benefit"  placeholder="<?php echo "Medical"?>" value="<?php echo $employee_file->medical_benefit; ?>">
                      </div>
                  </div>
                   
                  <div class="col-sm-6">
                      <div class="form-group form-group-margin">
                          <label for="dfs"><?php echo "Family"?></label>
                          <input type="number" class="form-control" id="family_benefit"
                          name="family_benefit"  placeholder="<?php echo "Family"?>" value="<?php echo $employee_file->family_benefit; ?>">
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="form-group form-group-margin">
                          <label for="dfs"><?php echo "Transportation"?></label>
                          <input type="number" class="form-control" id="transportation_benefit"
                          name="transportation_benefit"  placeholder="<?php echo "Transportation"?>" value="<?php echo $employee_file->transportation_benefit; ?>">
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="form-group form-group-margin">
                          <label for="dfs"><?php echo "Others"?></label>
                          <input type="number" class="form-control" id="other_benefit"
                          name="other_benefit"  placeholder="<?php echo "Others"?>" value="<?php echo $employee_file->other_benefit; ?>">
                      </div>
                  </div>

                </div>

                <div class="form-group form-group-margin text-right">
                   
                  <input type="button" class="btn btn-primary btnPrevious"  value="Previous">
                  <input type="button" class="btn btn-primary btnNext" onclick="valid_inf3()" value="NEXT">
                </div>
            
          </div>  
          </div>
        </div>
      </div>
    </div>
 
            <div id="classmenu" class="tab-pane fade">
      <div class="row">
        <div class="col-sm-12 col-md-12 employee-form">
            <div class="panel">
                
                <div class="panel-body">

                    <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="dfs"><?php echo display('class_code')?></label>
                                        <input type="text" class="form-control" id="c_code"
                                        name="c_code"  placeholder="<?php echo display('class_code')?>" value="<?php echo $data->class_code; ?>">
                                    </div>
                                </div>
                                 
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="l_name"><?php echo display('class_descript')?></label>
                                        <input type="text" class="form-control" id="c_code_d"
                                        name="c_code_d" placeholder="<?php echo display('class_descript')?>" value="<?php echo $data->class_code_desc; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="l_name"><?php echo display('class_acc_date')?> </label>
                                        <input type="text" class="form-control datepicker" id="class_acc_date"
                                        name="class_acc_date" placeholder="<?php echo display('class_acc_date')?>" value="<?php echo $data->class_acc_date; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="status"><?php echo display('class_sta')?> <sup class="color-red "></sup></label>
                                        <select name="class_sst"  class="form-control" >
                                        <option value="1" <?php if($data->class_status==1){
                                          echo 'selected';
                                        }?>>Active</option>
                                        <option value="2" <?php if($data->class_status==2){
                                          echo 'selected';
                                        }?>>Inactive</option>
                                    </select>
                                    </div>
                                </div>
                               

                            </div>

                        <div class="form-group form-group-margin text-right">
                           
                          <input type="button" class="btn btn-primary btnPrevious"  value="Previous">
             <input type="button" class="btn btn-primary btnNext" onclick="valid_class()" value="NEXT">
                        </div>
                   

                </div>  
            </div>
        </div>
    </div>
    </div>
    <div id="menu3" class="tab-pane fade">
      <div class="row">
        <div class="col-sm-12 col-md-12 employee-form">
            <div class="panel">
                
                <div class="panel-body">

                    <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="s_name"><?php echo display('super_visor_name')?></label>
                                       <select name="supervisorname"  class="form-control" >
                                        <option value="">Select One</option>
                                        <option value="self" <?php if($data->super_visor_id=='self'){echo 'selected';}?>>Self</option>
                                        <?php foreach ($supervisor as $suplist) {?>
                                        <option value="<?php echo $suplist->employee_id?>" <?php if($data->super_visor_id==$suplist->employee_id){
                                            echo 'selected';
                                        }?>><?php echo $suplist->first_name.' '.$suplist->last_name?></option>
                                        <?php } ?>
                                    </select>
                                    </div>
                                </div>
                                
                                <!-- Earlier it was is_supervisor but later renamed as 'Ist Supervisor' for client -->
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="l_name"><?php echo "Ist Supervisor";?></label>
                                       <select name="is_supervisor"  class="form-control" >
                                        <option value="0" <?php if($data->is_super_visor==0){
                                            echo 'selected';
                                        }?>>No</option>
                                        <option value="1" <?php if($data->is_super_visor==1){
                                            echo 'selected';
                                        }?>>Yes</option>
                                    </select>
                                    </div>
                                </div>

                                <!-- Earlier it was reports but later renamed as 'Reporting To' for client -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reports"><?php echo "Reporting To";?> </label>
                                        <input type="text" class="form-control" id="benifit_acc_date"
                                        name="reports" placeholder="Reports" value="<?php echo $data->supervisor_report;?>">
                                    </div>
                                </div>

                            </div>

                        <div class="form-group form-group-margin text-right">
                           
                           <input type="button" class="btn btn-primary btnPrevious"  value="Previous">
             <input type="button" class="btn btn-primary btnNext" onclick="valid_inf4()" value="NEXT">
                        </div>
                   

                </div>  
            </div>
        </div>
    </div>
    </div>
    <div id="menu4" class="tab-pane fade">
        <div class="row">
        <div class="col-sm-12 col-md-12 employee-form">
            <div class="panel">
                
                <div class="panel-body">

                    <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="s_name"><?php echo display('dob')?><sup class="color-red ">*</sup></label>
                                        <input type="text" class="form-control datepicker" id="dob"
                                        name="dob" placeholder="Date Of Birth" value="<?php echo $data->dob;?>">
                                    </div>
                                </div>
                                 
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="gender"><?php echo display('gender')?><sup class="color-red ">*</sup></label>
                                       <select name="gender" id="gender" class="form-control" >
                                        <option value="1" <?php if($data->gender==1){
                                            echo 'selected';
                                        }?>>Male</option>
                                        <option value="2" <?php if($data->gender==2){
                                            echo 'selected';
                                        }?>>Female</option>
                                        <option value="2" <?php if($data->gender==3){
                                            echo 'selected';
                                        }?>>Other</option>
                                    </select>
                                              <span id="gend"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="reports"><?php echo display('marital_stats')?> </label>
                                       <select name="marital_status"  class="form-control" >
                                        <option value="1" <?php if($data->marital_status==1){
                                            echo 'selected';
                                        }?>>Single</option>
                                        <option value="2" <?php if($data->marital_status==2){
                                            echo 'selected';
                                        }?>>Married</option>
                                        <option value="3" <?php if($data->marital_status==3){
                                            echo 'selected';
                                        }?>>Divorced</option>
                                        <option value="4" <?php if($data->marital_status==4){
                                            echo 'selected';
                                        }?>>Widowed</option>
                                        <option value="5" <?php if($data->marital_status==5){
                                            echo 'selected';
                                        }?>>Other</option>
                                    </select>
                                    </div>
                                </div>
                              <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="s_name"><?php echo display('ethnic_group')?></label>
                                        <input type="text" class="form-control" id="ethnic"
                                        name="ethnic" placeholder="Ethnic" value="<?php echo $data->ethnic_group;?>">
                                    </div>
                                </div>
                                 <div class="col-sm-6" style="display:none;">
                                    <div class="form-group form-group-margin">
                                        <label for="eeo_class"><?php echo display('eeo_class_gp')?></label>
                                        <input type="text" class="form-control" id="eeo_class"
                                        name="eeo_class" placeholder="EEO Class Group" value="<?php echo $data->eeo_class_gp;?>">
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="sos"><?php echo display('sos')?> <sup class="color-black">*</sup></label>
                                        <input type="text" class="form-control" id="sos"
                                        name="sos" placeholder="SOS" value="<?php echo $data->sos;?>">

                                    </div>
                                </div>

                                <!-- Earlier it was work_in_state but later renamed as 'Work in City' for client -->
                                 <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="w_s"><?php echo "Work in City";?></label>



                                      <input type="text" class="form-control" id="w_s" name="w_s" placeholder="<?php echo "Work in City";?>" value="<?php echo $data->work_in_state;?>">

                                    </div>
                                </div>

                                <!-- Earlier it was live_in_state but later renamed as 'City of Residence' for client -->
                                 <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="l_in_s"><?php echo "City of Residence";?></label>
                                       <select name="l_in_s"  class="form-control" >
                                        <option value="1" <?php if($data->live_in_state==1){
                                            echo 'selected';
                                        }?>>Yes</option>
                                        <option value="2" <?php if($data->live_in_state==2){
                                            echo 'selected';
                                        }?>>No</option>
                                    </select>
                                    </div>
                                </div>

                                <!-- Earlier it was citizenship but later renamed as 'Work Permit' for client -->
                                 <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="citizenship"><?php echo "Work Permit";?></label>
                                         <select name="citizenship"  class="form-control" >
                                          <option value="">Select</option>
                                        <option value="1" <?php if($data->citizenship==1){
                                          echo 'selected';
                                        }?>> Yes</option>
                                        <option value="0" <?php if($data->citizenship==0){
                                          echo 'selected';
                                        }?>> No</option>
                                    </select>
                                    </div>
                                </div>

                                  <div class="col-sm-6">
                                <label for="picture"><?php echo display('picture')?></label>
                               <input type="file" accept="image/*" name="picture" onchange="loadFile(event)">
                                <small id="fileHelp" class="text-muted"><img src="<?php if($data->picture){echo base_url().$data->picture;}else{echo base_url().'assets/img/user/default.jpg';} ?>" id="output" class="img-thumbnail img-preview"/>
</small>
<input type="hidden" name="old_image" value="<?php echo $data->picture;?>">
                            </div>

                            </div>

                        <div class="form-group form-group-margin text-right">
                           
                           <input type="button" class="btn btn-primary btnPrevious"  value="Previous">
             <input type="button" class="btn btn-primary btnNext" onclick="valid_inf5()" value="NEXT">
                        </div>
                   

                </div>  
            </div>
        </div>
    </div>
    </div>
      <div id="menu5" class="tab-pane fade">
      <div class="row">
        <div class="col-sm-12 col-md-12 employee-form">
            <div class="panel">
                
                <div class="panel-body">

                    <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="s_name"><?php echo display('home_email')?></label>
                                       <input type="email" class="form-control" id="h_email"
                                        name="h_email" placeholder="Home Email" value="<?php echo $data->home_email;?>">
                                        <span id="h_email_v_message"></span>
                                    </div>
                                </div>
                                 
                               <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="b_email"><?php echo display('business_email')?></label>
                                       <input type="email" class="form-control" id="b_email"
                                        name="b_email" placeholder="Business Email" value="<?php echo $data->business_email;?>">
                                        <span id="b_email_v_message"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="h_phone"><?php echo display('home_phone')?> <sup class="color-red ">*</sup></label>
                                        <input type="number" class="form-control" id="h_phone"
                                        name="h_phone" placeholder="Home Phone" value="<?php echo $data->home_phone;?>">
                                    
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="w_phone"><?php echo display('business_phone')?> </label>
                                        <input type="number" class="form-control" id="w_phone"
                                        name="w_phone" placeholder="Work Phone" value="<?php echo $data->business_phone;?>">
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="c_phone"><?php echo display('cell_phone')?> <sup class="color-red ">*</sup></label>
                                     
                                        <input type="number" class="form-control" id="c_phone"
                                        name="c_phone" placeholder="Cell Phone" value="<?php echo $data->cell_phone;?>">
                                         
                                    </div>
                                </div>
                            </div>

                        <div class="form-group form-group-margin text-right">
                           
                           <input type="button" class="btn btn-primary btnPrevious"  value="Previous">
             <input type="button" class="btn btn-primary btnNext" onclick="valid_inf6()" value="NEXT">
                        </div>
                   

                </div>  
            </div>
        </div>
    </div>
    </div>
       <div id="menu6" class="tab-pane fade">
      <div class="row">
        <div class="col-sm-12 col-md-12 employee-form">
            <div class="panel">
                
                <div class="panel-body">

                    <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="s_name"><?php echo "Emergency Contact Person";?> <sup class="color-red ">*</sup></label>
                                       <input type="text" class="form-control" id="em_contact_person"
                                        name="em_contact_person" placeholder="Emergency Contact Person" value="<?php echo $data->em_contact_person;?>">
                                         
                                    </div>
                                </div>

                                <!-- Earlier it was e_c_relation but later renamed as 'Emergency Contact Relationship' for client -->
                                 <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="e_c_relation"><?php echo "Emergency Contact Relationship";?> </label>
                                        <input type="text" class="form-control" id="e_c_relation"
                                        name="e_c_relation" placeholder="<?php echo "Emergency Contact Relationship";?>" value="<?php echo $data->emgr_contct_relation;?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="s_name"><?php echo display('emerg_contct')?> <sup class="color-red ">*</sup></label>
                                       <input type="number" class="form-control" id="em_contact"
                                        name="em_contact" placeholder="<?php echo display('emerg_contct')?>" value="<?php echo $data->emerg_contct;?>">
                                         
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="alt_em_cont"><?php echo display('alt_em_contct')?></label>
                                       <input type="text" class="form-control" id="alt_em_cont"
                                        name="alt_em_cont" placeholder="Alter Emergency Contact" value="<?php echo $data->alt_em_contct;?>">
                                    </div>
                                </div>
                                 
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="e_h_phone"><?php echo display('emerg_home_phone')?> <sup class="color-red ">*</sup></label>
                               
                                        <input type="number" class="form-control" id="e_h_phone"
                                        name="e_h_phone" placeholder="Emergency Home Phone" value="<?php echo $data->emrg_h_phone;?>">
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="a_e_h_phone"><?php echo display('alt_emg_h_phone')?> </label>
                                        <input type="number" class="form-control" id="a_e_h_phone"
                                        name="a_e_h_phone" placeholder="<?php echo display('alt_em_contct')?>" value="<?php echo $data->alt_emg_h_phone;?>">
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="e_w_phone"><?php echo display('emrg_w_phone')?> <sup class="color-red ">*</sup></label>
                                        <input type="number" class="form-control" id="e_w_phone"
                                        name="e_w_phone" placeholder="Emergency Work Phone" value="<?php echo $data->emrg_w_phone;?>">
                                         
                                    </div>
                                </div>
                                 
                                 <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="a_e_w_phone"><?php echo display('alt_emg_w_phone')?> </label>
                                        <input type="number" class="form-control" id="a_e_w_phone"
                                        name="a_e_w_phone" placeholder="Alt Emergency Work Phone" value="<?php echo $data->alt_emg_w_phone;?>">
                                    </div>
                                </div>
                            </div>

                        <div class="form-group form-group-margin text-right">
                            <input type="button" class="btn btn-primary btnPrevious"  value="Previous">
                            <input type="button" class="btn btn-primary" value="Next" onclick="valid_inf7()">
                        </div>
                   
                </div>  
            </div>
        </div>
    </div>
    </div>
        <div id="menu7" class="tab-pane fade">
      <div class="row">
        <div class="col-sm-12 col-md-12 employee-form">
            <div class="panel">
                
                <div class="panel-body">
                    <span>
                    <?php foreach($custominfo as $custom){ ?>
                          <div class="row">
                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="c_f_name"><?php echo 'Custom Field Name';?></label>
                                        <input type="text" class="form-control" id="c_f_name"
                                        name="c_f_name[]" value="<?php echo $custom->custom_field; ?>" placeholder="Custom Field Name">
                                    </div>
                                </div>
                                 
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="c_f_type"><?php echo 'Custom Field Type';?></label>
                                       <select name="c_f_type[]"  class="form-control">
                                        <option value="1" <?php if($custom->custom_data_type==1){ 
                                            echo 'selected';
                                        } ?>>Text</option>
                                        <option value="2" <?php if($custom->custom_data_type==2){ 
                                            echo 'selected';
                                        } ?>>Date</option>
                                        <option value="3" <?php if($custom->custom_data_type==3){ 
                                            echo 'selected';
                                        } ?>>Text Area</option>
                                    </select>
                                    </div>
                                </div>
                            
                                <div class="col-sm-12">
                                    <div class="form-group form-group-new form-group-margin-left">
                                        <label for="reports"><?php echo 'Custom Value'?> </label>
                                            <input type="text" name="customvalue[]" class="form-control" placeholder="custom value" value="<?php echo $custom->custom_data; ?>">

                                    </div>
                                </div>
                   
                            </div>

                    <?php } ?>
                     <?php if(empty($custominfo)){ ?>
                            <div class="row">
                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="c_f_name"><?php echo 'Custom Field Name';?></label>
                                        <input type="text" class="form-control" id="c_f_name"
                                        name="c_f_name[]" value="<?php echo @$custom->custom_field; ?>" placeholder="Custom Field Name">
                                    </div>
                                </div>
                                 
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="c_f_type"><?php echo 'Custom Field Type';?></label>
                                       <select name="c_f_type[]"  class="form-control">
                                        <option value="1" <?php if(@$custom->custom_data_type==1){ 
                                            echo 'selected';
                                        } ?>>Text</option>
                                        <option value="2" <?php if(@$custom->custom_data_type==2){ 
                                            echo 'selected';
                                        } ?>>Date</option>
                                        <option value="3" <?php if(@$custom->custom_data_type==3){ 
                                            echo 'selected';
                                        } ?>>Text Area</option>
                                    </select>
                                    </div>
                                </div>
                            
                                <div class="col-sm-12">
                                    <div class="form-group form-group-new form-group-margin-left">
                                        <label for="reports"><?php echo 'Custom Value'?> </label>
                                            <input type="text" name="customvalue[]" class="form-control" placeholder="custom value" value="<?php echo @$custom->custom_data; ?>">

                                    </div>
                                </div>
                   
                            </div>
                      <?php } ?>
                      </span>
                     
                         <div id="add" class="toggle">
                            <span>
                      <div class="row">
                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="c_f_name"><?php echo 'Custom Field Name';?></label>
                                        <input type="text" class="form-control" id="c_f_name"
                                        name="c_f_name[]" placeholder="Custom Field Name">
                                    </div>
                                </div>
                                 
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="c_f_type"><?php echo 'Custom Field Type';?></label>
                                       <select name="c_f_type[]"  class="form-control">
                                        <option value="1">Text</option>
                                        <option value="2">Date</option>
                                        <option value="3">Text Area</option>
                                    </select>
                                    </div>
                                </div>
                            
                                <div class="col-sm-12">
                                    <div class="form-group form-group-new form-group-margin-left">
                                        <label for="reports"><?php echo 'Custom Value'?> </label>
                                            <input type="text" name="customvalue[]" class="form-control" placeholder="custom value">

                                    </div>
                                </div>
                   
                            </div>
                        </span>
                              <div id="add" class="toggle">
                                <span>
                      <div class="row">
                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="c_f_name"><?php echo 'Custom Field Name';?></label>
                                        <input type="text" class="form-control" id="c_f_name"
                                        name="c_f_name[]" placeholder="Custom Field Name">
                                    </div>
                                </div>
                                 
                                <div class="col-sm-6">
                                    <div class="form-group form-group-margin">
                                        <label for="c_f_type"><?php echo 'Custom Field Type';?></label>
                                       <select name="c_f_type[]"  class="form-control">
                                        <option value="1">Text</option>
                                        <option value="2">Date</option>
                                        <option value="3">Text Area</option>
                                    </select>
                                    </div>
                                </div>
                            
                                <div class="col-sm-12">
                                    <div class="form-group form-group-new form-group-margin-left">
                                        <label for="reports"><?php echo 'Custom Value'?> </label>
                                            <input type="text" name="customvalue[]" class="form-control" placeholder="custom value">

                                    </div>
                                </div>
                   
                            </div>
                        </span>
                  </div>
                  </div>

                        <div class="form-group form-group-margin text-right">
                          <input type="button" class="btn btn-primary btnPrevious"  value="Previous">  
                         <input type="button" class="btn btn-primary btnNext" onclick="valid_inf_custom()" value="NEXT"> 
                        </div>
                   

                </div>  
            </div>
        </div>
    </div>
    </div>
    <div id="menu8" class="tab-pane fade">
  <div class="row">
    <div class="col-sm-12 col-md-12 employee-form">
      <div class="panel">
        
        <div class="panel-body">

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="s_name"><?php echo display('user_email')?> <sup class="color-red ">*</sup></label>
         
                 <input type="email" class="form-control" id="user_email"
                 name="user_email" readonly="" placeholder="<?php echo display('user_email')?>" value="<?php echo $data->email;?>">
                 <input type="hidden" name="old_useremail" value="<?php echo $data->email;?>">
              
             </div>
           </div>
         </div>
            <div class="row">
           <div class="col-sm-6">
            <div class="form-group">
              <label for="e_h_phone"><?php echo display('password')?> <sup class="color-red "></sup></label>
                <input type="password" class="form-control" id="password"
                name="password" placeholder="<?php echo display('password')?>">
                <input type="hidden" name="old_password" value="<?php echo $data->password;?>">
            </div>
          </div>
      
        </div>

 
        <div class="form-group form-group-margin text-right">
          <input type="button" class="btn btn-primary btnPrevious"  value="Previous">
          <input type="button" class="btn btn-success" onclick="valid_inf8()" value="Update">
        </div>
        
      </div>  
    </div>
  </div>
</div>
</div>
  <?php echo form_close() ?>
  </div>
</div>
</div>
<script src="<?php echo base_url('assets/js/employee.js') ?>" type="text/javascript"></script>
<script src="<?php echo MOD_URL.'employee/assets/js/employee_ammendmends.js'; ?>" type="text/javascript"></script>