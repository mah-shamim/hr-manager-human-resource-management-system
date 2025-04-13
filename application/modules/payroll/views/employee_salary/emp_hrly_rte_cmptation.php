<link href="<?php echo MOD_URL.'payroll/assets/css/horly_rate_computation.css'; ?>" rel="stylesheet" type="text/css"/>  

<div class="row">
 <div class="col-sm-12 col-md-12">
    <div class="panel panel-bd">
        <div class="panel-heading" >
            <div class="panel-title">
                <h3><?php echo $title; ?></h3>
            </div>
        </div>
        <div class="panel-body hrly_rate_computaiton">

            <div class="text-right" id="print">

               <button type="button" class="btn btn-warning" id="btnPrint" onclick="printPageArea('printArea');"><i class="fa fa-print"></i></button>

               <a href="<?php echo base_url($pdf)?>" target="_blank" title="download pdf">
                    <button  class="btn btn-success btn-md" name="btnPdf" id="btnPdf" ><i class="fa-file-pdf-o"></i> PDF</button>
                </a>
                
            </div>

            <br>

            <div id="printArea">

            <div>

                <div class="row mb-10">
                    <table class="table" width="99%">
                        <thead>
                            <tr>
                                <td align="center" class="text-center logo-image">
                                    <img src="<?php echo base_url('/').$setting->logo;?>">
                                </td>
                            </tr>
                            <tr>
                                <th align="center" class="text-center fs-20 hrly_rate_computaiton_title"><?php echo $title.' for '.$salary_sheet_generate_info->name; ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <?php

                $curncy_symbol = '';
                $social_security_tax_percnt = '';
                if(!empty($setting->currency_symbol)){
                    $curncy_symbol = '('.$setting->currency_symbol.')';
                    $social_security_tax_percnt = $setting->soc_sec_npf_tax;
                }

                ?>

                <table width="99%" class="payrollDatatableReport table table-striped table-bordered table-hover">

                    <thead bgcolor="#E7E0EE">

                      <tr>
                        <th class="text-left" width="3%">Employee ID</th>
                        <th class="text-left" width="7%">Employee Name</th>
                        <th class="text-left" width="8%">Basic Salary</th>
                        <th class="text-left" width="6%">Total Benefit</th>
                        <th class="text-left" width="9%">Transport Allowance</th>
                        <th class="text-left" width="9%">Normal Working Hrs/Mth</th>
                        <th class="text-left" width="9%">Actual Working Hrs/Mth</th>
                        <th class="text-left" width="5%">Overtime</th>
                        <th class="text-left" width="8%">Hourly Rate(Basic)</th>
                        <th class="text-left" width="9%">Hourly Rate(Transport Allowance)</th>
                        <th class="text-left" width="8%">Basic Salary(Pro-Rated)</th>
                        <th class="text-left" width="9%">Transport Allowance(Pro-Rated)</th>
                        <th class="text-left" width="10%">Basic+Transport Allowance</th>
                      </tr>

                    </thead>

                    <tbody class="employee_salary_chart">

                       <?php 

                      $i = 1;
                      $total_benefits = 0.0;

                      foreach ($hourly_rate_computations as $key => $row) {

                        $total_benefits = floatval($row->medical_benefit) + floatval($row->family_benefit) + floatval($row->transportation_benefit) + floatval($row->other_benefit);;

                        $overtime = 0.0;
                        if(floatval($row->actual_working_hrs_month) > floatval($row->normal_working_hrs_month)){

                            $overtime = floatval($row->actual_working_hrs_month) - floatval($row->normal_working_hrs_month);
                        }

                      ?>

                      <tr>
                        <td class="text-left"><?php echo $row->employee_id;?></td>
                        <td class="text-left"><?php echo $row->first_name.' '.$row->last_name;?></td>
                        <td class="text-left"><?php echo $setting->currency_symbol.' '.$row->basic;?></td>
                        <td class="text-left"><?php echo $setting->currency_symbol.' '.$total_benefits;?></td>
                        <td class="text-left"><?php echo $setting->currency_symbol.' '.$row->transport;?></td>
                        <td class="text-left"><?php echo $row->normal_working_hrs_month;?></td>
                        <td class="text-left"><?php echo $row->actual_working_hrs_month;?></td>
                        <td class="text-left"><?php echo $overtime;?></td>
                        <td class="text-left"><?php echo $setting->currency_symbol.' '.$row->hourly_rate_basic;?></td>
                        <td class="text-left"><?php echo $setting->currency_symbol.' '.$row->hourly_rate_trasport_allowance;?></td>
                        <td class="text-left"><?php echo $setting->currency_symbol.' '.$row->basic_salary_pro_rated;?></td>
                        <td class="text-left"><?php echo $setting->currency_symbol.' '.$row->transport_allowance_pro_rated;?></td>
                        <td class="text-left"><?php echo $setting->currency_symbol.' '.$row->basic_transport_allowance;?></td>
                      </tr>

                      <?php

                      $i++;

                      }

                      ?>
                      
                    </tbody>
                </table>

                <br>

                <tfoot>
                   <tr >
                    <td colspan="13" class="noborder">
                        <table border="0" width="100%" class="hrly_rate_computaiton_footer">                                                
                        <tr>
                            <td align="left" class="noborder" width="30%">
                                <div class="border-top"><?php echo display('prepared_by')?>: <b><?php echo $user_info['fullname'];?><b></div>
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

              </div>

            </div>

       </div>
    </div>
   </div>
</div>

<script src="<?php echo MOD_URL.'payroll/assets/js/horly_rate_computation.js'; ?>" type="text/javascript"></script>